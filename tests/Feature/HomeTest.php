<?php

namespace Tests\Feature;

use App\Models\Articulo;
use App\Models\Curso;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_is_accessible(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertViewIs('home');
    }

    public function test_home_shows_visible_cursos(): void
    {
        $visible = Curso::factory()->count(2)->create(['visible' => true]);
        Curso::factory()->oculto()->create();

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        foreach ($visible as $curso) {
            $response->assertSee($curso->titulo);
        }
    }

    public function test_home_does_not_show_hidden_cursos(): void
    {
        $oculto = Curso::factory()->oculto()->create();

        $response = $this->get(route('home'));

        $response->assertDontSee($oculto->titulo);
    }

    public function test_home_shows_published_articulos(): void
    {
        $publicado = Articulo::factory()->create();

        $response = $this->get(route('home'));

        $response->assertSee($publicado->titulo);
    }

    public function test_home_does_not_show_draft_articulos(): void
    {
        $borrador = Articulo::factory()->borrador()->create();

        $response = $this->get(route('home'));

        $response->assertDontSee($borrador->titulo);
    }

    public function test_home_shows_at_most_three_cursos(): void
    {
        Curso::factory()->count(6)->create(['visible' => true]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $this->assertCount(3, $response->viewData('cursos'));
    }

    public function test_home_shows_at_most_three_articulos(): void
    {
        Articulo::factory()->count(6)->create();

        $response = $this->get(route('home'));

        $this->assertCount(3, $response->viewData('articulos'));
    }
}
