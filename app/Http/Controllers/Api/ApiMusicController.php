<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Music;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class ApiMusicController extends Controller
{
    public function index()
    {
        try{
        $musics = Music::orderBy('id')->paginate(10);
        if($musics == null){
            return response()->json(['success'=>false,'message'=>'Musics not found'],400);
        }
        return response()->json(['success'=>true,'musics'=>$musics]);
    } catch (\Throwable $th) {
        $this->errorLog('ApiMusicController@index', $th->getMessage());
    }
}
///////////// create music
public function store(Request $request)
{
    $validation = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'body' => 'required|string',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
        if ($validation->fails()) {
            return response()->json(['errors'=>$validation->errors()],400);
        }
    
    if ($request->image != null && $request->image != null) {
        // generate random name for image file
        $fileName = rand(0, 10000) . time() . '.' . $request->image->extension();
        // move image file to folder ./storage/images/
        $request->image->move(public_path('musics/'), $fileName);
    }
    try {
        $music = Music::firstOrCreate([
            'title' => $request->title
        ], [
            'title' => $request->title,
            'body' => $request->body,
            'image' => $request->image != null ? ('musics/' . $fileName) : null
        ]);

        if ($music->wasRecentlyCreated)
        return response()->json(['success'=>true,'message'=>'Music created']);
           
        else
        return response()->json(['success'=>false,'message'=>'Music already found !'],400);
        
    } catch (\Throwable $th) {
        $this->errorLog('MusicController@store', $th->getMessage());
    }
}
///////////////////////////update function
public function update(Request $request,$id)
{
    try {
        $music=Music::find($id);
        if($music == null){
            return response()->json(['success'=>false,'message'=>'Music not found !'],400);
        }
        $fileName = "";
        // remove old image
        if ($music->image != null && $request->image != null) {
            // $imagepath1 = explode($request->root() . '/storage/', $class->image)[1];
            $imagepath = public_path('/') . $music->image;
            if (file_exists($imagepath)) {
                File::delete($imagepath);
            }
        }

        if ($request->image != null) {
            $fileName = rand(0, 10000) . time() . '.' . $request->image->extension();
            $request->image->move(public_path('musics/'), $fileName);
        }

        // store data
        $request->title != null ? $music->title = $request->title : null;
        $request->body != null ? $music->body = $request->body : null;
        $request->image != null ? ($music->image = 'musics/' . $fileName) : null;

        $music->save();
        return response()->json(['success'=>true,'message'=>'Music Updated']);
 
    } catch (\Throwable $th) {
        $this->errorLog('ApiMusicController@update', $th->getMessage());
    }
}
    /////////////////destroy function
    public function destroy($id)
    {
        try {
            $music=Music::find($id);
            if($music == null){
                return response()->json(['success'=>false,'message'=>'Music not found !'],400);
            }
            // remove old image
            if ($music->image != null) {
                $imagepath = public_path('/') . $music->image;
                if (file_exists($imagepath)) {
                    File::delete($imagepath);
                }
            }

            $assigntosession = Session::where('music_id', $music->id)->count();
            if ($assigntosession > 0) {
                return response()->json(['success'=>false,'message'=>'Music is assigned to a session please remove assign first then delete it']);
               
            }

            $music->delete();
            return response()->json(['success'=>true,'message'=>'Music Deleted']);
        } catch (\Throwable $th) {
            $this->errorLog('ApiMusicController@destroy', $th->getMessage());
        }
    }
    ///////////////////shoe function
    public function show($id){
        try{
            $music=Music::find($id);
            if($music == null){
                return response()->json(['success'=>false,'message'=>'music not found '],400);
            }
            return response()->json(['success'=>true,'music'=>$music]);
        } catch (\Throwable $th) {
            $this->errorLog('ApiMusicController@show', $th->getMessage());
        }
    }
}






