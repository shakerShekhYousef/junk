<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\Order;
use App\Models\Package;
use App\Models\PackagesMember;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class ApiPaymentController extends Controller
{

    public function handler(Request $request)
    {
        // add free package
        if ($request->package_id == 1) {
            $temp = PackagesMember::where('member_id', Auth::user()->id)->where('package_id', 1)->first();
            if ($temp != null)
                if ($temp->count() != 0)
                    return response()->json(['success' => false, 'message' => 'Sorry you already add this free package']);

            PackagesMember::create([
                'package_id' => 1,
                'member_id' => Auth::user()->id,
                'purchase_status' => 'valid',
                'valid_till' => now()->addYears(10)
            ]);

            return response()->json(['success' => true, 'message' => 'Free package added']);
        }
        $payment = PaymentSetting::orderBy('created_at', 'desc')->first();
        $merchant_data = '';
        $working_key = $payment->working_key;
        $access_code = $payment->access_code;

        // get new order id
        $lastOrder = Order::orderBy('created_at', 'desc')->first();
        if (!$lastOrder) {
            $number = 0;
        } else {
            $number = substr($lastOrder->order_id, 3);
        }
        $order_id = '#' . sprintf('%08d', intval($number) + 1);

        // package data
        $package = Package::find($request->package_id);
        if ($package == null)
            return response()->json(['success' => false, 'message' => 'Package not found']);

        Order::create([
            'package_id' => $request->package_id,
            'order_id' => $order_id,
            'currency' => $package->cost_type,
            'order_type' => "Purchase a package",
            'member_id' => Auth::user()->id,
            'cost' => $package->cost
        ]);

        $merchant_data .= 'amount=' . $package->cost . '&';
        $merchant_data .= 'merchant_id=' . $payment->merchant_id . '&';
        $merchant_data .= 'currency=' . $package->cost_type . '&';
        $merchant_data .= 'order_id=' . $order_id . '&';
        $merchant_data .= 'redirect_url=' . route('api_payWithCcav.response') . '&';
        $merchant_data .= 'cancel_url=' . route('api_payWithCcav.response') . '&';
        $merchant_data .= 'language=EN' . '&';
        $encrypted_data = $this->encrypt($merchant_data, $working_key);

        return view('front.ccavenue', compact('encrypted_data', 'access_code'));
    }

    public function freezehandler(Request $request) // id is packagemembers id
    {
        // $id, $value
        $id = $request->id;
        $value = $request->value;
        $payment = PaymentSetting::first();
        $merchant_data = '';
        $working_key = $payment->working_key;
        $access_code = $payment->access_code;

        $packagemember = PackagesMember::find($id);
        if ($packagemember == null)
            return response()->json(['success' => false, 'message' => 'Package not found']);
        $packagemember->freeze_value = 1;
        $packagemember->freeze_start_date = today();
        $packagemember->save();

        $package = Package::find($packagemember->package_id);
        if ($package == null)
            return response()->json(['success' => false, 'message' => 'Package not found']);

        $lastOrder = \App\Models\Order::orderBy('created_at', 'desc')->first();
        if (!$lastOrder) {
            $number = 0;
        } else {
            $number = substr($lastOrder->order_id, 3);
        }
        $order_id = '#' . sprintf("%08d", intval($number) + 1);

        if ($value == 1)
            $cost = 100;
        else if ($value == 2)
            $cost = 200;

        $data = [
            "amount" => $cost,
            "merchant_id" => $payment->merchant_id,
            "currency" => $package->cost_type,
            "order_id" => $order_id,
            "redirect_url" => route('api_fpayWithCcav.response'),
            "cancel_url" => route('api_fpayWithCcav.response'),
            "language" => "EN"
        ];

        Order::create([
            'package_id' => $package->id,
            'order_id' => $order_id,
            'member_id' => Auth::user()->id,
            'order_type' => "Freeze a package",
            'cost' => $cost,
            'package_member_id' => $id,
            'currency' => $package->cost_type,
        ]);
        foreach ($data as $key => $value) {
            $merchant_data .= $key . '=' . $value . '&';
        }

        $encrypted_data = $this->encrypt($merchant_data, $working_key);

        return view('front.ccavenue', compact('encrypted_data', 'access_code'));
    }

    public function feeshandler(Request $request)
    {
        // $id, $value
        $id = $request->id; // Fee id
        // $value = $request->value;
        $payment = PaymentSetting::first();
        $merchant_data = '';
        $working_key = $payment->working_key;
        $access_code = $payment->access_code;

        $fee = Fee::find($id);
        if ($fee == null)
            return response()->json(['success' => false, 'message' => 'Fee not found']);

        $lastOrder = \App\Models\Order::orderBy('created_at', 'desc')->first();
        if (!$lastOrder) {
            $number = 0;
        } else {
            $number = substr($lastOrder->order_id, 3);
        }
        $order_id = '#' . sprintf("%08d", intval($number) + 1);

        $data = [
            "amount" => $fee->fee_amount,
            "merchant_id" => $payment->merchant_id,
            "currency" => $fee->fee_amount_type,
            "order_id" => $order_id,
            "redirect_url" => route('api_feepayWithCcav.response'),
            "cancel_url" => route('api_feepayWithCcav.response'),
            "language" => "EN"
        ];

        Order::create([
            'package_id' => $fee->id,
            'order_id' => $order_id,
            'member_id' => Auth::user()->id,
            'order_type' => "Pay for a fee",
            'cost' => $fee->fee_amount,
            'currency' => $fee->fee_amount_type,
            'package_member_id' => $id
        ]);
        foreach ($data as $key => $value) {
            $merchant_data .= $key . '=' . $value . '&';
        }

        $encrypted_data = $this->encrypt($merchant_data, $working_key);

        return view('front.ccavenue', compact('encrypted_data', 'access_code'));
    }


    function encrypt($plainText, $key)
    {
        $key = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        $encryptedText = bin2hex($openMode);
        return $encryptedText;
    }

    function decrypt($encryptedText, $key)
    {
        $key = hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = hextobin($encryptedText);
        $decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        return $decryptedText;
    }

    //*********** Padding Function *********************

    function pkcs5_pad($plainText, $blockSize)
    {
        $pad = $blockSize - (strlen($plainText) % $blockSize);
        return $plainText . str_repeat(chr($pad), $pad);
    }

    //********** Hexadecimal to Binary function for php 4.0 version ********

    function hextobin($hexString)
    {
        $length = strlen($hexString);
        $binString = "";
        $count = 0;
        while ($count < $length) {
            $subString = substr($hexString, $count, 2);
            $packedString = pack("H*", $subString);
            if ($count == 0) {
                $binString = $packedString;
            } else {
                $binString .= $packedString;
            }

            $count += 2;
        }
        return $binString;
    }
}
