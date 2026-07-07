<?php

namespace Tests\Feature;

use App\Models\Testimonial;
use App\Models\User;
use App\Policies\TestimonialPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestimonialPolicyTest extends TestCase
{
    use RefreshDatabase;

    private TestimonialPolicy $policy;

    protected function setUp(): void
    {
        parent::setUp();
        $this->policy = new TestimonialPolicy();
    }

    public function test_admin_can_view_any_testimonials(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->assertTrue($this->policy->viewAny($admin));
    }

    public function test_non_admin_cannot_view_any_testimonials(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->assertFalse($this->policy->viewAny($user));
    }

    public function test_admin_can_view_testimonial(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $testimonial = Testimonial::factory()->create();

        $this->assertTrue($this->policy->view($admin, $testimonial));
    }

    public function test_non_admin_cannot_view_testimonial(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $testimonial = Testimonial::factory()->create();

        $this->assertFalse($this->policy->view($user, $testimonial));
    }

    public function test_admin_can_create_testimonials(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->assertTrue($this->policy->create($admin));
    }

    public function test_non_admin_cannot_create_testimonials(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->assertFalse($this->policy->create($user));
    }

    public function test_admin_can_update_testimonial(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $testimonial = Testimonial::factory()->create();

        $this->assertTrue($this->policy->update($admin, $testimonial));
    }

    public function test_non_admin_cannot_update_testimonial(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $testimonial = Testimonial::factory()->create();

        $this->assertFalse($this->policy->update($user, $testimonial));
    }

    public function test_admin_can_delete_testimonial(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $testimonial = Testimonial::factory()->create();

        $this->assertTrue($this->policy->delete($admin, $testimonial));
    }

    public function test_non_admin_cannot_delete_testimonial(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $testimonial = Testimonial::factory()->create();

        $this->assertFalse($this->policy->delete($user, $testimonial));
    }
}
