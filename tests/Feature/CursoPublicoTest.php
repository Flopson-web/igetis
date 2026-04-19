<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Curso;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CursoPublicoTest extends TestCase
{
    use RefreshDatabase;

    // ── index ────────────────────────────────────────────────────────────────

    public function test_cursos_index_is_accessible(): void
    {
        $response = $this->get(route('cursos.index'));

        $response->assertStatus(200);
        $response->assertViewIs('cursos.index');
    }

    public function test_cursos_index_shows_only_visible_cursos(): void
    {
        $visible = Curso::factory()->create(['visible' => true]);
        $oculto = Curso::factory()->oculto()->create();

        $response = $this->get(route('cursos.index'));

        $response->assertSee($visible->titulo);
        $response->assertDontSee($oculto->titulo);
    }

    public function test_cursos_index_filters_by_categoria(): void
    {
        $categoria = Categoria::factory()->create();
        $con = Curso::factory()->create(['visible' => true]);
        $sin = Curso::factory()->create(['visible' => true]);

        $con->categorias()->attach($categoria);

        $response = $this->get(route('cursos.index', ['categoria' => $categoria->slug]));

        $response->assertSee($con->titulo);
        $response->assertDontSee($sin->titulo);
    }

    public function test_cursos_index_searches_by_titulo(): void
    {
        $coincide = Curso::factory()->create(['titulo' => 'Curso de Laravel avanzado', 'visible' => true]);
        $noConcide = Curso::factory()->create(['titulo' => 'Gestión de proyectos', 'visible' => true]);

        $response = $this->get(route('cursos.index', ['buscar' => 'Laravel']));

        $response->assertSee($coincide->titulo);
        $response->assertDontSee($noConcide->titulo);
    }

    public function test_cursos_index_shows_categorias_in_sidebar(): void
    {
        $categoria = Categoria::factory()->create();

        $response = $this->get(route('cursos.index'));

        $response->assertSee($categoria->nombre);
    }

    // ── show ─────────────────────────────────────────────────────────────────

    public function test_curso_show_renders_visible_curso(): void
    {
        $curso = Curso::factory()->create(['visible' => true]);

        $response = $this->get(route('cursos.show', $curso->slug));

        $response->assertStatus(200);
        $response->assertViewIs('cursos.show');
        $response->assertSee($curso->titulo);
    }

    public function test_curso_show_returns_404_for_hidden_curso(): void
    {
        $curso = Curso::factory()->oculto()->create();

        $response = $this->get(route('cursos.show', $curso->slug));

        $response->assertStatus(404);
    }

    public function test_curso_show_returns_404_for_nonexistent_slug(): void
    {
        $response = $this->get(route('cursos.show', 'slug-que-no-existe'));

        $response->assertStatus(404);
    }

    public function test_curso_show_displays_objectives_and_audience_when_present(): void
    {
        $curso = Curso::factory()->create([
            'visible' => true,
            'objetivos' => 'Aprender testing en Laravel',
            'dirigido_a' => 'Desarrolladores PHP',
        ]);

        $response = $this->get(route('cursos.show', $curso->slug));

        $response->assertSee('Aprender testing en Laravel');
        $response->assertSee('Desarrolladores PHP');
    }
}
