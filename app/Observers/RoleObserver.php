<?php

namespace App\Observers;

use App\Models\Employeeship;
use App\Models\Role;

class RoleObserver
{
    public function deleting(Role $role)
    {
        // keep at least one role
        if (Role::query()->count() === 1) {
            return false;
        }

        // keep the role if it's assigned to a user
        if ($role->company->users()->wherePivot('role', $role->key)->count() > 0) {
            return false;
        }

        return true;
    }
}
