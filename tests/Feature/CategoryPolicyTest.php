<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use App\Policies\CategoryPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryPolicyTest extends TestCase
{
    use RefreshDatabase;

    private CategoryPolicy $policy;

    protected function setUp(): void
    {
        parent::setUp();
        $this->policy = new CategoryPolicy();
    }

    public function test_admin_can_view_any_categories(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->assertTrue($this->policy->viewAny($admin));
    }

    public function test_non_admin_cannot_view_any_categories(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->assertFalse($this->policy->viewAny($user));
    }

    public function test_admin_can_view_category(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $category = Category::factory()->create();

        $this->assertTrue($this->policy->view($admin, $category));
    }

    public function test_non_admin_cannot_view_category(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $category = Category::factory()->create();

        $this->assertFalse($this->policy->view($user, $category));
    }

    public function test_admin_can_create_categories(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->assertTrue($this->policy->create($admin));
    }

    public function test_non_admin_cannot_create_categories(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->assertFalse($this->policy->create($user));
    }

    public function test_admin_can_update_category(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $category = Category::factory()->create();

        $this->assertTrue($this->policy->update($admin, $category));
    }

    public function test_non_admin_cannot_update_category(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $category = Category::factory()->create();

        $this->assertFalse($this->policy->update($user, $category));
    }

    public function test_admin_can_delete_category(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $category = Category::factory()->create();

        $this->assertTrue($this->policy->delete($admin, $category));
    }

    public function test_non_admin_cannot_delete_category(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $category = Category::factory()->create();

        $this->assertFalse($this->policy->delete($user, $category));
    }
}
