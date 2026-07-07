<?php

namespace App\Policies;

use App\Models\Testimonial;
use App\Models\User;

class TestimonialPolicy
{
    /**
     * Determine if user can view any testimonials.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if user can view the testimonial.
     */
    public function view(User $user, Testimonial $testimonial): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if user can create testimonials.
     */
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if user can update the testimonial.
     */
    public function update(User $user, Testimonial $testimonial): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if user can delete the testimonial.
     */
    public function delete(User $user, Testimonial $testimonial): bool
    {
        return $user->is_admin;
    }
}
