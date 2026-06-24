<?php

namespace Database\Factories;

use App\Models\Cargo;
use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cargo>
 */
class CargoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'empresa_id' => Empresa::factory(),
            'nombre' => fake()->unique()->jobTitle(),
            'descripcion' => fake()->sentence(),
        ];
    }
}
