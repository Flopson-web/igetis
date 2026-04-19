<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::with('categorias')->latest()->paginate(15);

        return view('admin.cursos.index', compact('cursos'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('admin.cursos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'objetivos' => ['nullable', 'string'],
            'dirigido_a' => ['nullable', 'string', 'max:255'],
            'duracion' => ['nullable', 'string', 'max:100'],
            'modalidad' => ['nullable', 'string', 'max:100'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'categorias' => ['nullable', 'array'],
            'categorias.*' => ['exists:categorias,id'],
        ]);

        $data['slug'] = Str::slug($data['titulo']);
        $data['visible'] = $request->boolean('visible');

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('cursos', 'public');
        }

        $curso = Curso::create($data);
        $curso->categorias()->sync($request->input('categorias', []));

        return redirect()->route('admin.cursos.index')
            ->with('success', 'Curso creado correctamente.');
    }

    public function show(Curso $curso)
    {
        return redirect()->route('admin.cursos.edit', $curso);
    }

    public function edit(Curso $curso)
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('admin.cursos.edit', compact('curso', 'categorias'));
    }

    public function update(Request $request, Curso $curso)
    {
        $data = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'objetivos' => ['nullable', 'string'],
            'dirigido_a' => ['nullable', 'string', 'max:255'],
            'duracion' => ['nullable', 'string', 'max:100'],
            'modalidad' => ['nullable', 'string', 'max:100'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'categorias' => ['nullable', 'array'],
            'categorias.*' => ['exists:categorias,id'],
        ]);

        $data['slug'] = Str::slug($data['titulo']);
        $data['visible'] = $request->boolean('visible');

        if ($request->hasFile('imagen')) {
            if ($curso->imagen) {
                Storage::disk('public')->delete($curso->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('cursos', 'public');
        }

        $curso->update($data);
        $curso->categorias()->sync($request->input('categorias', []));

        return redirect()->route('admin.cursos.index')
            ->with('success', 'Curso actualizado correctamente.');
    }

    public function destroy(Curso $curso)
    {
        if ($curso->imagen) {
            Storage::disk('public')->delete($curso->imagen);
        }

        $curso->delete();

        return redirect()->route('admin.cursos.index')
            ->with('success', 'Curso eliminado correctamente.');
    }

    public function toggleVisibilidad(Curso $curso)
    {
        $curso->update(['visible' => ! $curso->visible]);

        return back()->with('success', $curso->visible ? 'Curso publicado.' : 'Curso ocultado.');
    }
}
