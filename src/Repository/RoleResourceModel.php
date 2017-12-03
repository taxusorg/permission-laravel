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
        return $this->hasMany(AllowsModel::class, 'role_id', 'id');
    }

    public function getId()
    {
        return $this['id'];
    }

    public function getName()
    {
        return $this['name'];
    }

    public function getAllows()
    {
        return $this['allows'];
    }

    public function addAllows($insert)
    {
        foreach ($insert as $item) {
            $this->allows()->firstOrCreate(['name' => $item]);
        }
    }

    public function deleteAllows($delete)
    {
        $this->allows()->whereIn('name', $delete)->delete();
    }
}
