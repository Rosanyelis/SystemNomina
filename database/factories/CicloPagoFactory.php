<?php

namespace Database\Factories;

use App\Models\CicloPago;
use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CicloPago>
 */
class CicloPagoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'empresa_id' => Empresa::factory(),
            'nombre' => fake()->randomElement(['Semanal', 'Quincenal', 'Mensual']),
            'dias' => fake()->randomElement([7, 15, 30]),
            'activo' => true,
        ];
    }
}
