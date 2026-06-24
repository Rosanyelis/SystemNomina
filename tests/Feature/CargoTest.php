<?php

namespace Tests\Feature;

use App\Models\Cargo;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class CargoTest extends TestCase
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
        $this->rrhh->givePermissionTo('cargos.listar', 'cargos.crear', 'cargos.editar');

        session()->put('empresa_id', $this->empresa->id);
    }

    public function test_list_cargos(): void
    {
        Cargo::create(['empresa_id' => $this->empresa->id, 'nombre' => 'Analista']);

        $this->actingAs($this->rrhh)
            ->get(route('cargos.index'))
            ->assertOk()
            ->assertSee('Analista');
    }

    public function test_create_cargo(): void
    {
        $this->actingAs($this->rrhh)
            ->post(route('cargos.store'), ['nombre' => 'Gerente', 'descripcion' => 'Gerencia general'])
            ->assertRedirect();

        $this->assertDatabaseHas('cargos', ['nombre' => 'Gerente']);
    }

    public function test_cargo_scoped_to_empresa(): void
    {
        $otraEmpresa = Empresa::factory()->create();
        Cargo::create(['empresa_id' => $this->empresa->id, 'nombre' => 'Cargo A']);
        Cargo::create(['empresa_id' => $otraEmpresa->id, 'nombre' => 'Cargo B']);

        $this->actingAs($this->rrhh)
            ->get(route('cargos.index'))
            ->assertSee('Cargo A')
            ->assertDontSee('Cargo B');
    }
}
