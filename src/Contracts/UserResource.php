<?php

namespace Taxusorg\PermissionLaravel\Contracts;

interface UserResource
{
    /**
     * @return \Taxusorg\Permission\Contracts\RoleResource
     */
    public function getRole();
}
