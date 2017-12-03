<?php

namespace Taxusorg\PermissionLaravel\Repository;

use Taxusorg\Permission\Contracts\RoleRepository as RepositoryContracts;

class RoleRepository implements RepositoryContracts
{
    public function getById($id)
    {
        return RoleResourceModel::find($id);
    }

    public function getByName($name)
    {
        return RoleResourceModel::where('name', $name)->first();
    }
}
