<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactoTest extends TestCase
{
    use RefreshDatabase;

    // ── index ────────────────────────────────────────────────────────────────

    public function test_contacto_page_is_accessible(): void
    {
        $response = $this->get(route('contacto.index'));

        $response->assertStatus(200);
        $response->assertViewIs('contacto.index');
    }

    // ── store ────────────────────────────────────────────────────────────────

    public function test_contacto_store_saves_mensaje_and_redirects(): void
    {
        $data = [
            'nombre' => 'Ana López',
            'email' => 'ana@ejemplo.com',
            'telefono' => '600123456',
            'mensaje' => 'Me interesa el curso de Laravel.',
        ];

        $response = $this->post(route('contacto.store'), $data);

        $response->assertRedirect(route('contacto.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('mensajes', [
            'nombre' => 'Ana López',
            'email' => 'ana@ejemplo.com',
            'mensaje' => 'Me interesa el curso de Laravel.',
        ]);
    }

    public function test_contacto_store_works_without_telefono(): void
    {
        $response = $this->post(route('contacto.store'), [
            'nombre' => 'Pedro Ruiz',
            'email' => 'pedro@ejemplo.com',
            'mensaje' => 'Quiero más información.',
        ]);

        $response->assertRedirect(route('contacto.index'));
        $this->assertDatabaseCount('mensajes', 1);
    }

    public function test_contacto_store_requires_nombre(): void
    {
        $response = $this->post(route('contacto.store'), [
            'email' => 'test@ejemplo.com',
            'mensaje' => 'Hola.',
        ]);

        $response->assertSessionHasErrors('nombre');
        $this->assertDatabaseCount('mensajes', 0);
    }

    public function test_contacto_store_requires_valid_email(): void
    {
        $response = $this->post(route('contacto.store'), [
            'nombre' => 'Test',
            'email' => 'no-es-un-email',
            'mensaje' => 'Hola.',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertDatabaseCount('mensajes', 0);
    }

    public function test_contacto_store_requires_mensaje(): void
    {
        $response = $this->post(route('contacto.store'), [
            'nombre' => 'Test',
            'email' => 'test@ejemplo.com',
        ]);

        $response->assertSessionHasErrors('mensaje');
        $this->assertDatabaseCount('mensajes', 0);
    }

    public function test_contacto_store_rejects_mensaje_too_long(): void
    {
        $response = $this->post(route('contacto.store'), [
            'nombre' => 'Test',
            'email' => 'test@ejemplo.com',
            'mensaje' => str_repeat('a', 2001),
        ]);

        $response->assertSessionHasErrors('mensaje');
        $this->assertDatabaseCount('mensajes', 0);
    }

    public function test_mensaje_is_stored_as_unread_by_default(): void
    {
        $this->post(route('contacto.store'), [
            'nombre' => 'Test',
            'email' => 'test@ejemplo.com',
            'mensaje' => 'Mensaje de prueba.',
        ]);

        $this->assertDatabaseHas('mensajes', ['leido' => false]);
    }
}
