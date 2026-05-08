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
            'tipo' => ['nullable', 'string', 'max:100'],
            'descripcion' => ['required', 'string'],
            'objetivos' => ['nullable', 'string'],
            'dirigido_a' => ['nullable', 'string', 'max:255'],
            'duracion' => ['nullable', 'string', 'max:100'],
            'modalidad' => ['nullable', 'string', 'max:100'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
            'certificacion' => ['nullable', 'string', 'max:255'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'imagen' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp,gif', 'max:2048'],
            'docente_foto' => ['nullable', 'array'],
            'docente_foto.*' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'categorias' => ['nullable', 'array'],
            'categorias.*' => ['exists:categorias,id'],
        ]);

        $data['slug'] = Str::slug($data['titulo']);
        $data['visible'] = $request->boolean('visible');
        $data['precios'] = $this->collectPrecios($request);
        $data['agenda'] = $this->collectAgenda($request);
        $data['docentes_curso'] = $this->collectDocentes($request);

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
            'tipo' => ['nullable', 'string', 'max:100'],
            'descripcion' => ['required', 'string'],
            'objetivos' => ['nullable', 'string'],
            'dirigido_a' => ['nullable', 'string', 'max:255'],
            'duracion' => ['nullable', 'string', 'max:100'],
            'modalidad' => ['nullable', 'string', 'max:100'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
            'certificacion' => ['nullable', 'string', 'max:255'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'imagen' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp,gif', 'max:2048'],
            'docente_foto' => ['nullable', 'array'],
            'docente_foto.*' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'categorias' => ['nullable', 'array'],
            'categorias.*' => ['exists:categorias,id'],
        ]);

        $data['slug'] = Str::slug($data['titulo']);
        $data['visible'] = $request->boolean('visible');
        $data['precios'] = $this->collectPrecios($request);
        $data['agenda'] = $this->collectAgenda($request);
        $data['docentes_curso'] = $this->collectDocentes($request);

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

    private function collectPrecios(Request $request): ?array
    {
        $tipos = $request->input('precio_tipo', []);
        $montos = $request->input('precio_monto', []);
        $precios = [];

        foreach ($tipos as $i => $tipo) {
            if (! empty(trim((string) $tipo))) {
                $precios[] = ['tipo' => $tipo, 'precio' => $montos[$i] ?? ''];
            }
        }

        return ! empty($precios) ? $precios : null;
    }

    private function collectAgenda(Request $request): ?array
    {
        $titulos = $request->input('agenda_titulo', []);
        $descs = $request->input('agenda_descripcion', []);
        $agenda = [];

        foreach ($titulos as $i => $titulo) {
            if (! empty(trim((string) $titulo))) {
                $agenda[] = ['titulo' => $titulo, 'descripcion' => $descs[$i] ?? ''];
            }
        }

        return ! empty($agenda) ? $agenda : null;
    }

    private function collectDocentes(Request $request): ?array
    {
        $nombres = $request->input('docente_nombre', []);
        $especialidades = $request->input('docente_especialidad', []);
        $roles = $request->input('docente_rol', []);
        $fotosExistentes = $request->input('docente_foto_existente', []);
        $fotos = $request->file('docente_foto', []);
        $docentes = [];

        foreach ($nombres as $i => $nombre) {
            if (! empty(trim((string) $nombre))) {
                $fotoPath = $fotosExistentes[$i] ?? null;

                if (isset($fotos[$i]) && $fotos[$i]->isValid()) {
                    if ($fotoPath) {
                        Storage::disk('public')->delete($fotoPath);
                    }
                    $fotoPath = $fotos[$i]->store('docentes_curso', 'public');
                }

                $docentes[] = [
                    'nombre' => $nombre,
                    'especialidad' => $especialidades[$i] ?? '',
                    'rol' => $roles[$i] ?? '',
                    'foto' => $fotoPath ?: null,
                ];
            }
        }

        return ! empty($docentes) ? $docentes : null;
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
