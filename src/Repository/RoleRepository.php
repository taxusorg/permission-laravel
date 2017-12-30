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

    /**
     * @param string $name
     * @return \Taxusorg\Permission\Contracts\RoleResource
     */
    public function add($name)
    {
        return RoleResourceModel::create(['name' => $name]);
    }

    /**
     * @param array ...$id
     * @return bool|int
     */
    public function delete(...$id)
    {
        return RoleResourceModel::destroy(...$id);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function deleteByName($name)
    {
        return RoleResourceModel::where(['name' => $name])->destroy();
    }
}
