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

    // Route to get logs of the authenticated user
    Route::get('logs', function (Request $request) {
        $user = AuthService::getAuthenticatedUser($request->bearerToken());
        
        if ($user) {
            // Return logs only for the authenticated user
            return Log::where('user_id', $user->id)->get();
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    })->middleware('auth.token');
});
