<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user() != null && Auth::user()->role_id == 1) {
            $users = User::where('role_id', '!=', 3)->get();
            return view('dashboard.users.index', ['users' => $users]);
        } else {
            $packages = Package::get();
            return view('front.home', ['packages' => $packages]);
        }
    }

    public function calendar()
    {
        return view('dashboard.calendar.index');
    }

    public function logout($message = null)
    {
        //logout user
        Auth::logout();
        // redirect to homepage
        session()->flash('error', $message);
        return redirect('/');
    }
}
