<?php

namespace Taxusorg\PermissionLaravel;

use Illuminate\Support\ServiceProvider;
use Taxusorg\Permission\Factory;
use Taxusorg\Permission\Permissions\Permission;
use Taxusorg\PermissionLaravel\Repository\RoleRepository;

class PermissionServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->singleton('permission', function ($app) {
            $factory = new Factory(new RoleRepository());
            if ($this->app['auth']->check())
                $factory->setRoleDefault($this->app['auth']->user->role_id);
            return $factory;
        });

        Permission::addBefore(function () {
            return $this->app['auth']->check();
        });

        Permission::setFactoryCallback(function () {
            return $this->app['permission'];
        });
    }
}
