<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Product;
use App\Order;
use Response;

class CartApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
//        $this->middleware('auth:admin');
    }

    public function checkProductExist(){
        $id = Input::get('id');

        $exist = DB::table('product')
            ->select('*')
            ->where('id', '=', $id)
            ->where('is_deleted', '=', 0)
            ->limit(1)
            ->get();
        $exist[0]->image = json_decode($exist[0]->image);
        if(empty($exist)){
            return response()->json(['id' => $id, 'message' => 'not_found'], 404);
        }

        if($exist[0]->quantity <= 0){
            return response()->json(['id' => $id, 'message' => 'out_of_stock'], 200);
        }

        return response()->json(['id' => $id, 'result' => $exist[0], 'message' => 'success'], 200);
    }

    public function getStoredCartProducts(){
        $products = json_decode(Input::get('products'));

        $ids = [];
        foreach($products as $key => $value){
            $ids[] = $value->id;
        }

        $stored = DB::table('product')
            ->select('*')
            ->whereIn('id', $ids)
            ->where('is_deleted', '=', 0)
            ->get();

        if(empty($stored)){
            return response()->json(['id' => $ids, 'message' => 'not_found'], 404);
        }

        return response()->json(['id' => $ids, 'result' => $stored, 'message' => 'success'], 200);
    }

    public function checkout(){
        // Build Personal information
        $inputPersonalInfo = json_decode(Input::get('personalInfo'));
        $personalInfo = $this->buildPersonalInfoArray($inputPersonalInfo);
        $code = substr(str_shuffle(MD5(microtime())), 0, 9);
        $personalInfo['unique_code'] = strtoupper($code);
        $result = false;

        DB::beginTransaction();
        try {
            $orderId = DB::table('order')->insertGetId($personalInfo);
            if($orderId){
                // Build Order by products received
                $inputOrder = json_decode(Input::get('orderInfo'), true);
                $orderInfo = $this->buildOrderInfoArray($orderId, $inputOrder['products']);

                $result = DB::table('order_product')->insert($orderInfo);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        if($result){
            return response()->json(['orderCode' => $code, 'message' => 'success'], 200);
        }else{
            return response()->json(['orderCode' => null, 'message' => 'fail'], 404);
        }
    }

    public function fetchLoggedInfo(){
        if(Auth::check()) {
            $userLoggedIn = Auth::user();
        }

        return response()->json(['output' => $userLoggedIn, 'message' => 'success'], 200);
    }

    protected function buildPersonalInfoArray($inputpersonalInfo){
        return $output = [
            'customer_id' => $inputpersonalInfo->id,
            'customer_name' => $inputpersonalInfo->name,
            'customer_email' => $inputpersonalInfo->email,
            'customer_phone' => $inputpersonalInfo->phone,
            'customer_address' => $inputpersonalInfo->address,
            'customer_district' => $inputpersonalInfo->district,
            'customer_city' => $inputpersonalInfo->city,
            'customer_content' => (!empty($inputpersonalInfo->content)) ? $inputpersonalInfo->content : '',
            'payment_method' => $inputpersonalInfo->paymentMethod,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ];
    }

    protected function buildOrderInfoArray($orderId, $inputOrder){
        $output = [];
        foreach($inputOrder as $key => $value){
            $output[$key] = [
                'order_id' => $orderId,
                'product_id' => $value['id'],
                'product_name' => $value['name'],
                'product_quantity' => $value['quantity'],
                'product_total_cost' => $value['totalCost']
            ];
        }
        return $output;
    }

    protected function randomOrderUniqueCode(){

        $code = str_random(10);

        $validator = \Validator::make(['unique_code' => $code], ['unique_code'=>'unique:order, unique_code']);

        if($validator->fails()){
            $this->randomOrderUniqueCode();
        }

        return $code;
    }
}

