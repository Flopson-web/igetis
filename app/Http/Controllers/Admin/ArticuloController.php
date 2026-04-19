<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticuloController extends Controller
{
    public function index()
    {
        $articulos = Articulo::latest('publicado_en')->paginate(15);

        return view('admin.articulos.index', compact('articulos'));
    }

    public function create()
    {
        return view('admin.articulos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'autor' => ['required', 'string', 'max:150'],
            'cuerpo' => ['required', 'string'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'publicado_en' => ['nullable', 'date'],
        ]);

        $data['slug'] = Str::slug($data['titulo']);
        $data['publicado_en'] = $data['publicado_en'] ?? now();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('articulos', 'public');
        }

        Articulo::create($data);

        return redirect()->route('admin.articulos.index')
            ->with('success', 'Artículo creado correctamente.');
    }

    public function show(Articulo $articulo)
    {
        return redirect()->route('admin.articulos.edit', $articulo);
    }

    public function edit(Articulo $articulo)
    {
        return view('admin.articulos.edit', compact('articulo'));
    }

    public function update(Request $request, Articulo $articulo)
    {
        $data = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'autor' => ['required', 'string', 'max:150'],
            'cuerpo' => ['required', 'string'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'publicado_en' => ['nullable', 'date'],
        ]);

        $data['slug'] = Str::slug($data['titulo']);
        $data['publicado_en'] = $data['publicado_en'] ?? $articulo->publicado_en;

        if ($request->hasFile('imagen')) {
            if ($articulo->imagen) {
                Storage::disk('public')->delete($articulo->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('articulos', 'public');
        }

        $articulo->update($data);

        return redirect()->route('admin.articulos.index')
            ->with('success', 'Artículo actualizado correctamente.');
    }

    public function destroy(Articulo $articulo)
    {
        if ($articulo->imagen) {
            Storage::disk('public')->delete($articulo->imagen);
        }

        $articulo->delete();

        return redirect()->route('admin.articulos.index')
            ->with('success', 'Artículo eliminado correctamente.');
    }
}
