<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Tìm user theo email
        $user = User::where('email', $credentials['email'])->first();

        // Kiểm tra mật khẩu
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Tạo token cho user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ]);
    }
    //logout
    public function destroy(Request $request)
    {
        // Xóa token của user
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout successful'
        ]);
    }

    public function register(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        // Tạo user mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Tạo token cho user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Register successful',
            'token' => $token,
            'user' => $user
        ], 201);
    }
}
