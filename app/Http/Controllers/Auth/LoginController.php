<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RateServiceEmail;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function authenticated()
    {
        // clear session variables
        session()->put('classid', 0);
        session()->put('weekid', 0);
        session()->put('direction', 0);
        session()->put('musicid', 0);
        session()->put('coachid', 0);

        if (Auth::user()->email_verified_at == null) {
            return redirect()->route('web_logout', ['message' => 'Email verification required']);
        }

        if (auth()->User()->role_id == 1) {
            // do your magic here
            return redirect()->route('home');
        } else {
            if (Auth::user()->getavailablebalance() == 0)
                return redirect()->route('buy-packages');
            else
                return redirect()->route('web_calander_data_show');
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public
    function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
