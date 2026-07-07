<?php

namespace Tests\Feature;

use App\Models\Portfolio;
use App\Models\User;
use App\Policies\PortfolioPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioPolicyTest extends TestCase
{
    use RefreshDatabase;

    private PortfolioPolicy $policy;

    protected function setUp(): void
    {
        parent::setUp();
        $this->policy = new PortfolioPolicy();
    }

    public function test_admin_can_view_any_portfolio_items(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->assertTrue($this->policy->viewAny($admin));
    }

    public function test_non_admin_cannot_view_any_portfolio_items(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->assertFalse($this->policy->viewAny($user));
    }

    public function test_admin_can_view_portfolio_item(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $portfolio = Portfolio::factory()->create();

        $this->assertTrue($this->policy->view($admin, $portfolio));
    }

    public function test_non_admin_cannot_view_portfolio_item(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $portfolio = Portfolio::factory()->create();

        $this->assertFalse($this->policy->view($user, $portfolio));
    }

    public function test_admin_can_create_portfolio_items(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->assertTrue($this->policy->create($admin));
    }

    public function test_non_admin_cannot_create_portfolio_items(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->assertFalse($this->policy->create($user));
    }

    public function test_admin_can_update_portfolio_item(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $portfolio = Portfolio::factory()->create();

        $this->assertTrue($this->policy->update($admin, $portfolio));
    }

    public function test_non_admin_cannot_update_portfolio_item(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $portfolio = Portfolio::factory()->create();

        $this->assertFalse($this->policy->update($user, $portfolio));
    }

    public function test_admin_can_delete_portfolio_item(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $portfolio = Portfolio::factory()->create();

        $this->assertTrue($this->policy->delete($admin, $portfolio));
    }

    public function test_non_admin_cannot_delete_portfolio_item(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $portfolio = Portfolio::factory()->create();

        $this->assertFalse($this->policy->delete($user, $portfolio));
    }
}
