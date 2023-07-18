<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassM;
use App\Models\MemberSessionData;
use App\Models\RequestM;
use App\Models\Session;
use App\Models\SessionsHistory;
use App\Models\SessionsMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class ApiClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
        $classes = ClassM::paginate(10);
        if ($classes != null)
            return response()->json(['success' => true, 'data' => $classes]);
        else
            return response()->json(['success' => false, 'message' => 'Classes not found!']);
        } catch (\Throwable $th) {
            $reference_error_id = $this->errorLog('ApiClassController@index', $th->getMessage());
            return response()->json(['error', 'Error happen pleas contatct administrator, error reference_' . $reference_error_id], 500);
            
        }
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
            'name' => 'required'
        ]);

        if ($request->image != null && $request->image != null) {
            // generate random name for image file
            $fileName = rand(0, 10000) . time() . '.' . $request->image->extension();
            // move image file to folder ./storage/images/
            $request->image->move(public_path('classes/'), $fileName);
        }

        try {
            $class = ClassM::firstOrCreate([
                'name' => $request->name,
                'type' => $request->type
            ], [
                'name' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
                'image' => $request->image != null ? ('classes/' . $fileName) : null
            ]);
            if ($class->wasRecentlyCreated)
                return response()->json(['success' => true, 'message' => 'Class created']);
            else
                return response()->json(['success' => false, 'message' => 'Class already found!']);

        } catch (\Throwable $th) {
            $this->errorLog('ApiClassController@store', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
        $class = ClassM::find($id);
        if ($class != null)
            return response()->json(['success' => true, 'data' => $class]);
        else
            return response()->json(['success' => false, 'message' => 'Class not found!']);
    
} catch (\Throwable $th) {
    $reference_error_id = $this->errorLog('ApiClassController@show', $th->getMessage());
    return response()->json(['error', 'Error happen pleas contatct administrator, error reference_' . $reference_error_id], 500);
    
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
        try {
            $fileName = "";
            $class = ClassM::find($id);
            if ($class == null)
                return response()->json([
                    'success' => false, 'message' => 'Class not found!'
                ]);

            // remove old image
            if ($class->image != null && $request->image != null) {
                // $imagepath1 = explode($request->root() . '/storage/', $class->image)[1];
                $imagepath = public_path('/') . $class->image;
                if (file_exists($imagepath)) {
                    File::delete($imagepath);
                }
            }

            if ($request->image != null) {
                $fileName = rand(0, 10000) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('classes/'), $fileName);
            }

            // store data
            $request->name != null ? $class->name = $request->name : null;
            $request->description != null ? $class->description = $request->description : null;
            $request->type != null ? $class->type = $request->type : null;
            $request->image != null ? ($class->image = 'classes/' . $fileName) : null;

            $class->save();

            return response()->json(['success' => true, 'message' => 'Class updated']);
        } catch (\Throwable $th) {
            $this->errorLog('ClassController@update', $th->getMessage());
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
            $class = ClassM::find($id);
            if ($class == null)
                return response()->json([
                    'success' => false, 'message' => 'Class not found!'
                ]);
            // remove old image
            //
            $assigntosession = Session::where('class_id', $class->id)->count();
            if ($assigntosession > 0) {
                return response()->json(['success'=>false,'message'=>'Class is assigned to a session please remove assign first then delete it']);
             
            }
            if ($class->image != null) {
                $imagepath = public_path('/') . $class->image;
                if (file_exists($imagepath)) {
                    File::delete($imagepath);
                }
            }

            $class->delete();
            return response()->json(['success' => true, 'message' => 'Class deleted']);
        } catch (\Throwable $th) {
            $this->errorLog('ClassController@destroy', $th->getMessage());
        }
    }

    public function getcompletedclasses()
    {
        try {
            $sessions = Session::where('isfull', true)->paginate(10);
            if ($sessions->count() == 0)
                return response()->json(['success' => false, 'message' => 'No classes found!']);
            else
                return response()->json(['success' => true, 'data' => $sessions]);
        } catch (\Throwable $th) {
            $this->errorLog('ApiClassController@getcompletedclasses', $th->getMessage());
        }
    }

    public function getremainingclassess($id)
    {
        try {
            $session = Session::find($id);
            $userid = Auth::user()->id;
            $attendedsessions = MemberSessionData::where('session_id', $id)->where('member_id', $userid)->count();
            $remainingsessions = $session->session_total_count - $attendedsessions;

            return response()->json(['success' => true, 'data' => $remainingsessions]);
        } catch (\Throwable $th) {
            $this->errorLog('ClassController@getremainingclasses', $th->getMessage());
        }
    }

    // public function showcancelclassrequests()
    // {
    //     try {
    //         $requests = RequestM::where('type', 'cacnel_class_request')->get();
    //         $user = User::all();
    //         foreach ($requests as $key => $request) {
    //             $temp = $user->where('id', $request->approved_by)->first();
    //             $request->approved_by = $temp  != null ? $temp->username() : null;
    //         }
    //         if ($requests->count() > 0)
    //             return $requests;
    //         else
    //             return 'No requests found!';
    //     } catch (\Throwable $th) {
    //         $this->errorLog('ClassController@showcancelclassrequests', $th->getMessage());
    //     }
    // }

    // public function approvecancelclassrequest($id)
    // {
    //     try {
    //         $requestm = RequestM::find($id);
    //         if ($requestm != null) {
    //             if ($requestm->status == 'Approved')
    //                 return 'Request already approved!';
    //             else {
    //                 $requestm->status = 'Approved';
    //                 $requestm->approved_by = Auth::user()->id;
    //                 $requestm->save();

    //                 // remove book
    //                 SessionsMember::where('session_id', $requestm->session_id)->where('member_id', $requestm->member_id)->delete();

    //                 // change session complete status
    //                 $session = Session::find($requestm->session_id);
    //                 if ($session->isfull) {
    //                     $session->isfull = false;
    //                     $session->save();
    //                 }

    //                 // add old book to history
    //                 SessionsHistory::create([
    //                     'session_id' => $requestm->session_id,
    //                     'member_id' => $requestm->member_id,
    //                     'change_type' => 'cacnel_class_request'
    //                 ]);

    //                 return 'Request approved';
    //             }
    //         } else
    //             return 'Requests not found!';
    //     } catch (\Throwable $th) {
    //         $this->errorLog('ClassController@approvecancelclassrequest', $th->getMessage());
    //     }
    // }
}
