<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Introduce;
use Response;

class IntroduceApiController extends Controller
{
    public function __construct(){
        //
    }

    public function fetchAllIntroduce(){
        $result = DB::table('introduce')
            ->select('*')
            ->where('is_deleted', '=', 0)
            ->get();

        if(!$result){
            return response()->json('No item found', 404);
        }
        return response()->json($result, 200);
    }
}