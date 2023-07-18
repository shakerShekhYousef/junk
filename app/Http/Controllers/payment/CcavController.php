<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\front\FrontUserController;
use App\Models\Fee;
use App\Models\Order;
use App\Models\Package;
use App\Models\PackagesMember;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CcavController extends Controller
{

    public function dropdownhandler($id)
    {
        if ($id == 1) {
            $frontsercontroller = new FrontUserController();
            return $frontsercontroller->addfreepackage();
        }
        $package = Package::find($id);
        $payment = PaymentSetting::first();
        $merchant_data = '';
        $working_key = $payment->working_key;
        $access_code = $payment->access_code;

        $lastOrder = \App\Models\Order::orderBy('created_at', 'desc')->first();
        if (!$lastOrder) {
            $number = 0;
        } else {
            $number = substr($lastOrder->order_id, 3);
        }
        $order_id = '#' . sprintf("%08d", intval($number) + 1);

        $data = [
            "amount" => $package->cost,
            "merchant_id" => $payment->merchant_id,
            "currency" => $package->cost_type,
            "order_id" => $order_id,
            "redirect_url" => url('payWithCcav/response'),
            "cancel_url" => url('payWithCcav/response'),
            "language" => "EN"
        ];

        Order::create([
            'package_id' => $package->id,
            'order_id' => $order_id,
            'currency' => $package->cost_type,
            'order_type' => "Purchase a package",
            'member_id' => Auth::user()->id,
            'cost' => $package->cost
        ]);
        // // dd($request->toArray());
        foreach ($data as $key => $value) {
            $merchant_data .= $key . '=' . $value . '&';
        }
        $encrypted_data = $this->encrypt($merchant_data, $working_key);

        return view('front.ccavenue', compact('encrypted_data', 'access_code'));
    }

    public function handler(Request $request)
    {
        // $sessionId = Session::getId();
        $payment = PaymentSetting::first();
        $merchant_data = '';
        $working_key = $payment->working_key;
        $access_code = $payment->access_code;
        Order::create([
            'package_id' => $request->payment_type_id,
            'order_id' => $request->order_id,
            'currency' => $request->currency,
            'order_type' => "Purchase a package",
            'member_id' => Auth::user()->id,
            'cost' => $request->amount
        ]);
        foreach ($request->toArray() as $key => $value) {
            $merchant_data .= $key . '=' . $value . '&';
        }
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
        $packagemember->freeze_value = 1;
        $packagemember->freeze_start_date = today();
        $packagemember->save();

        $package = Package::find($packagemember->package_id);

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
            "redirect_url" => url('fpayWithCcav/response'),
            "cancel_url" => url('fpayWithCcav/response'),
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
            "redirect_url" => url('feepayWithCcav/response'),
            "cancel_url" => url('feepayWithCcav/response'),
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



    // public function response()
    // {
    //     $workingKey = '';        //Working Key should be provided here.
    //     $encResponse = $_POST["encResp"];    //This is the response sent by the CCAvenue Server
    //     $rcvdString = $this->decrypt($encResponse, $workingKey);        //Crypto Decryption used as per the specified working key.
    //     $order_status = "success";
    //     $decryptValues = explode('&', $rcvdString);
    //     $dataSize = sizeof($decryptValues);
    //     echo "<center>";

    //     for ($i = 0; $i < $dataSize; $i++) {
    //         $information = explode('=', $decryptValues[$i]);
    //         if ($i == 3) $order_status = $information[1];
    //     }

    //     if ($order_status === "Success") {
    //         echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
    //     } else if ($order_status === "Aborted") {
    //         echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
    //     } else if ($order_status === "Failure") {
    //         echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
    //     } else {
    //         echo "<br>Security Error. Illegal access detected";
    //     }

    //     echo "<br><br>";

    //     echo "<table cellspacing=4 cellpadding=4>";
    //     for ($i = 0; $i < $dataSize; $i++) {
    //         $information = explode('=', $decryptValues[$i]);
    //         echo '<tr><td>' . $information[0] . '</td><td>' . $information[1] . '</td></tr>';
    //     }

    //     echo "</table><br>";
    //     echo "</center>";
    // }


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
