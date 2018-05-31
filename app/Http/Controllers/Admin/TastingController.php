<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Tasting;
use File;

class TastingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $tasting = DB::table('tasting')
                        // ->join('tasting_product', 'tasting.id', '=', 'tasting_product.tasting_id')
                        ->where('status',0)
                        ->select('tasting.*')
                        ->paginate(10);
            $result = $this->buildTastingList($tasting);
        
            // print_r($result);die;
        return view('admin/tasting/index', ['tasting' => $result]);
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
    public function destroy($id)
    {
        //
    }

    public function finish()
    {
        $tasting = DB::table('tasting')
                        ->where('status',1)
                        ->paginate(10);
        $result = $this->buildTastingList($tasting);
        return view('admin/tasting/index', ['tasting' => $result]);
    }

    public function ajaxFinish()
    {
        $id = Input::get("id");
        $isExist = false;
        $tasting = DB::table('tasting')
                    ->select('*')
                    ->where('id', '=', $id)
                    ->get();
        if(!$tasting){
            return response()->json(['id' => $id, 'status' => '404']);
        }

        $update = DB::table('tasting')
            ->where('id', $id)
            ->update(['status' => 1]);
        if($update){
            $isExist = true;
        }

        return response()->json(['isExist' => $isExist, 'status' => '200']);
    }

    private function buildTastingList($tastings){
        $result = [];
        foreach($tastings as $key_tasting => $tasting){
            $result[$key_tasting] = $tasting;
            $result[$key_tasting]->product_info = $this->fetchProductsInTasting($tasting->id);

            // foreach($result[$key_tasting]->product_info as $key => $product){
            //     $result[$key_tasting]->product_info[$key]->detail = $this->fetchProductById($product->product_id);
            // }
        }
        return $result;
    }

    private function fetchProductsInTasting($id){
        $result = DB::table('tasting_product')
            ->select('*')
            ->where('tasting_id', '=', $id)
            ->get();
        return $result;
    }
    private function fetchProductById($id){
        $result = DB::table('product')
            ->where('id', '=', $id)
            ->limit(1)
            ->get();
        return $result;
    }
}
