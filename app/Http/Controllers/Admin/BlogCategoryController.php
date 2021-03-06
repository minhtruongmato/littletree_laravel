<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\BlogCategory;
use App\Blog;
use Response;
use Session;
use File;

class BlogCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $categories = DB::table('blog_category')
            ->select('*')
            ->where('is_deleted',0)
            ->paginate(10);
        foreach ($categories as $key => $value) {
            $categories[$key]->sub = 'Danh mục gốc';
            if($value->parent_id !=0){
                $sub = BlogCategory::find($value->parent_id);
                $categories[$key]->sub = $sub->title;
            }
        }
        return view('admin/blog-category/index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $blog_category_list = BlogCategory::where('is_deleted',0)->get();
        $new_blog_category = $this->buildArrayForDropdown($blog_category_list);
        $blog_category = $new_blog_category;
        return view('admin/blog-category/create', [
                'blog_category' => $blog_category
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validateInput($request);
        $uniqueSlug = $this->buildUniqueSlug('blog_category', null, $request->slug);
        $keys = ['title','parent_id'];
        $input = $this->createQueryInput($keys, $request);
        $input['slug'] = $uniqueSlug;
        // Not implement yet
        if(BlogCategory::create($input)){
            Session::flash('success','Thêm mới danh mục blog thành công');
            return redirect()->intended('admin/blog-category');
        }
        Session::flash('error','Thêm mới danh mục blog thất bại');
        return redirect()->intended('admin/blog-category');
    }
    public function edit($id){
        $blog_category = BlogCategory::find($id);
        if ($blog_category == null) {
            Session::flash('error','Danh mục không tồn tai');
            return redirect()->intended('admin/blog-category'); 
        }
        $blog_category_list = BlogCategory::where('is_deleted',0)->get();
        $new_blog_category = $this->buildArrayForDropdown($blog_category_list);
        unset($new_blog_category[$id]);
        $blog_category->new_blog_category = $new_blog_category;
        return view('admin/blog-category/edit', [
            'blog_category' => $blog_category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $blog_category = BlogCategory::findOrFail($id);
        $this->validateInput($request);
        $uniqueSlug = $this->buildUniqueSlug('blog_category', $request->id, $request->slug);
        $keys = ['title','parent_id'];
        $input = $this->createQueryInput($keys, $request);
        $input['slug'] = $uniqueSlug;
        if(BlogCategory::where('id', $id)->update($input) == 1){
            Session::flash('success','Sửa danh mục thành công');
            return redirect()->intended('admin/blog-category');
        }
        Session::flash('error','Lỗi sửa danh mục');
        return redirect()->intended('admin/blog-category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $count = BlogCategory::where('id',$id)->where('is_deleted',0)->count();
        if($count == 1){
            $check_parent = BlogCategory::where('parent_id',$id)->where('is_deleted',0)->count();
            if($check_parent == 0){
                $check_blog = Blog::where('category_id',$id)->where('is_deleted',0)->count();
                if($check_blog == 0){
                    if(BlogCategory::where('id', $id)->update(['is_deleted' => 1]) == 1){
                        Session::flash('success','Xóa danh mục thành công');
                        return redirect()->intended('admin/blog-category');
                    }
                    Session::flash('error','Lỗi không thể xóa');
                    return redirect()->intended('admin/blog-category');
                }
                Session::flash('error','Danh mục blog có chứa '.$check_blog.' bài viết không thể xóa');
                return redirect()->intended('admin/blog-category');
            }
            Session::flash('error','Danh mục blog chứa '.$check_parent.' danh mục con không thể xóa');
            return redirect()->intended('admin/blog-category');
        }
        Session::flash('error','Danh mục blog không tồn tại');
        return redirect()->intended('admin/blog-category');
    }

    /**
     * Search state from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $constraints = [
            'title' => $request['title']
        ];
        $categories = $this->doSearchingQuery($constraints);
        foreach ($categories as $key => $value) {
            $categories[$key]->sub = 'Danh mục gốc';
            if($value->parent_id !=0){
                $sub = BlogCategory::find($value->parent_id);
                $categories[$key]->sub = $sub->title;
            }
        }
        return view('admin/blog-category/index', ['categories' => $categories, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints){
        $query = DB::table('blog_category')
            ->select('*')
            ->where('is_deleted',0)
            ->where('title', 'like', '%' . $constraints['title'] . '%');
        return $query->paginate(10);
    }   

    private function validateInput($request) {
        $this->validate($request, [
            'title' => 'required|max:60',
//            'price' => 'required|max:60',
//            'middlename' => 'required|max:60',
//            'address' => 'required|max:120',
//            'city_id' => 'required',
//            'state_id' => 'required',
//            'country_id' => 'required',
//            'zip' => 'required|max:10',
//            'age' => 'required',
//            'birthdate' => 'required',
//            'date_hired' => 'required',
//            'department_id' => 'required',
//            'division_id' => 'required'
        ]);
    }
    protected function buildArrayForDropdown($data = array()){
        $new_data = array(0 => 'Danh mục gốc');
        foreach ($data as $key => $value) {
            $new_data[$value['id']] = $value['title'];
        }
        return $new_data;
    }
}
