<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackagesMember;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
//
class PackageController extends Controller
{
    public function firstclassfree()
    {
        return view('front.firstclassfree');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        if (count($packages) != 0) {
            return view('dashboard.package.index', ['data' => $packages]);
        } else
            return 'No data found!';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sessions = Session::all();
        $types = Package::select('id', 'name')->get();
        return view('dashboard.package.create', ['sessions' => $sessions, 'types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'valid_for_type' => 'required',
            'valid_for_value' => 'required',
            'cost' => 'required',
        ]);

        try {
            if ($validation->fails()) {
                return back()->with(['errors' => $validation->errors()]);
            }

            // check sessions
            // if ($request->sessions != null) {
            //     // $request->sessions = json_decode($request->sessions);
            //     $sessions = Session::select('id')->get();
            //     foreach ($request->sessions as $key => $session) {
            //         if (!$sessions->contains($session))
            //             throw ValidationException::withMessages(['sessions' => 'Not all passed sessions is found']);
            //     }
            // }

            if ($request->image != null && $request->image != null) {
                // generate random name for image file
                $fileName = rand(0, 10000) . time() . '.' . $request->image->extension();
                // move image file to folder ./storage/images/
                $request->image->move(public_path('packages/'), $fileName);
            }

            $package = Package::firstOrCreate([
                'name' => $request->name
            ], [
                'name' => $request->name,
                // 'type' => $request->type,
                'cost' => $request->cost,
                'cost_type' => $request->cost_type,
                'valid_for_type' => $request->valid_for_type,
                'valid_for_value' => $request->valid_for_value,
                'sessions_count' => $request->sessions_count,
                'image' => $request->image != null ? ('packages/' . $fileName) : null
            ]);

            // generate unique sku
            $sku = rand(11111111111, 99999999999);
            $skus = Package::pluck('sku');
            while ($skus->contains($sku)) {
                $sku = rand(11111111111, 99999999999);
            }

            // add barcode
            $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
            $barcode = 'data:image/png;base64,' . base64_encode($generator->getBarcode($sku, $generator::TYPE_CODE_128));

            $package->barcode = $barcode;
            $package->sku = $sku;
            $package->save();

            if ($package->wasRecentlyCreated) {

                $package->sessions()->attach($request->sessions);
                session()->flash('success', 'Package Created');
                return redirect()->route('packages.index');
            } else {
                session()->flash('error', 'Package already found!');
                return redirect()->route('packages.index');
            }
        } catch (\Throwable $th) {
            $this->errorLog('PackageController@store', $th->getMessage());
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
        $package = Package::find($id);
        // $sessiondata = [];
        // if ($package->sessions->count() > 0) {
        //     foreach ($package->sessions as $key => $session) {
        //         array_push($sessiondata, $session->where('id', $session->id)->first());
        //     }
        // }
        if ($package != null)
            return view('dashboard.package.show', compact('package'));
        else {
            session()->flash('error', 'package not found!');
            return 'Package not found!';
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::find($id);
        // $sessions = Session::all();
        // $sessiondata = [];
        // if ($package->sessions->count() > 0) {
        //     foreach ($package->sessions as $key => $session) {
        //         array_push($sessiondata, $session->where('id', $session->id)->first());
        //     }
        // }

        if ($package != null)
            return view('dashboard.package.edit', compact('package'));
        else {
            session()->flash('error', 'package not found!');
            return 'Package not found!';
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
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'valid_for_type' => 'required',
            'valid_for_value' => 'required',
            'cost' => 'required',
        ]);

        try {
            if ($validation->fails()) {
                return back()->with(['errors' => $validation->errors()]);
            }
            $fileName = null;
            $package = Package::find($id);
            if ($package == null)
                return back()->with(['Package not found!']);

            // check sessions
            // if ($request->sessions != null) {
            //     $sessions = Session::select('id')->get();
            //     foreach ($request->sessions as $key => $session) {
            //         if (!$sessions->contains($session))
            //             return back()->with(['Not all passed sessions is found']);
            //     }
            // }
            // remove old image
            if ($package->image != null && $request->image != null) {
                $imagepath = public_path('/') . $package->image;
                if (file_exists($imagepath)) {
                    File::delete($imagepath);
                }
            }

            if ($request->image != null) {
                $fileName = rand(0, 10000) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('packages/'), $fileName);
            }

            $package->name = $request->name != null ? $request->name : null;
            $package->type = $request->type != null ? $request->type : null;
            $package->cost = $request->cost != null ? $request->cost : null;
            $package->valid_for_type = $request->valid_for_type != null ? $request->valid_for_type : null;
            $package->valid_for_value = $request->valid_for_value != null ? $request->valid_for_value : null;
            $package->sessions_count = $request->sessions_count != null ? $request->sessions_count : null;
            $request->image != null ? ($package->image = 'packages/' . $fileName) : null;
            $package->save();


            $package->sessions()->detach();
            $package->sessions()->attach($request->sessions);

            session()->flash('success', 'Package Updated');
            return redirect()->route('packages.index');
        } catch (\Throwable $th) {
            $this->errorLog('PackageController@update', $th->getMessage());
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
            $package = Package::find($id);
            if ($package == null)
                return 'Package not found!';

            $assigntosession = PackagesMember::where('package_id', $package->id)->count();
            if ($assigntosession > 0) {
                session()->flash('error', 'Package is assigned to a user please remove assign first then delete it');
                return redirect()->route('packages.index');
            }

            // remove old image
            if ($package->image != null) {
                $imagepath = public_path('/') . $package->image;
                if (file_exists($imagepath)) {
                    File::delete($imagepath);
                }
            }

            $package->delete();
            session()->flash('success', 'Package Deleted');
            return redirect()->route('packages.index');
        } catch (\Throwable $th) {
            $this->errorLog('PackageController@destroy', $th->getMessage());
        }
    }
}
