<?php

namespace Taxusorg\PermissionLaravel\Repository;

use Illuminate\Database\Eloquent\Model;
use Taxusorg\Permission\Contracts\PermissionResource;

class AllowsModel extends Model implements PermissionResource
{
    protected $table = 'permissions';

    protected $fillable = ['name'];

    public function role()
    {
        return $this->belongsTo(RoleResourceModel::class, 'role_id', 'id');
    }

    public function getName()
    {
        return $this['name'];
    }
}
