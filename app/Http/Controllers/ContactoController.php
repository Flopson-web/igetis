<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use App\Models\Mensaje;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index()
    {
        $config = [
            'telefono' => Configuracion::get('telefono', ''),
            'email' => Configuracion::get('email', ''),
            'horario' => Configuracion::get('horario', 'Lunes a viernes, 9:00 – 18:00'),
        ];

        return view('contacto.index', compact('config'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'mensaje' => ['required', 'string', 'max:2000'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Introduce un correo válido.',
            'mensaje.required' => 'El mensaje es obligatorio.',
        ]);

        Mensaje::create($validated);

        return redirect()->route('contacto.index')
            ->with('success', 'Tu mensaje ha sido enviado. Te responderemos pronto.');
    }
}
