<?php

namespace Database\Factories;

use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Empresa>
 */
class EmpresaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'razon_social' => fake()->company(),
            'rif' => 'J-'.fake()->unique()->numerify('########').'-'.fake()->randomDigit(),
            'telefono' => fake()->phoneNumber(),
            'email' => fake()->companyEmail(),
            'direccion' => fake()->address(),
            'activo' => true,
        ];
    }

    public function inactiva(): static
    {
        return $this->state(fn (array $attributes) => ['activo' => false]);
    }
}
