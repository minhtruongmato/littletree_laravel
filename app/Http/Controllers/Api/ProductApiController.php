<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Product;
use Response;

class ProductApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
//        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $products = Product::all();

        return response()->json($products, 200);
    }

    public function fetchAllProduct(){
        $result = DB::table('product')
            ->select('*')
            ->where('is_deleted', '=', 0)
            ->get();
        foreach ($result as $key => $value) {
            $result[$key]->image = json_decode($value->image);
        }
        
        // print_r($result);die;
        if(!$result){
            return response()->json('No item found', 404);
        }
        if(!$result){
            return response()->json('No item found', 404);
        }
        return response()->json($result, 200);
    }

    public function detail(){
        $slug = Input::get('slug');

        $result = DB::table('product')
            ->select('product.*', 'origin.name as origin_title')
            // ->join('product_trademark', 'product.trademark_id', '=', 'product_trademark.id')
            ->join('origin', 'origin.id', '=', 'product.origin_id')
            ->where('product.slug', '=', $slug)
            ->where('product.is_deleted', '=', 0)
            ->get();
        $result[0]->image = json_decode($result[0]->image);
        if(!$result){
            return response()->json('No item found', 404);
        }
        return response()->json($result, 200);
    }

    public function fetchDiscountProduct(){
        $result = DB::table('product')
            ->select('*')
            ->where('is_discount', '=', 1)
            ->where('is_deleted', '=', 0)
            ->get();
        foreach ($result as $key => $value) {
            $result[$key]->image = json_decode($value->image);
        }
        if(!$result){
            return response()->json('No item found', 404);
        }
        return response()->json($result, 200);
    }

    /**
     * Fetch products in one trademark or category
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchTargetProducts(){
        $target = Input::get('target');
        $subTarget = Input::get('subTarget');
        $query = DB::table('product');
        $result = [];
        if($target == 'thuong-hieu'){
            $query->select('product.*', 'product_trademark.slug as trademark_slug')
                ->join('product_trademark', 'product.trademark_id', '=', 'product_trademark.id')
                ->where('product_trademark.slug', '=', $subTarget);
        }elseif($target == 'loai-san-pham'){
            $query->select('product.*')
                ->join('type', 'product.type_id', '=', 'type.id')
                ->where('type.slug', '=', $subTarget);
        }elseif($target == 'dong-san-pham'){
            $query->select('product.*')
                ->join('kind', 'product.kind_id', '=', 'kind.id')
                ->where('kind.slug', '=', $subTarget);
        }else{
            return response()->json(null, 400);
        }

        $result['targetProducts'] = $query->where('product.is_deleted', '=', 0)->get();
        $result['type'] = $target;
        $result['target'] = $this->fetchTarget($target, $subTarget);
        foreach ($result['targetProducts'] as $key => $value) {
            $result['targetProducts'][$key]->image = json_decode($value->image);
        }
        if(!$result){
            return response()->json($result, 404);
        }
        return response()->json($result, 200);
    }

    /**
     * Fetch Trademark or Category selected
     *
     * @param string $target (type = trademark or category?)
     * @param string subTarget (which trademark? or which category?)
     *
     * @return object
     */
    public function fetchTarget($target, $subTarget){
        if($target == 'thuong-hieu'){
            $query = DB::table('product_trademark')
                ->select('*')
                ->where('slug', '=', $subTarget);
        }elseif($target == 'dong-san-pham'){
            $query = DB::table('kind')
                ->select('*')
                ->where('slug', '=', $subTarget);
        }else{
            $query = DB::table('type')
                ->select('*')
                ->where('slug', '=', $subTarget);
        }

        return $query->where('is_deleted', '=', 0)->get();
    }

    public function fetchMenuProduct(){
        $type = DB::table('type')
            ->select('*')
            ->where('is_active', '=', 1)
            ->where('is_deleted', '=', 0)
            ->get();

        $kind = DB::table('kind')
            ->select('*')
            ->where('is_active', '=', 1)
            ->where('is_deleted', '=', 0)
            ->get();

        $trademarks = DB::table('product_trademark')
            ->select('*')
            ->where('is_active', '=', 1)
            ->where('is_deleted', '=', 0)
            ->get();

        // $categories = DB::table('product_category')
        //     ->select('*')
        //     ->where('is_active', '=', 1)
        //     ->where('is_deleted', '=', 0)
        //     ->get();

        if(!$trademarks){
            return response()->json('No item found', 404);
        }

        $menuProduct = [
            'type' => $type ? $type : [],
            'kind' => $kind ? $kind : [],
            'trademarks' => $trademarks ? $trademarks : []
        ];

        return response()->json($menuProduct, 200);
    }

    public function search(Request $request){
        $post = $request->all();

        $query = DB::table('product')->select('product.*');

        if(isset($post['target']) && isset($post['subTarget'])){
            if($post['target'] == 'thuong-hieu'){
                $query->join('product_trademark', 'product.trademark_id', '=', 'product_trademark.id')
                    ->where('product_trademark.slug', '=', $post['subTarget']);
            }elseif($post['target'] == 'dong-san-pham'){
                $query->join('kind', 'product.kind_id', '=', 'kind.id')
                    ->where('kind.slug', '=', $post['subTarget']);
            }elseif($post['target'] == 'loai-san-pham'){
                $query->join('type', 'product.type_id', '=', 'type.id')
                    ->where('type.slug', '=', $post['subTarget']);
            }
        }
        if(isset($post['name'])){
            $query->where('product.name', 'like', '%' . $post['name'] . '%');
        }
        if(isset($post['price'])){
            switch($post['price']){
                case 0:
                    $query->whereBetween('product.price', [0, 100000]);
                    break;
                case 1:
                    $query->whereBetween('product.price', [100001, 300000]);
                    break;
                case 2:
                    $query->whereBetween('product.price', [300001, 500000]);
                    break;
                case 3:
                    $query->whereBetween('product.price', [500001, 800000]);
                    break;
                case 4:
                    $query->where('product.price', '>=', 800001);
                    break;
                default:
                    break;
            }
        }
        if(isset($post['origin'])){
            $query->where('product.origin_id', $post['origin']);
        }
        $query->where('product.is_deleted', '=', 0);

        $result = $query->get();
        foreach ($result as $key => $value) {
            $result[$key]->image = json_decode($value->image);
        }

        return response()->json($result, 200);
    }

    public function fetchTrademarkProduct()
    {
        $trademark_id = Input::get('trademark_id');
        $id = Input::get('id');

        $result = DB::table('product')
            ->where('product.trademark_id', '=', $trademark_id)
            ->where('product.id', '!=', $id)
            ->where('product.is_deleted', '=', 0)
            ->get();
        foreach ($result as $key => $value) {
            $result[$key]->image = json_decode($value->image);
        }
        if(!$result){
            return response()->json('No item found', 404);
        }
        return response()->json($result, 200);
    }
}

