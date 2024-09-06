<?php namespace AppUser\User\Classes\Services;

use AppUser\User\Models\User;

class AuthService
{
    public static function getAuthenticatedUser($token)
    {
        return User::where('token', $token)->first();
    }
}