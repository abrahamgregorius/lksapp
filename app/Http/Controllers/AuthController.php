<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        if(!Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = uuid_create();
        auth()->user()->update([
            'token' => $token
        ]);

        return response()->json([
            'message' => "Login success",
            'token' => $token,
            'user' => auth()->user()
        ]);
    }

    public function logout(Request $request) {
        $user = User::where('token', $request->bearerToken())->first();

        if(!$user || !$request->bearerToken()) {
            return response()->json([
                'message' => "Invalid token"
            ],401);
        }

        auth()->user()->update([
            'token' => null
        ]);

        return response()->json([
            'message' => 'Logout success'
        ]);
    }
}
