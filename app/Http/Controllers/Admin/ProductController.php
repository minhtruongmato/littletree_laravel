<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\ProductCategory;
use Response;
use Session;
use File;
use Validator;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:admin');
//        Cookie::forget('activeMenu');
//        Cookie::queue('activeMenu', 'product', 45000);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $products = Product::with('productCategory')->Paginate(10);
        return view('admin/product/index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $product_category_list = ProductCategory::where('is_deleted',0)->get();
        $this->buildNewCategory($product_category_list,0,$product_category);
        return view('admin/product/create', [
           'product_category' => $product_category 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validateInput('',$request);
        $uniqueSlug = $this->buildUniqueSlug('product', $request->id, $request->slug);

        $path = base_path() . '/' . 'storage/app/products';
        $newFolderPath = $this->buildNewFolderPath($path, $uniqueSlug);
        File::makeDirectory($newFolderPath[1], 0777, true, true);

        $files = $request->file('image');
        foreach ($files as $key => $file) {
            $fileName[$key] = $file->hashName();
            $file->store('products/' . $newFolderPath[0]);
        }

        $image_json = json_encode($fileName);
        $keys = ['title','category_id' ,'price_min', 'price_mid', 'price_max', 'content', 'description'];
        $input = $this->createQueryInput($keys, $request);
        $input['image'] = $image_json;
        $input['slug'] = $uniqueSlug;
        if(Product::create($input)){
            Session::flash('success','Thêm mới sản phẩm thành công');
        return redirect()->intended('admin/product');
        }
        Session::flash('error','Thêm mới sản phẩm thất bại');
        return redirect()->intended('admin/product');
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
        $product = Product::find($id);
        // Redirect to product list if updating product wasn't existed
        if ($product == null) {
            Session::flash('error','Sản phẩm không tồn tại');
            return redirect()->intended('admin/product');
        }
        $product_category_list = ProductCategory::where('is_deleted',0)->get();
        $this->buildNewCategory($product_category_list,0,$product_category,$product['category_id']);
        /*$product_category = $this->buildArrayForDropdown($product_category_list);*/
        return view('admin/product/edit', [
            'product' => $product,'product_category' => $product_category 
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
        $product = Product::findOrFail($id);
        $this->validateInput($id, $request);
        $uniqueSlug = $this->buildUniqueSlug('product', $request->id, $request->slug);

        $path = base_path() . '/' . 'storage/app/products';
        if($request->slug != $product->slug){
            rename($path . '/' . $product->slug, $path . '/' . $uniqueSlug);
        }

        $keys = ['title','category_id', 'price_min', 'price_mid', 'price_max', 'content', 'description'];
        $input = $this->createQueryInput($keys, $request);
        $input['slug'] = $uniqueSlug;

        $fileName = [];
        if($request->file('image')){
            foreach ($request->file('image') as $key => $file) {
                $fileName[] = $file->hashName();
                $file->store('products/' . $uniqueSlug);
            }
            // print_r($upload);die;
            $image_json = json_encode($fileName);
            $input['image'] = $image_json;
        }
        if(Product::where('id', $id)->update($input) == 1){
            Session::flash('success','Sửa sản phẩm thành công');
        return redirect()->intended('admin/product');
        }
        Session::flash('error','Sửa sản phẩm thất bại');
        return redirect()->intended('admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $product = Product::findOrFail($id);
        if(Product::where('id', $id)->update(['is_deleted' => 1])){
            Session::flash('success','Xóa sản phẩm thành công');
            return redirect()->intended('admin/product');
        }
        Session::flash('error','Lỗi xóa sản phẩm');
        return redirect()->intended('admin/product');
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
        $products = $this->doSearchingQuery($constraints);
        foreach ($products as $key => $value) {
                $sub = ProductCategory::find($value->category_id);
                $products[$key]->sub = $sub->title;
        }
        return view('admin/product/index', ['products' => $products, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints){
        $query = DB::table('product')
            ->select('*')
            ->where('is_deleted',0)
            ->where('title', 'like', '%' . $constraints['title'] . '%');
        return $query->paginate(10);
    }   

    private function validateInput($id = null, $request) {
        // echo 'required|unique:product, id, ' . $id . '|max:255';die;
        $this->validate($request, [
            'title' => 'required|max:255',
            'slug' => 'required|unique:product,slug, ' . $id . '|max:255',
            'price_max' => 'required|numeric',
            'price_mid' => 'required|numeric',
            'price_min' => 'required|numeric'
        ]);
    }

    function buildNewFolderPath($path, $fileName){
        $newPath = $path . '/' . $fileName;
        $newName = $fileName;
        $counter = 1;
        while (file_exists($newPath)) {
            $newName = $fileName . '-' . $counter;
            $newPath = $path . '/' . $newName;
            $counter++;
        }

        return array($newName, $newPath);
    }

    function fetchAllTrademark(){
        $trademarks = DB::table('product_trademark')
            ->select('*')
            ->where('is_active', '=', 1)
            ->where('is_deleted', '=', 0)
            ->get();

        $arrayTrademark = [];
        foreach($trademarks as $item){
            $arrayTrademark[$item->id] = $item->name;
        }

        return $arrayTrademark;
    }

    function fetchCategoryByTrademark($id){
        $categories = DB::table('product_category')
            ->select('*')
            ->where('trademark_id', '=', $id)
            ->where('is_active', '=', 1)
            ->where('is_deleted', '=', 0)
            ->get();

        $arrayCategory = [];
        foreach($categories as $item){
            $arrayCategory[$item->id] = $item->name;
        }

        return $arrayCategory;
    }

    function fetchByType(){
        $type_id = Input::get('type_id');
        $kind = DB::table('kind')
            ->select('*')
            ->where('type_id', $type_id)
            ->where('is_active', '=', 1)
            ->where('is_deleted', '=', 0)
            ->get();
        if(!$kind){
            return response()->json(['kind_id' => $kind_id, 'status' => '404']);
        }

        $arrayKind = [];
        foreach($kind as $item){
            $arrayKind[$item->id] = $item->title;
        }

        return response()->json(['kinds' => $arrayKind, 'status' => '200']);
    }

    function fetchByKind(){
        $kind_id = Input::get('kind_id');
        $trademark = DB::table('product_trademark')
            ->select('*')
            ->where('kind_id', $kind_id)
            ->where('is_active', '=', 1)
            ->where('is_deleted', '=', 0)
            ->get();
        if(!$trademark){
            return response()->json(['trademark_id' => $trademark_id, 'status' => '404']);
        }

        $arrayTrademark = [];
        foreach($trademark as $item){
            $arrayTrademark[$item->id] = $item->name;
        }

        return response()->json(['trademarks' => $arrayTrademark, 'status' => '200']);
    }

    private function fetchAllType(){
        $types = DB::table('type')->get();
        $type_collection = [];
        foreach($types as $key => $value){
            $type_collection[$value->id] = $value->title;
        }
        return $type_collection;
    }
    private function fetchAllKind(){
        $kinds = DB::table('kind')->get();
        $kind_collection = [];
        foreach($kinds as $key => $value){
            $kind_collection[$value->id] = $value->title;
        }
        return $kind_collection;
    }
    private function fetchTrademark(){
        $trademarks = DB::table('product_trademark')->get();
        $trademark_collection = [];
        foreach($trademarks as $key => $value){
            $trademark_collection[$value->id] = $value->name;
        }
        return $trademark_collection;
    }
    private function fetchAllOrigin(){
        $origins = DB::table('origin')->get();
        $origin_collection = [];
        foreach($origins as $key => $value){
            $origin_collection[$value->id] = $value->name;
        }
        return $origin_collection;
    }

    public function multiple_upload($upload) {
        // getting all of the post data
        $files = Input::file('image');

        // Making counting of uploaded images
        $file_count = count($files);

        // start count how many uploaded
        $uploadcount = 0;

        $list_image = [];
        foreach($files as $file) {
            $rules = array('file' => 'required');

            //'required|mimes:png,gif,jpeg,txt,pdf,doc'

            $validator = Validator::make(array('file'=> $file), $rules);

            if($validator->passes()){
                $destinationPath = $upload;
                $filename = $file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $filename);
                $uploadcount ++;
                $list_image[] = $filename;
            }

        }
    }

    public function delete_image(Request $request){
        $image = $request->image;
        $id = $request->id;
        $path = base_path() . '/storage/app/products/';
        $product = Product::findOrFail($id);


        $upload = [];
        $upload = json_decode($product->image);
        $key = array_search($image, $upload);
        unset($upload[$key]);
        $newUpload = [];
        foreach ($upload as $key => $value) {
            $newUpload[] = $value;
        }
        
        $image_json = json_encode($newUpload);
        $result = DB::table('product')
            ->where('id', $id)
            ->update(['image' => $image_json]);
        if($result){
            File::delete($path.$product->slug.'/'.$image);
            $success = true;
        }
        return response()->json(['image_json' => $image_json, 'status' => '200']); 
        
    }
    protected function buildArrayForDropdown($data = array()){
        $new_data = array(0 => 'Danh mục gốc');
        foreach ($data as $key => $value) {
            $new_data[$value['id']] = $value['title'];
        }
        return $new_data;
    }
    protected function buildNewCategory($categorie, $parent_id = 0,&$result, $parent_id_edit = "",$id_edit = "",$char=""){
        $cate_child = array();
        foreach ($categorie as $key => $item){
            if ($item['parent_id'] == $parent_id){
                $cate_child[] = $item;
                unset($categorie[$key]);
            }
        }
        if ($cate_child){
            foreach ($cate_child as $key => $value){
                    $select = ($value['id'] == $parent_id_edit)? 'selected' : '';
                if($value['id'] != $id_edit){
                    $result.='<option value="'.$value['id'].'"'.$select.'>'.$char.$value['title'].'</option>';
                    $this->buildNewCategory($categorie, $value['id'],$result, $parent_id_edit,$id_edit, $char.'---|');
                }
            }
        }
    }


}
