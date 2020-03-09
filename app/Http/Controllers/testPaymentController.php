<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyCrypt;
use App\Jobs\TestPayment;

class testPaymentController extends Controller
{
    //
	public function getTestPayment(Request $request){
		$sign = $request->header('X-Signature');
		
		if(!$sign) 
			return response()->json([
			"status"=>"failed"
			]);
		$crypt=new MyCrypt; 
		$sidStatus=$crypt->decrypt($sign);
		if($sidStatus!=1){
			return response()->json([
			"status"=>"failed"
			]);
		}
		$data = json_decode($request->input('data'),1);
		TestPayment::dispatch($data["order_number"],$data["sum"]);
		return response()->json([
			"status"=>"ok",
			"sig"=>$sidStatus
        ]);
	}
}
