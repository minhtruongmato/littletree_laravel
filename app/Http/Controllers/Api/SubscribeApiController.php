<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use DateTime;
use Response;

class SubscribeApiController extends Controller{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function save(){
    	$email = Input::get('email');
    	$count = DB::table('subscribe')->where('email', $email)->count();
    	$result = [];
    	if($count == 0){
    		$result = DB::table('subscribe')->insert(['email' => $email]);
    	}
    	

    	if($result != null){
            return response()->json(['message' => 'success'], 200);
        }else{
            return response()->json(['message' => 'fail'], 200);
        }
    }
}
