<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Categoria;
use App\Models\Curso;
use App\Models\Articulo;
use App\Models\Configuracion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Administrador IGETIS',
            'email'    => 'admin@igetis.com',
            'password' => Hash::make('admin1234'),
        ]);

        // Categorías
        $categorias = ['Enfermería', 'Medicina', 'Farmacia', 'Laboratorio'];
        foreach ($categorias as $nombre) {
            Categoria::create([
                'nombre' => $nombre,
                'slug'   => Str::slug($nombre),
            ]);
        }

        // Cursos de prueba
        $categoria1 = Categoria::where('slug', 'enfermeria')->first();
        $categoria2 = Categoria::where('slug', 'medicina')->first();

        for ($i = 1; $i <= 6; $i++) {
            $curso = Curso::create([
                'titulo'      => "Curso de prueba $i",
                'slug'        => "curso-de-prueba-$i",
                'descripcion' => 'Descripción del curso número ' . $i,
                'objetivos'   => 'Objetivos del curso',
                'dirigido_a'  => 'Profesionales de la salud',
                'duracion'    => '40 horas',
                'modalidad'   => 'Virtual',
                'visible'     => true,
            ]);

            // Asigna 2 categorías a cada curso
            $curso->categorias()->attach([$categoria1->id, $categoria2->id]);
        }

        // Artículos de prueba
        for ($i = 1; $i <= 3; $i++) {
            Articulo::create([
                'titulo'       => "Artículo de prueba $i",
                'slug'         => "articulo-de-prueba-$i",
                'autor'        => 'Equipo IGETIS',
                'cuerpo'       => 'Contenido del artículo número ' . $i,
                'publicado_en' => now(),
            ]);
        }

        // Configuración global
        $configs = [
            'whatsapp_numero' => '59170000000',
            'email'           => 'info@igetis.com',
            'direccion'       => 'Cochabamba, Bolivia',
            'quienes_somos'   => 'IGETIS es una institución dedicada a la formación y capacitación en salud.',
            'mision'          => 'Nuestra misión es formar profesionales de la salud.',
            'vision'          => 'Nuestra visión es ser referentes en capacitación médica.',
        ];
        foreach ($configs as $clave => $valor) {
            Configuracion::create(compact('clave', 'valor'));
        }
    }
}