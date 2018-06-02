<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\ProductCategory;
use App\Product;
use Response;
use Session;
use File;

class ProductCategoryController extends Controller
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
        $categories = DB::table('product_category')
            ->select('*')
            ->where('is_deleted',0)
            ->paginate(10);
        foreach ($categories as $key => $value) {
            $categories[$key]->sub = 'Danh mục gốc';
            if($value->parent_id !=0){
                $sub = ProductCategory::find($value->parent_id);
                $categories[$key]->sub = $sub->title;
            }
        }
        return view('admin/product-category/index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $product_category_list = ProductCategory::where('is_deleted',0)->get();
        $this->buildNewCategory($product_category_list,0,$product_category);
        return view('admin/product-category/create', [
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
        $this->validateInput($request);
        $uniqueSlug = $this->buildUniqueSlug('product_category', null, $request->slug);
        $keys = ['title','parent_id'];
        $input = $this->createQueryInput($keys, $request);
        $input['slug'] = $uniqueSlug;
        // Not implement yet
        if(ProductCategory::create($input)){
            Session::flash('success','Thêm mới danh mục thành công');
        return redirect()->intended('admin/product-category');
        }
        Session::flash('error','Thêm mới danh mục thất bại');
        return redirect()->intended('admin/product-category');
    }
    public function edit($id){
        $product_category = ProductCategory::find($id);
        if ($product_category == null) {
            Session::flash('error','Danh mục không tồn tai');
            return redirect()->intended('admin/product-category'); 
        }

        $product_category_list1 = ProductCategory::where('is_deleted',0)->get();
        $this->buildNewCategory($product_category_list1,0,$product_category_list,$product_category['parent_id'],$id);
        return view('admin/product-category/edit', [
            'product_category' => $product_category, 'product_category_list' => $product_category_list
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
        $product_category = ProductCategory::findOrFail($id);
        $this->validateInput($request);
        if($request->parent_id == ''){
            Session::flash('error','Bạn phải chọn danh mục cha');
            return redirect()->back();
        }
        $uniqueSlug = $this->buildUniqueSlug('product_category', $request->id, $request->slug);
        $keys = ['title','parent_id'];
        $input = $this->createQueryInput($keys, $request);
        $input['slug'] = $uniqueSlug;
        if(ProductCategory::where('id', $id)->update($input) == 1){
            Session::flash('success','Sửa danh mục thành công');
            return redirect()->intended('admin/product-category');
        }
        Session::flash('error','Lỗi sửa danh mục');
        return redirect()->intended('admin/product-category');
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
        $count = ProductCategory::where('id',$id)->where('is_deleted',0)->count();
        if($count == 1){
            $check_parent = ProductCategory::where('parent_id',$id)->where('is_deleted',0)->count();
            if($check_parent == 0){
                $check_product = Product::where('category_id',$id)->where('is_deleted',0)->count();
                if($check_product == 0){
                    if(ProductCategory::where('id', $id)->update(['is_deleted' => 1]) == 1){
                        Session::flash('success','Xóa danh mục thành công');
                        return redirect()->intended('admin/product-category');
                    }
                    Session::flash('error','Lỗi không thể xóa');
                    return redirect()->intended('admin/product-category');
                }
                Session::flash('error','Danh mục sản phẩm có chứa '.$check_product.' sản phẩm không thể xóa');
                return redirect()->intended('admin/product-category');
            }
            Session::flash('error','Danh mục sản phẩm chứa '.$check_parent.' danh mục con không thể xóa');
            return redirect()->intended('admin/product-category');
        }
        Session::flash('error','Danh mục sản phẩm không tồn tại');
        return redirect()->intended('admin/product-category');
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
                $sub = ProductCategory::find($value->parent_id);
                $categories[$key]->sub = $sub->title;
            }
        }
        return view('admin/product-category/index', ['categories' => $categories, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints){
        $query = DB::table('product_category')
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
    protected function buildNewCategory($categorie, $parent_id = 0,&$result, $parent_id_edit = "",$id_edit = "",$char=""){
        $cate_child = array();
        foreach ($categorie as $key => $item){
            if ($item['parent_id'] == $parent_id){
                $cate_child[] = $item;
                unset($categorie[$key]);
            }
        }
        if ($cate_child){
            if($parent_id == 0){
                $result.='<option value="0" selected>Danh mục gốc</option>';
            }
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
