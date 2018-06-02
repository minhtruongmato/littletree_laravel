<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Blog;
use App\BlogCategory;
use Response;
use Session;
use File;

class BlogController extends Controller
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
        $blog = DB::table('blog')
            ->select('*')
            ->where('is_deleted',0)
            ->paginate(10);
        foreach ($blog as $key => $value) {
                $sub = BlogCategory::find($value->category_id);
                $blog[$key]->sub = $sub->title;
        }
        return view('admin/blog/index', ['blog' => $blog]);
    }

    /**
     * Display a listing of the advise.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display a listing of the news.
     *
     * @return \Illuminate\Http\Response
     */
    public function news(){
        $news = DB::table('blog')
            ->select('*')
            ->where('type', '=', 1)
            ->where('is_deleted', '=', 0)
            ->paginate(10);
        return view('admin/blog/news', [
            'type' => 'news',
            'news' => $news
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $type
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $blog_category_list = BlogCategory::where('is_deleted',0)->get();
        $new_blog_category = $this->buildArrayForDropdown($blog_category_list);
        unset($new_blog_category[0]);
        $categories = $new_blog_category;
        return view('admin/blog/create', [
                'categories' => $categories
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if($request->category_id == ''){
            Session::flash('error','Bạn phải chọn danh mục cha');
            return redirect()->intended('admin/blog/create');
        }
        $uniqueSlug = $this->buildUniqueSlug('blog', null, $request->slug);
        $path = $request->file('image')->store('blog');
        $keys = ['title', 'category_id', 'content'];
        $input = $this->createQueryInput($keys, $request);
        $input['image'] = $path;
        $input['slug'] = $uniqueSlug;
        if(Blog::create($input)){
            Session::flash('success','Thêm mới bài viết thành công');
            return redirect()->intended('admin/blog');
        }
        Session::flash('error','Thêm mới bài viết thất bại');
        return redirect()->intended('admin/blog');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $blog = Blog::find($id);
        if ($blog == null) {
            Session::flash('error','Blog không tồn tại');
            return redirect()->intended('admin/blog');
        }
        $blog_category_list = BlogCategory::where('is_deleted',0)->get();
        $new_blog_category = $this->buildArrayForDropdown($blog_category_list);
        unset($new_blog_category[0]);
        $blog->new_blog_category = $new_blog_category;
        return view('admin/blog/edit', [
            'blog' => $blog
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
        $blog = Blog::findOrFail($id);
        $this->validateInput($request);
        $uniqueSlug = $this->buildUniqueSlug('blog', $request->id, $request->slug);
        $keys = ['title', 'content'];
        $input = $this->createQueryInput($keys, $request);
        $input['slug'] = $uniqueSlug;
        // Upload image
        if($request->file('image')){
            $path = $request->file('image')->store('blog');
            $input['image'] = $path;
        }
        if(Blog::where('id', $id)->update($input) == 1){
            Session::flash('success','Sửa danh mục thành công');
            return redirect()->intended('admin/blog');
        }
        Session::flash('error','Lỗi sửa danh mục');
        return redirect()->intended('admin/blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $blog = Blog::findOrFail($id);
        if(Blog::where('id', $id)->update(['is_deleted' => 1])){
            Session::flash('success','Xóa bài viết thành công');
            return redirect()->intended('admin/blog');
        }
        Session::flash('error','Lỗi xóa bài viết');
        return redirect()->intended('admin/blog');
    }

    public function search(Request $request){
        $constraints = [
            'title' => $request['title']
        ];
        $blog = $this->doSearchingQuery($constraints);
        foreach ($blog as $key => $value) {
            $sub = BlogCategory::find($value->category_id);
            $blog[$key]->sub = $sub->title;
        }
        return view('admin/blog/index', ['blog' => $blog, 'searchingVals' => $constraints]);
    }

/*    public function getCategoryByType($type){
        $categories = DB::table('blog_category')
            ->select('*')
            ->where('type', '=', ($type == 'advise') ? 0 : 1)
            ->where('is_deleted', '=', 0)
            ->get();
        $arrayCategories = [];
        foreach($categories as $item){
            $arrayCategories[$item->id] = $item->title;
        }

        return $arrayCategories;
    }*/

    private function doSearchingQuery($constraints){
        $query = DB::table('blog')
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
