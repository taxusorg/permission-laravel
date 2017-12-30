<?php

namespace Taxusorg\PermissionLaravel;

use Illuminate\Support\ServiceProvider;
use Taxusorg\Permission\Factory;
use Taxusorg\Permission\Permissions\Permission;
use Taxusorg\PermissionLaravel\Contracts\UserResource;
use Taxusorg\PermissionLaravel\Repository\RoleRepository;

class PermissionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/permission_laravel.php' => config_path('permission_laravel.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/permission_laravel.php', 'permission_laravel');

        $this->app->singleton('permission', function ($app) {
            $factory = new Factory(new RoleRepository());

            if ($this->app['auth']->guard($this->getConfig()['auth_guard'])->check()
                && $this->app['auth']->guard($this->getConfig()['auth_guard'])->user() instanceof UserResource)
                $factory->setRolesDefault($this->app['auth']->user()->getRole());

            return $factory;
        });

        Permission::setFactoryCallback(function () {
            return $this->app['permission'];
        });
    }

    protected function getConfig()
    {
        return $this->app['config']['permission_laravel'];
    }
}
