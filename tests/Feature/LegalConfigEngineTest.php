<?php

namespace Tests\Feature;

use App\Models\Empresa;
use App\Models\ParametroEmpresa;
use App\Services\LegalConfigEngine;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class LegalConfigEngineTest extends TestCase
{
    use LazilyRefreshDatabase;

    private LegalConfigEngine $engine;

    private Empresa $empresa;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->engine = app(LegalConfigEngine::class);
        $this->empresa = Empresa::factory()->create();
    }

    public function test_returns_parametros_for_exact_date(): void
    {
        ParametroEmpresa::factory()->create([
            'empresa_id' => $this->empresa->id,
            'salario_minimo' => 150.00,
            'vigencia_desde' => '2026-01-01',
            'vigencia_hasta' => '2026-06-30',
        ]);

        $result = $this->engine->getParametrosVigentes($this->empresa, Carbon::parse('2026-03-15'));

        $this->assertNotNull($result);
        $this->assertEquals(150.00, $result->salario_minimo);
    }

    public function test_returns_null_for_date_before_any_vigencia(): void
    {
        ParametroEmpresa::factory()->create([
            'empresa_id' => $this->empresa->id,
            'vigencia_desde' => '2026-01-01',
        ]);

        $result = $this->engine->getParametrosVigentes($this->empresa, Carbon::parse('2025-12-31'));

        $this->assertNull($result);
    }

    public function test_returns_null_for_date_after_vigencia_hasta(): void
    {
        ParametroEmpresa::factory()->create([
            'empresa_id' => $this->empresa->id,
            'vigencia_desde' => '2026-01-01',
            'vigencia_hasta' => '2026-06-30',
        ]);

        $result = $this->engine->getParametrosVigentes($this->empresa, Carbon::parse('2026-07-01'));

        $this->assertNull($result);
    }

    public function test_returns_vigente_for_null_vigencia_hasta(): void
    {
        ParametroEmpresa::factory()->create([
            'empresa_id' => $this->empresa->id,
            'vigencia_desde' => '2026-01-01',
            'vigencia_hasta' => null,
        ]);

        $result = $this->engine->getParametrosVigentes($this->empresa, Carbon::parse('2026-12-01'));

        $this->assertNotNull($result);
    }

    public function test_returns_most_recent_for_date_in_range(): void
    {
        ParametroEmpresa::factory()->create([
            'empresa_id' => $this->empresa->id,
            'salario_minimo' => 100.00,
            'vigencia_desde' => '2026-01-01',
            'vigencia_hasta' => '2026-05-31',
        ]);

        ParametroEmpresa::factory()->create([
            'empresa_id' => $this->empresa->id,
            'salario_minimo' => 200.00,
            'vigencia_desde' => '2026-06-01',
            'vigencia_hasta' => null,
        ]);

        $result = $this->engine->getParametrosVigentes($this->empresa, Carbon::parse('2026-06-15'));

        $this->assertNotNull($result);
        $this->assertEquals(200.00, $result->salario_minimo);
    }
}
