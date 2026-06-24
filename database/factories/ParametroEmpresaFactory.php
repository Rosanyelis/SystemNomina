<?php

namespace Database\Factories;

use App\Models\Empresa;
use App\Models\ParametroEmpresa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ParametroEmpresa>
 */
class ParametroEmpresaFactory extends Factory
{
    protected $model = ParametroEmpresa::class;

    public function definition(): array
    {
        return [
            'empresa_id' => Empresa::factory(),
            'salario_minimo' => 130.00,
            'porcentaje_ivss' => 4.00,
            'porcentaje_faov' => 1.00,
            'porcentaje_rpe' => 0.50,
            'valor_ut' => 0.00,
            'vigencia_desde' => fake()->unique()->dateTimeBetween('2025-01-01', '2025-12-31')->format('Y-m-d'),
            'vigencia_hasta' => null,
        ];
    }
}
