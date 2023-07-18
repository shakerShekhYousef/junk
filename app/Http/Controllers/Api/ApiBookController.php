<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\JobSendBookEmailForUserAndAdmin;
use App\Mail\EmailFeeToUser;
use App\Models\Book;
use App\Models\Fee;
use App\Models\Notification;
use App\Models\Package;
use App\Models\PackagesMember;
use App\Models\Session;
use App\Models\SessionsMember;
use App\Models\User;
use App\Models\UserBalance;
use Carbon\Carbon;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ApiBookController extends Controller
{
    public function index()
    {
        try {
            $books = Book::paginate(10);
            return response()->json(['success' => true, 'books' => $books]);
        } catch (\Throwable $th) {
            $this->errorLog('ApiBookController@index', $th->getMessage());
        }
    }
    //////////show book
    public function show($id)
    {
        try {
            $book = Book::find($id);
            if ($book == null) {
                return response()->json(['success' => false, 'message' => 'Book not found']);
            }
            return response()->json(['success' => true, 'book' => $book]);
        } catch (\Throwable $th) {
            $this->errorLog('ApiBookController@show', $th->getMessage());
        }
    }
    //////////////////////destroy book
    public function destroy($id)
    {
        try {

            $book = Book::find($id);
            if ($book == null)
                return response()->json(['success' => false, 'message' => 'Book not found']);
            else {
                $session = Session::find($book->session_id);
                $user = User::find($book->member_id);

                // check if cancel before 8 hour of session start
                $temp = Carbon::parse($book->day_name)->diffInHours(now()->toDateTimeString());

                if ($temp < 8) {
                    // add fee
                    $fee = Fee::create([
                        'member_id' => $user->id,
                        'fee_type' => 'session',
                        'type_id' => $session->id,
                        'fee_amount' => 50,
                        'fee_amount_type' => 'AED',
                        'description' => 'Dear subscriber ' . $user->username() . ' this fee is du to cancelation of session ' . $session->classm->name . ' book befor less than 8 hour of session start',
                        'fee_status' => 'unpaid',
                    ]);

                    $data = ['fee_amount' => $fee->fee_amount, 'fee_amount_type' => $fee->fee_amount_type, 'session_name' => $session->classm->name];
                    Mail::to($user->email)->send(new EmailFeeToUser($data));

                    Notification::create([
                        'notification_type' => 'Fee entitlement',
                        'member_id' => $user->id,
                        'message' => $fee->description
                    ]);
                }

                $book->delete();

                return response()->json(['success' => true, 'message' => 'Book deleted !']);
            }
        } catch (\Throwable $th) {
            $this->errorLog('ApiBookController@destroy', $th->getMessage());
        }
    }
    //////////////////////////create  book
    public function store(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:sessions,id',
            // 'member_id' => 'required|exists:users,id',

        ]);

        $user = Auth::user();
        if ($user->role_id != 4)
            return response()->json(['success' => false, 'message' => 'please register as member']);

        // check if user has balance
        $userbalance = $user->getavailablebalance();
        if ($userbalance == 0)
            return response()->json(['success' => false, 'message' => 'you do not have balance you should buy a package']);


        $session = Session::find($request->session_id);

        // check is completed
        if ($session->sessionbookedmemberscountinday($session->id, $request->bookdate) == $session->capacity) {
            return response()->json(['success' => false, 'message' => 'this session is completed']);
        }

        try {
            $book = Book::firstOrCreate(
                [
                    'class_id' => $session->class_id,
                    'session_id' => $request->session_id,
                    'member_id' => $user->id,
                    'bookdate' => $request->bookdate,
                    'status' => 'Pending'
                ],
                [
                    'class_id' => $session->class_id,
                    'session_id' => $request->session_id,
                    'member_id' => $user->id,
                    'bookdate' => $request->bookdate,
                    'day_name' => $request->bookdate . ' ' . $session->start_time,
                    'status' => 'Pending'
                ]
            );

            if ($book->wasRecentlyCreated) {
                // $session->users()->attach($request->member_id, ['role_id' => 4]);

                $emaildata = [
                    'memberemail' => $user->email,
                    'classname' => $session->classm->name,
                    'membername' => $user->username(),
                    'sessionlink' => route('sessions.show', $session->id),
                    'userlink' => route('users.show', $user->id)
                ];

                try {
                    JobSendBookEmailForUserAndAdmin::dispatch($emaildata);
                } catch (\Throwable $th) {
                }

                $url = route('web_calander_data_show') . '/' . session()->get('classid') . '/' . session()->get('musicid', 0) . '/' . session()->get('coachid', 0) . '/' . session()->get('weekid') . '/3';

                return response()->json(['success' => true, 'message' => 'Booking created', 'url' => $url]);
            } else {
                return response()->json(['success' => false, 'message' => 'Booking already done!']);
            }

            // return view()
        } catch (\Throwable $th) {
            $this->errorLog('ApiBookController@store', $th->getMessage());
        }
    }
    ////////////////////////update  book
    public function update(Request $request, $id)
    {

        try {
            $book = Book::find($id);
            if ($book == null) {
                return response()->json(['success' => false, 'message' => 'Book not found !']);
            }
            if ($request->member_id != null) {
                $user = User::find($request->member_id);
                if ($user->role_id != 4)
                    return response()->json(['success' => false, 'message' => 'please register as member']);


                // check if user has balance
                $userbalance = $user->getavailablebalance();
                if ($userbalance == 0)
                    return response()->json(['success' => false, 'message' => 'you do not have balance you should buy a package']);
            }
            if ($request->session_id != null) {
                $session = Session::find($request->session_id);

                // check is completed
                if ($session->sessionbookedmemberscountinday($session->id, $request->bookdate) == $session->capacity) {
                    return response()->json(['success' => false, 'message' => 'this session is completed']);
                }
            }

            $request->class_id != null ? $book->class_id = $request->class_id : null;
            $request->session_id != null ? $book->session_id = $request->session_id : null;
            $request->member_id != null ? $book->member_id = $request->member_id : null;
            $request->bookdate != null ? $book->bookdate = $request->bookdate : null;

            $request->bookdate != null ? $book->day_name = $request->bookdate . ' ' . $session->start_time : null;
            $request->status != null ? $book->status = $request->status : null;
            $book->save();
            return response()->json(['success' => true, 'message' => 'Book Updated!']);
        } catch (\Throwable $th) {
            $this->errorLog('ApiBookController@store', $th->getMessage());
        }
    }
    // /////////////////get available for booking
    // public function getAvalilableForBooking()
    // {
    //     try {

    //         $sessions = Session::where('status', '!=', 'Finished')->get();

    //         if ($sessions == null) {
    //             return response()->json(['success' => false, 'message' => 'All session finished']);
    //         }
    //         $data = [];
    //         foreach ($sessions as $key => $session) {
    //             $data[] = [
    //                 'session' => $session,
    //                 'membercount' => $session->sessionmemberscount()
    //             ];
    //         }
    //         return response()->json(['success' => true, 'available for booking' => $data]);
    //     } catch (\Throwable $th) {
    //         $this->errorLog('ApiBookController@store', $th->getMessage());
    //     }
    // }
    //////////////////////view expiration of purchase
    public function viewexpirationofpurchase()
    {
        $purchaseslist = [];
        $users = User::get();
        $packagememebers = PackagesMember::get();
        $packages = Package::get();
        foreach ($packagememebers as $key => $packagememeber) {
            $user = $users->where('id', $packagememeber->member_id)->first();
            $username = $user != null ? $user->username() : null;
            $packagename = $packages->where('id', $packagememeber->package_id)->first()->name;
            $purchaseslist[] = [
                'user_id' => $user->id,
                'user_name' => "<a href=" . route('users.show', $user->id) . ">$username</a>",
                'package_name' => $packagename,
                'payment_date' =>  $packagememeber->created_at->toDateString(),
                'expire_date' =>   $packagememeber->valid_till->toDateString(),
                'remain_for_expiration' => Carbon::parse($packagememeber->valid_till)->diffInDays(today())
            ];
        }
        return response()->json(['success' => true, 'purchaseslist' => $purchaseslist]);
    }

    ////////////////fees
    public function getfees()
    {
        try {
            $fees = Fee::all();
            if ($fees == null) {
                return response()->json(['message' => 'No fees'], 400);
            }
            $users = User::get();
            foreach ($fees as $key => $fee) {
                $fee->member_id = $users->where('id', $fee->member_id)->first()->username();
                $fee->save();
            }
            return response()->json(['success' => true, 'fees' => $fees]);
        } catch (\Throwable $th) {
            $this->errorLog('ApiBookController@getfees', $th->getMessage());
        }
    }


    ////////////get user fees
    public function getuserfees()
    {
        try {
            $fees = Fee::where('member_id', Auth::user()->id)->get();
            if ($fees == null) {
                return response()->json(['message' => 'No fees for you'], 400);
            }
            return response()->json(['success' => true, 'myfees' => $fees]);
        } catch (\Throwable $th) {
            $this->errorLog('ApiBookController@getuserfees', $th->getMessage());
        }
    }
}
