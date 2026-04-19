<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Configuracion;
use App\Models\Curso;

class HomeController extends Controller
{
    public function index()
    {
        $cursos = Curso::where('visible', true)
            ->with('categorias')
            ->latest()
            ->take(3)
            ->get();

        $articulos = Articulo::whereNotNull('publicado_en')
            ->orderByDesc('publicado_en')
            ->take(3)
            ->get();

        $config = [
            'hero_titulo' => Configuracion::get('hero_titulo', 'Formación profesional que transforma carreras'),
            'hero_texto' => Configuracion::get('hero_texto', 'Cursos especializados en gestión y tecnología para profesionales que quieren avanzar.'),
            'telefono' => Configuracion::get('telefono', ''),
            'email' => Configuracion::get('email', ''),
        ];

        return view('home', compact('cursos', 'articulos', 'config'));
    }
}
