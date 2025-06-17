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
    public function register(Request $request)
    {
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

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'kec_id' => $request->kec_id ?: null, 
            'kel_id' => $request->kel_id ?: null,
            'role_id' => $request->role_id ?: null,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('MyApp')->accessToken;
       
        return response()->json(['token' => $token], 200);  
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]); 

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
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

            return response()->json(['token' => $token,'kode' => 1], 200); 
        }

        return response()->json(['errors' => ['email' => 'Invalid credentials']], 401);
    }

    public function logout(Request $request)
    {
        \Auth::logout();

        if ($request->user() && method_exists($request->user(), 'token')) {
            $request->user()->token()->revoke();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
