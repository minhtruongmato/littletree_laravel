<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\About;
use Response;
use Session;
use File;

class AboutController extends Controller
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
        $about = DB::table('about')
            ->select('*')
            ->where('is_deleted',0)
            ->paginate(10);
        return view('admin/about/index', ['about' => $about]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $count = About::where('id',$id)->where('is_deleted',0)->count();
        if($count == 1){
            $about = About::find($id);
            if ($about == null) {
                return redirect()->intended('admin/about');
            }
            return view('admin/about/edit', [
                'about' => $about
            ]);
        }
        Session::flash('error','About không tồn tại');
        return redirect()->intended('admin/about');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $about = About::findOrFail($id);
        $this->validateInput($request);
        $uniqueSlug = $this->buildUniqueSlug('about', $request->id, $request->slug);
        $keys = ['title', 'content'];
        $input = $this->createQueryInput($keys, $request);
        $input['slug'] = $uniqueSlug;
        // Upload image
        if($request->file('image')){
            $path = $request->file('image')->store('about');
            $input['image'] = $path;
        }
        if(About::where('id', $id)->update($input) == 1){
            Session::flash('success','Sửa about thành công');
            return redirect()->intended('admin/about');
        }
        Session::flash('error','Lỗi sửa about');
        return redirect()->intended('admin/about');
    }
    private function validateInput($request) {
        $this->validate($request, [
            'title' => 'required|max:60',
//            'price' => 'required|max:60',
//            'middlename' => 'required|max:60',
//            'address' => 'required|max:120',
//            'city_id' => 'required',
//            'state_id' => 'required',
//            'country_id' => 'required',
//            'zip' => 'required|max:10',
//            'age' => 'required',
//            'birthdate' => 'required',
//            'date_hired' => 'required',
//            'department_id' => 'required',
//            'division_id' => 'required'
        ]);
    }
}
