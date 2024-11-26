<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "data" => [
                    "errors" => $validator->invalid()
                ]
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        // if (!$user || !Hash::check($request->password, $user->password)) {
        //     throw ValidationException::withMessages([
        //         'name' => ['The provided credentials are incorrect.'],
        //     ]);
        // }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "error" => "The provided credentials are incorrect."
            ], 401);
        }

        // Create a new token for the user
        $token = $user->createToken("tokenName")->plainTextToken;

        return response()->json([
            "data" => [
                "message" => "User logged in successfully.",
                "token" => $token
            ]
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password', // same:password for confirm password
        ], [
            'confirm_password.same' => 'The confirm password must match the password' // Error message if confirm password doesn't match
        ]);

        if ($validator->fails()) {
            return response()->json([
                "data" => [
                    "errors" => $validator->errors()
                ]
            ], 422);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            "data" => [
                "message" => "User registered successfully."
            ]
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "data" => [
                "message" => "User  logged out successfully."
            ]
        ]);
    }
}
