<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\JobEmailFeeToUser;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return $books;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:sessions,id',
            // 'member_id' => 'required|exists:users,id'
        ]);

        $user = Auth::user();
        if ($user->role_id != 4)
            return back()->with('error', 'Please Register as a Member To Continue <br> You Are An Admin');

        // check if user has balance
        $userbalance = $user->getavailablebalance();
        if ($userbalance == 0)
            return back()->with('error', "You don't have balance you should buy a package");

        $session = Session::find($request->session_id);

        // check is completed
        if ($session->sessionbookedmemberscountinday($session->id, $request->bookdate) == $session->capacity) {
            return back()->with('error', "This session is completed");
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
                // $session->users()->attach($user->id, ['role_id' => 4]);

                // send email to user and admin
                $emaildata = [
                    'memberemail' => $user->email,
                    'classname' => $session->classm->name,
                    'membername' => $user->username(),
                    'sessionlink' => route('sessions.show', $session->id),
                    'userlink' => route('users.show', $user->id)
                ];

                JobSendBookEmailForUserAndAdmin::dispatch($emaildata);

                $url = route('web_calander_data_show') . '/' . session()->get('classid') . '/' . session()->get('musicid', 0) . '/' . session()->get('coachid', 0) . '/' . session()->get('weekid') . '/3';

                return redirect()->to($url)->with(['success' => 'Booking success']);
            } else {
                return back()->with('error', 'Booking already done!');
            }

            // return view()
        } catch (\Throwable $th) {
            $this->errorLog('BookController@store', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return $book;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $book = Book::find($id);
            $session = Session::find($book->session_id);
            $user = User::find($book->member_id);

            if ($book == null)
                return 'Booking not found';
            else {

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

                    $data = ['email' => $user->email, 'fee_amount' => $fee->fee_amount, 'fee_amount_type' => $fee->fee_amount_type, 'session_name' => $session->classm->name];
                    JobEmailFeeToUser::dispatch($data);
                    Notification::create([
                        'notification_type' => 'Fee entitlement',
                        'member_id' => $user->id,
                        'message' => $fee->description
                    ]);
                }

                // cancel session booking
                // SessionsMember::where('session_id', $book->session_id)->where('member_id', $book->member_id)->where('role_id', 4)->delete();
                $book->delete();

                return back();
            }
        } catch (\Throwable $th) {
            $this->errorLog('BookController@destroy', $th->getMessage());
        }
    }

    // public function getAvalilableForBooking()
    // {
    //     $sessions = Session::where('status', '!=', 'Finished')->get();
    //     $data = [];
    //     foreach ($sessions as $key => $session) {
    //         $data[] = [
    //             'session' => $session,
    //             'membercount' => $session->sessionmemberscount()
    //         ];
    //     }
    //     return $data;
    // }

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
                // 'user_id' => $user->id,
                'user_name' => "<a href=" . route('users.show', $user->id) . ">$username</a>",
                'package_name' => $packagename,
                'payment_date' =>  $packagememeber->created_at->toDateString(),
                'expire_date' =>   $packagememeber->valid_till->toDateString(),
                'remain_for_expiration' => Carbon::parse($packagememeber->valid_till)->diffInDays(today())
            ];
        }
        return view('dashboard.payment.expirationofpurchase', ['purchaseslist' => $purchaseslist]);
    }
}

