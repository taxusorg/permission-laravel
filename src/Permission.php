<?php

namespace Taxusorg\PermissionLaravel;

use Taxusorg\Permission\Permissions\Permission as BasePermission;

abstract class Permission extends BasePermission
{
    static protected $before = [];

    static protected $factory;

    static protected $factory_callback;
}
