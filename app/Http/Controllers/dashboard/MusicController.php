<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Music;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
//
class MusicController extends Controller
{

    public function index()
    {
        $musics = Music::orderBy('id')->get();
        return view('dashboard.music.index', compact('musics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.music.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
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
                session()->flash('success', 'Music created');
            else
                session()->flash('error', 'Music already found!');

            return redirect()->route('musics.index');
        } catch (\Throwable $th) {
            $this->errorLog('MusicController@store', $th->getMessage());
        }
    }


    public function show(Music $music)
    {
        return view('dashboard.music.show', compact('music'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function edit(Music $music)
    {
        return view('dashboard.music.edit', compact('music'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Music $music)
    {
        try {
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

            session()->flash('success', 'Music Updated');
            return redirect()->route('musics.index');
        } catch (\Throwable $th) {
            $this->errorLog('MusicController@update', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function destroy(Music $music)
    {
        try {
            // remove old image
            if ($music->image != null) {
                $imagepath = public_path('/') . $music->image;
                if (file_exists($imagepath)) {
                    File::delete($imagepath);
                }
            }

            $assigntosession = Session::where('music_id', $music->id)->count();
            if ($assigntosession > 0) {
                session()->flash('error', 'Music is assigned to a session please remove assign first then delete it');
                return redirect()->route('musics.index');
            }

            $music->delete();
            session()->flash('success', 'Music deleted');
            return redirect()->route('musics.index');
        } catch (\Throwable $th) {
            $this->errorLog('MusicController@destroy', $th->getMessage());
        }
    }
}
