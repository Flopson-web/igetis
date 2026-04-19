<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use App\Models\Docente;

class NosotrosController extends Controller
{
    public function index()
    {
        $docentes = Docente::visible()->get();

        $config = [
            'mision' => Configuracion::get('mision', ''),
            'vision' => Configuracion::get('vision', ''),
            'direccion' => Configuracion::get('direccion', ''),
            'telefono' => Configuracion::get('telefono', ''),
            'email' => Configuracion::get('email', ''),
            'facebook' => Configuracion::get('facebook', ''),
            'instagram' => Configuracion::get('instagram', ''),
            'linkedin' => Configuracion::get('linkedin', ''),
            'whatsapp' => preg_replace('/\D/', '', Configuracion::get('whatsapp_numero', '')),
        ];

        return view('nosotros.index', compact('docentes', 'config'));
    }
}
