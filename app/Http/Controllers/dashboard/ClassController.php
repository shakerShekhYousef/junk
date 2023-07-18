<?php

namespace App\Http\Controllers\dashboard;
////////////
use App\Http\Controllers\Controller;
use App\Models\ClassM;
use App\Models\RequestM;
use App\Models\Session;
use App\Models\SessionsHistory;
use App\Models\SessionsMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\arrayHasKey;

class ClassController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = ClassM::all();
        return view('dashboard.class.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.class.create');
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
                'image' => $request->image != null ? ('public/classes/' . $fileName) : null
            ]);
            if ($class->wasRecentlyCreated)
                session()->flash('success', 'Class created');
            else
                session()->flash('error', 'Class already found!');

            return redirect()->route('classes.index');
        } catch (\Throwable $th) {
            $this->errorLog('ClassController@store', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ClassM $class)
    {
        return view('dashboard.class.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassM $class)
    {
        return view('dashboard.class.edit', compact('class'));
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
            $request->image != null ? ($class->image = 'public/classes/' . $fileName) : null;

            $class->save();

            session()->flash('success', 'Class Updated');
            return redirect()->route('classes.index');
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

            $assigntosession = Session::where('class_id', $class->id)->count();
            if ($assigntosession > 0) {
                session()->flash('error', 'Class is assigned to a session please remove assign first then delete it');
                return redirect()->route('classes.index');
            }
            // remove old image
            if ($class->image != null) {
                $imagepath = public_path('/') . $class->image;
                if (file_exists($imagepath)) {
                    File::delete($imagepath);
                }
            }

            $class->delete();
            session()->flash('success', 'Class deleted');
            return redirect()->route('classes.index');
        } catch (\Throwable $th) {
            $this->errorLog('ClassController@destroy', $th->getMessage());
        }
    }

    public function getcompletedclasses()
    {
        try {
            $sessions = Session::where('isfull', true)->get();
            if ($sessions->count() == 0)
                return 'No classess found!';
            else
                return $sessions;
        } catch (\Throwable $th) {
            $this->errorLog('ClassController@getcompletedclasses', $th->getMessage());
        }
    }

    public function getremainingclassess()
    {
        try {
            $sessions = Session::where('isfull', false)->get();
            return $sessions;
        } catch (\Throwable $th) {
            $this->errorLog('ClassController@getremainingclasses', $th->getMessage());
        }
    }

    // public function createcancelclassrequest(Request $request)
    // {
    //     $request->validate([
    //         'body' => 'required|json'
    //     ]);
    //     // $session = Session::find($id);
    //     $userid = Auth::user()->id;
    //     // $sessions = Auth::user()->sessions->pluck('id');
    //     // $userid = 5;

    //     // if ($session == null)
    //     //     throw ValidationException::withMessages(['id' => 'Session not found!']);

    //     // if (!$session->sessionmembers()->contains($userid))
    //     //     throw ValidationException::withMessages(['id' => 'You are not a member on session!']);

    //     try {
    //         $requestM = RequestM::firstOrCreate(
    //             [
    //                 'type' => 'cacnel_class_request',
    //                 'member_id' => $userid,
    //                 'status' => 'Pending'
    //             ],
    //             [
    //                 'type' => 'cacnel_class_request',
    //                 'body' => $request->body,
    //                 'member_id' => $userid,
    //                 'status' => 'Pending'
    //             ]
    //         );
    //         if ($requestM->wasRecentlyCreated)
    //             return 'Request send';
    //         else
    //             return 'Request already found!';
    //     } catch (\Throwable $th) {
    //         $this->errorLog('ClassController@createcancelclassrequest', $th->getMessage());
    //     }
    // }

    // public function showcancelclassrequests()
    // {
    //     try {
    //         $requests = RequestM::where('type', 'cacnel_class_request')->get();
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
    //                 return back()->with(['error' => 'Request already approved!']);
    //             // return 'Request already approved!';
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

    //                 return back()->with(['success' => 'Request Approved']);
    //                 // return 'Request approved';
    //             }
    //         } else
    //             return 'Requests not found!';
    //     } catch (\Throwable $th) {
    //         $this->errorLog('ClassController@approvecancelclassrequest', $th->getMessage());
    //     }
    // }
}
