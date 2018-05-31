<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Origin;
use Response;

class OriginApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
//        $this->middleware('auth:admin');
    }
    public function index(){
        $origin = DB::table('origin')->where('is_deleted', 0)->get();

        return response()->json($origin, 200);
    }

}
