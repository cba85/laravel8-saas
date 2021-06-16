<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthTokenController extends Controller
{
    public function login(Request $request)
    {
        // 1. "Form" validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => "required"
        ]);

        // 2. Check if user exists and credentials are corrects
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            /*
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
            */
            return response()->json(['error' => 'The provided credentials are incorrect.'], 401);
        }

        // 3. Clear old tokens
        $user->tokens()->where('tokenable_id', $user->id)->delete();

        // 4. Create auth token
        $token = $user->createToken($request->device_name, ['posts:read'])->plainTextToken;

        // 5. Return token
        return response()->json([
            'token' => $token,
            'email' => $user->email,
            'name' => $user->name,
            'created_at' => $user->created_at
        ]);
    }

    public function register(Request $request)
    {
        // 1. "Form" validation
        $request->validate([
            'email' => 'required|email',
            'name' => "required",
            'password' => 'required',
            'device_name' => 'required',
        ]);

        // 2. Check if user exists
        $exists = User::where('email', $request->email)->exists();

        if ($exists) {
            return response()->json([
                'error' => "You are already registered. Please login instead."
            ], 409);
        }

        // 3. Create user
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name
        ]);

        // 4. Create auth token
        $token = $user->createToken($request->device_name, ['posts:read'])->plainTextToken;

        // 5. Return token
        return response()->json([
            'token' => $token,
            'email' => $user->email,
            'name' => $user->name,
            'created_at' => $user->created_at
        ]);
    }

    public function me(Request $request)
    {
        return response()->json([
            'email' => $request->user()->email,
            'name' => $request->user()->name,
            'created_at' => $request->user()->created_at
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response(null, 204);
    }
}
