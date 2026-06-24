<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class UsuarioTest extends TestCase
{
    use LazilyRefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->admin = User::where('email', 'admin@systemnomina.com')->first();
    }

    public function test_admin_can_list_usuarios(): void
    {
        $this->actingAs($this->admin)
            ->get(route('usuarios.index'))
            ->assertOk()
            ->assertSee('admin@systemnomina.com');
    }

    public function test_admin_can_create_rrhh_user(): void
    {
        $this->actingAs($this->admin)->post(route('usuarios.store'), [
            'name' => 'Nuevo RRHH',
            'email' => 'nuevo.rrhh@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'RRHH',
        ])->assertRedirect(route('usuarios.index'));

        $this->assertDatabaseHas('users', ['email' => 'nuevo.rrhh@test.com']);
    }

    public function test_super_admin_no_empresa_required(): void
    {
        $this->actingAs($this->admin)->post(route('usuarios.store'), [
            'name' => 'Nuevo Admin',
            'email' => 'nuevo.admin@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'Super Admin',
        ])->assertRedirect(route('usuarios.index'));

        $this->assertDatabaseHas('users', ['email' => 'nuevo.admin@test.com']);
    }
}
