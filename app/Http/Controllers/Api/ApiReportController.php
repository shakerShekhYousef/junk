<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RequestM;
use App\Models\Session;
use App\Models\SessionsHistory;
use App\Models\SessionsMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\OrderInfo;
use App\Models\Package;
use App\Models\Book;
use App\Models\PackagesMember;
use App\Models\ServiceRating;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Str;

class ApiReportController extends Controller
{
   public function getordersinfo(){
       $orders=Order::where('status',true)->get();
       $orderinfos = OrderInfo::all();
       $users = User::all();
       $packages = Package::all();
       $dateslist = [];
       $ordertypelist = [];
       $data = [];
        foreach ($orders as $key => $order) {
            $package = $packages->where('id', $order->package_id)->first();
            $user = $users->where('id', $order->member_id)->first();
            $orderinfo = $orderinfos->where('order_id', $order->id)->first();
       $data[] = [
        'id' => $order->id,
        'order_id' => $order->order_id,
        'member' => $user->username(),
        'package' => $package->name,
        'cost' => $order->cost,
        'currency' => $order->currency,
        'order_date' => $order->created_at->toDateString(),
        'order_type' => $order->order_type,
        'payment_mode' => $orderinfo != null ? $orderinfo->payment_mode : null,
        'card_name' => $orderinfo != null ? $orderinfo->card_name : null,
        'billing_name' => $orderinfo != null ? $orderinfo->billing_name : null,
        'billing_address' => $orderinfo != null ? $orderinfo->billing_address : null,
        'billing_city' => $orderinfo != null ? $orderinfo->billing_city : null,
        'billing_state' => $orderinfo != null ? $orderinfo->billing_state : null,
        'billing_zip' => $orderinfo != null ? $orderinfo->billing_zip : null,
        'billing_country' => $orderinfo != null ? $orderinfo->billing_country : null,
        'billing_tel' => $orderinfo != null ? $orderinfo->billing_tel : null,
        'billing_email' => $orderinfo != null ? $orderinfo->billing_email : null,
        'delivery_name' => $orderinfo != null ? $orderinfo->delivery_name : null,
        'delivery_address' => $orderinfo != null ? $orderinfo->delivery_address : null,
        'delivery_city' => $orderinfo != null ? $orderinfo->delivery_city : null,
        'delivery_state' => $orderinfo != null ? $orderinfo->delivery_state : null,
        'delivery_zip' => $orderinfo != null ? $orderinfo->delivery_zip : null,
        'delivery_country' => $orderinfo != null ? $orderinfo->delivery_country : null,
        'delivery_tel' => $orderinfo != null ? $orderinfo->delivery_tel : null
    ];

    if (!in_array($order->created_at->toDateString(), $dateslist))
        array_push($dateslist, $order->created_at->toDateString());

    if (!in_array($order->order_type, $ordertypelist))
        array_push($ordertypelist, $order->order_type);
}

return response()->json(['success'=>true,'data'=>$data,'packages'=>$packages,'users'=>$users,'dateslist'=>$dateslist,'ordertypelist'=>$ordertypelist]);

}
//////////list service rate
public function listservicerates()
{
    try{
    $rates = ServiceRating::all();
    if($rates == null){
        return response()->json(['success'=>false,'message'=>'No rates fouund'],400);
    }
    $users = User::get();
    foreach ($rates as $key => $rate) {
        $rate->member_name = $users->where('id', $rate->memeber_id)->first()->username();
        $rate->is_your_elements_accurately_found = $rate->is_your_elements_accurately_found == 1 ? 'Yes' : 'No';
        $rate->did_you_need_customers_service = $rate->did_you_need_customers_service == 1 ? 'Yes' : 'No';
    }
    return response()->json(['success'=>true,'rates'=>$rates]);
} catch (\Throwable $th) {
    $this->errorLog('ApiReportController@listservicerates', $th->getMessage());
}
}
 //////////////////////destroy service rate
 public function destroyrate($id)
 {
     try{
    $serviceRate= ServiceRating::where('memeber_id', $id)->first();
     if($serviceRate == null){
         return response()->json(['success'=>false,'message'=>'No Service Rate found'],400);
     }
     $serviceRate->delete();
     return response()->json(['success'=>true,'message'=>'Member rate deleted']);
    } catch (\Throwable $th) {
        $this->errorLog('ApiReportController@destroyrate', $th->getMessage());
    }
 }  
 ///////////////////users datatable
 public function usersdatatable(){
     $users=User::where('role_id',4)->get();
     $bookuser = Book::get();
     $packages = PackagesMember::join("packages", "packages.id", "=", "packages_members.package_id")->where("purchase_status", "valid")->get();
     $data=[];
     foreach ($users as $key => $user) {
        $data = $packages->where("member_id", $user->id);
        $result = null;
        // if (!empty($request->get('validtilldate'))) {
            // $data = $packages->where("member_id", $user->id);
        //     $result = null;
        //     foreach ($data as $key => $item) {
        //         $packagedatadiff = Carbon::parse($item->valid_till)->diffInDays($request->get('validtilldate'));
        //         if ($packagedatadiff == 0) {
        //             $result .= "<b>" . $item->name . "</b> <small>" . $item->valid_till->toDateString() . "</small></br>";
        //         }
        //     }
        //     return $result;
        // } else {
            $data = $packages->where("member_id", $user->id);
            $result = null;
            foreach ($data as $key => $item) {
                if ($item != null) {
                    $result .= "<b>" . $item->name . "</b> <small>" . $item->valid_till->toDateString() . "</small></br>";
                }
            }
        //     return $result;
        // }
         $data[]=[
             'id'=>$user->id,
             'Name'=>$user->username(),
             'Email'=>$user->email,
             'gender'=>$user->gender,
             'Date of Brith'=>$user->dob,
             'Total Incomming Sessions'=>$bookuser->where('member_id', $user->id)->where('status', 'Pending')->count(),
             'Total Attend Sessions'=>$bookuser->where('member_id', $user->id)->where('status', 'Finished')->where("attended", true)->count(),
             'Total Booked And Not Attended Session'=>$bookuser->where('member_id', $user->id)->where('status', 'Finished')->where("attended", false)->count(),
             'Package Expiration of date'=>$result,

         ];

 }
 return response()->json(['success'=>true,'users'=>$data]);
}
////////////////////////////order filter
public function getordersinfofiltered($package = null, $user = null, $date = null, $type = null)
{
    $orders = Order::query()->where('status', true);
    if ($package != "null")
    
        $orders = $orders->where('package_id', $package);
        if($orders == null){
            return response()->json(['success'=>false,'message'=>'No orders for this package'],400);
        }
    if ($user != "null")
        $orders = $orders->where('member_id', $user);
        if($orders == null){
            return response()->json(['success'=>false,'message'=>'No orders for this user'],400);
        }
    if ($type != "null")
        $orders = $orders->where('order_type', $type);
        if($orders == null){
            return response()->json(['success'=>false,'message'=>'No orders for this type'],400);
        }
    if ($date != "null") {
        $date = Carbon::parse($date)->toDateString();
        $orders = $orders->whereDate('created_at', $date);
        if($orders == null){
            return response()->json(['success'=>false,'message'=>'No orders for this date'],400);
        }
    }
    $orders = $orders->get();
    if($orders == null){
        return response()->json(['success'=>false,'message'=>'No orders found'],400);
    }
    $ordersids = $orders->pluck('id');
    $orderinfos = OrderInfo::whereIn('order_id', $ordersids)->get();
    $users = User::all();
    $packages = Package::all();
    $data = [];
    foreach ($orders as $key => $order) {

        $package = $packages->where('id', $order->package_id)->first();
        $user = $users->where('id', $order->member_id)->first();
        $orderinfo = $orderinfos->where('order_id', $order->id)->first();
        $data[] = [
            'id' => $order->id,
            'order_id' => $order->order_id,
            'member' => $user->username(),
            'package' => $package->name,
            'cost' => $order->cost,
            'currency' => $order->currency,
            'order_date' => $order->created_at->toDateString(),
            'order_type' => $order->order_type,
            'payment_mode' => $orderinfo->payment_mode,
            'card_name' => $orderinfo->card_name,
            'billing_name' => $orderinfo->billing_name,
            'billing_address' => $orderinfo->billing_address,
            'billing_city' => $orderinfo->billing_city,
            'billing_state' => $orderinfo->billing_state,
            'billing_zip' => $orderinfo->billing_zip,
            'billing_country' => $orderinfo->billing_country,
            'billing_tel' => $orderinfo->billing_tel,
            'billing_email' => $orderinfo->billing_email,
            'delivery_name' => $orderinfo->delivery_name,
            'delivery_address' => $orderinfo->delivery_address,
            'delivery_city' => $orderinfo->delivery_city,
            'delivery_state' => $orderinfo->delivery_state,
            'delivery_zip' => $orderinfo->delivery_zip,
            'delivery_country' => $orderinfo->delivery_country,
            'delivery_tel' => $orderinfo->delivery_tel
        ];
    }
    return response()->json(['success'=>true,'orders'=>$data]);
}
}