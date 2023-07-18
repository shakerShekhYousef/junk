<?php

namespace App\Http\Controllers\Api;

use Acaronlex\LaravelCalendar\Calendar;
use App\Http\Controllers\Controller;
use App\Models\ClassM;
use App\Models\Music;
use App\Models\Package;
use App\Models\PackagesMember;
use App\Models\Session;
use App\Models\SessionDay;
use App\Models\User;
use App\Models\UserBalance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ApiCalendarController extends Controller
{
    public function calanderdata($id, $date = null)
    {
        $session = Session::where('id', $id)->where('open_date', $date)->get();
        if ($session != null)
            return response()->json(['success' => true, 'date' => $date, 'session' => $session]);
        else
            return response()->json(['success' => false, 'message' => 'Session not found !'], 400);
    }

    ///
    public function backcalanderdatashow($classid = 0, $musicid = 0, $coachid = 0, $weekid = 0, $direction = 0)
    {
        try {

            if ($direction != 3) {
                //
                if ($direction == 1) {
                    $sessionvalue = session()->get('weekid');
                    if ($sessionvalue > 0)
                        session()->put('weekid', $sessionvalue - 1);
                } else if ($direction == 2) {
                    $sessionvalue = session()->get('weekid');
                    session()->put('weekid', $sessionvalue + 1);
                } else {
                    session()->put('weekid', 0);
                }

                session()->put('direction', $direction);
            }
            session()->put('classid', $classid);
            session()->put('musicid', $musicid);
            session()->put('coachid', $coachid);

            if ($classid != 0 && $musicid != 0 && $coachid != 0) {
                $sessions = Session::where('class_id', $classid)->where('music_id', $musicid)->where('coach_id', $coachid)->get();
            } else if ($classid != 0 && $musicid != 0 && $coachid == 0) {
                $sessions = Session::where('class_id', $classid)->where('music_id', $musicid)->get();
            } else if ($classid == 0 && $musicid != 0 && $coachid != 0) {
                $sessions = Session::where('music_id', $musicid)->where('coach_id', $coachid)->get();
            } else if ($classid != 0 && $musicid == 0 && $coachid != 0) {
                $sessions = Session::where('class_id', $classid)->where('coach_id', $coachid)->get();
            } else if ($classid != 0 && $musicid == 0 && $coachid == 0) {
                $sessions = Session::where('class_id', $classid)->get();
            } else if ($classid == 0 && $musicid != 0 && $coachid == 0) {
                $sessions = Session::where('music_id', $musicid)->get();
            } else if ($classid == 0 && $musicid == 0 && $coachid != 0) {
                $sessions = Session::where('coach_id', $coachid)->get();
            } else {
                $sessions = Session::all();
            }

            $userid =  Auth::user()->id;

            $users = User::all();
            $user =  $users->where('id', $userid)->first();
            $data = [];
            $sat = [];
            $sun = [];
            $mon = [];
            $tue = [];
            $wed = [];
            $thu = [];
            $fri = [];
            $currentdayname = today()->shortDayName;
            foreach ($sessions as $key => $session) {
                if ($session->recurring_type == "Daily") {
                    if ($currentdayname == 'Sun') {
                        $date0 = today()->addWeeks($weekid)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($sun, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(1);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($mon, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(2);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($tue, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(3);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($wed, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(4);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($thu, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(5);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($fri, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(6);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($sat, $data);
                    } else if ($currentdayname == 'Mon') {
                        $date0 = today()->addWeeks($weekid)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($mon, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($tue, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($wed, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(3)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($thu, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(4)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($fri, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(5)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($sat, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($sun, $data);
                    } else if ($currentdayname == 'Tue') {
                        $date0 = today()->addWeeks($weekid)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($tue, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($wed, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($thu, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(3)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($fri, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(4)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($sat, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($mon, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($sun, $data);
                    } else if ($currentdayname == 'Wed') {
                        $date0 = today()->addWeeks($weekid)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($wed, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($thu, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($fri, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(3)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($sat, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($tue, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($mon, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(3)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($sun, $data);
                    } else if ($currentdayname == 'Thu') {
                        $date0 = today()->addWeeks($weekid)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($thu, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($fri, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($sat, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($wed, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($tue, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(3)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($mon, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(4)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($sun, $data);
                    } else if ($currentdayname == 'Fri') {
                        $date0 = today()->addWeeks($weekid)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($fri, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($sat, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($thu, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($wed, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(3)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($tue, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(4)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($mon, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(5)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($sun, $data);
                    } else if ($currentdayname == 'Sat') {
                        $date0 = today()->addWeeks($weekid)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($sat, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($fri, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($thu, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(3)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($wed, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(4)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($tue, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(5)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($mon, $data);

                        $date0 = today()->addWeeks($weekid)->subDays(6)->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        array_push($sun, $data);
                    }
                } else if ($session->recurring_type == "Weekly") {
                    $recuringinterval = json_decode($session->recuring_interval);
                    foreach ($recuringinterval as $key => $item) {
                        if ($item == 1) // sat
                        {
                            if ($currentdayname == 'Sun') {
                                $date0 = today()->addWeeks($weekid)->addDays(6)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($sat, $data);
                            } else if ($currentdayname == 'Mon') {
                                $date0 = today()->addWeeks($weekid)->addDays(5)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($sat, $data);
                            } else if ($currentdayname == 'Tue') {
                                $date0 = today()->addWeeks($weekid)->addDays(4)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($sat, $data);
                            } else if ($currentdayname == 'Wed') {
                                $date0 = today()->addWeeks($weekid)->addDays(3)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($sat, $data);
                            } else if ($currentdayname == 'Thu') {
                                $date0 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($sat, $data);
                            } else if ($currentdayname == 'Fri') {
                                $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($sat, $data);
                            } else if ($currentdayname == 'Sat') {
                                $date0 = today()->addWeeks($weekid)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($sat, $data);
                            }
                        } else if ($item == 2) // sun
                        {
                            if ($currentdayname == 'Sun') {
                                $date0 = today()->addWeeks($weekid)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($sun, $data);
                            } else if ($currentdayname == 'Mon') {
                                $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($sun, $data);
                            } else if ($currentdayname == 'Tue') {
                                $date0 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($sun, $data);
                            } else if ($currentdayname == 'Wed') {
                                $date0 = today()->addWeeks($weekid)->subDays(3)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($sun, $data);
                            } else if ($currentdayname == 'Thu') {
                                $date0 = today()->addWeeks($weekid)->subDays(4)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($sun, $data);
                            } else if ($currentdayname == 'Fri') {
                                $date0 = today()->addWeeks($weekid)->subDays(5)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($sun, $data);
                            } else if ($currentdayname == 'Sat') {
                                $date0 = today()->addWeeks($weekid)->subDays(6)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($sun, $data);
                            }
                        } else if ($item == 3) // mon
                        {
                            if ($currentdayname == 'Sun') {
                                $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($mon, $data);
                            } else if ($currentdayname == 'Mon') {
                                $date0 = today()->addWeeks($weekid)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($mon, $data);
                            } else if ($currentdayname == 'Tue') {
                                $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($mon, $data);
                            } else if ($currentdayname == 'Wed') {
                                $date0 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($mon, $data);
                            } else if ($currentdayname == 'Thu') {
                                $date0 = today()->addWeeks($weekid)->subDays(3)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($mon, $data);
                            } else if ($currentdayname == 'Fri') {
                                $date0 = today()->addWeeks($weekid)->subDays(4)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($mon, $data);
                            } else if ($currentdayname == 'Sat') {
                                $date0 = today()->addWeeks($weekid)->subDays(5)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($mon, $data);
                            }
                        } else if ($item == 4) // tue
                        {
                            if ($currentdayname == 'Sun') {
                                $date0 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($tue, $data);
                            } else if ($currentdayname == 'Mon') {
                                $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($tue, $data);
                            } else if ($currentdayname == 'Tue') {
                                $date0 = today()->addWeeks($weekid)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($tue, $data);
                            } else if ($currentdayname == 'Wed') {
                                $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($tue, $data);
                            } else if ($currentdayname == 'Thu') {
                                $date0 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($tue, $data);
                            } else if ($currentdayname == 'Fri') {
                                $date0 = today()->addWeeks($weekid)->subDays(3)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($tue, $data);
                            } else if ($currentdayname == 'Sat') {
                                $date0 = today()->addWeeks($weekid)->subDays(4)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($tue, $data);
                            }
                        } else if ($item == 5) // wed
                        {
                            if ($currentdayname == 'Sun') {
                                $date0 = today()->addWeeks($weekid)->addDays(3)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($wed, $data);
                            } else if ($currentdayname == 'Mon') {
                                $date0 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($wed, $data);
                            } else if ($currentdayname == 'Tue') {
                                $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($wed, $data);
                            } else if ($currentdayname == 'Wed') {
                                $date0 = today()->addWeeks($weekid)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($wed, $data);
                            } else if ($currentdayname == 'Thu') {
                                $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($wed, $data);
                            } else if ($currentdayname == 'Fri') {
                                $date0 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($wed, $data);
                            } else if ($currentdayname == 'Sat') {
                                $date0 = today()->addWeeks($weekid)->subDays(3)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($wed, $data);
                            }
                        } else if ($item == 6) // thu
                        {
                            if ($currentdayname == 'Sun') {
                                $date0 = today()->addWeeks($weekid)->addDays(4)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($thu, $data);
                            } else if ($currentdayname == 'Mon') {
                                $date0 = today()->addWeeks($weekid)->addDays(3)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($thu, $data);
                            } else if ($currentdayname == 'Tue') {
                                $date0 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($thu, $data);
                            } else if ($currentdayname == 'Wed') {
                                $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($thu, $data);
                            } else if ($currentdayname == 'Thu') {
                                $date0 = today()->addWeeks($weekid)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($thu, $data);
                            } else if ($currentdayname == 'Fri') {
                                $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($thu, $data);
                            } else if ($currentdayname == 'Sat') {
                                $date0 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($thu, $data);
                            }
                        } else if ($item == 7) // fri
                        {
                            if ($currentdayname == 'Sun') {
                                $date0 = today()->addWeeks($weekid)->addDays(5)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($fri, $data);
                            } else if ($currentdayname == 'Mon') {
                                $date0 = today()->addWeeks($weekid)->addDays(4)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($fri, $data);
                            } else if ($currentdayname == 'Tue') {
                                $date0 = today()->addWeeks($weekid)->addDays(3)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($fri, $data);
                            } else if ($currentdayname == 'Wed') {
                                $date0 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($fri, $data);
                            } else if ($currentdayname == 'Thu') {
                                $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($fri, $data);
                            } else if ($currentdayname == 'Fri') {
                                $date0 = today()->addWeeks($weekid)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($fri, $data);
                            } else if ($currentdayname == 'Sat') {
                                $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'capacity' => $session->capacity,
                                    'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                                    'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                                ];
                                array_push($fri, $data);
                            }
                        }
                    }
                } else if ($session->recurring_type == "None") {
                    //
                    $startofweek = Carbon::now()->addWeeks($weekid)->startOfWeek(0)->format('Y-m-d');
                    $endofweek = Carbon::now()->addWeeks($weekid)->endOfWeek(0)->format('Y-m-d');
                    $sessiondate = Carbon::parse($session->open_date);
                    if ($sessiondate->greaterThanOrEqualTo($startofweek) && $sessiondate->lessThanOrEqualTo($endofweek)) {
                        $currentdayname = today()->addWeeks($weekid);
                        $date0 = $sessiondate->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0),
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'capacity' => $session->capacity,
                            'users' => route('web_get_session_users_id_date', ['sessionid' => $session->id, 'date' => $date0]),
                            'userscount' => $session->sessionbookedmemberscountinday($session->id, $date0)
                        ];
                        if ($sessiondate->shortDayName == "Sat") {
                            array_push($sat, $data);
                        } else if ($sessiondate->shortDayName == "Sun") {
                            array_push($sun, $data);
                        } else if ($sessiondate->shortDayName == "Mon") {
                            array_push($mon, $data);
                        } else if ($sessiondate->shortDayName == "Tue") {
                            array_push($tue, $data);
                        } else if ($sessiondate->shortDayName == "Wed") {
                            array_push($wed, $data);
                        } else if ($sessiondate->shortDayName == "Thu") {
                            array_push($thu, $data);
                        } else if ($sessiondate->shortDayName == "Fri") {
                            array_push($fri, $data);
                        }
                    }
                }
            }

            usort($sun, function ($a, $b) {
                $a = $a['start_time'];
                $b = $b['start_time'];

                if (Carbon::parse($a)->greaterThan(Carbon::parse($b)))
                    return 1;
                else if (Carbon::parse($a)->lessThan(Carbon::parse($b)))
                    return -1;
                else
                    return 0;
            });

            usort($mon, function ($a, $b) {
                $a = $a['start_time'];
                $b = $b['start_time'];

                if (Carbon::parse($a)->greaterThan(Carbon::parse($b)))
                    return 1;
                else if (Carbon::parse($a)->lessThan(Carbon::parse($b)))
                    return -1;
                else
                    return 0;
            });

            usort($tue, function ($a, $b) {
                $a = $a['start_time'];
                $b = $b['start_time'];

                if (Carbon::parse($a)->greaterThan(Carbon::parse($b)))
                    return 1;
                else if (Carbon::parse($a)->lessThan(Carbon::parse($b)))
                    return -1;
                else
                    return 0;
            });

            usort($wed, function ($a, $b) {
                $a = $a['start_time'];
                $b = $b['start_time'];

                if (Carbon::parse($a)->greaterThan(Carbon::parse($b)))
                    return 1;
                else if (Carbon::parse($a)->lessThan(Carbon::parse($b)))
                    return -1;
                else
                    return 0;
            });

            usort($thu, function ($a, $b) {
                $a = $a['start_time'];
                $b = $b['start_time'];

                if (Carbon::parse($a)->greaterThan(Carbon::parse($b)))
                    return 1;
                else if (Carbon::parse($a)->lessThan(Carbon::parse($b)))
                    return -1;
                else
                    return 0;
            });

            usort($fri, function ($a, $b) {
                $a = $a['start_time'];
                $b = $b['start_time'];

                if (Carbon::parse($a)->greaterThan(Carbon::parse($b)))
                    return 1;
                else if (Carbon::parse($a)->lessThan(Carbon::parse($b)))
                    return -1;
                else
                    return 0;
            });

            usort($sat, function ($a, $b) {
                $a = $a['start_time'];
                $b = $b['start_time'];

                if (Carbon::parse($a)->greaterThan(Carbon::parse($b)))
                    return 1;
                else if (Carbon::parse($a)->lessThan(Carbon::parse($b)))
                    return -1;
                else
                    return 0;
            });

            $data = [
                'sat' => $sat,
                'sun' => $sun,
                'mon' => $mon,
                'tue' => $tue,
                'wed' => $wed,
                'thu' => $thu,
                'fri' => $fri,
            ];

            $sundate = Carbon::now()->addWeeks($weekid)->startOfWeek(0)->format('m-d');
            $mondate = Carbon::now()->addWeeks($weekid)->startOfWeek(0)->addDays(1)->format('m-d');
            $tuedate = Carbon::now()->addWeeks($weekid)->startOfWeek(0)->addDays(2)->format('m-d');
            $weddate = Carbon::now()->addWeeks($weekid)->startOfWeek(0)->addDays(3)->format('m-d');
            $thudate = Carbon::now()->addWeeks($weekid)->startOfWeek(0)->addDays(4)->format('m-d');
            $fridate = Carbon::now()->addWeeks($weekid)->startOfWeek(0)->addDays(5)->format('m-d');
            $satdate = Carbon::now()->addWeeks($weekid)->startOfWeek(0)->addDays(6)->format('m-d');
            $dates = ['satdate' => $satdate, 'sundate' => $sundate, 'mondate' => $mondate, 'tuedate' => $tuedate, 'weddate' => $weddate, 'thudate' => $thudate, 'fridate' => $fridate];
            $musics = Music::get();

            $classeslist = ClassM::get();
            $coaches = User::where('role_id', 3)->get();
            return response()->json(['coaches' => $coaches, 'musics' => $musics, 'data' => $data, 'dates' => $dates, 'currentdatename' => today()->format('m-d'), 'classeslist' => $classeslist]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $this->errorLog('ApiCalendarController@calanderdatashow', $th->getMessage());
        }
    }
    ////////////
    function getstartendofweek($weekid)
    {
        $currentdate = today()->addWeeks($weekid)->shortDayName;
        if ($currentdate == 'Sat')
            $data = ['week_start' => today()->addWeeks($weekid)->subDays(6)->toDateString(), 'week_end' => today()->addWeeks($weekid)->toDateString()];
        else if ($currentdate == 'Sun')
            $data = ['week_start' => today()->addWeeks($weekid)->toDateString(), 'week_end' => today()->addWeeks($weekid)->addDays(6)->toDateString()];
        else if ($currentdate == 'Mon')
            $data = ['week_start' => today()->addWeeks($weekid)->subDays(1)->toDateString(), 'week_end' => today()->addWeeks($weekid)->addDays(5)->toDateString()];
        else if ($currentdate == 'Tue')
            $data = ['week_start' => today()->addWeeks($weekid)->subDays(2)->toDateString(), 'week_end' => today()->addWeeks($weekid)->addDays(4)->toDateString()];
        else if ($currentdate == 'Wed')
            $data = ['week_start' => today()->addWeeks($weekid)->subDays(3)->toDateString(), 'week_end' => today()->addWeeks($weekid)->addDays(3)->toDateString()];
        else if ($currentdate == 'Tue')
            $data = ['week_start' => today()->addWeeks($weekid)->subDays(4)->toDateString(), 'week_end' => today()->addWeeks($weekid)->addDays(2)->toDateString()];
        else if ($currentdate == 'Fri')
            $data = ['week_start' => today()->addWeeks($weekid)->subDays(5)->toDateString(), 'week_end' => today()->addWeeks($weekid)->addDays(1)->toDateString()];
        return $data;
    }

    public function calanderdatashow($classid = 0, $musicid = 0, $coachid = 0, $weekid = 0, $direction = 0)
    {
        try {
            // check sessions availability
            $sessions = Session::get();
            foreach ($sessions as $key => $session) {
                foreach ($session->todaypendingbooks as $key => $item) {
                    $temp0 = Carbon::parse($item->day_name)->lessThanOrEqualTo(now());
                    if ($temp0) {
                        if ($session->minimum_open_type == "Spot") {
                            if ($session->sessionbookedmemberscountinday($item->session_id, today()->toDateString()) < (int)$session->minimum_open_value) {
                                $item->delete();
                            } else {
                                $item->status = "Finished";
                                $item->save();
                            }
                        } else {
                            $item->status = "Finished";
                            $item->save();
                        }
                    }
                }
            }

            if ($direction != 3) {
                //
                if ($direction == 1) {
                    $sessionvalue = session()->get('weekid');
                    if ($sessionvalue > 0)
                        session()->put('weekid', $sessionvalue - 1);
                } else if ($direction == 2) {
                    $sessionvalue = session()->get('weekid');
                    session()->put('weekid', $sessionvalue + 1);
                } else {
                    session()->put('weekid', 0);
                }

                session()->put('direction', $direction);
            }
            session()->put('classid', $classid);
            session()->put('musicid', $musicid);
            session()->put('coachid', $coachid);

            if ($classid != 0 && $musicid != 0 && $coachid != 0) {
                $sessions = Session::where('class_id', $classid)->where('music_id', $musicid)->where('coach_id', $coachid)->get();
            } else if ($classid != 0 && $musicid != 0 && $coachid == 0) {
                $sessions = Session::where('class_id', $classid)->where('music_id', $musicid)->get();
            } else if ($classid == 0 && $musicid != 0 && $coachid != 0) {
                $sessions = Session::where('music_id', $musicid)->where('coach_id', $coachid)->get();
            } else if ($classid != 0 && $musicid == 0 && $coachid != 0) {
                $sessions = Session::where('class_id', $classid)->where('coach_id', $coachid)->get();
            } else if ($classid != 0 && $musicid == 0 && $coachid == 0) {
                $sessions = Session::where('class_id', $classid)->get();
            } else if ($classid == 0 && $musicid != 0 && $coachid == 0) {
                $sessions = Session::where('music_id', $musicid)->get();
            } else if ($classid == 0 && $musicid == 0 && $coachid != 0) {
                $sessions = Session::where('coach_id', $coachid)->get();
            } else {
                $sessions = Session::all();
            }

            $totalsessions = 0;
            $getavailablebalance = 0;
            $getbookedbalance = 0;
            if (Auth::user()) {
                $totalsessions = Auth::user()->gettotalbalance();
                $getavailablebalance = Auth::user()->getavailablebalance();
                $getbookedbalance = Auth::user()->getbookedbalance();
            }

            $userid = Auth::user() != null ? Auth::user()->id : 1;
            $users = User::all();
            $user =  $users->where('id', $userid)->first();
            $data = [];
            $sat = [];
            $sun = [];
            $mon = [];
            $tue = [];
            $wed = [];
            $thu = [];
            $fri = [];
            $currentdayname = today()->shortDayName;
            $weekdays = ['sat' => 1, 'sun' => 2, 'mon' => 3, 'tue' => 4, 'wed' => 5, 'thu' => 6, 'fri' => 7];
            $purchasevalidation = PackagesMember::where('member_id', $user->id)
                ->where('purchase_status', 'valid')
                ->orderBy('valid_till', 'asc')
                ->select('valid_till')
                ->get();

            foreach ($sessions as $key => $session) {
                if ($session->recurring_type == "Daily") {
                    if ($currentdayname == 'Sun') {
                        $date0 = today()->addWeeks($weekid)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date0);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'bookdate' => $date0,
                            'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($sun, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(1);
                        $bookedid = $user->memberbooksessionindat($session->id, $date0);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'bookdate' => $date0,
                            'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($mon, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(2);
                        $bookedid = $user->memberbooksessionindat($session->id, $date0);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'bookdate' => $date0,
                            'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($tue, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(3);
                        $bookedid = $user->memberbooksessionindat($session->id, $date0);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'bookdate' => $date0,
                            'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($wed, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(4);
                        $bookedid = $user->memberbooksessionindat($session->id, $date0);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'bookdate' => $date0,
                            'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($thu, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(5);
                        $bookedid = $user->memberbooksessionindat($session->id, $date0);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'bookdate' => $date0,
                            'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($fri, $data);

                        $date0 = today()->addWeeks($weekid)->addDays(6);
                        $bookedid = $user->memberbooksessionindat($session->id, $date0);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'bookdate' => $date0,
                            'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($sat, $data);
                    } else if ($currentdayname == 'Mon') {
                        $date1 = today()->addWeeks($weekid)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date1);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date1) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date1)) == 0 ? true : false,
                            'bookdate' => $date1,
                            'previous' => Carbon::parse($date1 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($mon, $data);

                        $date1 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date1);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date1) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date1)) == 0 ? true : false,
                            'bookdate' => $date1,
                            'previous' => Carbon::parse($date1 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($tue, $data);

                        $date1 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date1);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date1) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date1)) == 0 ? true : false,
                            'bookdate' => $date1,
                            'previous' => Carbon::parse($date1 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($wed, $data);

                        $date1 = today()->addWeeks($weekid)->addDays(3)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date1);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date1) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date1)) == 0 ? true : false,
                            'bookdate' => $date1,
                            'previous' => Carbon::parse($date1 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($thu, $data);

                        $date1 = today()->addWeeks($weekid)->addDays(4)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date1);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date1) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date1)) == 0 ? true : false,
                            'bookdate' => $date1,
                            'previous' => Carbon::parse($date1 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($fri, $data);

                        $date1 = today()->addWeeks($weekid)->addDays(5)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date1);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date1) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date1)) == 0 ? true : false,
                            'bookdate' => $date1,
                            'previous' => Carbon::parse($date1 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($sat, $data);

                        $date1 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date1);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date1) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date1)) == 0 ? true : false,
                            'bookdate' => $date1,
                            'previous' => Carbon::parse($date1 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($sun, $data);
                    } else if ($currentdayname == 'Tue') {
                        $date2 = today()->addWeeks($weekid)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date2);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date2) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date2)) == 0 ? true : false,
                            'bookdate' => $date2,
                            'previous' => Carbon::parse($date2 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($tue, $data);

                        $date2 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date2);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date2) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date2)) == 0 ? true : false,
                            'bookdate' => $date2,
                            'previous' => Carbon::parse($date2 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($wed, $data);

                        $date2 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date2);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date2) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date2)) == 0 ? true : false,
                            'bookdate' => $date2,
                            'previous' => Carbon::parse($date2 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($thu, $data);

                        $date2 = today()->addWeeks($weekid)->addDays(3)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date2);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date2) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date2)) == 0 ? true : false,
                            'bookdate' => $date2,
                            'previous' => Carbon::parse($date2 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($fri, $data);

                        $date2 = today()->addWeeks($weekid)->addDays(4)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date2);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date2) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date2)) == 0 ? true : false,
                            'bookdate' => $date2,
                            'previous' => Carbon::parse($date2 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($sat, $data);

                        $date2 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date2);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date2) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date2)) == 0 ? true : false,
                            'bookdate' => $date2,
                            'previous' => Carbon::parse($date2 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($sun, $data);

                        $date2 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date2);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date2) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date2)) == 0 ? true : false,
                            'bookdate' => $date2,
                            'previous' => Carbon::parse($date2 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($mon, $data);
                    } else if ($currentdayname == 'Wed') {
                        $date3 = today()->addWeeks($weekid)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date3);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date3) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date3)) == 0 ? true : false,
                            'bookdate' => $date3,
                            'previous' => Carbon::parse($date3 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($wed, $data);

                        $date3 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date3);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date3) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date3)) == 0 ? true : false,
                            'bookdate' => $date3,
                            'previous' => Carbon::parse($date3 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($thu, $data);

                        $date3 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date3);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date3) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date3)) == 0 ? true : false,
                            'bookdate' => $date3,
                            'previous' => Carbon::parse($date3 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($fri, $data);

                        $date3 = today()->addWeeks($weekid)->addDays(3)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date3);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date3) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date3)) == 0 ? true : false,
                            'bookdate' => $date3,
                            'previous' => Carbon::parse($date3 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($sat, $data);

                        $date3 = today()->addWeeks($weekid)->subDays(3)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date3);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date3) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date3)) == 0 ? true : false,
                            'bookdate' => $date3,
                            'previous' => Carbon::parse($date3 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($sun, $data);

                        $date3 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date3);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date3) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date3)) == 0 ? true : false,
                            'bookdate' => $date3,
                            'previous' => Carbon::parse($date3 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($mon, $data);

                        $date3 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date3);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date3) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date3)) == 0 ? true : false,
                            'bookdate' => $date3,
                            'previous' => Carbon::parse($date3 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($tue, $data);
                    } else if ($currentdayname == 'Thu') {
                        $date4 = today()->addWeeks($weekid)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date4);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date4) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date4)) == 0 ? true : false,
                            'bookdate' => $date4,
                            'previous' => Carbon::parse($date4 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($thu, $data);

                        $date4 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date4);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date4) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date4)) == 0 ? true : false,
                            'bookdate' => $date4,
                            'previous' => Carbon::parse($date4 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($fri, $data);

                        $date4 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date4);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date4) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date4)) == 0 ? true : false,
                            'bookdate' => $date4,
                            'previous' => Carbon::parse($date4 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($sat, $data);

                        $date4 = today()->addWeeks($weekid)->subDays(4)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date4);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date4) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date4)) == 0 ? true : false,
                            'bookdate' => $date4,
                            'previous' => Carbon::parse($date4 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($sun, $data);

                        $date4 = today()->addWeeks($weekid)->subDays(3)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date4);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date4) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date4)) == 0 ? true : false,
                            'bookdate' => $date4,
                            'previous' => Carbon::parse($date4 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($mon, $data);

                        $date4 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date4);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date4) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date4)) == 0 ? true : false,
                            'bookdate' => $date4,
                            'previous' => Carbon::parse($date4 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($tue, $data);

                        $date4 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date4);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date4) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date4)) == 0 ? true : false,
                            'bookdate' => $date4,
                            'previous' => Carbon::parse($date4 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($wed, $data);
                    } else if ($currentdayname == 'Fri') {
                        $date5 = today()->addWeeks($weekid)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date5);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date5) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date5)) == 0 ? true : false,
                            'bookdate' => $date5,
                            'previous' => Carbon::parse($date5 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($fri, $data);

                        $date5 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date5);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date5) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date5)) == 0 ? true : false,
                            'bookdate' => $date5,
                            'previous' => Carbon::parse($date5 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($sat, $data);

                        $date5 = today()->addWeeks($weekid)->subDays(5)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date5);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date5) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date5)) == 0 ? true : false,
                            'bookdate' => $date5,
                            'previous' => Carbon::parse($date5 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($sun, $data);

                        $date5 = today()->addWeeks($weekid)->subDays(4)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date5);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date5) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date5)) == 0 ? true : false,
                            'bookdate' => $date5,
                            'previous' => Carbon::parse($date5 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($mon, $data);

                        $date5 = today()->addWeeks($weekid)->subDays(3)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date5);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date5) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date5)) == 0 ? true : false,
                            'bookdate' => $date5,
                            'previous' => Carbon::parse($date5 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($tue, $data);

                        $date5 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date5);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date5) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date5)) == 0 ? true : false,
                            'bookdate' => $date5,
                            'previous' => Carbon::parse($date5 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($wed, $data);

                        $date5 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date5);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date5) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date5)) == 0 ? true : false,
                            'bookdate' => $date5,
                            'previous' => Carbon::parse($date5 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($thu, $data);
                    } else if ($currentdayname == 'Sat') {
                        $date6 = today()->addWeeks($weekid)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date6);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date6) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date6)) == 0 ? true : false,
                            'bookdate' => $date6,
                            'previous' => Carbon::parse($date6 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($sat, $data);

                        $date6 = today()->addWeeks($weekid)->subDays(6)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date6);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date6) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date6)) == 0 ? true : false,
                            'bookdate' => $date6,
                            'previous' => Carbon::parse($date6 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($sun, $data);

                        $date6 = today()->addWeeks($weekid)->subDays(5)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date6);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date6) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date6)) == 0 ? true : false,
                            'bookdate' => $date6,
                            'previous' => Carbon::parse($date6 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($mon, $data);

                        $date6 = today()->addWeeks($weekid)->subDays(4)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date6);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date6) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date6)) == 0 ? true : false,
                            'bookdate' => $date6,
                            'previous' => Carbon::parse($date6 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($tue, $data);

                        $date6 = today()->addWeeks($weekid)->subDays(3)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date6);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date6) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date6)) == 0 ? true : false,
                            'bookdate' => $date6,
                            'previous' => Carbon::parse($date6 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($wed, $data);

                        $date6 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date6);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date6) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date6)) == 0 ? true : false,
                            'bookdate' => $date6,
                            'previous' => Carbon::parse($date6 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($thu, $data);

                        $date6 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                        $bookedid = $user->memberbooksessionindat($session->id, $date6);
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date6) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date6)) == 0 ? true : false,
                            'bookdate' => $date6,
                            'previous' => Carbon::parse($date6 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];
                        array_push($fri, $data);
                    }
                } else if ($session->recurring_type == "Weekly") {
                    $recuringinterval = json_decode($session->recuring_interval);
                    foreach ($recuringinterval as $key => $item) {
                        if ($item == 1) // sat
                        {
                            if ($currentdayname == 'Sun') {
                                $date0 = today()->addWeeks($weekid)->addDays(6)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($sat, $data);
                            } else if ($currentdayname == 'Mon') {
                                $date0 = today()->addWeeks($weekid)->addDays(5)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($sat, $data);
                            } else if ($currentdayname == 'Tue') {
                                $date0 = today()->addWeeks($weekid)->addDays(4)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($sat, $data);
                            } else if ($currentdayname == 'Wed') {
                                $date0 = today()->addWeeks($weekid)->addDays(3)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($sat, $data);
                            } else if ($currentdayname == 'Thu') {
                                $date0 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($sat, $data);
                            } else if ($currentdayname == 'Fri') {
                                $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($sat, $data);
                            } else if ($currentdayname == 'Sat') {
                                $date0 = today()->addWeeks($weekid)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($sat, $data);
                            }
                        } else if ($item == 2) // sun
                        {
                            if ($currentdayname == 'Sun') {
                                $date0 = today()->addWeeks($weekid)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($sun, $data);
                            } else if ($currentdayname == 'Mon') {
                                $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($sun, $data);
                            } else if ($currentdayname == 'Tue') {
                                $date0 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($sun, $data);
                            } else if ($currentdayname == 'Wed') {
                                $date0 = today()->addWeeks($weekid)->subDays(3)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($sun, $data);
                            } else if ($currentdayname == 'Thu') {
                                $date0 = today()->addWeeks($weekid)->subDays(4)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($sun, $data);
                            } else if ($currentdayname == 'Fri') {
                                $date0 = today()->addWeeks($weekid)->subDays(5)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($sun, $data);
                            } else if ($currentdayname == 'Sat') {
                                $date0 = today()->addWeeks($weekid)->subDays(6)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($sun, $data);
                            }
                        } else if ($item == 3) // mon
                        {
                            if ($currentdayname == 'Sun') {
                                $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($mon, $data);
                            } else if ($currentdayname == 'Mon') {
                                $date0 = today()->addWeeks($weekid)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($mon, $data);
                            } else if ($currentdayname == 'Tue') {
                                $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($mon, $data);
                            } else if ($currentdayname == 'Wed') {
                                $date0 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($mon, $data);
                            } else if ($currentdayname == 'Thu') {
                                $date0 = today()->addWeeks($weekid)->subDays(3)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($mon, $data);
                            } else if ($currentdayname == 'Fri') {
                                $date0 = today()->addWeeks($weekid)->subDays(4)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($mon, $data);
                            } else if ($currentdayname == 'Sat') {
                                $date0 = today()->addWeeks($weekid)->subDays(5)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($mon, $data);
                            }
                        } else if ($item == 4) // tue
                        {
                            if ($currentdayname == 'Sun') {
                                $date0 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($tue, $data);
                            } else if ($currentdayname == 'Mon') {
                                $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($tue, $data);
                            } else if ($currentdayname == 'Tue') {
                                $date0 = today()->addWeeks($weekid)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($tue, $data);
                            } else if ($currentdayname == 'Wed') {
                                $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($tue, $data);
                            } else if ($currentdayname == 'Thu') {
                                $date0 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($tue, $data);
                            } else if ($currentdayname == 'Fri') {
                                $date0 = today()->addWeeks($weekid)->subDays(3)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($tue, $data);
                            } else if ($currentdayname == 'Sat') {
                                $date0 = today()->addWeeks($weekid)->subDays(4)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($tue, $data);
                            }
                        } else if ($item == 5) // wed
                        {
                            if ($currentdayname == 'Sun') {
                                $date0 = today()->addWeeks($weekid)->addDays(3)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($wed, $data);
                            } else if ($currentdayname == 'Mon') {
                                $date0 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($wed, $data);
                            } else if ($currentdayname == 'Tue') {
                                $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($wed, $data);
                            } else if ($currentdayname == 'Wed') {
                                $date0 = today()->addWeeks($weekid)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($wed, $data);
                            } else if ($currentdayname == 'Thu') {
                                $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($wed, $data);
                            } else if ($currentdayname == 'Fri') {
                                $date0 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($wed, $data);
                            } else if ($currentdayname == 'Sat') {
                                $date0 = today()->addWeeks($weekid)->subDays(3)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($wed, $data);
                            }
                        } else if ($item == 6) // thu
                        {
                            if ($currentdayname == 'Sun') {
                                $date0 = today()->addWeeks($weekid)->addDays(4)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($thu, $data);
                            } else if ($currentdayname == 'Mon') {
                                $date0 = today()->addWeeks($weekid)->addDays(3)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($thu, $data);
                            } else if ($currentdayname == 'Tue') {
                                $date0 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($thu, $data);
                            } else if ($currentdayname == 'Wed') {
                                $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($thu, $data);
                            } else if ($currentdayname == 'Thu') {
                                $date0 = today()->addWeeks($weekid)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($thu, $data);
                            } else if ($currentdayname == 'Fri') {
                                $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($thu, $data);
                            } else if ($currentdayname == 'Sat') {
                                $date0 = today()->addWeeks($weekid)->subDays(2)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($thu, $data);
                            }
                        } else if ($item == 7) // fri
                        {
                            if ($currentdayname == 'Sun') {
                                $date0 = today()->addWeeks($weekid)->addDays(5)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($fri, $data);
                            } else if ($currentdayname == 'Mon') {
                                $date0 = today()->addWeeks($weekid)->addDays(4)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($fri, $data);
                            } else if ($currentdayname == 'Tue') {
                                $date0 = today()->addWeeks($weekid)->addDays(3)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($fri, $data);
                            } else if ($currentdayname == 'Wed') {
                                $date0 = today()->addWeeks($weekid)->addDays(2)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($fri, $data);
                            } else if ($currentdayname == 'Thu') {
                                $date0 = today()->addWeeks($weekid)->addDays(1)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($fri, $data);
                            } else if ($currentdayname == 'Fri') {
                                $date0 = today()->addWeeks($weekid)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($fri, $data);
                            } else if ($currentdayname == 'Sat') {
                                $date0 = today()->addWeeks($weekid)->subDays(1)->toDateString();
                                $bookedid = $user->memberbooksessionindat($session->id, $date0);
                                $data = [
                                    'id' => $session->id,
                                    'class_name' => $session->classM->name,
                                    'class_icon' => $session->classM->class_icon,
                                    'start_time' => $session->start_time,
                                    'end_time' => $session->end_time,
                                    'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                                    'music_name' => $session->music != null ? $session->music->title : null,
                                    'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                                    'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                                    'booked' => $bookedid != null ? true : false,
                                    'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                                    'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                                    'bookdate' => $date0,
                                    'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                                ];
                                array_push($fri, $data);
                            }
                        }
                    }
                } else if ($session->recurring_type == "None") {
                    $currentdayname = today()->addWeeks($weekid);
                    $valu1 = $this->getstartendofweek($weekid);
                    $sessiondate = Carbon::parse($session->open_date);
                    if ($sessiondate->greaterThanOrEqualTo($valu1['week_start']) && $sessiondate->lessThanOrEqualTo($valu1['week_end'])) {
                        $bookedid = $user->memberbooksessionindat($session->id, $currentdayname->toDateString());
                        $date0 = $sessiondate->toDateString();
                        $data = [
                            'id' => $session->id,
                            'class_name' => $session->classM->name,
                            'class_icon' => $session->classM->class_icon,
                            'start_time' => $session->start_time,
                            'end_time' => $session->end_time,
                            'coach_name' => $users->where('id', $session->coach_id)->first()->username(),
                            'music_name' => $session->music != null ? $session->music->title : null,
                            'duration' => Carbon::parse($session->start_time)->diffInMinutes($session->end_time) . ' mins',
                            'available' => $session->sessionbookedmemberscountinday($session->id, $date0) . '/' . $session->capacity,
                            'booked' => $bookedid != null ? true : false,
                            'UnBook' => $bookedid != null ? route('books.destroy', $bookedid['bookid']) : null,
                            'full' => ($session->capacity - $session->sessionbookedmemberscountinday($session->id, $date0)) == 0 ? true : false,
                            'bookdate' => $date0,
                            'previous' => Carbon::parse($date0 . ' ' . $session->start_time)->lessThanOrEqualTo(now())
                        ];

                        if ($sessiondate->shortDayName == "Sat") {
                            array_push($sat, $data);
                        } else if ($sessiondate->shortDayName == "Sun") {
                            array_push($sun, $data);
                        } else if ($sessiondate->shortDayName == "Mon") {
                            array_push($mon, $data);
                        } else if ($sessiondate->shortDayName == "Tue") {
                            array_push($tue, $data);
                        } else if ($sessiondate->shortDayName == "Wed") {
                            array_push($wed, $data);
                        } else if ($sessiondate->shortDayName == "Thu") {
                            array_push($thu, $data);
                        } else if ($sessiondate->shortDayName == "Fri") {
                            array_push($fri, $data);
                        }
                    }
                }
            }

            usort($sun, function ($a, $b) {
                $a = $a['start_time'];
                $b = $b['start_time'];
                
                if (Carbon::parse($a)->greaterThan(Carbon::parse($b)))
                return 1;
                else if (Carbon::parse($a)->lessThan(Carbon::parse($b)))
                return -1;
                else
                return 0;
            });
            
            usort($mon, function ($a, $b) {
                $a = $a['start_time'];
                $b = $b['start_time'];
                
                if (Carbon::parse($a)->greaterThan(Carbon::parse($b)))
                return 1;
                else if (Carbon::parse($a)->lessThan(Carbon::parse($b)))
                return -1;
                else
                return 0;
            });

            usort($tue, function ($a, $b) {
                $a = $a['start_time'];
                $b = $b['start_time'];
                
                if (Carbon::parse($a)->greaterThan(Carbon::parse($b)))
                return 1;
                else if (Carbon::parse($a)->lessThan(Carbon::parse($b)))
                return -1;
                else
                return 0;
            });
            
            usort($wed, function ($a, $b) {
                $a = $a['start_time'];
                $b = $b['start_time'];

                if (Carbon::parse($a)->greaterThan(Carbon::parse($b)))
                return 1;
                else if (Carbon::parse($a)->lessThan(Carbon::parse($b)))
                return -1;
                else
                return 0;
            });
            
            usort($thu, function ($a, $b) {
                $a = $a['start_time'];
                $b = $b['start_time'];
                
                if (Carbon::parse($a)->greaterThan(Carbon::parse($b)))
                return 1;
                else if (Carbon::parse($a)->lessThan(Carbon::parse($b)))
                return -1;
                else
                return 0;
            });

            usort($fri, function ($a, $b) {
                $a = $a['start_time'];
                $b = $b['start_time'];
                
                if (Carbon::parse($a)->greaterThan(Carbon::parse($b)))
                return 1;
                else if (Carbon::parse($a)->lessThan(Carbon::parse($b)))
                return -1;
                else
                return 0;
            });
            
            usort($sat, function ($a, $b) {
                $a = $a['start_time'];
                $b = $b['start_time'];
                
                if (Carbon::parse($a)->greaterThan(Carbon::parse($b)))
                return 1;
                else if (Carbon::parse($a)->lessThan(Carbon::parse($b)))
                return -1;
                else
                return 0;
            });
            
            $data = [
                'sat' => $sat,
                'sun' => $sun,
                'mon' => $mon,
                'tue' => $tue,
                'wed' => $wed,
                'thu' => $thu,
                'fri' => $fri,
            ];
            
            // $balance = UserBalance::where('member_id', $userid)->first();
            $sundate = Carbon::now()->addWeeks($weekid)->startOfWeek(0)->format('m-d');
            $mondate = Carbon::now()->addWeeks($weekid)->startOfWeek(0)->addDays(1)->format('m-d');
            $tuedate = Carbon::now()->addWeeks($weekid)->startOfWeek(0)->addDays(2)->format('m-d');
            $weddate = Carbon::now()->addWeeks($weekid)->startOfWeek(0)->addDays(3)->format('m-d');
            $thudate = Carbon::now()->addWeeks($weekid)->startOfWeek(0)->addDays(4)->format('m-d');
            $fridate = Carbon::now()->addWeeks($weekid)->startOfWeek(0)->addDays(5)->format('m-d');
            $satdate = Carbon::now()->addWeeks($weekid)->startOfWeek(0)->addDays(6)->format('m-d');
            $dates = ['satdate' => $satdate, 'sundate' => $sundate, 'mondate' => $mondate, 'tuedate' => $tuedate, 'weddate' => $weddate, 'thudate' => $thudate, 'fridate' => $fridate];
            $musics = Music::get();

            $classeslist = ClassM::get();
            $coaches = User::where('role_id', 3)->get();
            return response()->json([
                'success' => true,
                'data' => [
                    'coaches' => $coaches,
                    'purchasevalidation' => $purchasevalidation,
                    'musics' => $musics,
                    'data' => $data,
                    'balance' => $totalsessions,
                    'bookedbalance' => $getbookedbalance,
                    'dates' => $dates,
                    'currentdatename' => today()->format('m-d'),
                    'classeslist' => $classeslist
                ]
            ]);
        } catch (\Throwable $th) {
            $this->errorLog('ApiCalendarController@calanderdatashow', $th->getMessage());
        }
    }
}
