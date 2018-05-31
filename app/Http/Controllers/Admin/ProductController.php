<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\Trademark;
use App\Type;
use App\Kind;
use Response;
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
        $products = DB::table('product')->where('is_deleted', '=', 0)->orderBy('id','desc')->paginate(10);
        $averageRating = 0;
        foreach ($products as $key => $value) {
            // echo $value->id.'<br>';
            $count = DB::table('product_comment')
                ->where('product_id', $value->id)
                ->where('is_deleted', '=', 0)   
                ->count();
            
            $rating = DB::table('product_comment')
                ->select('rating')
                ->where('product_id', $value->id)
                ->get();
            $totalRating = 0;
            foreach ($rating as $k => $val) {
                $totalRating = $totalRating + $val->rating;
            }
            
            if($count != 0){
                $averageRating = $totalRating/$count;
            }else{
                $averageRating = 0;
            }
            $products[$key]->rating = $averageRating;
            $products[$key]->count = $count;
        }
       // print_r($products);die;
        return view('admin/product/index', [
            'products' => $products,
            'type_collection' => $this->fetchAllType(),
            'kind_collection' => $this->fetchAllKind(),
            'trademark_collection' => $this->fetchTrademark(),
            'origin_collection' => $this->fetchAllOrigin()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $type = DB::table('type')->get();
        $origin = DB::table('origin')->get();
        return view('admin/product/create', [
            'trademarks' => $this->fetchAllTrademark(),
            'type' => $type,
            'origin' => $origin
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

        // var_dump($image_json);die;
        $keys = ['name','type_id', 'kind_id', 'trademark_id', 'is_special', 'is_new', 'capacity', 'material', 'year', 'producer', 'volume', 'origin_id', 'price', 'selling_price', 'content', 'is_discount', 'discount_percent', 'discount_price', 'is_gift', 'gift', 'description', 'concentrations', 'quantity'];
        // $keys = ['name'];
        $input = $this->createQueryInput($keys, $request);
        $input['image'] = $image_json;
        $input['slug'] = $uniqueSlug;

        // Not implement yet
        Product::create($input);

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
        $type = DB::table('type')->get();
        $origin = DB::table('origin')->get();
        // Redirect to product list if updating product wasn't existed
        if ($product == null) {
            return redirect()->intended('admin/product');
        }
        return view('admin/product/edit', [
            'product' => $product,
            'trademarks' => $this->fetchAllTrademark(),
            'categories' => $this->fetchCategoryByTrademark($product->trademark_id),
            'type' => $type,
            'origin' => $origin
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

        $keys = ['name','type_id', 'kind_id', 'trademark_id', 'is_special', 'is_new', 'capacity', 'material', 'year', 'producer', 'volume', 'origin_id', 'price', 'selling_price', 'content', 'is_discount', 'discount_percent', 'discount_price', 'is_gift', 'gift', 'description', 'concentrations'];
        $input = $this->createQueryInput($keys, $request);
        $input['slug'] = $uniqueSlug;

        $fileName = [];
        $fileName = json_decode($product->image);
        
        // Upload image
        if($request->file('image')){
            foreach ($request->file('image') as $key => $file) {
                $fileName[] = $file->hashName();
                $file->store('products/' . $uniqueSlug);
            }
            // print_r($upload);die;
            $image_json = json_encode($fileName);
            $input['image'] = $image_json;
        }

        Product::where('id', $id)
            ->update($input);

        return redirect()->intended('admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        Product::where('id', $id)->update(['is_deleted' => 1]);
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
            'name' => $request['name']
        ];
        $products = $this->doSearchingQuery($constraints);

        return view('admin/product/index', ['products' => $products, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints){
        $query = DB::table('product')
            ->where('product.is_deleted', '=', 0)
            ->join('type', 'type.id', '=', 'product.type_id')
            ->join('kind', 'kind.id', '=', 'product.kind_id')
            ->join('product_trademark', 'product_trademark.id', '=', 'product.trademark_id')
            ->select('product.*', 'type.title as type_title', 'kind.title as kind_title', 'product_trademark.name as trademark_title');
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where('product.'.$fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(10);
    }

    private function validateInput($id = null, $request) {
        // echo 'required|unique:product, id, ' . $id . '|max:255';die;
        $this->validate($request, [
            'name' => 'required|max:255',
            'slug' => 'required|unique:product,slug, ' . $id . '|max:255',
            'type_id' => 'required',
            'price' => 'required|numeric',
            'selling_price' => 'numeric',
            'discount_percent' => 'numeric',
            'discount_price' => 'numeric'
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




}
