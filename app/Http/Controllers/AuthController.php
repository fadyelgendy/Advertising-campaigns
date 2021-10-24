<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt($credentials)) {
           return response()
           ->json([
                'success' => 1,
                "message" => "User logged in."
            ], 200);
        }

        return response([
            'success' => 0,
            'message' => 'Please check your credentials'
        ],401);
    }

    public function logout()
    {
        //
    }
}
