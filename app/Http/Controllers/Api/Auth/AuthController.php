<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignInRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function signIn(SignInRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        $accessToken = JWTAuth::attempt($credentials);

        if (!$accessToken) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $user = Auth::user();
        return response()->json(['access_token' => $accessToken, 'user' => $user], 200);
    }

    public function signUp(SignUpRequest $request)
    {
        $user = User::create($request->validated());
        if ($user) {
            return response()->json(['message' => 'User registered successfully'], 201);
        }

        return response()->json(['message' => 'User registration failed'], 500);
    }
}
