<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Trademark;
use App\Type;
use App\Kind;
use Response;
use File;

class TrademarkController extends Controller
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
        $trademarks = DB::table('product_trademark')
                    ->join('type', 'product_trademark.type_id', '=', 'type.id')
                    ->join('kind', 'product_trademark.kind_id', '=', 'kind.id')
                    ->select('product_trademark.*', 'type.title as type_title', 'kind.title as kind_title')
                    ->where('product_trademark.is_deleted', 0)
                    ->paginate(10);
                    // print_r($trademarks);die;
        return view('admin/trademark/index', ['trademarks' => $trademarks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $type = DB::table('type')->get();
        // $kind = DB::table('kind')->get();
        return view('admin/trademark/create', ['type' => $type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validateInput($request);

        // Upload image
        $path = $request->file('image')->store('trademarks');
        $keys = ['name', 'slug', 'is_active', 'description', 'type_id', 'kind_id'];
        $input = $this->createQueryInput($keys, $request);
        $input['image'] = $path;
        // Not implement yet
        Trademark::create($input);

        return redirect()->intended('admin/trademark');
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
    public function edit($id){
        $type = DB::table('type')->get();
        
        $trademark = Trademark::find($id);
        $kind = DB::table('kind')->where('id', $trademark->kind_id)->get();
        // Redirect to trademark list if updating trademark wasn't existed
        if ($trademark == null || count($trademark) == 0) {
            return redirect()->intended('admin/trademark');
        }
        return view('admin/trademark/edit', [
            'trademark' => $trademark,
            'type' => $type,
            'kind' => $kind
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $trademark = Trademark::findOrFail($id);
        if(!$trademark){
            return redirect()->intended('admin/trademark');
        }

        $count = $this->countForCheckEmptyObject('product_category', 'trademark_id', $id);
        if($count > 0 && $request->is_active == 0){
            return view('admin/trademark/edit', ['trademark' => $trademark, 'error_message' => sprintf($this->commonMessage['isNotEmpty'], 'Thương hiệu', $trademark->name, 'bỏ dùng thương hiệu')]);
        }

        $this->validateInput($request);
        $uniqueSlug = $this->buildUniqueSlug('product_trademark', $request->id, $request->slug);
        $keys = ['name', 'slug', 'is_active', 'description', 'type_id', 'kind_id'];
        $input = $this->createQueryInput($keys, $request);
        $input['slug'] = $uniqueSlug;

        // Upload image
        if($request->file('image')){
            $path = $request->file('image')->store('trademarks');
            $input['image'] = $path;
        }

        Trademark::where('id', $id)
            ->update($input);

        return redirect()->intended('admin/trademark');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $trademark = Trademark::findOrFail($id);
        if(!$trademark){
            return redirect()->intended('admin/trademark');
        }

        $count = $this->countForCheckEmptyObject('product_category', 'trademark_id', $id);
        if($count > 0){
            return view('admin/trademark/index', ['trademarks' => $this->fetchAllTrademark(), 'error_message' => sprintf($this->commonMessage['isNotEmpty'], 'Thương hiệu', $trademark->name, 'xoá')]);
        }

        Trademark::where('id', $id)->update(['is_deleted' => 1]);
        return redirect()->intended('admin/trademark');
    }

    /**
     * Search state from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $constraints = [
            'name' => $request['name']
        ];
        $trademarks = $this->doSearchingQuery($constraints);

        return view('admin/trademark/index', ['trademarks' => $trademarks, 'searchingVals' => $constraints]);
    }

    protected function fetchAllTrademark(){
        $trademarks = DB::table('product_trademark')
            ->select('*')
            ->where('is_deleted', '=', 0)
            ->paginate(10);
        return $trademarks;
    }

    private function doSearchingQuery($constraints){
        $query = DB::table('product_trademark')
                ->join('type', 'product_trademark.type_id', '=', 'type.id')
                ->join('kind', 'product_trademark.kind_id', '=', 'kind.id')
                ->select('product_trademark.*', 'type.title as type_title', 'kind.title as kind_title')
                ->where('product_trademark.is_deleted', 0);
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where('product_trademark.'.$fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(10);
    }

    private function validateInput($request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'slug' => 'required|unique:product_trademark|max:255'
        ]);
    }

    public function selectKind()
    {
        $type_id = Input::get("type_id");
        $kinds = DB::table('kind')
            ->select('*')
            ->where('type_id', '=', $type_id)
            ->where('is_active', '=', 1)
            ->where('is_deleted', '=', 0)
            ->get();

        if(!$kinds){
            return response()->json(['type_id' => $type_id, 'status' => '404']);
        }

        $arrayKind = [];
        foreach($kinds as $item){
            $arrayKind[$item->id] = $item->title;
        }

        return response()->json(['kinds' => $arrayKind, 'status' => '200']);
    }
}
