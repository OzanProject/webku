<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use App\Policies\ServicePolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServicePolicyTest extends TestCase
{
    use RefreshDatabase;

    private ServicePolicy $policy;

    protected function setUp(): void
    {
        parent::setUp();
        $this->policy = new ServicePolicy();
    }

    public function test_admin_can_view_any_services(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->assertTrue($this->policy->viewAny($admin));
    }

    public function test_non_admin_cannot_view_any_services(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->assertFalse($this->policy->viewAny($user));
    }

    public function test_admin_can_view_service(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $service = Service::factory()->create();

        $this->assertTrue($this->policy->view($admin, $service));
    }

    public function test_non_admin_cannot_view_service(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $service = Service::factory()->create();

        $this->assertFalse($this->policy->view($user, $service));
    }

    public function test_admin_can_create_services(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->assertTrue($this->policy->create($admin));
    }

    public function test_non_admin_cannot_create_services(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->assertFalse($this->policy->create($user));
    }

    public function test_admin_can_update_service(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $service = Service::factory()->create();

        $this->assertTrue($this->policy->update($admin, $service));
    }

    public function test_non_admin_cannot_update_service(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $service = Service::factory()->create();

        $this->assertFalse($this->policy->update($user, $service));
    }

    public function test_admin_can_delete_service(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $service = Service::factory()->create();

        $this->assertTrue($this->policy->delete($admin, $service));
    }

    public function test_non_admin_cannot_delete_service(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $service = Service::factory()->create();

        $this->assertFalse($this->policy->delete($user, $service));
    }
}
