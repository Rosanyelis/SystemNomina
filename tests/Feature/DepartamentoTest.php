<?php

namespace Tests\Feature;

use App\Models\Departamento;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class DepartamentoTest extends TestCase
{
    use LazilyRefreshDatabase;

    private User $rrhh;

    private Empresa $empresa;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->empresa = Empresa::first();
        $this->rrhh = User::factory()->create();
        $this->rrhh->givePermissionTo('departamentos.listar', 'departamentos.crear', 'departamentos.editar');

        session()->put('empresa_id', $this->empresa->id);
    }

    public function test_list_departamentos(): void
    {
        Departamento::create(['empresa_id' => $this->empresa->id, 'nombre' => 'Contabilidad']);

        $this->actingAs($this->rrhh)
            ->get(route('departamentos.index'))
            ->assertOk()
            ->assertSee('Contabilidad');
    }

    public function test_create_departamento(): void
    {
        $this->actingAs($this->rrhh)
            ->post(route('departamentos.store'), ['nombre' => 'IT'])
            ->assertRedirect();

        $this->assertDatabaseHas('departamentos', ['nombre' => 'IT', 'empresa_id' => $this->empresa->id]);
    }

    public function test_departamento_scoped_to_empresa(): void
    {
        $otraEmpresa = Empresa::factory()->create();
        Departamento::create(['empresa_id' => $this->empresa->id, 'nombre' => 'Solo A']);
        Departamento::create(['empresa_id' => $otraEmpresa->id, 'nombre' => 'Otra Emp']);

        $this->actingAs($this->rrhh)
            ->get(route('departamentos.index'))
            ->assertSee('Solo A')
            ->assertDontSee('Otra Emp');
    }
}
