<?php

namespace Tests\Feature;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class EmpresaTest extends TestCase
{
    use LazilyRefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->admin = User::where('email', 'admin@systemnomina.com')->first();
    }

    public function test_guest_cannot_list_empresas(): void
    {
        $this->get(route('empresas.index'))->assertRedirect(route('login'));
    }

    public function test_admin_can_list_empresas(): void
    {
        $this->actingAs($this->admin)
            ->get(route('empresas.index'))
            ->assertOk()
            ->assertSee('J-12345678-0');
    }

    public function test_admin_can_create_empresa(): void
    {
        $this->actingAs($this->admin)->post(route('empresas.store'), [
            'razon_social' => 'Nueva Empresa, C.A.',
            'rif' => 'J-98765432-1',
            'email' => 'nueva@empresa.com',
            'activo' => true,
        ])->assertRedirect(route('empresas.index'));

        $this->assertDatabaseHas('empresas', ['rif' => 'J-98765432-1']);
    }

    public function test_rif_must_be_unique(): void
    {
        Empresa::factory()->create(['rif' => 'J-11111111-1']);

        $this->actingAs($this->admin)
            ->post(route('empresas.store'), [
                'razon_social' => 'Otra Empresa',
                'rif' => 'J-11111111-1',
            ])
            ->assertSessionHasErrors('rif');
    }

    public function test_admin_sees_create_button_as_link(): void
    {
        $response = $this->actingAs($this->admin)->get(route('empresas.index'));

        $response->assertOk();
        $response->assertSee(route('empresas.create'), false);
        $response->assertSee('href="'.route('empresas.create').'"', false);
    }

    public function test_admin_can_toggle_empresa_status(): void
    {
        $empresa = Empresa::factory()->create(['activo' => true]);

        $this->actingAs($this->admin)->patch(route('empresas.update', $empresa), [
            'razon_social' => $empresa->razon_social,
            'rif' => $empresa->rif,
            'activo' => false,
        ])->assertRedirect(route('empresas.index'));

        $this->assertDatabaseHas('empresas', ['id' => $empresa->id, 'activo' => false]);
    }

    public function test_admin_can_toggle_activo_directly(): void
    {
        $empresa = Empresa::factory()->create(['activo' => true]);

        $this->actingAs($this->admin)
            ->post(route('empresas.toggle-activo', $empresa))
            ->assertRedirect();

        $this->assertDatabaseHas('empresas', ['id' => $empresa->id, 'activo' => false]);

        $this->actingAs($this->admin)
            ->post(route('empresas.toggle-activo', $empresa))
            ->assertRedirect();

        $this->assertDatabaseHas('empresas', ['id' => $empresa->id, 'activo' => true]);
    }
}
