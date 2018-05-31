<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Response;

class SearchApiController extends Controller
{
    public function __construct(){
        //
    }

    public function searchAllBlog(){
    	$name = Input::get('name');
    	$newName = json_decode($name);
        $result = DB::table('blog')
            ->select('*')
            ->where('title','LIKE','%'.$newName->search.'%')
            ->where('is_deleted', '=', 0)
            ->get();
        if(!$result){
            return response()->json('No item found', 404);
        }
        return response()->json($result, 200);
    }

    public function searchAllProduct(){
    	$name = Input::get('name');
    	$newName = json_decode($name);
        $result = DB::table('product')
            ->select('*')
            ->where('name','LIKE','%'.$newName->search.'%')
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
}
