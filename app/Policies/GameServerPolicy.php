<?php

namespace App\Policies;

use App\Models\GameServer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GameServerPolicy
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
    public function view(User $user, GameServer $gameServer): \Illuminate\Auth\Access\Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): \Illuminate\Auth\Access\Response|bool
    {
        return $user->canManageResource('game-servers');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GameServer $gameServer): \Illuminate\Auth\Access\Response|bool
    {
        return $user->canManageResource('game-servers');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GameServer $gameServer): \Illuminate\Auth\Access\Response|bool
    {
        return $user->canManageResource('game-servers');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GameServer $gameServer): \Illuminate\Auth\Access\Response|bool
    {
        return $user->canManageResource('game-servers');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GameServer $gameServer): \Illuminate\Auth\Access\Response|bool
    {
        return $user->canManageResource('game-servers');
    }
}
