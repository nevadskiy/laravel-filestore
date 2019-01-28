<?php

namespace App\Traits;

use App\Role;

trait HasRoles
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function hasRole($role)
    {
        return $this->roles->contains('name', $role);
    }
}
