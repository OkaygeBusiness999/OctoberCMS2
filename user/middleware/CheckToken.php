<?php namespace AppUser\User\Middleware;

use Closure;
use AppUser\User\Classes\Services\AuthService;

class CheckToken
{
    public function handle($request, Closure $next)
    {
        $user = AuthService::getAuthenticatedUser($request->bearerToken());

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->merge(['user' => $user]);

        return $next($request);
    }
}
