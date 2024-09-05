<?php namespace AppUser\User\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Flash;
use AppUser\User\Models\Log;

class Logs extends Controller
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
        BackendMenu::setContext('AppUser.User', 'log', 'logs');
    }

    // update delay status
    public function onToggleDelay($recordId)
    {
        $log = Log::find($recordId);
        if ($log) {
            $log->has_delay = !$log->has_delay;
            $log->save();
            Flash::success('Log delay status updated successfully!');
        } else {
            Flash::error('Log not found.');
        }

        return $this->listRefresh();
    }
}
