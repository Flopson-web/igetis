<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Articulo::whereNotNull('publicado_en')->orderByDesc('publicado_en');

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('titulo', 'like', "%{$buscar}%")
                    ->orWhere('autor', 'like', "%{$buscar}%");
            });
        }

        $articulos = $query->paginate(9)->withQueryString();

        return view('blog.index', compact('articulos'));
    }

    public function show(string $slug)
    {
        $articulo = Articulo::where('slug', $slug)
            ->whereNotNull('publicado_en')
            ->firstOrFail();

        $recientes = Articulo::whereNotNull('publicado_en')
            ->where('id', '!=', $articulo->id)
            ->orderByDesc('publicado_en')
            ->take(4)
            ->get();

        return view('blog.show', compact('articulo', 'recientes'));
    }
}
