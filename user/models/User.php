<?php namespace AppUser\User\Models;

use Model;

class User extends Model
{
    protected $table = 'appuser_user_users';
    protected $fillable = ['username', 'password', 'token'];

    // Hide password and token from JSON output
    protected $hidden = ['password', 'token'];
}
