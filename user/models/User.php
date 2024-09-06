<?php namespace AppUser\User\Models;

use Model;
use October\Rain\Database\Traits\Validation;

class User extends Model
{
    use Validation;

    protected $table = 'appuser_user_users';

    protected $fillable = ['username', 'password', 'token'];

    public $rules = [
        'username' => 'required|unique:appuser_user_users',
        'password' => 'sometimes|min:8',
    ];

    protected $hidden = ['password', 'token'];

    public function beforeSave()
    {
        if ($this->isDirty('password')) {
            $this->password = bcrypt($this->password);
        }
    }

    public $hasMany = [
        'logs' => ['AppUser\User\Models\Log', 'key' => 'user_id', 'otherKey' => 'id']
    ];
}