<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
///
class ApiSessionController extends Controller
{
    public function index()
    {
        $sessions = Session::all();
        $sessionslist = [];

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

            $sessionslist[] = [
                'id' => $session->id,
                'class' => $session->classm != null ? $session->classm->name : null,
                'music' => $session->music != null ? $session->music->title: null,
                'start_time' => $session->start_time,
                'end_time' => $session->end_time,
                'capacity' => $session->capacity,
                'status' => $session->status,
                'recurring_type' => $session->recurring_type,
                'recuring_interval' => $session->recuring_interval,
                'session total spot' => $session->session_total_count,
                'minimum open type' => $session->minimum_open_type,
                'minimum open value' => $session->minimum_open_value,
                'coach' => $session->coachname()
            ];
        }

        return response()->json(['sessions' => $sessionslist]);
    }
    ////////////////////completed
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
        return response()->json(['success' => true, 'sessions' => $sessionslist]);
    }

    //////////////////////////uncompleted sessions
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
                    'capacity' => $session->capacity,
                    'opendate' => $book->bookdate,
                    'totalusers' => $book->totalusers,
                    'coach' => $session->coachname()
                ];
            }
        }
        // $sessionslist=$this->paginate($sessionslist);
        // return response()->json(['success'=>true,'sessions'=>$array]);
        return response()->json(['success' => true, 'sessions' => $sessionslist]);
    }
    /////////////////////////////////create session
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'class_id' => '|exists:classes,id',
            'start_time' => 'required',
            'end_time' => 'required',
            'capacity' => 'required',
            'coach_id' => 'required|exists:users,id,role_id,3'
        ]);
        if ($validator->fails()) {
            $errorslist = '';
            foreach ($validator->getMessageBag()->toArray() as $key => $value) {
                $errorslist .= $value[0];
            }
            return response()->json(['error' => $errorslist], 400);
        }

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
                    return response()->json(['success' => false, 'message' => 'Open date error value!']);
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

                // add to session day//
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
                // // $session->users()->attach([$request->coach_id], ['role_id' => 3]);
                return response()->json(['success' => true, 'message' => 'Session created']);
            } else {
                return response()->json(['success' => false, 'message' => 'Session already found']);
            }
            // return view
        } catch (\Throwable $th) {
            $this->errorLog('ApiSessionController@store', $th->getMessage());
        }
    }
    ////////////////////update session
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'class_id' => '|exists:classes,id',
            'coach_id' => 'exists:users,id,role_id,3'
        ]);
        if ($validator->fails()) {
            $errorslist = '';
            foreach ($validator->getMessageBag()->toArray() as $key => $value) {
                $errorslist .= $value[0];
            }
            return response()->json(['error' => $errorslist], 400);
        }

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
            // // add to session day
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

            return response()->json(['success' => true, 'message' => 'Session updated']);
            // return view
        } catch (\Throwable $th) {
            $this->errorLog('ApiSessionController@update', $th->getMessage());
        }
    }
    ///////////////////destroy session
    public function destroy($id)
    {
        try {
            $session = Session::find($id);
            if ($session == null)
                return response()->json([
                    'success' => false, 'message' => 'Session not found!'
                ]);

            $session->delete();

            return response()->json(['success' => true, 'message' => 'Session deleted']);
            // return view
        } catch (\Throwable $th) {
            $this->errorLog('ApiSessionController@destroy', $th->getMessage());
        }
    }
    ///////////////show qrcode
    public function getsessionqrcode($id)
    {
        $session = Session::find($id);
        if ($session == null)
            return response()->json(['success' => false, 'message' => 'Session not found']);

        try {
            return response()->json(['success' => true, 'qrcode' => $session->qrcode]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    ////////////////////attend session
    public function adminattendsession(Request $request)
    {
        $validate =  Validator::make($request->all(), [
            'session' => 'required|exists:books,id'
        ]);
        if ($validate->fails()) {
            return  response()->json(['error' => $validate->getMessageBag()->first()], 400);
        }

        //  session is book id
        $book = Book::find($request->session);
        if ($book == null) {
            return response()->json(['message' => 'No Book for this session'], 400);
        }

        $userinfo = User::find($book->member_id);

        if ($userinfo->role_id != 4) {
            return response()->json(['error' => 'User is not a member !'], 400);
        }

        try {

            if ($book == null)
                return response()->json(['message' => 'There is no booking for this user'], 400);


                
            // attend user
            if ($book->attended) {
                return response()->json(['error' => 'Session already attended'], 400);
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
                return response()->json(['success' => 'Session attended']);
            }
        } catch (\Throwable $th) {
            $this->errorLog('ApiSessionController@adminattendsession', $th->getMessage());
        }
    }
    public function show($id)
    {
        try {
            $session = Session::find($id);
            if ($session == null) {
                return response()->json(['message' => 'No session found'], 400);
            }
            return response()->json(['success' => true, 'session' => $session]);
        } catch (\Throwable $th) {
            $this->errorLog('ApiSessionController@show', $th->getMessage());
        }
    }

    public function generatesessiondailyqrcode($id)
    {
        try {
            $qrcode =  QrCode::size(300)->backgroundColor(204, 255, 255)->generate(request()->root() . '/sessions/attendsession/' . $id);
            return response()->json(['qrcode' => $qrcode]);
        } catch (\Throwable $th) {
            $this->errorLog('SessionController@generatesessionqrcode', $th->getMessage());
        }
    }
}
