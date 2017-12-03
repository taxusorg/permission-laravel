<?php

namespace Taxusorg\PermissionLaravel\Repository;

use Illuminate\Database\Eloquent\Model;

class AllowsModel extends Model
{
    protected $table = 'permissions';

    protected $fillable = ['name'];

    public function role()
    {
        return $this->belongsTo(RoleResourceModel::class, 'role_id', 'id');
    }
}
