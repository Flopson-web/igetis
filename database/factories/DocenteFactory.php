<?php

namespace Database\Factories;

use App\Models\Docente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Docente>
 */
class DocenteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => fake()->name(),
            'cargo' => fake()->randomElement(['Docente', 'Instructor Senior', 'Coordinador Académico', 'Especialista']),
            'bio' => fake()->paragraph(3),
            'foto' => null,
            'linkedin' => null,
            'orden' => fake()->numberBetween(0, 10),
            'visible' => true,
        ];
    }

    public function oculto(): static
    {
        return $this->state(['visible' => false]);
    }
}
