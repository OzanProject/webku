<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine if user can view any users.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if user can view the user.
     */
    public function view(User $user, User $model): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if user can create users.
     */
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if user can update the user.
     */
    public function update(User $user, User $model): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if user can delete the user.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->is_admin;
    }
}
