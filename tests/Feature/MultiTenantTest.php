<?php

namespace Tests\Feature;

use App\Models\Departamento;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class MultiTenantTest extends TestCase
{
    use LazilyRefreshDatabase;

    private Empresa $empresaA;

    private Empresa $empresaB;

    private User $superAdmin;

    private User $rrhh;

    private User $contador;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->empresaA = Empresa::factory()->create(['razon_social' => 'Empresa A', 'rif' => 'J-11111111-1']);
        $this->empresaB = Empresa::factory()->create(['razon_social' => 'Empresa B', 'rif' => 'J-22222222-2']);

        $this->superAdmin = User::where('email', 'admin@systemnomina.com')->first();

        $this->rrhh = User::factory()->create(['activo' => true]);
        $this->rrhh->assignRole('RRHH');

        $this->contador = User::factory()->create(['activo' => true]);
        $this->contador->assignRole('Contador');
    }

    /* ─── Super Admin ─── */

    public function test_super_admin_can_list_empresas_without_session_empresa(): void
    {
        session()->forget('empresa_id');

        $this->actingAs($this->superAdmin)
            ->get(route('empresas.index'))
            ->assertOk()
            ->assertSee('Empresa A')
            ->assertSee('Empresa B');
    }

    public function test_super_admin_cannot_create_departamento_without_empresa_in_session(): void
    {
        session()->forget('empresa_id');

        $this->actingAs($this->superAdmin)
            ->post(route('departamentos.store'), ['nombre' => 'Nuevo Depto'])
            ->assertForbidden();
    }

    public function test_super_admin_cannot_view_create_form_without_empresa_in_session(): void
    {
        session()->forget('empresa_id');

        $this->actingAs($this->superAdmin)
            ->get(route('departamentos.create'))
            ->assertForbidden();
    }

    public function test_super_admin_can_create_departamento_with_empresa_in_session(): void
    {
        session()->put('empresa_id', $this->empresaA->id);

        $this->actingAs($this->superAdmin)->post(route('departamentos.store'), [
            'nombre' => 'Ventas',
        ])->assertRedirect();

        $this->assertDatabaseHas('departamentos', ['nombre' => 'Ventas', 'empresa_id' => $this->empresaA->id]);
    }

    /* ─── RRHH ─── */

    public function test_rrhh_without_empresas_listar_permission_cannot_list_empresas(): void
    {
        $this->actingAs($this->rrhh)
            ->get(route('empresas.index'))
            ->assertForbidden();
    }

    public function test_rrhh_with_empresas_listar_permission_can_list_empresas(): void
    {
        $this->rrhh->givePermissionTo('empresas.listar');

        $this->actingAs($this->rrhh)
            ->get(route('empresas.index'))
            ->assertOk();
    }

    public function test_rrhh_without_session_empresa_sees_no_departamentos(): void
    {
        session()->forget('empresa_id');
        Departamento::create(['empresa_id' => $this->empresaA->id, 'nombre' => 'Depto A']);

        $this->actingAs($this->rrhh)
            ->get(route('departamentos.index'))
            ->assertOk()
            ->assertDontSee('Depto A');
    }

    public function test_rrhh_with_session_empresa_sees_only_that_empresa_departamentos(): void
    {
        session()->put('empresa_id', $this->empresaA->id);
        Departamento::create(['empresa_id' => $this->empresaA->id, 'nombre' => 'Depto A']);
        Departamento::create(['empresa_id' => $this->empresaB->id, 'nombre' => 'Depto B']);

        $this->actingAs($this->rrhh)
            ->get(route('departamentos.index'))
            ->assertOk()
            ->assertSee('Depto A')
            ->assertDontSee('Depto B');
    }

    public function test_rrhh_can_use_empresa_selector(): void
    {
        $this->actingAs($this->rrhh)
            ->post(route('seleccionar-empresa'), ['empresa_id' => $this->empresaA->id])
            ->assertRedirect();

        $this->assertEquals($this->empresaA->id, session('empresa_id'));
    }

    public function test_rrhh_creates_departamento_with_session_empresa(): void
    {
        session()->put('empresa_id', $this->empresaA->id);

        $this->actingAs($this->rrhh)->post(route('departamentos.store'), [
            'nombre' => 'IT',
        ])->assertRedirect();

        $this->assertDatabaseHas('departamentos', ['nombre' => 'IT', 'empresa_id' => $this->empresaA->id]);
        $this->assertDatabaseMissing('departamentos', ['nombre' => 'IT', 'empresa_id' => $this->empresaB->id]);
    }

    /* ─── Contador ─── */

    public function test_user_without_any_tenant_permissions_cannot_change_empresa_in_session(): void
    {
        $user = User::factory()->create(['activo' => true]);

        $this->actingAs($user)
            ->post(route('seleccionar-empresa'), ['empresa_id' => $this->empresaA->id])
            ->assertForbidden();
    }

    public function test_user_with_tenant_permission_can_use_empresa_selector(): void
    {
        $user = User::factory()->create(['activo' => true]);
        $user->givePermissionTo('departamentos.listar');

        $this->actingAs($user)
            ->post(route('seleccionar-empresa'), ['empresa_id' => $this->empresaA->id])
            ->assertRedirect();
    }
}
