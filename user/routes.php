<?php namespace AppUser\User;

use AppUser\User\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use AppUser\User\Models\Log;
use AppUser\User\Classes\Services\AuthService;

Route::group(['prefix' => 'api/v1'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth.token');

    Route::middleware(['auth.token'])->group(function () {
        Route::get('logs', function () {
            $user = request()->get('user');
            return $user->logs; // Return only logs of the authenticated user
        });
    });
});
