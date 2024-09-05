<?php namespace AppUser\User\Models;

use Model;

class Log extends Model
{
    protected $table = 'appuser_user_logs';

    public $belongsTo = [
        'user' => 'AppUser\User\Models\User',
    ];
}
