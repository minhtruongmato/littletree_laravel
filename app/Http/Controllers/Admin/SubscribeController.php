<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Subscribe;
use Mail;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        $subscribes = DB::table('subscribe')->paginate(10);
        // print_r($subscribes);die;

        return view('admin/subscribe/index', ['subscribes' => $subscribes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        DB::table('subscribe')->where('id', $id)->delete();
        return redirect()->intended('admin/subscribe');
    }

    public function sendMail(){
        $isExists = false;
        $check = Mail::send('admin/subscribe/mailfb', array(), function($message){
            $email = Input::get('email');
            $message->to($email, 'Visitor')->subject('Visitor Feedback!');
            return $isExists = true;
        });
    }

    function sendAll(Request $request){
        $ids = request()->input('ids');
        $emails = DB::table('subscribe')
                    ->whereIn('id', $ids)
                    ->get();
        foreach ($emails as $value) {
            Mail::send('admin/subscribe/mailfb', request()->all(), function($message) use($value){
                $message->to($value->email, 'Visitor')->subject('Visitor Feedback!');
            });
        }
    }
}
