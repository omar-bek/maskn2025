<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/user-types', [AuthController::class, 'userTypes']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout-all', [AuthController::class, 'logoutAll']);

    // Projects API
    Route::get('/projects', function () {
        return response()->json([
            'success' => true,
            'message' => 'Projects API endpoint'
        ]);
    });

    // Offers API
    Route::get('/offers', function () {
        return response()->json([
            'success' => true,
            'message' => 'Offers API endpoint'
        ]);
    });

    // Cost Calculator API
    Route::post('/calculate-cost', function (Request $request) {
        return response()->json([
            'success' => true,
            'message' => 'Cost calculation endpoint'
        ]);
    });
});
