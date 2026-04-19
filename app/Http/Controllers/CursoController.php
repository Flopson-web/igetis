<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index(Request $request)
    {
        $query = Curso::where('visible', true)->with('categorias')->latest();

        if ($request->filled('categoria')) {
            $query->whereHas('categorias', function ($q) use ($request) {
                $q->where('slug', $request->categoria);
            });
        }

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('titulo', 'like', "%{$buscar}%")
                    ->orWhere('descripcion', 'like', "%{$buscar}%");
            });
        }

        $cursos = $query->paginate(9)->withQueryString();
        $categorias = Categoria::orderBy('nombre')->get();

        return view('cursos.index', compact('cursos', 'categorias'));
    }

    public function show(string $slug)
    {
        $curso = Curso::where('slug', $slug)
            ->where('visible', true)
            ->with('categorias')
            ->firstOrFail();

        return view('cursos.show', compact('curso'));
    }
}
