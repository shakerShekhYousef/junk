<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Mail\RateServiceEmail;
use App\Models\Book;
use App\Models\BookHistory;
use App\Models\ClassM;
use App\Models\MemberSessionData;
use App\Models\Music;
use App\Models\Session;
// use App\Models\SessionDay;
use App\Models\SessionsHistory;
use App\Models\SessionsMember;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    ///
    public function index()
    {
        $sessions = Session::all();
        foreach ($sessions as $key => $session) {
            $temp = "[";
            if ($session->recurring_type == "Weekly") {
                $temp0 = json_decode($session->recuring_interval);
                foreach ($temp0 as $key => $item) {
                    if ($item != end($temp0)) {
                        if ($item == 1)
                            $temp .= "sat,";
                        else if ($item == 2)
                            $temp .= "sun,";
                        else if ($item == 3)
                            $temp .= "mon,";
                        else if ($item == 4)
                            $temp .= "tue,";
                        else if ($item == 5)
                            $temp .= "wed,";
                        else if ($item == 6)
                            $temp .= "thu,";
                        else if ($item == 7)
                            $temp .= "fri,";
                    } else {
                        if ($item == 1)
                            $temp .= "sat";
                        else if ($item == 2)
                            $temp .= "sun";
                        else if ($item == 3)
                            $temp .= "mon";
                        else if ($item == 4)
                            $temp .= "tue";
                        else if ($item == 5)
                            $temp .= "wed";
                        else if ($item == 6)
                            $temp .= "thu";
                        else if ($item == 7)
                            $temp .= "fri";
                    }
                }
                $temp .= "]";
                $session->recuring_interval = $temp;
            }
        }

        return view('dashboard.session.index', compact('sessions'));
    }

    public function getcompletedsessions()
    {
        $sessions = Session::get();
        $books = Book::join('sessions', 'sessions.id', '=', 'books.session_id')->where('books.status', 'Pending')->select(DB::raw('count(*) as totalusers'), 'sessions.id', 'books.bookdate')->groupBy(['books.bookdate', 'books.session_id'])->get();
        $sessionslist = [];
        foreach ($books as $key => $book) {
            $session = $sessions->where('id', $book->id)->first();
            if ($session->capacity == $book->totalusers) {
                $sessionslist[] = [
                    'class' => $session->classm->name,
                    'start_time' => $session->start_time,
                    'end_time' => $session->end_time,
                    'capacity' => $session->capacity,
                    'opendate' => $book->bookdate,
                    'coach' => $session->coachname()
                ];
            }
        }
        return view('dashboard.session.completedindex', ['sessions' =>  $sessionslist]);
    }

    public function getuncompletedsessions()
    {
        $sessions = Session::get();
        $books = Book::join('sessions', 'sessions.id', '=', 'books.session_id')->where('books.status', 'Pending')->select(DB::raw('count(*) as totalusers'), 'sessions.id', 'books.bookdate')->groupBy(['books.bookdate', 'books.session_id'])->get();
        $sessionslist = [];
        foreach ($books as $key => $book) {
            $session = $sessions->where('id', $book->id)->first();
            if ($session->capacity > $book->totalusers) {
                $sessionslist[] = [
                    'class' => $session->classm->name,
                    'start_time' => $session->start_time,
                    'end_time' => $session->end_time,
                    'capacity' => $session->capacity . '/' . $book->totalusers,
                    'opendate' => $book->bookdate,
                    'coach' => $session->coachname()
                ];
            }
        }
        return view('dashboard.session.uncompletedindex', ['sessions' =>  $sessionslist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = ClassM::all();
        $musics = Music::all();
        $users = User::where('role_id', '3')->get();
        return view('dashboard.session.create', compact('classes', 'users', 'musics'));
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
            'class_id' => '|exists:classes,id',
            'start_time' => 'required',
            'end_time' => 'required',
            'capacity' => 'required',
            'coach_id' => 'required|exists:users,id,role_id,3'
        ]);

        try {

            $recuringinterval = null;
            if ($request->recurring_type == "Daily") {
                $recuringinterval = $request->recuring_interval_daily;
            } else if ($request->recurring_type == "Weekly") {
                $recuringinterval = json_encode($request->recuring_interval_weekly, JSON_NUMERIC_CHECK);
            }

            if ($request->minimum_open_type == "Date") {
                $opendate = Carbon::parse($request->minimum_open_value_d);
                $datedif = $opendate->lessThan(today());
                if ($datedif) {
                    session()->flash('error', 'Open date error value!');
                    return redirect()->route('sessions.index');
                }
            }
            $session = Session::firstOrCreate([
                'class_id' => $request->class_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'coach_id' => $request->coach_id
            ], [
                'class_id' => $request->class_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'capacity' => $request->capacity,
                'session_cost' => $request->session_cost,
                'total_cost' => $request->session_cost * $request->session_total_count,
                'coach_id' => $request->coach_id,
                'music_id' => $request->music_id,
                'status' => 'Pending',
                'recurring_type' => $request->recurring_type,
                'recuring_interval' =>  json_decode($recuringinterval),
                'session_total_count' => $request->session_total_count,
                'minimum_open_type' => $request->recurring_type != "None" ? $request->minimum_open_type : null,
                'minimum_open_value' => $request->minimum_open_type == 'Spot' ? $request->minimum_open_value : $request->minimum_open_value_d,
                'open_date' => ($request->minimum_open_type == "Date" || $request->recurring_type == "None") ? $request->minimum_open_value_d : null
            ]);
            if ($session->wasRecentlyCreated) {
                // add to session day
                // $sessiondays = null;
                // if ($session->recurring_type == "Daily") {
                //     $sessiondays = [['session_id' => $session->id, 'session_day' => 1], ['session_id' => $session->id, 'session_day' => 2], ['session_id' => $session->id, 'session_day' => 3], ['session_id' => $session->id, 'session_day' => 4], ['session_id' => $session->id, 'session_day' => 5], ['session_id' => $session->id, 'session_day' => 6], ['session_id' => $session->id, 'session_day' => 7]];
                // } else if ($session->recurring_type == "Weekly") {
                //     $recuringinterval = json_decode($recuringinterval);
                //     foreach ($recuringinterval as $key => $item) {
                //         $sessiondays[] = ['session_id' => $session->id, 'session_day' => $item];
                //     }
                // } else {
                //     $weekdays = ['Sat' => 1, 'Sun' => 2, 'Mon' => 3, 'Tue' => 4, 'Wed' => 5, 'Thu' => 6, 'Fri' => 7];
                //     $currentday = Carbon::parse($session->open_date)->shortDayName;
                //     $currentday = $currentday;
                //     $sessiondays = ['session_id' => $session->id, 'session_day' => $weekdays[$currentday]];
                // }

                // SessionDay::insert($sessiondays);
                // $session->users()->attach([$request->coach_id], ['role_id' => 3]);
                session()->flash('success', 'Session created');
                return redirect()->route('sessions.index');
            } else {
                session()->flash('error', 'Session already found!');
                return redirect()->route('sessions.index');
            }
            // return view
        } catch (\Throwable $th) {
            $this->errorLog('SessionController@store', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        return view('dashboard.session.show', compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classes = ClassM::all();
        $users = User::where('role_id', '3')->get();
        $musics = Music::all();
        $session = Session::find($id);

        if ($session != null)
            return view('dashboard.session.edit', compact('session', 'classes', 'users', 'musics'));
        else {
            session()->flash('error', 'Session not found!');
            return 'Session not found!';
        }
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
        $request->validate([
            'class_id' => '|exists:classes,id',
            'coach_id' => 'exists:users,id,role_id,3'
        ]);

        try {
            $session = Session::find($id);
            if ($session == null)
                return response()->json([
                    'success' => false, 'message' => 'Session not found!'
                ]);

            $recuringinterval = null;
            if ($request->recurring_type == "Daily") {
                $recuringinterval = $request->recuring_interval_daily;
            } else if ($request->recurring_type == "Weekly") {
                $recuringinterval = json_encode($request->recuring_interval_weekly, JSON_NUMERIC_CHECK);
            }

            $session->class_id = $request->class_id != null ?  $request->class_id : null;
            $session->start_time = $request->start_time != null ? $request->start_time : null;
            $session->end_time = $request->end_time != null ? $request->end_time : null;
            $session->capacity = $request->capacity != null ? $request->capacity : null;
            $session->coach_id = $request->coach_id != null ? $request->coach_id : null;
            $session->music_id = $request->music_id != null ? $request->music_id : null;
            $session->session_cost = $request->session_cost != null ? $request->session_cost : null;

            $totalsessioncost = 0;
            if ($request->session_cost != null && $request->session_total_count != null) {
                $totalsessioncost = $request->session_cost * $request->session_total_count;
            } else if ($request->session_cost == null && $request->session_total_count != null) {
                $totalsessioncost = $session->session_cost * $request->session_total_count;
            } else if ($request->session_cost != null && $request->session_total_count == null) {
                $totalsessioncost = $request->session_cost * $session->session_total_count;
            } else {
                $totalsessioncost = $session->session_cost * $session->session_total_count;
            }

            $session->total_cost = $totalsessioncost;
            $session->recurring_type = $request->recurring_type != null ? $request->recurring_type : null;
            $session->recuring_interval = $recuringinterval;
            $session->session_total_count = $request->session_total_count != null ? $request->session_total_count : null;
            $session->minimum_open_type = $request->minimum_open_type != null ? $request->minimum_open_type : null;
            if ($request->minimum_open_type == 'Spot' && $request->recurring_type != "None")
                $session->minimum_open_value = $request->minimum_open_value != null ? $request->minimum_open_value : null;
            else if ($request->minimum_open_type == 'Date' && $request->recurring_type != "None")
                $session->minimum_open_value = $request->minimum_open_value_d != null ? $request->minimum_open_value_d : null;
            $session->save();

            // update session day
            // remove old value
            // SessionDay::where('session_id', $session->id)->delete();
            // add to session day
            // $sessiondays = null;
            // if ($session->recurring_type == "Daily") {
            //     $sessiondays = [['session_id' => $session->id, 'session_day' => 1], ['session_id' => $session->id, 'session_day' => 2], ['session_id' => $session->id, 'session_day' => 3], ['session_id' => $session->id, 'session_day' => 4], ['session_id' => $session->id, 'session_day' => 5], ['session_id' => $session->id, 'session_day' => 6], ['session_id' => $session->id, 'session_day' => 7]];
            // } else if ($session->recurring_type == "Weekly") {
            //     $recuringinterval = json_decode($recuringinterval);
            //     foreach ($recuringinterval as $key => $item) {
            //         $sessiondays[] = ['session_id' => $session->id, 'session_day' => $item];
            //     }
            // } else {
            //     $weekdays = ['Sat' => 1, 'Sun' => 2, 'Mon' => 3, 'Tue' => 4, 'Wed' => 5, 'Thu' => 6, 'Fri' => 7];
            //     $currentday = Carbon::parse($session->open_date)->shortDayName;
            //     $sessiondays = ['session_id' => $session->id, 'session_day' => $weekdays[$currentday]];
            // }

            // SessionDay::insert($sessiondays);

            session()->flash('success', 'Session updated');
            return redirect()->route('sessions.index');
            // return view
        } catch (\Throwable $th) {
            $this->errorLog('SessionController@update', $th->getMessage());
        }
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
            $session = Session::find($id);
            if ($session == null)
                return response()->json([
                    'success' => false, 'message' => 'Session not found!'
                ]);

            // SessionDay::where('session_id', $session->id)->delete();

            $bookedsession = Book::where('session_id', $session->id)->count();
            if ($bookedsession > 0) {
                session()->flash('error', 'Session is booked from members please remove all books first then delete it');
                return redirect()->route('sessions.index');
            }
            
            $session->delete();

            session()->flash('success', 'Session deleted');
            return redirect()->route('sessions.index');
            // return view
        } catch (\Throwable $th) {
            $this->errorLog('SessionController@destroy', $th->getMessage());
        }
    }

    // done
    public function attendmembertosessionview()
    {
        $users = User::where('role_id', 4)->get();

        return view('dashboard.session.attendsession', ['users' => $users]);
    }

    public function getsessionusersinclass($id = 0)
    {
        $session = Session::find($id);
        if ($session != null)
            return $session->users->where('role_id', 4);
    }

    // done
    public function getsessionsforuserinday($id = 0)
    {
        // id is user id
        $userbooks = Book::join('sessions', 'sessions.id', '=', 'books.session_id')->join('classes', 'classes.id', '=', 'sessions.class_id')->where('books.status', 'Pending')->where('member_id', $id)->select('books.id', 'sessions.start_time', 'sessions.end_time', 'books.bookdate', 'classes.name')->get();


        // $sessions = [];
        // $sunbooks = Book::join('sessions', 'sessions.id', '=', 'books.session_id')->join('classes', 'classes.id', '=', 'sessions.class_id')->where('books.status', 'Pending')->where('books.day_name', 'sun')->where('member_id', $id)->select('books.id', 'sessions.start_time', 'sessions.end_time', 'books.day_name', 'classes.name')->get();
        // $monbooks = Book::join('sessions', 'sessions.id', '=', 'books.session_id')->join('classes', 'classes.id', '=', 'sessions.class_id')->where('books.status', 'Pending')->where('books.day_name', 'mon')->where('member_id', $id)->select('books.id', 'sessions.start_time', 'sessions.end_time', 'books.day_name', 'classes.name')->get();
        // $tuebooks = Book::join('sessions', 'sessions.id', '=', 'books.session_id')->join('classes', 'classes.id', '=', 'sessions.class_id')->where('books.status', 'Pending')->where('books.day_name', 'tue')->where('member_id', $id)->select('books.id', 'sessions.start_time', 'sessions.end_time', 'books.day_name', 'classes.name')->get();
        // $wedbooks = Book::join('sessions', 'sessions.id', '=', 'books.session_id')->join('classes', 'classes.id', '=', 'sessions.class_id')->where('books.status', 'Pending')->where('books.day_name', 'wed')->where('member_id', $id)->select('books.id', 'sessions.start_time', 'sessions.end_time', 'books.day_name', 'classes.name')->get();
        // $thubooks = Book::join('sessions', 'sessions.id', '=', 'books.session_id')->join('classes', 'classes.id', '=', 'sessions.class_id')->where('books.status', 'Pending')->where('books.day_name', 'thu')->where('member_id', $id)->select('books.id', 'sessions.start_time', 'sessions.end_time', 'books.day_name', 'classes.name')->get();
        // $fribooks = Book::join('sessions', 'sessions.id', '=', 'books.session_id')->join('classes', 'classes.id', '=', 'sessions.class_id')->where('books.status', 'Pending')->where('books.day_name', 'fri')->where('member_id', $id)->select('books.id', 'sessions.start_time', 'sessions.end_time', 'books.day_name', 'classes.name')->get();
        // $satbooks = Book::join('sessions', 'sessions.id', '=', 'books.session_id')->join('classes', 'classes.id', '=', 'sessions.class_id')->where('books.status', 'Pending')->where('books.day_name', 'sat')->where('member_id', $id)->select('books.id', 'sessions.start_time', 'sessions.end_time', 'books.day_name', 'classes.name')->get();

        // foreach ($sunbooks as $key => $sunbook) {
        //     array_push($sessions, $sunbook);
        // }
        // foreach ($monbooks as $key => $monbook) {
        //     array_push($sessions, $monbook);
        // }
        // foreach ($tuebooks as $key => $tuebook) {
        //     array_push($sessions, $tuebook);
        // }
        // foreach ($wedbooks as $key => $wedbook) {
        //     array_push($sessions, $wedbook);
        // }
        // foreach ($thubooks as $key => $thubook) {
        //     array_push($sessions, $thubook);
        // }
        // foreach ($fribooks as $key => $fribook) {
        //     array_push($sessions, $fribook);
        // }
        // foreach ($satbooks as $key => $satbook) {
        //     array_push($sessions, $satbook);
        // }

        // $usersids = Book::find($id)->pluck('member_id');
        // $users = User::whereIn('id', $usersids)->where('role_id', 4)->get();
        if ($userbooks != null)
            return $userbooks;
    }

    // done///
    public function generatesessiondailyqrcodeview()
    {
        $sessions = Book::join('sessions', 'sessions.id', '=', 'books.session_id')
            ->join('classes', 'classes.id', '=', 'sessions.class_id')
            ->where('books.status', 'Pending')
            ->groupBy(['books.bookdate', 'sessions.start_time', 'sessions.end_time'])
            ->select(['sessions.id', 'sessions.start_time', 'sessions.end_time', 'books.day_name', 'classes.name'])
            ->get();

        // session id in blade is book id
        return view('dashboard.session.generatesessiondailyqrcode', ['sessions' => $sessions]);
    }

    // done
    public function generatesessiondailyqrcode($id)
    {
        try {
            $qrcode =  QrCode::size(300)->backgroundColor(204, 255, 255)->generate(request()->root() . '/sessions/attendsession/' . $id);
            return view('dashboard.session.mytemplate', ['qrcode' => $qrcode]);
        } catch (\Throwable $th) {
            $this->errorLog('SessionController@generatesessionqrcode', $th->getMessage());
        }
    }

    // public function generatesessionqrcode($id)
    // {
    //     $session = Session::find($id);
    //     if ($session == null)
    //         throw ValidationException::withMessages(['id' => 'Session not found!']);

    //     try {
    //         $qrcode =  QrCode::size(300)->backgroundColor(204, 255, 255)->generate(request()->root() . '/sessions/attendsession/' . $id);
    //         if ($session->qrcode == null) {
    //             $session->qrcode = $qrcode;
    //             $session->save();
    //             return 'Qr code created';
    //         } else {
    //             return 'Session already has qrcode';
    //         }
    //     } catch (\Throwable $th) {
    //         $this->errorLog('SessionController@generatesessionqrcode', $th->getMessage());
    //     }
    // }

    public function getsessionqrcode($id)
    {
        $session = Session::find($id);
        if ($session == null)
            throw ValidationException::withMessages(['id' => 'Session not found!']);

        try {
            return $session->qrcode;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // done
    public function adminattendsession(Request $request)
    {
        $validate =  Validator::make($request->all(), [
            'session' => 'required|exists:books,id'
        ]);
        if ($validate->fails()) {
            session()->flash('error', $validate->getMessageBag()->first());
            return back();
        }

        //  session is book id
        $book = Book::find($request->session);

        $userinfo = User::find($book->member_id);

        if ($userinfo->role_id != 4) {
            session()->flash('error', 'User is not a member!');
            return back();
        }

        try {

            if ($book == null)
                return back()->with(['There is no booking for this user']);

            // attend user
            if ($book->attended) {
                session()->flash('error', 'Session already attended');
                return back();
            } else {
                $book->attended = true;
                $book->status = "Finished";
                $book->save();

                // change first class
                $userinfo->firstclass = false;
                $userinfo->save();

                // send survay email if first class of user
                if ($userinfo->firstclass) {
                    Mail::to($userinfo->email)->send(new RateServiceEmail($userinfo));
                }

                session()->flash('success', 'Session attended');
                return back();
            }
            // // finsih book
            // $book->status = "Finished";
            // $book->save();

            // $count = MemberSessionData::where('member_id', $book->member_id)->where('session_id', $book->session_id)->where('day_name', $book->day_name)->count();

            // if ($count == 0) {
            //     MemberSessionData::create([
            //         'member_id' => $book->member_id,
            //         'session_id' => $book->session_id,
            //         'day_name' => $book->day_name,
            //         // 'date_of_session' => Carbon::parse($request->date_of_session),
            //         'attended' => true,
            //     ]);
            //     // change user first class
            //     $userinfo->firstclass = false;
            //     $userinfo->save();

            //     session()->flash('success', 'Session attended');
            //     return back();
            // } else {
            //     session()->flash('error', 'Session already attended');
            //     return back();
            // }
        } catch (\Throwable $th) {
            $this->errorLog('SessionController@attendsession', $th->getMessage());
        }
    }

    // done
    public function attendsession($id)
    {
        $values = json_decode($id);
        $sessionid = $values[0];
        $dayname = $values[1];

        $sessioninfo = Session::find($sessionid);
        $userid = Auth::user()->id;

        if ($sessioninfo == null)
            return 'Session not found';
        // throw ValidationException::withMessages(['session' => 'Session not found!']);

        try {

            $book = Book::where('member_id', $userid )->where('session_id', $sessionid)->where('day_name', $dayname)->where('status', 'Pending')->first();
            if ($book == null) {
                return 'Ther are no booking for you';
            } else {
                $userinfo = User::find($userid );
                // attend user
                if ($book->attended) {
                    session()->flash('error', 'Session already attended');
                    return back();
                } else {
                    $book->attended = true;
                    $book->status = "Finished";
                    $book->save();

                    // send survay email if first class of user
                    if ($userinfo->firstclass) {
                        Mail::to($userinfo->email)->send(new RateServiceEmail($userinfo));
                    } 

                    // change first class
                    $userinfo->firstclass = false;
                    $userinfo->save();
                    
                    session()->flash('success', 'Session attended');
                    return redirect()->route('front-home');
                }
            }


            // $book->status = "Finished";
            // $book->save();

            // $count = MemberSessionData::where('member_id', $book->member_id)->where('session_id', $book->session_id)->where('day_name', $book->day_name)->count();
            // if ($count == 0) {
            //     MemberSessionData::create([
            //         'member_id' => $book->member_id,
            //         'session_id' => $book->session_id,
            //         'day_name' => $book->day_name,
            //         'attended' => true,
            //     ]);
            //     // change user first class
            //     User::where('id', Auth::user()->id)->update([
            //         'firstclass' => false
            //     ]);

            //     return 'Session attended';
            // } else {
            //     return 'Session already attended';
            // }
        } catch (\Throwable $th) {
            $this->errorLog('SessionController@attendsession', $th->getMessage());
        }
    }

    public function changesessionschedule(Request $request, $id)
    {
        // new session $request->session_id

        try {
            $book = Book::find($id);
            if ($book == null)
                return 'Book not found!';

            if ($book->status != "Pending")
                return "You can't change session schedule";

            $temp = Carbon::parse($book->day_name)->diffInHours(now()->setTimezone('Asia/Damascus')->toDateTimeString());
            if ($temp >= 24) {

                // add to book history
                BookHistory::create([
                    'class_id' => $book->class_id,
                    'session_id' => $book->session_id,
                    'member_id' => $book->member_id,
                    'day_name' => $book->day_name,
                    'status' => 'Archived',
                    'description' => $request->description,
                ]);

                // remove old book
                $book->delete();

                $book->session_id = $request->session_id;
                $book->save();

                return 'Booking change';
            } else
                return "Session will start tommorrw so you can't change schedule";
        } catch (\Throwable $th) {
            $this->errorLog('SessionController@changesessionschedule', $th->getMessage());
        }
    }

    public function getsessiondata($id)
    {
        $session = Session::find($id);
        if ($session == null)
            throw ValidationException::withMessages(['Session not found!']);

        try {
            $capacity = $session->capacity;
            $MembersCount = $session->sessionmemberscount();
            $Available = $capacity - $MembersCount;

            $data = [
                'Capacit' => $session->capacity,
                'MembersCount' => $MembersCount,
                'Available' => $Available
            ];
            return $data;
        } catch (\Throwable $th) {
            $this->errorLog('SessionController@getsessiondata', $th->getMessage());
        }
    }
}
