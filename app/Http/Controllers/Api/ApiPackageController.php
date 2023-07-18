<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackagesMember;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
//

class ApiPackageController extends Controller
{

    public function index()
    {
        $packages = Package::all();
        if (count($packages) != 0) {
            return response()->json(['success'=>true,'packages'=>$packages]);
        } else
            return response()->json(['success'=>false,'message'=>'No data found !',400]);
    }

////////////////create function
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
                return response()->json(['errors'=>$validation->errors()],400);
            }

 

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

               
                return response()->json(['success'=>true,'message'=>'package created']);
            } else {
               return response()->json(['success'=>false,'message'=>'package already found'],400);
            }
        } catch (\Throwable $th) {

            
            $this->errorLog('ApiPackageController@store', $th->getMessage());
        }
    }
////////////////////////////////////////////////show function
public function show($id)
{
    try{
    $package = Package::find($id);
   
    if ($package != null)
        return response()->json(['success'=>true,'package'=>$package]);
    else {
        return response()->json(['success'=>false,'message'=>'package not found '],400);
    }
} catch (\Throwable $th) {
    $this->errorLog('ApiPackageController@show', $th->getMessage());
}
}
//////////////////////////////////////update function
public function update(Request $request, $id)
{
    // $validation = Validator::make($request->all(), [
    //     'name' => 'required',
    //     'image' => 'required',
    //     'valid_for_type' => 'required',
    //     'valid_for_value' => 'required',
    //     'cost' => 'required',
    // ]);

    try {
      
        // if ($validation->fails()) {
            
        //     return response()->json(['errors'=>$validation->errors()],400);
        // }
       
        $fileName = null;
        $package = Package::find($id);
        if ($package == null)
           return response()->json(['success'=>false,'message'=>'package not found'],400);

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
        $request->cost != null ? $package->cost = $request->cost : null;
        $request->name != null ? $package->name = $request->name :null;
        $request->type != null ? $package->type = $request->type : null ;
        $request->valid_for_type != null ? $package->valid_for_type = $request->valid_for_type : null;
        $request->valid_for_value != null ? $package->valid_for_value = $request->valid_for_value : null;
        $request->sessions_count != null ? $package->sessions_count = $request->sessions_count :null;

        $request->image != null ? ($package->image = 'packages/' . $fileName) : null;
        $package->save();
        return response()->json(['success'=>true,'message'=>'package updated']);

    } catch (\Throwable $th) {
        $this->errorLog('ApiPackageController@update', $th->getMessage());
    }
}

////////////////////function destroy
public function destroy($id)
{
    try {
        $package = Package::find($id);
        if ($package == null)
            return response()->json(['success'=>false,'message'=>'package not found'],400);

        $assigntosession = PackagesMember::where('package_id', $package->id)->count();
        if ($assigntosession > 0) {
            return response()->json(['success'=>false,'message'=>'Package is assigned to a user please remove assign first then delete it'],400);
          
        }

        // remove old image
        if ($package->image != null) {
            $imagepath = public_path('/') . $package->image;
            if (file_exists($imagepath)) {
                File::delete($imagepath);
            }
        }

        $package->delete();
        return response()->json(['success'=>true,'message'=>"Package deleted"]);
    } catch (\Throwable $th) {
        $this->errorLog('ApiPackageController@destroy', $th->getMessage());
    }
}


////////////////
    public function getpackages()
    {
        $packages = Package::withOnly('sessions.classm')->get();
        foreach ($packages as $key => $package) {
            $sessiondata = [];
            if ($package->sessions->count() > 0) {
                foreach ($package->sessions as $key => $session) {
                    array_push($sessiondata, $session->classm->where('id', $session->class_id)->pluck('name')->first());
                }
            }
            $data[] = [
                'package_id' => $package->id,
                'package_name' => $package->name,
                'cost' => $package->cost,
                'valid' => $package->valid_for_value . ' ' . $package->valid_for_type,
                'image' => $package->image,
                'sku' => $package->sku,
                'barcode' => $package->barcode,
                'sessions' => $sessiondata
            ];
        }
        if (count($data) != 0) {
            return $data;
        } else
            return 'No data found!';
    }
}
