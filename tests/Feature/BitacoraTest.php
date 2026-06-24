<?php

namespace Tests\Feature;

use App\Models\Bitacora;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class BitacoraTest extends TestCase
{
    use LazilyRefreshDatabase;

    private User $admin;

    private Empresa $empresa;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->admin = User::where('email', 'admin@systemnomina.com')->first();
        $this->empresa = Empresa::first();

        session()->put('empresa_id', $this->empresa->id);
    }

    public function test_crear_empresa_genera_bitacora(): void
    {
        $this->actingAs($this->admin)->post(route('empresas.store'), [
            'razon_social' => 'Bitacora Test',
            'rif' => 'J-99999999-9',
            'activo' => true,
        ]);

        $this->assertDatabaseHas('bitacora', [
            'usuario_id' => $this->admin->id,
            'accion' => 'Creó empresa: Bitacora Test',
        ]);
    }

    public function test_admin_puede_ver_bitacora(): void
    {
        Bitacora::registrar($this->admin, 'Test action');

        $this->actingAs($this->admin)
            ->get(route('bitacora.index'))
            ->assertOk()
            ->assertSee('Test action');
    }
}
