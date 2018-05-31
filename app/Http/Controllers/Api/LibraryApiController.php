<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Response;
use App\Library;

class LibraryApiController extends Controller
{
    public function __construct(){
        //
    }

    public function fetchAllLibrary(){
        $result = DB::table('library')
            ->select('*')
            ->where('is_deleted', '=', 0)
            ->get();
	    foreach ($result as $key => $value) {
	    	$image = DB::table('image')
	        ->select('*')
	        ->where('library_id', '=', $value->id)
	        ->first();
	        $result[$key]->image = $image->image;
	    }
        if(!$result){
            return response()->json('No item found', 404);
        }
        return response()->json($result, 200);
    }

    public function detail(){
    	$slug = Input::get('slug');
    	$library = DB::table('library')
            ->select('*')
            ->where('slug', '=', $slug)
            ->first();

        $images = DB::table('image')
            ->select('*')
            ->where('library_id', '=', $library->id)
            ->get();
        $library->image = $images;
        if(!$library){
            return response()->json('No item found', 404);
        }
        return response()->json($library, 200);
    }
}
