<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\RequestM;
use App\Models\Session;
use App\Models\SessionsHistory;
use App\Models\SessionsMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $requests = RequestM::all();
        $data = [];

        foreach ($requests as $key => $item) {
            $temp = json_decode($item->body, true);
            $body = '';
            if ($item->type == "cancel_class_request") {
                $body =
                    "<h5 style='color:red; font-weight: bolder'>Cancel class request</h5>" .
                    "<b>COMPLETED BY MEMBER:</b> <br><div class='pl-4'>" .
                    "Today's Date: <b>" . $item->created_at . "</b> <br>" .
                    "Member Name: <b>" . $users->where('id', $item->member_id)->first()->username() . "</b> <br>" .
                    "Phone: <b>" . $users->where('id', $item->member_id)->first()->phone . "</b> <br>" .
                    "Email: <b>" . $users->where('id', $item->member_id)->first()->email . "</b> <br>" .
                    "Customer Service from front desk staff: " . $temp['COMPLETED BY MEMBER']['Customer Service from front desk staff'] . "<br>" .
                    "Cleanliness and atmosphere of facility: " . $temp['COMPLETED BY MEMBER']['Cleanliness and atmosphere of facility'] . "<br>" .
                    "Group exercise classes and schedule: : " . $temp['COMPLETED BY MEMBER']['Group exercise classes and schedule'] . "<br>" .
                    "Overall experience at JUNK Fitness Club" . $temp['COMPLETED BY MEMBER']['Overall experience at JUNK Fitness Club'] . "<br>" .
                    "Reason for Cancellation: " . $temp['COMPLETED BY MEMBER']['Reason for Cancellation'] . "<br>" .
                    "</div><b>COMPLETED BY CREW:</b> <br><div class='pl-4'>" .
                    "Membership Cancellation Date: " . $temp['COMPLETED BY CREW']['Membership Cancellation Date'] . "<br>" .
                    "Membership Termination Date: " . $temp['COMPLETED BY CREW']['Membership Termination Date'] . "<br>" .
                    "Final EFT Billing Date: " . $temp['COMPLETED BY CREW']['Final EFT Billing Date'] . "<br>" .
                    "</div><b>SIGNATURES:</b> <br><div class='pl-4'>" .
                    "Member Signature: " . $temp['SIGNATURES']['Member Signature'] . "<br>" .
                    "Junk Crew Member: " . $temp['SIGNATURES']['Junk Crew Member'] . '</div>';
            } else if ($item->type == "suspention_request") {
                $body =
                    "<h5 style='color:red; font-weight: bolder'>Hold class request</h5>" .
                    "Full Name: <b>" . $users->where('id', $item->member_id)->first()->username() . "</b> <br>" .
                    "Email: <b>" . $users->where('id', $item->member_id)->first()->email . "</b> <br>" .
                    "Phone: <b>" . $users->where('id', $item->member_id)->first()->phone . "</b> <br>" .
                    "Whatsapp phone: <b>" . $users->where('id', $item->member_id)->first()->whats_app_phone . "</b> <br>" .
                    "Membership: <b>" . $temp['Membership'] . "</b><br>" .
                    "Access: <b>" . $temp['Access'] . "</b><br>" .
                    "Type: <b>" . $temp['Type'] . "</b><br>" .
                    "Eligibility: <b>" . $temp['Eligibility'] . "</b><br>" .
                    "I hereby request to Hold My JUNK and temporarily suspend my current membership:<br>" .
                    "starting on: <b>" . $temp['starting on'] . "</b><br>" .
                    "returning on: <b>" . $temp['returning on'] . "</b><br>" .
                    "I approve and acknowledge that by submitting this request my current billing date for the Backstage<br>Pass– monthly auto-recurring membership has been adjusted " .
                    "to restart on: <b>" . $temp['Monthly Auto-recurring']['to restart on'] . "</b><br>" .
                    " and continue billing on: <b>" . $temp['Monthly Auto-recurring']['continue billing on'] . "</b><br>" .
                    "I approve and acknowledge that by submitting this request my current expiry date of my World Tour PIF<br>membership has been adjusted to " .
                    "<b>" . $temp['WORLD TOUR PIF']['current expiry date adjusted to'] . "</b><br>" .
                    "<b>Signature:</b> <br>" .
                    "New Guest Signature: " .
                    "Signature <b> Yes </b>" .
                    "sign date: <b>" . $temp['Signature']['New Guest Signature']['sign date'] . "</b><br>" .
                    "Parent/ Legal Guardian Signature: " .
                    "Signature <b> Yes </b>" .
                    "sign date: <b>" . $temp['Signature']['Parent/ Legal Guardian Signature']['sign date'] . "</b><br>";
            }

            $data[] = [
                'id' => $item->id,
                'type' => $item->type,
                'body' => $body,
                'member' => $item->user->username(),
                'status' => $item->status,
                'approvedby' => $item->approved_by != null ? $users->where('id', $item->approved_by)->first()->username() : null
            ];
        }
        // dd($data);
        return view('dashboard.report.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|json',
            'member_id' => 'required|exists:users,id',
            'type' => 'required|in:' . implode(',', ['er_contact', 'medical', 'injury_history']),
        ], [
            'type.in' => 'Report type must be er_contact, medical, injury_history'
        ]);
        if ($validator->fails())
            return back()->with(['error' => $validator->getMessageBag()]);

        try {

            $member = User::find($request->member_id);
            if ($member->role_id != 4)
                return back()->with(['error' => 'This is not a junk member']);

            $memberid = $request->member_id;

            // type: er_contact, medical, injury_history
            $requestM = RequestM::firstOrCreate(
                [
                    'type' => $request->type,
                    'member_id' => $memberid,
                    'status' => 'Pending'
                ],
                [
                    'type' => $request->type,
                    'body' => $request->body,
                    'member_id' => $memberid,
                    'status' => 'Pending'
                ]
            );
            if ($requestM->wasRecentlyCreated)
                return back()->with(['success' => 'Report send']);
            else
                return back()->with(['error' => 'Report already found!']);
        } catch (\Throwable $th) {
            $this->errorLog('ReportController@store', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = RequestM::find($id);
        if ($report == null)
            return back()->with(['error' => 'Report not found!']);
        $users = User::whereIn('id', [$report->member_id, $report->approved_by])->get();

        $temp = json_decode($report->body, true);
        $body = '';
        if ($report->type == "cacnel_class_request") {
            $body =
                "<h5 style='color:red; font-weight: bolder'>Cancel class request</h5>" .
                "<b>COMPLETED BY MEMBER:</b> <br><div class='pl-4'>" .
                "Today's Date: <b>" . $report->created_at . "</b> <br>" .
                "Member Name: <b>" . $users->where('id', $report->member_id)->first()->username() . "</b> <br>" .
                "Phone: <b>" . $users->where('id', $report->member_id)->first()->phone . "</b> <br>" .
                "Email: <b>" . $users->where('id', $report->member_id)->first()->email . "</b> <br>" .
                "Customer Service from front desk staff: " . $temp['COMPLETED BY MEMBER']['Customer Service from front desk staff'] . "<br>" .
                "Cleanliness and atmosphere of facility: " . $temp['COMPLETED BY MEMBER']['Cleanliness and atmosphere of facility'] . "<br>" .
                "Group exercise classes and schedule: : " . $temp['COMPLETED BY MEMBER']['Group exercise classes and schedule'] . "<br>" .
                "Overall experience at JUNK Fitness Club" . $temp['COMPLETED BY MEMBER']['Overall experience at JUNK Fitness Club'] . "<br>" .
                "Reason for Cancellation: " . $temp['COMPLETED BY MEMBER']['Reason for Cancellation'] . "<br>" .
                "</div><b>COMPLETED BY CREW:</b> <br><div class='pl-4'>" .
                "Membership Cancellation Date: " . $temp['COMPLETED BY CREW']['Membership Cancellation Date'] . "<br>" .
                "Membership Termination Date: " . $temp['COMPLETED BY CREW']['Membership Termination Date'] . "<br>" .
                "Final EFT Billing Date: " . $temp['COMPLETED BY CREW']['Final EFT Billing Date'] . "<br>" .
                "</div><b>SIGNATURES:</b> <br><div class='pl-4'>" .
                "Member Signature: " . $temp['SIGNATURES']['Member Signature'] . "<br>" .
                "Junk Crew Member: " . $temp['SIGNATURES']['Junk Crew Member'] . '</div>';
        } else if ($report->type == "suspention_request") {
            $body =
                "<h5 style='color:red; font-weight: bolder'>Hold class request</h5>" .
                "Full Name: <b>" . $users->where('id', $report->member_id)->first()->username() . "</b> <br>" .
                "Email: <b>" . $users->where('id', $report->member_id)->first()->email . "</b> <br>" .
                "Phone: <b>" . $users->where('id', $report->member_id)->first()->phone . "</b> <br>" .
                "Whatsapp phone: <b>" . $users->where('id', $report->member_id)->first()->whats_app_phone . "</b> <br>" .
                "Membership: <b>" . $temp['Membership'] . "</b><br>" .
                "Access: <b>" . $temp['Access'] . "</b><br>" .
                "Type: <b>" . $temp['Type'] . "</b><br>" .
                "Eligibility: <b>" . $temp['Eligibility'] . "</b><br>" .
                "I hereby request to Hold My JUNK and temporarily suspend my current membership:<br>" .
                "starting on: <b>" . $temp['starting on'] . "</b><br>" .
                "returning on: <b>" . $temp['returning on'] . "</b><br>" .
                "I approve and acknowledge that by submitting this request my current billing date for the Backstage<br>Pass– monthly auto-recurring membership has been adjusted " .
                "to restart on: <b>" . $temp['Monthly Auto-recurring']['to restart on'] . "</b><br>" .
                " and continue billing on: <b>" . $temp['Monthly Auto-recurring']['continue billing on'] . "</b><br>" .
                "I approve and acknowledge that by submitting this request my current expiry date of my World Tour PIF<br>membership has been adjusted to " .
                "<b>" . $temp['WORLD TOUR PIF']['current expiry date adjusted to'] . "</b><br>" .
                "<b>Signature:</b> <br>" .
                "New Guest Signature: " .
                "Signature <b> Yes </b>" .
                "sign date: <b>" . $temp['Signature']['New Guest Signature']['sign date'] . "</b><br>" .
                "Parent/ Legal Guardian Signature: " .
                "Signature <b> Yes </b>" .
                "sign date: <b>" . $temp['Signature']['Parent/ Legal Guardian Signature']['sign date'] . "</b><br>";
        }

        $data = [
            'id' => $report->id,
            'type' => $report->type,
            'body' => $body,
            'member' => $report->user->username(),
            'status' => $report->status,
            'approvedby' => $report->approved_by != null ? $users->where('id', $report->approved_by)->first()->username() : null
        ];
        return view('dashboard.report.show', ['report' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = RequestM::find($id);

        if ($report == null)
            return back()->with(['error' => 'Reprot not found!']);

        try {
            $report->delete();
            return back()->with(['success' => 'Report Deleted']);
        } catch (\Throwable $th) {
            $this->errorLog('ReportController@destroy', $th->getMessage());
        }
    }

    public function createrequest(Request $request)
    {
        $request->validate([
            'type' => 'required'
        ]);

        $userid = Auth::user()->id;
        try {

            $sessions = Auth::user()->sessions->pluck('id');
            if (count($sessions) == 0)
                return "You don't have any session";

            if ($request->type == "cacnel_class_request") {
                $data = [
                    "COMPLETED BY MEMBER" =>
                    [
                        "Customer Service from front desk staff" => $request->customer_service_from_front_desk_staff,
                        "Cleanliness and atmosphere of facility" => $request->cleanliness_and_atmosphere_of_facility,
                        "Group exercise classes and schedule" => $request->group_exercise_classes_and_schedule,
                        "Overall experience at JUNK Fitness Club" => $request->overall_experience_at_junk_fitness_club,
                        "Reason for Cancellation" => $request->reason_for_cancellation
                    ],
                    "COMPLETED BY CREW" =>
                    [
                        "Membership Cancellation Date" => $request->membership_cancellation_date,
                        "Membership Termination Date" => $request->membership_termination_date,
                        "Final EFT Billing Date" => $request->final_eft_billing_date
                    ],
                    "SIGNATURES" => [
                        "Member Signature" => $request->member_signature,
                        "Junk Crew Member" => $request->junk_crewmember
                    ]
                ];
            } else if ($request->type  == "suspention_request") {
                $data = [
                    'Membership' => $request->membership,
                    'Access' => $request->access,
                    'Type' => $request->membership_type,
                    'Eligibility' => $request->eligibility,
                    'starting on' => $request->starting_on,
                    'returning on' => $request->returning_on,
                    'Monthly Auto-recurring' => ['to restart on' => $request->restart_on, 'continue billing on' => $request->continue_billing_on],
                    'WORLD TOUR PIF' => ['current expiry date adjusted to' => $request->current_expiry_date_adjusted_to],
                    'Signature' => [
                        'New Guest Signature' => ['signature' => $request->new_guest_signature, 'sign date' => $request->guest_sign_date],
                        'Parent/ Legal Guardian Signature' => ['signature' => $request->parent_legal_guardian_signature, 'sign date' => $request->parent_sign_date]
                    ]
                ];
            }

            $requestM = RequestM::firstOrCreate(
                [
                    'type' => $request->type,
                    'member_id' => $userid,
                    'status' => 'Pending'
                ],
                [
                    'type' => $request->type,
                    'body' => json_encode($data),
                    'member_id' => $userid,
                    'session_id' => $sessions,
                    'status' => 'Pending'
                ]
            );
            if ($requestM->wasRecentlyCreated)
                return 'Request send';
            else
                return 'Request already found!';
        } catch (\Throwable $th) {
            $this->errorLog('ClassController@createcancelclassrequest', $th->getMessage());
        }
    }

    public function approverequest($id)
    {
        try {
            $requestm = RequestM::find($id);
            if ($requestm != null) {
                if ($requestm->status == 'Approved')
                    return back()->with(['error' => 'Request is already approved']);
                else {
                    $requestm->status = 'Approved';
                    $requestm->approved_by = Auth::user()->id;
                    $requestm->save();

                    // remove book
                    $requestm->session_id = json_decode($requestm->session_id);
                    SessionsMember::whereIn('session_id', $requestm->session_id)->where('member_id', $requestm->member_id)->delete();

                    // change session complete status
                    $sessions = Session::whereIn('id', $requestm->session_id)->get();

                    foreach ($sessions as $key => $session) {
                        if ($session->isfull) {
                            $session->isfull = false;
                            $session->save();
                        }
                    }

                    // add old book to history
                    $user = User::find($requestm->member_id);

                    $user->historysessions()->attach($sessions, ['change_type' => $requestm->type]);

                    return back()->with(['success' => 'Request approved']);
                }
            } else
                return back()->with(['error' => 'Requests not found!']);
        } catch (\Throwable $th) {
            $this->errorLog('ClassController@approvecancelclassrequest', $th->getMessage());
        }
    }
}
