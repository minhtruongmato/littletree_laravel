<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Introduce;
use Response;
use Illuminate\Support\Facades\Cookie;

class IntroduceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:admin');
//        Cookie::queue('activeMenu', 'introduce', 45000);
    }

    public function introduce($type){
        $result = DB::table('introduce')
            ->select('*')
            ->where('slug', '=', $type)
            ->get();
        return view('admin/introduce/index', [
            'data' => $result[0]
        ]);
    }

    public function saveIntroduce(Request $request, $slug){
        $keys = ['content'];
        $input = $this->createQueryInput($keys, $request);

        // Upload image
        if($request->file('image')){
            $path = $request->file('image')->store('introduce');
            $input['image'] = $path;
        }

        Introduce::where('slug', $slug)
            ->update($input);

        $item = $this->getBySlug($slug);
        return view('admin/introduce/index', [
            'data' => $item[0]
        ]);
    }

    public function getBySlug($slug){
        $query = DB::table('introduce')
            ->select('*')
            ->where('slug', '=', $slug);
        return $query->get();
    }
}
