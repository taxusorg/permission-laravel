<?php

namespace Taxusorg\PermissionLaravel\Repository;

use Taxusorg\Permission\Contracts\RoleRepository as RepositoryContracts;

class RoleRepository implements RepositoryContracts
{
    /**
     * @param $id
     * @return RoleResourceModel
     */
    public function find($id)
    {
        return RoleResourceModel::find($id);
    }

    /**
     * @param int $id
     * @return RoleResourceModel
     */
    public function getById($id)
    {
        return $this->find($id);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getByName($name)
    {
        return RoleResourceModel::where('name', $name)->first();
    }
}
