<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;

class ApiAuthController extends Controller
{


    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }

        Passport::personalAccessTokensExpireIn(Carbon::now()->addMonths(3));
        $tokenResult = Auth::user()->createToken('authToken');
        $success['token'] = $tokenResult->accessToken;
        $success['token_type'] =  'Bearer';
        $success['expires_at'] =  Carbon::parse($tokenResult->token->expires_at)->toDateTimeString();
        $success['name'] =  Auth::user()->username();

        return response($success);
    }
}
