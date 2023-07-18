<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderInfo;
use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // get order data
    //
    public function getordersinfo()
    {
        $orders = Order::where('status', true)->get();
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

        return view('dashboard.order.index', ['data' => $data, 'packages' =>  $packages, 'users' => $users, 'dateslist' => $dateslist, 'ordertypelist' => $ordertypelist]);
    }

    public function getordersinfodatatable(Request $request)
    {
        $orders = Order::query()->where('status', true);
        $users = User::all();
        $packages = Package::all();

        return Datatables::of($orders)
            ->addIndexColumn()
            ->addColumn('package', function ($order) use ($packages) {
                $package = $packages->where('id', $order->package_id)->first()->name;
                return $package;
            })
            ->addColumn('member', function ($order) use ($users) {
                $user = $users->where('id', $order->member_id)->first()->username();
                return $user;
            })
            ->addColumn('details', function ($order) {
                $actionBtn = '<a href=' . route('web_get_order_info_by_id', $order->id) . ' class="fas fa-eye"></a>' . " ";
                return $actionBtn;
            })
            ->filter(function ($instance) use ($request) {
                if (!empty($request->get('package'))) {
                    $instance->where('package_id', $request->get('package'));
                }
                if (!empty($request->get('member'))) {
                    $instance->where('member_id', $request->get('member'));
                }
                if (!empty($request->get('type'))) {
                    $instance->where('order_type', $request->get('type'));
                }
                if (!empty($request->get('startDate')) && !empty($request->get('endDate'))) {
                    $startDate = Carbon::parse($request->get('startDate'));
                    $endDate = Carbon::parse($request->get('endDate'));
                    $instance->whereBetween('created_at', [$startDate, $endDate]);
                }
            })

            ->rawColumns(['details'])
            ->make(true);
    }

    public function getordersinfofiltered($package = null, $user = null, $date = null, $type = null)
    {
        $orders = Order::query()->where('status', true);
        if ($package != "null")
            $orders = $orders->where('package_id', $package);
        if ($user != "null")
            $orders = $orders->where('member_id', $user);
        if ($type != "null")
            $orders = $orders->where('order_type', $type);
        if ($date != "null") {
            $date = Carbon::parse($date)->toDateString();
            $orders = $orders->whereDate('created_at', $date);
        }
        $orders = $orders->get();
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

        return $data;
    }

    public function getorderinfobyid($id)
    {
        $order = Order::find($id);
        $orderinfo = OrderInfo::where('order_id', $id)->first();
        $user = User::where('id', $order->member_id)->first();
        $package = Package::where('id', $order->package_id)->first();
        $data = [
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
        return view('dashboard.order.show', ['data' => $data]);
    }
}
