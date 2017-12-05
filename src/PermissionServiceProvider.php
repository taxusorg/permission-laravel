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

    }

    public function register()
    {
        $this->app->singleton('permission', function ($app) {
            $factory = new Factory(new RoleRepository());
            if ($this->app['auth']->check() && $this->app['auth']->user() instanceof UserResource)
                $factory->setRolesDefault($this->app['auth']->user()->getRole());
            return $factory;
        });

        Permission::setFactoryCallback(function () {
            return $this->app['permission'];
        });
    }
}
