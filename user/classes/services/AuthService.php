<?php namespace AppUser\User\Classes\Services;

use AppUser\User\Models\User;

class AuthService
{
    public static function getAuthenticatedUser($token)
    {
        // Fetch the user by the provided token
        return User::where('token', $token)->first();
    }

    public static function hashPassword($password)
    {
        // Use Laravel's bcrypt for hashing
        return bcrypt($password);
    }
}