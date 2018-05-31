<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Product;
use App\Tasting;
use DateTime;
use Response;

class TastingApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function checkTastingExist(){
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

        // if($exist[0]->quantity <= 0){
        //     return response()->json(['id' => $id, 'message' => 'out_of_stock'], 200);
        // }

        return response()->json(['id' => $id, 'result' => $exist[0], 'message' => 'success'], 200);
    }

    public function checkout(){
        // Build Personal information
        $inputPersonalInfo = json_decode(Input::get('personalInfo'));
        $personalInfo = $this->buildPersonalInfoArray($inputPersonalInfo);
        $result = false;
        DB::beginTransaction();
        try {
            $tastingId = DB::table('tasting')->insertGetId($personalInfo);
            if($tastingId){
                // Build tasting by products received
                $inputTasting = json_decode(Input::get('tastingInfo1'), true);
                
                $tastingInfo = $this->buildTastingInfoArray($tastingId, $inputTasting['product']);
                
                $result = DB::table('tasting_product')->insert($tastingInfo);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        
        if($result){
            return response()->json(['message' => 'success'], 200);
        }else{
            return response()->json(['message' => 'fail'], 200);
        }
    }

    protected function buildTastingInfoArray($tastingId, $inputTasting){
        $output = [];
        foreach($inputTasting as $key => $value){
            $output[$key] = [
                'tasting_id' => $tastingId,
                'product_id' => $value['id'],
                'product_name' => $value['name']
            ];
        }
        return $output;
    }
    protected function buildPersonalInfoArray($inputpersonalInfo){
        $output = [
            'customer_id' => $inputpersonalInfo->id,
            'customer_name' => $inputpersonalInfo->name,
            'customer_email' => $inputpersonalInfo->email,
            'customer_phone' => $inputpersonalInfo->phone,
            'customer_address' => $inputpersonalInfo->address,
            'customer_district' => $inputpersonalInfo->district,
            'customer_city' => $inputpersonalInfo->city,
            'people' => $inputpersonalInfo->people,
            'customer_content' => (!empty($inputpersonalInfo->content)) ? $inputpersonalInfo->content : '',
            'time' => (!empty($inputpersonalInfo->time)) ? $inputpersonalInfo->time.' '.$inputpersonalInfo->hour.':'.$inputpersonalInfo->minute.':00' : ''
        ];
        if($inputpersonalInfo->store == true){
            $output['is_store'] = 1;
        }else{
            $output['is_store'] = 0;
        }
        return $output;
    }
    
}
