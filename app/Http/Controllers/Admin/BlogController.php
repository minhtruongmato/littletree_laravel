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
        //
    }

    /**
     * Display a listing of the advise.
     *
     * @return \Illuminate\Http\Response
     */
    public function advise(){
        $advises = DB::table('blog')
            ->select('*')
            ->where('type', '=', 0)
            ->where('is_deleted', '=', 0)
            ->paginate(10);
        $categories = $this->getCategoryByType('advise');
        return view('admin/blog/advise', [
            'type' => 'advise',
            'categories' => $categories,
            'advises' => $advises
        ]);
    }

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
        $type = Input::get('type');
        $categories = $this->getCategoryByType($type);
        return view('admin/blog/create', [
            'type' => $type,
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
        $type = Input::get('type');
        $uniqueSlug = $this->buildUniqueSlug('blog', null, $request->slug);

        // Upload image
        $path = $request->file('image')->store(($type == 'advise') ? 'advises' : 'news');
        $keys = ['title', 'category_id', 'description', 'content'];
        $input = $this->createQueryInput($keys, $request);
        $input['type'] = ($type == 'advise') ? 0 : 1;
        $input['image'] = $path;
        $input['slug'] = $uniqueSlug;
        // Not implement yet
        Blog::create($input);

        return redirect()->intended(($type == 'advise') ? 'admin/advise' : 'admin/news');
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
        // Redirect to product list if updating product wasn't existed
        if ($blog == null || count($blog) == 0) {
            return redirect()->intended(($blog->type == 0) ? 'admin/advise' : 'admin/news');
        }
        return view('admin/blog/edit', [
            'type' => ($blog->type == 0) ? 'advise' : 'news',
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


        $keys = ['title', 'description', 'content'];
        $input = $this->createQueryInput($keys, $request);
        $input['slug'] = $uniqueSlug;

        // Upload image
        if($request->file('image')){
            $path = $request->file('image')->store(($blog->type == 'advise') ? 'advises' : 'news');
            $input['image'] = $path;
        }

        Blog::where('id', $id)
            ->update($input);

        return redirect()->intended(($blog->type == 0) ? 'admin/advise' : 'admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $blog = Blog::findOrFail($id);
        Blog::where('id', $id)->update(['is_deleted' => 1]);
        return redirect()->intended(($blog->type == 0) ? 'admin/advise' : 'admin/news');
    }

    public function search(Request $request){
        $blogs = $this->doSearchingQuery($request);
        $key = ($request['type'] == 'advise') ? 'advises' : 'news';

        return view(($request['type'] == 'advise') ? 'admin/blog/advise' : 'admin/blog/news', [
            'type' => $request['type'],
            $key => $blogs,
            'searchingVals' => $request
        ]);
    }

    public function getCategoryByType($type){
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
    }

    private function doSearchingQuery($constraints){
        $type = ($constraints['type'] == 'advise') ? 0 : 1;
        $query = DB::table('blog')
            ->select('*')
            ->where('type', '=', $type)
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
}
