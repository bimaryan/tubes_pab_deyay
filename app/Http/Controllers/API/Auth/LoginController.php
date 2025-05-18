<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        // Validasi request
        $credentials = $request->validate([
            'nim' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari user berdasarkan nim
        $user = User::where('nim', $credentials['nim'])->first();

        // Cek apakah user ditemukan dan password cocok
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'NIM atau password salah.'
            ], 401);
        }

        // Buat token login berdasarkan role
        $token = $user->createToken(strtolower($user->role) . '_token')->plainTextToken;

        return response()->json([
            'message' => 'Berhasil masuk sebagai ' . $user->role,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'nim' => $user->nim,
                'role' => $user->role,
            ],
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
