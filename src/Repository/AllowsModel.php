<?php

namespace Taxusorg\PermissionLaravel\Repository;

use Illuminate\Database\Eloquent\Model;

class AllowsModel extends Model
{
    protected $table = 'permissions';

    public function role()
    {
        return $this->belongsTo(RoleResourceModel::class, 'role_id', 'id');
    }
}
