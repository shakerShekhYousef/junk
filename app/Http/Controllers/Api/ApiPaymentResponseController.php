<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\EmailAfterPaymentComplete;
use App\Models\Fee;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderInfo;
use App\Models\Package;
use App\Models\PackagesMember;
use App\Models\PaymentSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ApiPaymentResponseController extends Controller
{
    public function response()
    {
        $payment = PaymentSetting::first();
        $workingKey = $payment->working_key;
        $encResponse = $_POST["encResp"];  //This is the response sent by the CCAvenue Server
        $rcvdString = $this->decrypt($encResponse, $workingKey);    //Crypto Decryption used as per the specified working key.
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);
        $payment = new \stdClass();
        for ($i = 0; $i < $dataSize; $i++) {
            $information = explode('=', $decryptValues[$i]);
            switch ($i) {
                case 0:
                    $payment->order_id = $information[1];
                    break;
                case 1:
                    $payment->tracking_id = $information[1];
                    break;
                case 3:
                    $payment->order_status = $information[1];
                    break;
                case 5:
                    $payment->payment_mode = $information[1];
                    break;
                case 6:
                    $payment->card_name = $information[1];
                    break;
                case 11:
                    $payment->billing_name = $information[1];
                    break;
                case 12:
                    $payment->billing_address = $information[1];
                    break;
                case 13:
                    $payment->billing_city = $information[1];
                    break;
                case 14:
                    $payment->billing_state = $information[1];
                    break;
                case 15:
                    $payment->billing_zip = $information[1];
                    break;
                case 16:
                    $payment->billing_country = $information[1];
                    break;
                case 17:
                    $payment->billing_tel = $information[1];
                    break;
                case 18:
                    $payment->billing_email = $information[1];
                    break;
                case 19:
                    $payment->delivery_name = $information[1];
                    break;
                case 20:
                    $payment->delivery_address = $information[1];
                    break;
                case 21:
                    $payment->delivery_city = $information[1];
                    break;
                case 22:
                    $payment->delivery_state = $information[1];
                    break;
                case 23:
                    $payment->delivery_zip = $information[1];
                    break;
                case 24:
                    $payment->delivery_country = $information[1];
                    break;
                case 25:
                    $payment->delivery_tel = $information[1];
                    break;
            }
        }

        $order = Order::where('order_id', $payment->order_id)->first();
        //user
        $user = User::where('id', $order->member_id)->first();
        //package
        $package = Package::where('id', $order->package_id)->first();
        if ($payment->order_status == "Success") {
            //insert into package_members
            $validtill = null;
            if ($package->valid_for_type == "Day") {
                $validtill = today()->addDays($package->valid_for_value)->toDateString();
            } else if ($package->valid_for_type == "Month") {
                $validtill = today()->addMonths($package->valid_for_value)->toDateString();
            } else if ($package->valid_for_type == "Year") {
                $validtill = today()->addYears($package->valid_for_value)->toDateString();
            }

            $packagemember = PackagesMember::create([
                'package_id' => $package->id,
                'member_id' =>  Auth::user()->id,
                'valid_till' =>  $validtill,
                'purchase_status' => 'valid'
            ]);

            //update order
            $order->update([
                'transaction_id' => $payment->tracking_id,
                'currency' => "AED",
                'status' => 1,
                'package_member_id' =>  $packagemember->id
            ]);

            // add to order info
            OrderInfo::create([
                'order_id' => $order->id,
                'tracking_id' => $payment->tracking_id,
                'payment_mode' => $payment->payment_mode,
                'card_name' => $payment->card_name,
                'billing_name' => $payment->billing_name,
                'billing_address' => $payment->billing_address,
                'billing_city' => $payment->billing_city,
                'billing_state' => $payment->billing_state,
                'billing_zip' => $payment->billing_zip,
                'billing_country' => $payment->billing_country,
                'billing_tel' => $payment->billing_tel,
                'billing_email' => $payment->billing_email,
                'delivery_name' => $payment->delivery_name,
                'delivery_address' => $payment->delivery_address,
                'delivery_city' => $payment->delivery_city,
                'delivery_state' => $payment->delivery_state,
                'delivery_zip' => $payment->delivery_zip,
                'delivery_country' => $payment->delivery_country,
                'delivery_tel' => $payment->delivery_tel
            ]);

            //send email to member
            $text = "Package name: " . $package->name .
                "<br/> Sessions count: " . $package->sessions_count .
                "<br/> cost: " . $package->cost . ' ' . $package->cost_type;
            $data = [
                'member_name' =>  $user->username(),
                'description' => $text
            ];
            Mail::to($user->email)->send(new EmailAfterPaymentComplete($data));

            //send notification to member
            Notification::create([
                'notification_type' => 'package',
                'member_id' => $user->id,
                'message' => $text
            ]);

            //return to home page with success message
            return response()->json(['success' => true, 'message' => 'Purchase package ' . $payment->order_status]);
        }

        $order->delete();
        return response()->json(['success' => false, 'message' => 'Purchase package ' . $payment->order_status]);
    }

    public function freezresponse()
    {
        // $current_session = Session::getId();
        $payment = PaymentSetting::first();
        $workingKey = $payment->working_key;
        $encResponse = $_POST["encResp"];  //This is the response sent by the CCAvenue Server
        $rcvdString = $this->decrypt($encResponse, $workingKey);    //Crypto Decryption used as per the specified working key.
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);
        $payment = new \stdClass();

        for ($i = 0; $i < $dataSize; $i++) {
            $information = explode('=', $decryptValues[$i]);
            switch ($i) {
                case 0:
                    $payment->order_id = $information[1];
                    break;
                case 1:
                    $payment->tracking_id = $information[1];
                    break;
                case 3:
                    $payment->order_status = $information[1];
                    break;
                case 5:
                    $payment->payment_mode = $information[1];
                    break;
                case 6:
                    $payment->card_name = $information[1];
                    break;
                case 11:
                    $payment->billing_name = $information[1];
                    break;
                case 12:
                    $payment->billing_address = $information[1];
                    break;
                case 13:
                    $payment->billing_city = $information[1];
                    break;
                case 14:
                    $payment->billing_state = $information[1];
                    break;
                case 15:
                    $payment->billing_zip = $information[1];
                    break;
                case 16:
                    $payment->billing_country = $information[1];
                    break;
                case 17:
                    $payment->billing_tel = $information[1];
                    break;
                case 18:
                    $payment->billing_email = $information[1];
                    break;
                case 19:
                    $payment->delivery_name = $information[1];
                    break;
                case 20:
                    $payment->delivery_address = $information[1];
                    break;
                case 21:
                    $payment->delivery_city = $information[1];
                    break;
                case 22:
                    $payment->delivery_state = $information[1];
                    break;
                case 23:
                    $payment->delivery_zip = $information[1];
                    break;
                case 24:
                    $payment->delivery_country = $information[1];
                    break;
                case 25:
                    $payment->delivery_tel = $information[1];
                    break;
            }
        }

        $order = Order::where('order_id', $payment->order_id)->first();
        $packagemember = PackagesMember::find($order->package_member_id);
        if ($payment->order_status == "Success") {
            $order->update([
                'transaction_id' => $payment->tracking_id,
                // 'currency' => "AED",
                'status' => 1
            ]);

            // add to order info
            OrderInfo::create([
                'order_id' => $order->id,
                'tracking_id' => $payment->tracking_id,
                'payment_mode' => $payment->payment_mode,
                'card_name' => $payment->card_name,
                'billing_name' => $payment->billing_name,
                'billing_address' => $payment->billing_address,
                'billing_city' => $payment->billing_city,
                'billing_state' => $payment->billing_state,
                'billing_zip' => $payment->billing_zip,
                'billing_country' => $payment->billing_country,
                'billing_tel' => $payment->billing_tel,
                'billing_email' => $payment->billing_email,
                'delivery_name' => $payment->delivery_name,
                'delivery_address' => $payment->delivery_address,
                'delivery_city' => $payment->delivery_city,
                'delivery_state' => $payment->delivery_state,
                'delivery_zip' => $payment->delivery_zip,
                'delivery_country' => $payment->delivery_country,
                'delivery_tel' => $payment->delivery_tel
            ]);

            //update order

            $packagemember->freeze_approved = true;
            $packagemember->valid_till = Carbon::parse($packagemember->valid_till)->addMonths($packagemember->freeze_value);
            $packagemember->save();

            // user
            $user = User::find($packagemember->member_id);
            $text = 'Dear subscriber your subscribtion is suspended till ' . $packagemember->valid_till . ' your subscribtion will continue after that';
            // make notifiatin
            Notification::create([
                'notification_type' => 'package',
                'member_id' => $user->id,
                'message' =>  $text
            ]);

            // mail user
            $data = [
                'member_name' =>  $user->username(),
                'description' =>  $text
            ];
            Mail::to($user->email)->send(new EmailAfterPaymentComplete($data));

            return response()->json(['success' => true, 'message' => 'Purchase freeze ' . $payment->order_status]);
        }
        $order->delete();
        return response()->json(['success' => false, 'message' => 'Purchase freeze ' . $payment->order_status]);
    }

    function encrypt($plainText, $key)
    {
        $key = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        $encryptedText = bin2hex($openMode);
        return $encryptedText;
    }

    public function feesresponse()
    {
        // $current_session = Session::getId();
        $payment = PaymentSetting::first();
        $workingKey = $payment->working_key;    //Working Key should be provided here.
        $encResponse = $_POST["encResp"];  //This is the response sent by the CCAvenue Server
        $rcvdString = $this->decrypt($encResponse, $workingKey);    //Crypto Decryption used as per the specified working key.
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);
        $payment = new \stdClass();
        for ($i = 0; $i < $dataSize; $i++) {
            $information = explode('=', $decryptValues[$i]);
            switch ($i) {
                case 0:
                    $payment->order_id = $information[1];
                    break;
                case 1:
                    $payment->tracking_id = $information[1];
                    break;
                case 3:
                    $payment->order_status = $information[1];
                    break;
                case 5:
                    $payment->payment_mode = $information[1];
                    break;
                case 6:
                    $payment->card_name = $information[1];
                    break;
                case 11:
                    $payment->billing_name = $information[1];
                    break;
                case 12:
                    $payment->billing_address = $information[1];
                    break;
                case 13:
                    $payment->billing_city = $information[1];
                    break;
                case 14:
                    $payment->billing_state = $information[1];
                    break;
                case 15:
                    $payment->billing_zip = $information[1];
                    break;
                case 16:
                    $payment->billing_country = $information[1];
                    break;
                case 17:
                    $payment->billing_tel = $information[1];
                    break;
                case 18:
                    $payment->billing_email = $information[1];
                    break;
                case 19:
                    $payment->delivery_name = $information[1];
                    break;
                case 20:
                    $payment->delivery_address = $information[1];
                    break;
                case 21:
                    $payment->delivery_city = $information[1];
                    break;
                case 22:
                    $payment->delivery_state = $information[1];
                    break;
                case 23:
                    $payment->delivery_zip = $information[1];
                    break;
                case 24:
                    $payment->delivery_country = $information[1];
                    break;
                case 25:
                    $payment->delivery_tel = $information[1];
                    break;
            }
        }

        $order = Order::where('order_id', $payment->order_id)->first();
        $fee = Fee::find($order->package_id);
        if ($payment->order_status == "Success") {
            $order->update([
                'transaction_id' => $payment->tracking_id,
                // 'currency' => "AED",
                'status' => 1
            ]);

            // add to order info
            OrderInfo::create([
                'order_id' => $order->id,
                'tracking_id' => $payment->tracking_id,
                'payment_mode' => $payment->payment_mode,
                'card_name' => $payment->card_name,
                'billing_name' => $payment->billing_name,
                'billing_address' => $payment->billing_address,
                'billing_city' => $payment->billing_city,
                'billing_state' => $payment->billing_state,
                'billing_zip' => $payment->billing_zip,
                'billing_country' => $payment->billing_country,
                'billing_tel' => $payment->billing_tel,
                'billing_email' => $payment->billing_email,
                'delivery_name' => $payment->delivery_name,
                'delivery_address' => $payment->delivery_address,
                'delivery_city' => $payment->delivery_city,
                'delivery_state' => $payment->delivery_state,
                'delivery_zip' => $payment->delivery_zip,
                'delivery_country' => $payment->delivery_country,
                'delivery_tel' => $payment->delivery_tel
            ]);

            //update fee
            $fee->fee_status = "paid";
            $fee->save();

            // user
            $user = User::find($fee->member_id);
            $text = 'Thank you for pay this fee ' . $fee->fee_amount . ' <br/> type: ' . $fee->fee_type;
            // make notifiatin
            Notification::create([
                'notification_type' => 'package',
                'member_id' => $user->id,
                'message' => $text
            ]);

            // mail user
            $data = [
                'member_name' =>  $user->username(),
                'description' =>  $text
            ];
            Mail::to($user->email)->send(new EmailAfterPaymentComplete($data));

            return response()->json(['success' => true, 'message' => 'Fee pay ' . $payment->order_status]);
        }
        $order->delete();
        return response()->json(['success' => false, 'message' => 'Fee pay ' . $payment->order_status]);
    }

    function decrypt($encryptedText, $key)
    {
        $key = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = $this->hextobin($encryptedText);
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
