<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuracion;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    /** Campos gestionables con etiqueta y tipo de input. */
    private const CAMPOS = [
        'nombre_sitio' => ['label' => 'Nombre del sitio',        'type' => 'text'],
        'email_contacto' => ['label' => 'Email de contacto',        'type' => 'email'],
        'telefono' => ['label' => 'Teléfono',                 'type' => 'text'],
        'direccion' => ['label' => 'Dirección',                'type' => 'text'],
        'descripcion_sitio' => ['label' => 'Descripción del sitio',    'type' => 'textarea'],
        'facebook' => ['label' => 'Facebook (URL)',            'type' => 'url'],
        'instagram' => ['label' => 'Instagram (URL)',           'type' => 'url'],
        'linkedin' => ['label' => 'LinkedIn (URL)',            'type' => 'url'],
    ];

    public function index()
    {
        $valores = Configuracion::whereIn('clave', array_keys(self::CAMPOS))
            ->pluck('valor', 'clave');

        $campos = self::CAMPOS;

        return view('admin.configuracion.index', compact('valores', 'campos'));
    }

    public function update(Request $request)
    {
        $rules = collect(self::CAMPOS)->mapWithKeys(fn ($campo, $clave) => [
            $clave => $campo['type'] === 'email' ? ['nullable', 'email', 'max:255']
                : ($campo['type'] === 'url' ? ['nullable', 'url', 'max:255']
                : ['nullable', 'string', 'max:500']),
        ])->all();

        $data = $request->validate($rules);

        foreach ($data as $clave => $valor) {
            Configuracion::updateOrCreate(
                ['clave' => $clave],
                ['valor' => $valor ?? '']
            );
        }

        return back()->with('success', 'Configuración guardada correctamente.');
    }
}
