<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ApiUserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        if($user->save()) {
            return response()->json($user);
        } else {
            return 'That bai';
        }
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
           $user = User::whereEmail($request->email)->first();
           $user->token = $user->createToken('Token')->accessToken;

           return response()->json($user);
        }

        return response()->json(['fail' => 'Sai ten email hoac passowrd'], 401);
    }

    public function userInfo(Request $request)
    {
        return response()->json($request->user('api'));
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user('api')->token()->revoke();
            return response()->json(['success' =>'logout_success'],200);
        }else{
            return response()->json(['error' =>'api.something_went_wrong'], 500);
        }
    }
}
