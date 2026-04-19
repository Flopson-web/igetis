<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::orderBy('orden')->orderBy('nombre')->paginate(20);

        return view('admin.docentes.index', compact('docentes'));
    }

    public function create()
    {
        return view('admin.docentes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'cargo' => ['nullable', 'string', 'max:150'],
            'bio' => ['nullable', 'string', 'max:2000'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'orden' => ['nullable', 'integer', 'min:0'],
            'visible' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('docentes', 'public');
        }

        $data['visible'] = $request->boolean('visible', true);
        $data['orden'] = $data['orden'] ?? 0;

        Docente::create($data);

        return redirect()->route('admin.docentes.index')
            ->with('success', 'Docente creado correctamente.');
    }

    public function edit(Docente $docente)
    {
        return view('admin.docentes.edit', compact('docente'));
    }

    public function update(Request $request, Docente $docente)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'cargo' => ['nullable', 'string', 'max:150'],
            'bio' => ['nullable', 'string', 'max:2000'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'orden' => ['nullable', 'integer', 'min:0'],
            'visible' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('foto')) {
            if ($docente->foto) {
                Storage::disk('public')->delete($docente->foto);
            }
            $data['foto'] = $request->file('foto')->store('docentes', 'public');
        }

        $data['visible'] = $request->boolean('visible');
        $data['orden'] = $data['orden'] ?? 0;

        $docente->update($data);

        return redirect()->route('admin.docentes.index')
            ->with('success', 'Docente actualizado correctamente.');
    }

    public function destroy(Docente $docente)
    {
        if ($docente->foto) {
            Storage::disk('public')->delete($docente->foto);
        }

        $docente->delete();

        return back()->with('success', 'Docente eliminado.');
    }

    public function toggleVisibilidad(Docente $docente)
    {
        $docente->update(['visible' => ! $docente->visible]);

        return back();
    }
}
