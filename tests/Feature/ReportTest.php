<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_view_payroll_summary_report(): void
    {
        $response = $this->get(route('reports.payroll-summary'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_view_payroll_summary_report(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('reports.payroll-summary'));

        $response->assertOk();
        $response->assertSee(__('Payroll summary'));
        $response->assertSee(__('No payroll data for this period'));
    }
}
