<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['signup', 'signin', 'signout']]);
    }

    public function signup()
    {
        $data = request()->validate([
            'name' => 'required|max:255',
            'phone' => 'required|digits:8|unique:users,phone',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:7|max:255',
        ]);
        $data['phone'] = '+963 ' . $data['phone'];
        $data['balance'] = 0;
        $user = User::create($data);
        $token = auth()->guard('api')->attempt(request()->only('email', 'password'));
        return response()->json([
            'user' => $user,
            'token' => $token,
            'type' => 'bearer',
        ], 200);
    }

    public function signin()
    {
        $data = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $token = auth('api')->attempt($data);
        if (!$token) {
            return response()->json(['message' => 'invalid credentials'], 401);
        }
        return response()->json([
            'user' => auth('api')->user(),
            'token' => $token,
            'type' => 'bearer',
        ], 200);
    }

    public function signout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'out'], 200);
    }
}
