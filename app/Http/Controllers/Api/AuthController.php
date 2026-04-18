<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:7']
        ]);

        if (!auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return response()->json([
                'message' => "Invalid Credentials",
                'errors' => [
                    'password' => [
                        'Invalid Credentials'
                    ]
                ]
            ], 422);
        }

        $user = User::where('email', $request->input('email'))->first();

        $authToken = $user->createToken('auth-sanctum')->plainTextToken;

        return response()->json([
            'message' => "Signed In Successfully",
            'token' => $authToken
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response('Logged Out Successfully', 200);
    }
}
