<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        // Honeypot: bots llenan campos ocultos, humanos no
        if ($request->filled('_website_url')) {
            return redirect()->route('contacto.index')
                ->with('success', 'Tu mensaje ha sido enviado. Te responderemos pronto.');
        }

        $request->validate([
            'nombre' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[\p{L}\s\'\-\.]+$/u'],
            'email' => ['required', 'email:rfc,dns', 'max:150'],
            'telefono' => ['nullable', 'string', 'regex:/^\+?[\d\s\-\(\)]{7,20}$/', 'max:20'],
            'mensaje' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 2 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Introduce un correo electrónico válido.',
            'telefono.regex' => 'El teléfono no tiene un formato válido (ej: +591 70000000).',
            'mensaje.required' => 'El mensaje es obligatorio.',
            'mensaje.min' => 'El mensaje debe tener al menos 10 caracteres.',
            'mensaje.max' => 'El mensaje no puede superar los 2000 caracteres.',
        ]);

        // Verificación reCAPTCHA v3 (solo si las claves están configuradas en .env)
        if (config('services.recaptcha.secret_key') && $request->filled('recaptcha_token')) {
            $result = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $request->recaptcha_token,
                'remoteip' => $request->ip(),
            ])->json();

            if (! ($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
                return back()
                    ->withInput()
                    ->withErrors(['mensaje' => 'No pudimos verificar tu solicitud. Por favor intenta de nuevo.']);
            }
        }

        Mensaje::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'mensaje' => $request->mensaje,
        ]);

        return redirect()->route('contacto.index')
            ->with('success', 'Tu mensaje ha sido enviado. Te responderemos pronto.');
    }
}
