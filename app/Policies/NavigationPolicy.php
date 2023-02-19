<?php

namespace App\Policies;

use App\Models\Navigation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NavigationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): \Illuminate\Auth\Access\Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Navigation $navigation): \Illuminate\Auth\Access\Response|bool
    {
        return $user->belongsToCompany($navigation->company);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): \Illuminate\Auth\Access\Response|bool
    {
        return $user->canManageResource('navigation');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Navigation $navigation): \Illuminate\Auth\Access\Response|bool
    {
        return $user->canManageResource('navigation', $navigation->company);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Navigation $navigation): \Illuminate\Auth\Access\Response|bool
    {
        return $user->canManageResource('navigation', $navigation->company);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Navigation $navigation): \Illuminate\Auth\Access\Response|bool
    {
        return $user->canManageResource('navigation', $navigation->company);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Navigation $navigation): \Illuminate\Auth\Access\Response|bool
    {
        return $user->canManageResource('navigation', $navigation->company);
    }
}
