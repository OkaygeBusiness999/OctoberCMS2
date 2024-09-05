<?php namespace AppUser\User\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Flash;
use AppUser\User\Models\User;

class Users extends Controller
{
    public $implement = [
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\FormController::class,
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('AppUser.User', 'user', 'users');
    }

    // Change psswrd
    public function onChangePassword($recordId)
    {
        $user = User::find($recordId);
        if ($user) {
            $user->password = bcrypt(post('password')); // hash psswrd
            $user->save();
            Flash::success('Password updated successfully!');
        } else {
            Flash::error('User not found.');
        }

        return $this->listRefresh();
    }
}
