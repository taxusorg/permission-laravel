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
            return new Factory(new RoleRepository());
        });

        Permission::setFactoryCallback(function () {
            return $this->app['permission'];
        });
    }
}
