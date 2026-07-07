<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;

class ServicePolicy
{
    /**
     * Determine if user can view any services.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if user can view the service.
     */
    public function view(User $user, Service $service): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if user can create services.
     */
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if user can update the service.
     */
    public function update(User $user, Service $service): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if user can delete the service.
     */
    public function delete(User $user, Service $service): bool
    {
        return $user->is_admin;
    }
}
