<?php

namespace Database\Factories;

use App\Models\Articulo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Articulo>
 */
class ArticuloFactory extends Factory
{
    public function definition(): array
    {
        $titulo = fake()->sentence(5, false);

        return [
            'titulo' => $titulo,
            'slug' => Str::slug($titulo).'-'.fake()->unique()->randomNumber(4),
            'autor' => fake()->name(),
            'imagen' => null,
            'cuerpo' => fake()->paragraphs(4, true),
            'publicado_en' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function borrador(): static
    {
        return $this->state(['publicado_en' => null]);
    }
}
