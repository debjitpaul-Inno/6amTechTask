<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login( Request $request) {
        $data =  $request->validate([
           'email' => 'required|string',
           'password' => 'required|string',
        ]);

        if ( !Auth::attempt($data)) {
            return \response([ 'message' => 'Bad Credentials' ]);
        }
        $user = Auth::user();
        $accessToken = $user->createToken('token')->accessToken;
        return \response(['user' => $user, 'accessToken' => $accessToken]);

    }
}
