<?php namespace AppUser\User;

use Backend;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'User',
            'description' => 'No description provided yet...',
            'author' => 'AppUser',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        //
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        $this->app['router']->aliasMiddleware('auth.token', \AppUser\User\Middleware\CheckToken::class);
    }
    
    

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'AppUser\User\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'appuser.user.some_permission' => [
                'tab' => 'User',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return [
            'user' => [
                'label'       => 'Users',
                'url'         => Backend::url('appuser/user/users'),
                'icon'        => 'icon-user',
                'permissions' => ['appuser.user.*'],
                'order'       => 500,
            ],
            'log' => [
                'label'       => 'Logs',
                'url'         => Backend::url('appuser/user/logs'),
                'icon'        => 'icon-file-text',
                'permissions' => ['appuser.user.*'],
                'order'       => 510,
            ],
        ];
    }
}
