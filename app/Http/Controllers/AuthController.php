<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->validated()['name'],
            'email' => $request->validated()['email'],
            'password' => Hash::make($request->validated()['password']),
        ]);

        return $this->successResponse(['user' => $user], 'User registered successfully', 201);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->validated()['email'])->first();

        if (!$user || !Hash::check($request->validated()['password'], $user->password)) {
            return $this->errorResponse('The provided credentials are incorrect.', 401);
        }

        $token = $user->createToken('hms')->plainTextToken;

        return $this->successResponse([
            'token' => $token,
            'user' => $user
        ], 'Login successful');
    }
}
