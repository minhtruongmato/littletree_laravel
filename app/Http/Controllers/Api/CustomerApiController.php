<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Response;

class CustomerApiController extends Controller
{
    public function __construct(){
        //
    }
    public function fetchCustomerFavoriteProduct(){
        $user_id = Input::get('user_id');

        $result = DB::table('user_like_product')
            ->select('*')
            ->where('user_id', '=', $user_id)
            ->get();

        if(!$result){
            return response()->json('No user found', 404);
        }
        return response()->json($result, 200);
    }

    public function fetchCustomerInfo(){
        $id = Input::get('id');

        $result = DB::table('users')
            ->select('*')
            ->where('id', '=', $id)
            ->get();

        if(!$result){
            return response()->json('No user found', 404);
        }
        return response()->json($result, 200);
    }

    public function fetchNotCompleteOrder(){
        $id = Input::get('id');

        $orders = DB::table('order')
            ->select('*')
            ->where('customer_id', '=', $id)
            ->where('status', '!=', 2)
            ->where('status', '!=', 99)
            ->get();
        $result = $this->buildOrderList($orders);

        if(!$result){
            return response()->json(['result' => [], 'message' => 'No item found'], 200);
        }
        return response()->json(['result' => $result, 'message' => 'Success'], 200);
    }

    public function fetchCompleteOrder(){
        $id = Input::get('id');

        $orders = DB::table('order')
            ->select('*')
            ->where('customer_id', '=', $id)
            ->where('status', '=', 2)
            ->get();
        $result = $this->buildOrderList($orders);

        if(!$result){
            return response()->json(['result' => [], 'message' => 'No item found'], 200);
        }
        return response()->json(['result' => $result, 'message' => 'Success'], 200);
    }

    public function updateInfo(){
        $inputCustomerInfo = json_decode(Input::get('customerInfo'));
        $customerInfo = $this->buildCustomerInfoInfoArray($inputCustomerInfo);
        $id = $inputCustomerInfo->id;

        $result = DB::table('users')
            ->where('id', $id)
            ->update($customerInfo);

        if($result){
            return response()->json(['message' => 'success'], 200);
        }else{
            return response()->json(['message' => 'fail'], 404);
        }
    }

    protected function buildCustomerInfoInfoArray($input){
        $output = [
            'name' => $input->name,
            'phone' => $input->phone,
            'address' => $input->address,
            'district' => $input->district,
            'city' => $input->city,
            'updated_at' => \Carbon\Carbon::now()
        ];
        return $output;
    }

    private function buildOrderList($orders){
        $result = [];
        foreach($orders as $key_order => $order){
            $result[$key_order] = $order;
            $result[$key_order]->product_info = $this->fetchProductsInOrder($order->id);

            $result[$key_order]->price = 0;
            foreach($result[$key_order]->product_info as $key => $product){
                $result[$key_order]->price += (int)$product->product_total_cost;
            }
        }
        return $result;
    }

    private function fetchProductsInOrder($id){
        $result = DB::table('order_product')
            ->select('*')
            ->where('order_id', '=', $id)
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