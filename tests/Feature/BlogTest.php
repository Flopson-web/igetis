<?php

namespace Tests\Feature;

use App\Models\Articulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    // ── index ────────────────────────────────────────────────────────────────

    public function test_blog_index_is_accessible(): void
    {
        $response = $this->get(route('blog.index'));

        $response->assertStatus(200);
        $response->assertViewIs('blog.index');
    }

    public function test_blog_index_shows_published_articulos(): void
    {
        $publicado = Articulo::factory()->create();

        $response = $this->get(route('blog.index'));

        $response->assertSee($publicado->titulo);
    }

    public function test_blog_index_hides_draft_articulos(): void
    {
        $borrador = Articulo::factory()->borrador()->create();

        $response = $this->get(route('blog.index'));

        $response->assertDontSee($borrador->titulo);
    }

    public function test_blog_index_searches_by_titulo(): void
    {
        $coincide = Articulo::factory()->create(['titulo' => 'Introducción a Docker']);
        $noConcide = Articulo::factory()->create(['titulo' => 'Gestión de equipos remotos']);

        $response = $this->get(route('blog.index', ['buscar' => 'Docker']));

        $response->assertSee($coincide->titulo);
        $response->assertDontSee($noConcide->titulo);
    }

    public function test_blog_index_searches_by_autor(): void
    {
        $coincide = Articulo::factory()->create(['autor' => 'María García']);
        $noConcide = Articulo::factory()->create(['autor' => 'Juan Pérez']);

        $response = $this->get(route('blog.index', ['buscar' => 'María']));

        $response->assertSee($coincide->titulo);
        $response->assertDontSee($noConcide->titulo);
    }

    // ── show ─────────────────────────────────────────────────────────────────

    public function test_blog_show_renders_published_articulo(): void
    {
        $articulo = Articulo::factory()->create();

        $response = $this->get(route('blog.show', $articulo->slug));

        $response->assertStatus(200);
        $response->assertViewIs('blog.show');
        $response->assertSee($articulo->titulo);
    }

    public function test_blog_show_returns_404_for_draft_articulo(): void
    {
        $borrador = Articulo::factory()->borrador()->create();

        $response = $this->get(route('blog.show', $borrador->slug));

        $response->assertStatus(404);
    }

    public function test_blog_show_returns_404_for_nonexistent_slug(): void
    {
        $response = $this->get(route('blog.show', 'slug-que-no-existe'));

        $response->assertStatus(404);
    }

    public function test_blog_show_displays_recent_articulos_in_sidebar(): void
    {
        $principal = Articulo::factory()->create();
        $recientes = Articulo::factory()->count(3)->create();

        $response = $this->get(route('blog.show', $principal->slug));

        foreach ($recientes as $rec) {
            $response->assertSee($rec->titulo);
        }
    }

    public function test_blog_show_does_not_include_itself_in_sidebar(): void
    {
        $articulo = Articulo::factory()->create();

        $response = $this->get(route('blog.show', $articulo->slug));

        $recientes = $response->viewData('recientes');
        $this->assertFalse($recientes->contains('id', $articulo->id));
    }
}
