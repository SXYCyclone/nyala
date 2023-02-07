<?php

namespace App\Helpers;

class RoleHelper
{
    /**
     * @return int 0 if the roles are equal, -1 if $role1 is lower than $role2, 1 if $role1 is higher than $role2
     */
    public static function compareRoleLevel(string $role1, string $role2): int
    {
        $roleLevels = [
            'owner' => 0,
            'admin' => 1,
            'editor' => 2,
        ];

        return $roleLevels[$role1] <=> $roleLevels[$role2];
    }
}
