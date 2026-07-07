<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use App\Policies\OrderPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderPolicyTest extends TestCase
{
    use RefreshDatabase;

    private OrderPolicy $policy;

    protected function setUp(): void
    {
        parent::setUp();
        $this->policy = new OrderPolicy();
    }

    public function test_admin_can_view_any_orders(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->assertTrue($this->policy->viewAny($admin));
    }

    public function test_non_admin_cannot_view_any_orders(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->assertFalse($this->policy->viewAny($user));
    }

    public function test_admin_can_view_order(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $order = Order::factory()->create();

        $this->assertTrue($this->policy->view($admin, $order));
    }

    public function test_non_admin_cannot_view_order(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $order = Order::factory()->create();

        $this->assertFalse($this->policy->view($user, $order));
    }

    public function test_admin_can_create_orders(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->assertTrue($this->policy->create($admin));
    }

    public function test_non_admin_cannot_create_orders(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->assertFalse($this->policy->create($user));
    }

    public function test_admin_can_update_order(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $order = Order::factory()->create();

        $this->assertTrue($this->policy->update($admin, $order));
    }

    public function test_non_admin_cannot_update_order(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $order = Order::factory()->create();

        $this->assertFalse($this->policy->update($user, $order));
    }

    public function test_admin_can_delete_order(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $order = Order::factory()->create();

        $this->assertTrue($this->policy->delete($admin, $order));
    }

    public function test_non_admin_cannot_delete_order(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $order = Order::factory()->create();

        $this->assertFalse($this->policy->delete($user, $order));
    }
}
