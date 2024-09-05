<?php namespace AppUser\User\Middleware;

use Closure;
use AppUser\User\Classes\Services\AuthService;

class CheckToken
{
    public function handle($request, Closure $next)
    {
        // Fetch the authenticated user using the AuthService
        $user = AuthService::getAuthenticatedUser($request->bearerToken());

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Optionally set user context manually if needed
        $request->merge(['user' => $user]);

        return $next($request);
    }
}
