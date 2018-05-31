<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Mail;

class QuotationApiController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function sendMail(){
    	$name = Input::get('name');
        $email = Input::get('email');
        $phone = Input::get('phone');
        $content = Input::get('content');
        $data = array('name' => $name, 'email' => $email, 'phone' => $phone, 'content' => $content);
        Mail::send('admin/subscribe/mailfb', $data, function($message) use ($data){
        	
            $message->to($data['email'], 'Visitor')->subject('Báo giá sản phẩm - Hầm Rượu Thịnh 24');
        });
    }
}
