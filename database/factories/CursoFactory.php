<?php

namespace Database\Factories;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Curso>
 */
class CursoFactory extends Factory
{
    public function definition(): array
    {
        $titulo = fake()->sentence(4, false);

        return [
            'titulo' => $titulo,
            'slug' => Str::slug($titulo).'-'.fake()->unique()->randomNumber(4),
            'descripcion' => fake()->paragraphs(2, true),
            'objetivos' => fake()->paragraph(),
            'dirigido_a' => fake()->sentence(),
            'duracion' => fake()->randomElement(['20 horas', '40 horas', '60 horas', '3 meses']),
            'modalidad' => fake()->randomElement(['Online', 'Presencial', 'Blended']),
            'imagen' => null,
            'video_url' => null,
            'visible' => true,
        ];
    }

    public function oculto(): static
    {
        return $this->state(['visible' => false]);
    }
}
