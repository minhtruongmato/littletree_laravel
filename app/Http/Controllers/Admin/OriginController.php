<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use File;
use App\Origin;

class OriginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $origin = DB::table('origin')->where('is_deleted', 0)->get();
        return view('admin/origin/index', ['origin' => $origin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/origin/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateInput($request);
        $keys = ['name'];
        $input = $this->createQueryInput($keys, $request);
        Origin::create($input);
        return redirect()->intended('admin/origin');
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
        $origin = Origin::find($id);
        return view('admin/origin/edit', ['origin' => $origin]);
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
        $origin = Origin::findOrFail($id);
        $this->validateInput($request);
        $keys = ['name'];
        $input = $this->createQueryInput($keys, $request);
        Origin::where('id', $id)
            ->update($input);
        return redirect()->intended('admin/origin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Origin::where('id', $id)->update(['is_deleted' => 1]);
        return redirect()->intended('admin/origin');
    }

    private function validateInput($request) {
        $this->validate($request, [
            'name' => 'required'
        ]);
    }
}
