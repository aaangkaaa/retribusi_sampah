<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Registrasi Pengguna Baru
    public function register(Request $request)
    {
        // Validasi input pengguna
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'kec_id' => 'nullable|integer',
            'kel_id' => 'nullable|integer',
            'role_id' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'kec_id' => $request->kec_id ?: null, 
            'kel_id' => $request->kel_id ?: null,
            'role_id' => $request->role_id ?: null,
            'password' => Hash::make($request->password),
        ]);

        // Membuat token untuk pengguna yang baru saja dibuat
        $token = $user->createToken('MyApp')->accessToken;
       
        return response()->json(['token' => $token], 200);  // Kirimkan token sebagai respons
    }

    // Login Pengguna
    public function login(Request $request)
    {
        // Validasi input pengguna
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]); 

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Verifikasi kredensial
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            // Membuat token untuk pengguna yang berhasil login
            $token = $user->createToken('MyApp')->accessToken;
            $userData = [
                'id' => $user->id,
                'name' => $user->name,  
                'email' => $user->email,
                'kec_id' => $user->kec_id,
                'kel_id' => $user->kel_id,
                'role' => $user->role,
                'token' => $token
            ];
            Session::put('user', $userData); 

            return response()->json(['token' => $token,'kode' => 1], 200);  // Kirimkan token sebagai respons
        }

        return response()->json(['errors' => ['email' => 'Invalid credentials']], 401);
    }

    // Logout Pengguna
    public function logout(Request $request)
    {
        // Untuk web guard (session)
        \Auth::logout();

        // Untuk API guard (token, Passport)
        if ($request->user() && method_exists($request->user(), 'token')) {
            $request->user()->token()->revoke();
        }

        // Destroy session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    // Mengambil Data Pengguna
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
