<?php

namespace App\Policies;

use App\Models\Portfolio;
use App\Models\User;

class PortfolioPolicy
{
    /**
     * Determine if user can view any portfolio items.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if user can view the portfolio item.
     */
    public function view(User $user, Portfolio $portfolio): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if user can create portfolio items.
     */
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if user can update the portfolio item.
     */
    public function update(User $user, Portfolio $portfolio): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if user can delete the portfolio item.
     */
    public function delete(User $user, Portfolio $portfolio): bool
    {
        return $user->is_admin;
    }
}
