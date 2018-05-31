<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use App\UserLikeProduct;
use Response;

class UserLikeProductApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
//        $this->middleware('auth:admin');
    }
    public function store(Request $request){
        if(!Auth::guest()){
            $check=UserLikeProduct::where('product_id',$request->product_id)->where('user_id',Auth::user()->id)->get();
            if(!isset($check[0]->user_id)){
                $like_product=new UserLikeProduct;    
                $like_product->product_id=$request->product_id;
                $like_product->user_id=Auth::user()->id;
                $like_product->save();
            	$check=UserLikeProduct::where('product_id',$request->product_id)->where('user_id',Auth::user()->id)->get();
                if(!isset($check[0]->user_id)){
	            	return response()->json(['message' => 'not_found'], 404);
	        	}
	        	return response()->json(['message' => 'success'], 200);
            }else{
            	$affectedRows = UserLikeProduct::where('product_id',$request->product_id)->where('user_id',Auth::user()->id)->delete();
            	if($affectedRows){
            		return response()->json(['message' => 'success'], 200);
            	}
            	return response()->json(['message' => 'not_found'], 404);
            }
            return response()->json(['message' => 'isset'], 404);
        }
    }
    public function getAll(){
        if(!Auth::guest()){
            $check=UserLikeProduct::all();
            return response()->json(['result' => $check], 200);
        }
    }
    public function getAllLike(){
        if(!Auth::guest()){
            $check=UserLikeProduct::where('user_id',Auth::user()->id)->get();
            foreach ($check as $key => $value) {
                $whereIn[] =  $value->product_id;
            }
            $product = DB::table('product')
            ->select('product.*', 'origin.name as origin_title')
            ->join('origin', 'origin.id', '=', 'product.origin_id')
            ->whereIn('product.id',$whereIn)
            ->get();
            return response()->json(['result' => $product], 200);
        }
    }





}