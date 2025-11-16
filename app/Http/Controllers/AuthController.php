<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $this->hashPassword($request->password),
        ]);

        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !$this->verifyPassword($user, $request->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        } else {
            $token = $user->createToken('api_token')->plainTextToken;
            return response()->json(['user' => $user, 'token' => $token], 200);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out'], 200);
    }

    private function hashPassword(string $password): string
    {
        return Hash::make($password);
    }

    private function verifyPassword(User $user, string $password): bool
    {
        return Hash::check($password, $user->password);
    }
}
