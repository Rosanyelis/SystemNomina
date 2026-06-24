<?php

namespace Tests\Feature;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class ParametroEmpresaTest extends TestCase
{
    use LazilyRefreshDatabase;

    private User $admin;

    private Empresa $empresa;

    private Empresa $otraEmpresa;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->admin = User::where('email', 'admin@systemnomina.com')->first();
        $this->empresa = Empresa::first();
        $this->otraEmpresa = Empresa::factory()->create();

        session()->put('empresa_id', $this->empresa->id);
    }

    public function test_create_parametros(): void
    {
        $this->actingAs($this->admin)->post(route('parametros-legales.store'), [
            'salario_minimo' => 200.00,
            'porcentaje_ivss' => 4.00,
            'porcentaje_faov' => 1.00,
            'porcentaje_rpe' => 0.50,
            'valor_ut' => 0.00,
            'vigencia_desde' => '2026-06-01',
        ])->assertRedirect();

        $this->assertDatabaseHas('parametros_empresa', ['salario_minimo' => 200.00]);
    }

    public function test_vigencia_hasta_must_be_after_vigencia_desde(): void
    {
        $this->actingAs($this->admin)
            ->post(route('parametros-legales.store'), [
                'salario_minimo' => 130.00,
                'porcentaje_ivss' => 4.00,
                'porcentaje_faov' => 1.00,
                'porcentaje_rpe' => 0.50,
                'valor_ut' => 0.00,
                'vigencia_desde' => '2026-06-01',
                'vigencia_hasta' => '2026-05-01',
            ])
            ->assertSessionHasErrors('vigencia_hasta');
    }
}
