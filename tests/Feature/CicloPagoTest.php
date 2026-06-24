<?php

namespace Tests\Feature;

use App\Models\CicloPago;
use App\Models\Empresa;
use App\Models\User;
use Database\Seeders\CicloPagoSeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class CicloPagoTest extends TestCase
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
        $this->rrhh->givePermissionTo('ciclos-pago.listar', 'ciclos-pago.crear', 'ciclos-pago.editar');

        session()->put('empresa_id', $this->empresa->id);
    }

    public function test_create_ciclo(): void
    {
        $this->actingAs($this->rrhh)
            ->post(route('ciclos-pago.store'), ['nombre' => 'Bisemanal', 'dias' => 14, 'activo' => true])
            ->assertRedirect();

        $this->assertDatabaseHas('ciclos_pago', ['nombre' => 'Bisemanal', 'dias' => 14]);
    }

    public function test_ciclos_seeded(): void
    {
        $this->seed(CicloPagoSeeder::class);

        $ciclos = CicloPago::where('empresa_id', $this->empresa->id)->get();

        $this->assertCount(3, $ciclos);
        $this->assertTrue($ciclos->contains('nombre', 'Semanal'));
        $this->assertTrue($ciclos->contains('nombre', 'Quincenal'));
        $this->assertTrue($ciclos->contains('nombre', 'Mensual'));
    }

    public function test_rrhh_can_toggle_ciclo_activo(): void
    {
        $this->rrhh->givePermissionTo('ciclos-pago.desactivar');

        $ciclo = CicloPago::factory()->create([
            'empresa_id' => $this->empresa->id,
            'nombre' => 'Personalizado',
            'dias' => 10,
            'activo' => true,
        ]);

        $this->actingAs($this->rrhh)
            ->post(route('ciclos-pago.toggle-activo', $ciclo))
            ->assertRedirect();

        $this->assertDatabaseHas('ciclos_pago', ['id' => $ciclo->id, 'activo' => false]);
    }
}
