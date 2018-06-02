<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Banner;
use Response;
use Session;
use File;

class BannerController extends Controller
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
        $banner = DB::table('banner')
            ->select('*')
            ->where('is_deleted',0)
            ->paginate(10);
        return view('admin/banner/index', ['banner' => $banner]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $type
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin/banner/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $path = $request->file('image')->store('banner');
        $input['image'] = $path;
        if(Banner::create($input)){
            Session::flash('success','Thêm mới banner thành công');
            return redirect()->intended('admin/banner');
        }
        Session::flash('error','Thêm mới banner thất bại');
        return redirect()->intended('admin/banner');
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

    public function destroy($id){
        $banner = Banner::findOrFail($id);
        if(Banner::where('id', $id)->update(['is_deleted' => 1])){
            Session::flash('success','Xóa banner thành công');
            return redirect()->intended('admin/banner');
        }
        Session::flash('error','Lỗi xóa banner');
        return redirect()->intended('admin/banner');
    }
}
