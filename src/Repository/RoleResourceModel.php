<?php

namespace Taxusorg\PermissionLaravel\Repository;

use Illuminate\Database\Eloquent\Model;
use Taxusorg\Permission\Contracts\RoleResource;

class RoleResourceModel extends Model implements RoleResource
{
    protected $table = 'roles';

    protected $fillable = ['name'];

    public function allows()
    {
        return $this->hasMany(AllowResourceModel::class, 'role_id', 'id');
    }

    public function getId()
    {
        return $this['id'];
    }

    public function getName()
    {
        return $this['name'];
    }

    /**
     * @return AllowResourceModel
     */
    public function getAllows()
    {
        return $this['allows'];
    }

    /**
     * @param array|\IteratorAggregate $insert
     * @return bool|void
     */
    public function addAllows($insert)
    {
        foreach ($insert as $item) {
            $this->allows()->firstOrCreate(['name' => $item]);
        }
    }

    /**
     * @param array|\IteratorAggregate $delete
     * @return bool|void
     */
    public function deleteAllows($delete)
    {
        $this->allows()->whereIn('name', $delete)->delete();
    }
}
