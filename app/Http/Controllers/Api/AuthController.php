<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Login user and create token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Check if user is active
        if (!$user->is_active) {
            throw ValidationException::withMessages([
                'email' => ['Your account has been deactivated.'],
            ]);
        }

        // Delete existing tokens for this device
        $user->tokens()->where('name', $request->device_name)->delete();

        // Create new token
        $token = $user->createToken($request->device_name);

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الدخول بنجاح',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'user_type' => $user->userType->name,
                    'user_type_display' => $user->userType->display_name_ar,
                    'phone' => $user->phone,
                    'is_verified' => $user->is_verified,
                ],
                'token' => $token->plainTextToken,
                'token_type' => 'Bearer',
            ]
        ]);
    }

    /**
     * Register new user
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type_id' => 'required|exists:user_types,id',
            'phone' => 'required|string|max:20',
            'device_name' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type_id' => $request->user_type_id,
            'phone' => $request->phone,
            'is_verified' => false,
            'is_active' => true,
        ]);

        // Create token
        $token = $user->createToken($request->device_name);

        return response()->json([
            'success' => true,
            'message' => 'تم إنشاء الحساب بنجاح',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'user_type' => $user->userType->name,
                    'user_type_display' => $user->userType->display_name_ar,
                    'phone' => $user->phone,
                    'is_verified' => $user->is_verified,
                ],
                'token' => $token->plainTextToken,
                'token_type' => 'Bearer',
            ]
        ], 201);
    }

    /**
     * Get authenticated user
     */
    public function user(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'user_type' => $user->userType->name,
                    'user_type_display' => $user->userType->display_name_ar,
                    'phone' => $user->phone,
                    'whatsapp' => $user->whatsapp,
                    'address' => $user->address,
                    'city' => $user->city,
                    'country' => $user->country,
                    'is_verified' => $user->is_verified,
                    'is_active' => $user->is_active,
                    'profile' => $user->profile,
                ]
            ]
        ]);
    }

    /**
     * Logout user (revoke token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الخروج بنجاح'
        ]);
    }

    /**
     * Logout from all devices
     */
    public function logoutAll(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الخروج من جميع الأجهزة بنجاح'
        ]);
    }

    /**
     * Get user types for registration
     */
    public function userTypes()
    {
        $userTypes = \App\Models\UserType::select('id', 'name', 'display_name_ar', 'display_name_en', 'description_ar', 'description_en')->get();

        return response()->json([
            'success' => true,
            'data' => $userTypes
        ]);
    }
}
