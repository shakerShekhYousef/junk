<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
   public function checkout(Request $request){
       $sessionId=Session::getId();
       //store in session (payment_type , payment_type_id , payment_value , total_amount)
       Session::put('total_amount',$request->total_amount);
       Session::put('payment_value',$request->payment_value);
       Session::put('payment_type_id',$request->payment_type_id);
       Session::put('payment_type',$request->payment_type);
       //return view front.checkout
       return true;
   }
}
