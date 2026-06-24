<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_guests_are_redirected_to_login(): void
    {
        $response = $this->get(route('dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_view_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee(__('Payroll overview'));
        $response->assertSee(__('Active employees'));
        $response->assertSee(__('Recent payroll runs'));
    }

    public function test_dashboard_displays_kpi_grid(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertSee(__('Labor cost'));
        $response->assertSee(__('Total deductions'));
        $response->assertSee(__('Processed payrolls'));
    }

    public function test_dashboard_shows_empty_state_when_no_payrolls(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertSee(__('No payroll runs yet'));
    }

    public function test_dashboard_includes_theme_toggle(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertSee(__('Switch to dark mode'), false);
        $response->assertSee('localStorage.getItem', false);
    }
}
