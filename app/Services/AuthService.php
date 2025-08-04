<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $credentials): array|false
    {
        if (!Auth::attempt($credentials)) {
            return false;
        }

        $user = Auth::user();

        return [
            'user' => $user,
            'token' => $user->createToken('api-token')->plainTextToken,
        ];
    }

    public function register(array $data): array
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return [
            'user' => $user,
            'token' => $user->createToken('api-token')->plainTextToken,
        ];
    }

    public function logout($user): void
    {
        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }
    }
}
