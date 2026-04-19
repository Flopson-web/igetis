<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mensaje;

class MensajeController extends Controller
{
    public function index()
    {
        $mensajes = Mensaje::latest()->paginate(20);

        return view('admin.mensajes.index', compact('mensajes'));
    }

    public function marcarLeido(Mensaje $mensaje)
    {
        $mensaje->update(['leido' => ! $mensaje->leido]);

        return back();
    }

    public function destroy(Mensaje $mensaje)
    {
        $mensaje->delete();

        return back()->with('success', 'Mensaje eliminado.');
    }
}
