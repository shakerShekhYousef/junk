<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Fee;
use App\Models\Order;
use App\Models\Package;
use App\Models\PackagesMember;
use App\Models\ServiceRating;
use App\Models\User;
use App\Models\UserInformation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class FrontUserController extends Controller
{
    public function myprofile()
    {
        return view('front.my-profile', ['user' => Auth::user(), 'profiletype' => 1]);
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);
        if ($user == null) {
            session()->flash('error', 'User not found!');
            return redirect()->back();
        }

        if ($request->password != null && $request->password_confirmation != null) {
            if (strcmp($request->password_confirmation, $request->password) != 0) {
                session()->flash('error', 'Password and confirmation not equal!');
                return redirect()->back();
            }
        }


        try {

            $age = null;
            if ($request->dob != null) {
                $age = Carbon::parse($request->dob)->diff(now())->y;
            }

            $name = explode(' ', $request->name);

            $fname = $name[0];
            $lname = $name[1];

            $request->name != null ? $user->fname = $fname : null;
            $request->name != null ? $user->lname = $lname : null;
            $request->gender != null ? $user->gender = $request->gender : null;
            $request->screen_name != null ? $user->screen_name = $request->screen_name : null;
            $request->dob != null ? $user->dob = $request->dob : null;
            $request->dob != null ? $user->age = $age : null;
            $request->height != null ? $user->height = $request->height : null;
            $request->weight != null ? $user->weight = $request->weight : null;
            $request->address1 != null ? $user->address1 = $request->address1 : null;
            $request->address2 != null ? $user->address2 = $request->address2 : null;
            $request->city != null ? $user->city = $request->city : null;
            $request->state != null ? $user->state = $request->state : null;
            $request->zip_code != null ? $user->zip_code = $request->zip_code : null;
            $request->country != null ? $user->country = $request->country : null;
            $request->phone != null ? $user->phone = $request->phone : null;
            $request->whats_app_phone != null ? $user->whats_app_phone = $request->whats_app_phone : null;
            $request->referred_by != null ? $user->referred_by = $request->referred_by : null;
            $request->emergency_contact_name != null ? $user->emergency_contact_name = $request->emergency_contact_name : null;
            $request->emergency_contact_number != null ? $user->emergency_contact_number = $request->emergency_contact_number : null;
            $request->emergency_contact_relation != null ? $user->emergency_contact_relation = $request->emergency_contact_relation : null;
            $request->tc_agree != null ? $user->tc_agree = $request->tc_agree : null;
            $request->role_id != null ? $user->role_id = $request->role_id : null;
            $request->password != null ? $user->password = Hash::make($request->password) : null;

            $userinfo = $user->userinfo;
            if ($userinfo == null) {
                $userinfo = UserInformation::create([
                    'member_id' => $user->id,
                    'how_did_you_hear_about_junk' => $request->how_did_you_hear_about_junk
                ]);
            } else {
                $userinfo->how_did_you_hear_about_junk = $request->how_did_you_hear_about_junk;
                $userinfo->save();
            }

            $user->save();
            session()->flash('success', 'User updated');
            return redirect()->back();
        } catch (\Throwable $th) {
            $this->errorLog('UserController@update', $th->getMessage());
        }
    }

    public function getcurrentusersessions()
    {
        $useid = Auth::user()->id;
        $sessions = Book::join('sessions', 'sessions.id', 'books.session_id')
            ->join('classes', 'classes.id', 'sessions.class_id')
            ->where('books.member_id', $useid)
            ->where('books.status', 'Pending')
            ->get(['sessions.start_time', 'sessions.end_time', 'day_name', 'classes.name', 'books.bookdate']);

        foreach ($sessions as $key => $session) {
            $sessionday = Carbon::parse($session->bookdate)->dayName;
            $session->day_name = $sessionday;
        }

        return view('front.my-profile', ['sessions' => $sessions, 'profiletype' => 3]);
    }

    public function getprevioususersessions()
    {
        $useid = Auth::user()->id;
        $sessions = Book::join('sessions', 'sessions.id', 'books.session_id')
            ->join('classes', 'classes.id', 'sessions.class_id')
            ->where('books.member_id', $useid)
            ->where('books.status', 'Finished')
            ->get(['sessions.start_time', 'sessions.end_time', 'day_name', 'classes.name', 'books.bookdate']);

        foreach ($sessions as $key => $session) {
            $sessionday = Carbon::parse($session->bookdate)->dayName;
            $session->day_name = $sessionday;
        }

        return view('front.my-profile', ['sessions' => $sessions, 'profiletype' => 4]);
    }

    // purcahse
    public function getuserpayments()
    {
        $payments = Order::where('member_id', Auth::user()->id)->where('status', true)->get();
        $total = 0;
        $currency = null;
        if ($payments->count() > 0) {
            $total = $payments->sum('cost');
            $currency = $payments->first()->currency;
        }
        return view('front.my-profile', ['payments' => $payments, 'profiletype' => 2, 'total' => $total, 'currency' => $currency]);
    }

    // packages
    public function getuserpackages()
    {
        $useid = Auth::user()->id;
        // $payments = Order::join('packages', 'packages.id', 'orders.package_id')
        //     ->where('member_id', $useid)
        //     ->where('orders.status', true)
        //     ->get(['orders.order_type', 'orders.package_member_id', 'packages.name', 'orders.cost', 'orders.currency', 'orders.created_at']);

        $packagesmembers = PackagesMember::where('member_id', Auth::user()->id)->get();
        $packages = Package::all();
        $packagesdata = [];
        foreach ($packagesmembers as $key => $packagemember) {
            $packagedata = $packages->where('id', $packagemember->package_id)->first();
            $packagesdata[] = [
                'name' => $packagedata->name,
                'cost' => $packagedata->cost,
                'currency' => $packagedata->cost_type,
                'payment_date' => $packagedata->created_at,
                'status' => $packagemember->freeze_approved ? 'frozen' : $packagemember->purchase_status,
                'package_member_id' => $packagemember->id,
                'valid_till' => Carbon::parse($packagemember->valid_till)->toDateString(),
                'frozen_end_date' => Carbon::parse($packagemember->freeze_start_date)->addMonths($packagemember->freeze_value)->toDateString()
            ];
            // $packagemember = $packagemembers->where('id', $payment->package_member_id)->first();
            // $payment->is_frozen = $packagemember->freeze_approved;
        }

        return view('front.my-profile', ['payments' => $packagesdata, 'profiletype' => 5]);
    }

    public function getfees()
    {
        $fees = Fee::all();
        $users = User::get();
        foreach ($fees as $key => $fee) {
            $fee->member_id = $users->where('id', $fee->member_id)->first()->username();
        }
        return view('dashboard.payment.fees', ['fees' => $fees]);
    }

    public function getuserfees()
    {
        $fees = Fee::where('member_id', Auth::user()->id)->get();
        return view('front.my-profile', ['fees' => $fees, 'profiletype' => 6]);
    }

    public function addfreepackage()
    {
        $temp = PackagesMember::where('member_id', Auth::user()->id)->where('package_id', 1)->first();
        if ($temp != null)
            if ($temp->count() != 0)
                return redirect()->back()->with(['error' => "Sorry you already add this free package"]);

        PackagesMember::create([
            'package_id' => 1,
            'member_id' => Auth::user()->id,
            'purchase_status' => 'valid',
            'valid_till' => now()->addYears(10)
        ]);

        return redirect()->route('web_calander_data_show')->with(['success' => 'Free package added successffuly']);
    }

    public function frontindex()
    {
        $packages = Package::get();
        return view('front.home', ['packages' => $packages]);
    }

    public function servicerate(Request $request, $id)
    {
        $request->validate(
            [
                'serviceRate' => 'required',
                'specialization_in_our_service' => 'required',
                'is_your_elements_accurately_found' => 'required',
                'did_you_need_customers_service' => 'required',
            ],
            [
                'serviceRate.required' => 'You should select service rate',
                'specialization_in_our_service.required' => 'You should select what makes your experience with us so special',
            ]
        );
        $specialization_in_our_service = explode(',', $request->specialization_in_our_service);
        $rate = ServiceRating::firstOrCreate(['memeber_id' => $id], [
            'memeber_id' => $id,
            'service_rate' => $request->serviceRate,
            'specialization_in_our_service' => json_encode($specialization_in_our_service, true),
            'is_your_elements_accurately_found' => $request->is_your_elements_accurately_found,
            'did_you_need_customers_service' => $request->did_you_need_customers_service,
            'comments' => $request->comments
        ]);
        return $rate->wasRecentlyCreated;
    }

    public function getuserrate($id)
    {
        $rate = ServiceRating::where('memeber_id', $id)->first()->pluck('service_rate');
        return $rate;
    }

    public function viewemailrate($id)
    {
        $user = User::find($id);
        return view('emails.rate', ['user' => $user]);
    }
}
