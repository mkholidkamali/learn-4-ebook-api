<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\AuthResources;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('apptoken')->plainTextToken;

        $result = [
            'user' => $user,
            'token' => $token
        ];

        return response($result, 201);
    }

    public function login(UserLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Bad Cred'
            ], 401);
        }

        $token = $user->createToken('apptoken')->plainTextToken;

        $result = [
            'user' => $user,
            'token' => $token
        ];

        return response($result, 201);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response(['message' => 'Logged Out']);
    }

    public function all()
    {
        $result = User::all();
        return response($result, 200);
    }
}
