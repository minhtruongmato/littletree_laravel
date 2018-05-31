<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Response;
use File;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
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
    public function listing($target){
        $query = DB::table('order')
            ->select('*');
        if($target == 'ongoing'){
            $status = 1;
        }elseif($target == 'complete'){
            $status = 2;
        }elseif($target == 'pending'){
            $status = 0;
        }elseif($target == 'cancel'){
            $status = 99;
        }else{
            $status = 0;
        }
        $orders = $query->where('status', '=', $status)->orderBy('id', 'desc')->get();
        $result = $this->buildOrderList($orders);

        return view('admin/order/index', ['orders' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $type
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
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
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }

    /**
     * Search state from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $constraints = [
            'unique_code' => $request['unique_code']
        ];
        $search = $this->doSearchingQuery($constraints);

        $orders = $this->buildOrderList($search);

        return view('admin/order/search', ['orders' => $orders, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints){
        $query = DB::table('order')
            ->select('order.*');
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where($fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->get();
    }

    /**
     * Confirmed and send product to customer
     * Each product's quantity will be decrease by quantity of order
     * Order's status change to 1 (on-going)
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($id){
        $order = $this->fetchOrderById($id);

        if(!empty($order)){
            $orderProducts = DB::table('order_product')
                ->where('order_id', $order[0]->id)
                ->get();

            foreach($orderProducts as $value){
                $product = $this->fetchProductById($value->product_id);

                if(empty($product)){
                    return redirect()->intended('admin/order/ongoing');
                }
                if($product[0]->quantity <= 0){
                    return redirect()->intended('admin/order/ongoing');
                }

                $new_quantity = (int)($product[0]->quantity) - (int)($value->product_quantity);
                DB::table('product')
                    ->where('id', $value->product_id)
                    ->update(['quantity' => $new_quantity]);
            }

            DB::table('order')
                ->where('id', $id)
                ->update([
                    'status' => 1,
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            return redirect()->intended('admin/order/pending');
        }
    }

    public function cancel($id){
        $order = $this->fetchOrderById($id);

        if(!empty($order)){
            DB::table('order')
                ->where('id', $id)
                ->update([
                    'status' => 99,
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            return redirect()->intended('admin/order/pending');
        }
    }

    public function rollback($id){
        $order = $this->fetchOrderById($id);

        if(!empty($order)){
            $orderProducts = DB::table('order_product')
                ->where('order_id', $order[0]->id)
                ->get();

            foreach($orderProducts as $value){
                $product = $this->fetchProductById($value->product_id);

                if(empty($product)){
                    return redirect()->intended('admin/order/ongoing');
                }

                $new_quantity = (int)($product[0]->quantity) + (int)($value->product_quantity);
                DB::table('product')
                    ->where('id', $value->product_id)
                    ->update(['quantity' => $new_quantity]);
            }

            DB::table('order')
                ->where('id', $id)
                ->update([
                    'status' => 0,
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            return redirect()->intended('admin/order/ongoing');
        }
    }

    /**
     * Products've success delivered to customer
     * Gotcha cash
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complete($id){
        $order = $this->fetchOrderById($id);

        if(!empty($order)){
            if($order[0]->status == 0){
                return redirect()->intended('admin/order/pending');
            }

            DB::table('order')
                ->where('id', $id)
                ->update([
                    'status' => 2,
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            return redirect()->intended('admin/order/ongoing');
        }
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

    private function fetchOrderById($id){
        $result = DB::table('order')
            ->where('id', $id)
            ->limit(1)
            ->get();

        return $result;
    }

    private function buildOrderList($orders){
        $result = [];
        foreach($orders as $key_order => $order){
            $result[$key_order] = $order;
            $result[$key_order]->product_info = $this->fetchProductsInOrder($order->id);

            $result[$key_order]->price = 0;
            foreach($result[$key_order]->product_info as $key => $product){
                $result[$key_order]->product_info[$key]->detail = $this->fetchProductById($product->product_id);
                $result[$key_order]->price += (int)$product->product_total_cost;
            }
        }
        return $result;
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

    public function excelPending(){

        $exportPending = $this->queryExcel(0);
        $newExportPending = array();
        $newExportOngoing = array();
        $newExportComplete = array();
        $newExportCancel = array();
        $error = array(
                    'Tên sản phẩm' => 'Tên sản phẩm',
                    'Số lượng mua' => 'Số lượng mua',
                    'Tổng giá tiền' => 'Tổng giá tiền',
                    'Code thanh toán' => 'Code thanh toán',
                    'Tên khách hàng' => 'Tên khách hàng',
                    'Email khách hàng' => 'Email khách hàng',
                    'Số điện thoại' => 'Số điện thoại',
                    'Phố' => 'Phố',
                    'Quận' => 'Quận',
                    'Thành phố' => 'Thành phố',
                    'Lời nhắn' => 'Lời nhắn',
                    'Phương thức thanh toán' => 'Phương thức thanh toán'
                );

        if ($exportPending) {
            foreach ($exportPending as $key => $value) {
                $payment_method = null;
                if($value->payment_method == 1){
                    $payment_method = 'Thanh toán khi giao hàng (COD)';
                }else{
                    $payment_method = 'Chuyển khoản ';
                }
                $newExportPending[$key + 1] = array(
                    'Tên sản phẩm' => $value->product_name,
                    'Số lượng mua' => $value->product_quantity,
                    'Tổng giá tiền' => $value->price * $value->product_quantity.' VND',
                    'Code thanh toán' => $value->unique_code,
                    'Tên khách hàng' => $value->customer_name,
                    'Email khách hàng' => $value->customer_email,
                    'Số điện thoại' => $value->customer_phone,
                    'Phố' => $value->customer_address,
                    'Quận' => $value->customer_district,
                    'Thành phố' => $value->customer_city,
                    'Lời nhắn' => $value->customer_content,
                    'Phương thức thanh toán' => $payment_method
                );
            }
        }

        $exportOngoing = $this->queryExcel(1);
        if ($exportOngoing) {
            foreach ($exportOngoing as $key => $value) {
                $payment_method = null;
                if($value->payment_method == 1){
                    $payment_method = 'Thanh toán khi giao hàng (COD)';
                }else{
                    $payment_method = 'Chuyển khoản ';
                }
                $newExportOngoing[$key + 1] = array(
                    'Tên sản phẩm' => $value->product_name,
                    'Số lượng mua' => $value->product_quantity,
                    'Tổng giá tiền' => $value->price * $value->product_quantity.' VND',
                    'Code thanh toán' => $value->unique_code,
                    'Tên khách hàng' => $value->customer_name,
                    'Email khách hàng' => $value->customer_email,
                    'Số điện thoại' => $value->customer_phone,
                    'Phố' => $value->customer_address,
                    'Quận' => $value->customer_district,
                    'Thành phố' => $value->customer_city,
                    'Lời nhắn' => $value->customer_content,
                    'Phương thức thanh toán' => $payment_method
                );
            }
        }

        $exportComplete = $this->queryExcel(2);
        if ($exportComplete) {
            foreach ($exportComplete as $key => $value) {
                $payment_method = null;
                if($value->payment_method == 1){
                    $payment_method = 'Thanh toán khi giao hàng (COD)';
                }else{
                    $payment_method = 'Chuyển khoản ';
                }
                $newExportComplete[$key + 1] = array(
                    'Tên sản phẩm' => $value->product_name,
                    'Số lượng mua' => $value->product_quantity,
                    'Tổng giá tiền' => $value->price * $value->product_quantity.' VND',
                    'Code thanh toán' => $value->unique_code,
                    'Tên khách hàng' => $value->customer_name,
                    'Email khách hàng' => $value->customer_email,
                    'Số điện thoại' => $value->customer_phone,
                    'Phố' => $value->customer_address,
                    'Quận' => $value->customer_district,
                    'Thành phố' => $value->customer_city,
                    'Lời nhắn' => $value->customer_content,
                    'Phương thức thanh toán' => $payment_method
                );
            }
        }

        $exportCancel = $this->queryExcel(99);
        if ($exportCancel) {
            foreach ($exportCancel as $key => $value) {
                $payment_method = null;
                if($value->payment_method == 1){
                    $payment_method = 'Thanh toán khi giao hàng (COD)';
                }else{
                    $payment_method = 'Chuyển khoản ';
                }
                $newExportCancel[$key + 1] = array(
                    'Tên sản phẩm' => $value->product_name,
                    'Số lượng mua' => $value->product_quantity,
                    'Tổng giá tiền' => $value->price * $value->product_quantity.' VND',
                    'Code thanh toán' => $value->unique_code,
                    'Tên khách hàng' => $value->customer_name,
                    'Email khách hàng' => $value->customer_email,
                    'Số điện thoại' => $value->customer_phone,
                    'Phố' => $value->customer_address,
                    'Quận' => $value->customer_district,
                    'Thành phố' => $value->customer_city,
                    'Lời nhắn' => $value->customer_content,
                    'Phương thức thanh toán' => $payment_method
                );
            }
        }
        
        
        Excel::create('Order_'.date('d-m-Y'), function($excel) use($newExportPending, $newExportOngoing, $newExportComplete, $newExportCancel, $error){
            $excel->sheet('Chờ xác nhận', function($sheet) use($newExportPending){
                $sheet->fromArray($newExportPending);
            });
            
            if($newExportOngoing != null){
                $excel->sheet('Đã xác nhận', function($sheet) use($newExportOngoing){
                    $sheet->fromArray($newExportOngoing);
                });
            }else{
                $excel->sheet('Đã xác nhận', function($sheet) use($error){
                    $sheet->fromArray($error);
                });
            }

            if($newExportComplete != null){
                $excel->sheet('Đã hoàn thành', function($sheet) use($newExportComplete){
                    $sheet->fromArray($newExportComplete);
                });
            }else{
                $excel->sheet('Đã hoàn thành', function($sheet) use($error){
                    $sheet->fromArray($error);
                });
            }

            if($newExportCancel != null){
                $excel->sheet('Đã bỏ qua', function($sheet) use($newExportCancel){
                    $sheet->fromArray($newExportCancel);
                });
            }else{
                $excel->sheet('Đã bỏ qua', function($sheet) use($error){
                    $sheet->fromArray($error);
                });
            }
        })->export('xls');
    }

    protected function queryExcel($status){
        $query = DB::table('order_product')
                ->join('order', 'order.id', '=', 'order_product.order_id')
                ->join('product', 'order_product.product_id', '=', 'product.id' )
                ->select('order_product.product_name', 'order_product.product_quantity', 'order_product.product_total_cost', 'order.unique_code', 'order.customer_name', 'order.customer_email', 'order.customer_phone', 'order.customer_address', 'order.customer_district', 'order.customer_city', 'order.customer_content', 'order.payment_method', 'product.price')
                ->where('order.status', $status)->get()->toArray();
        return $query;
    }
}
