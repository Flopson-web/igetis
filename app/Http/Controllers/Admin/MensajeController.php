<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mensaje;
use Illuminate\Http\Request;

class MensajeController extends Controller
{
    public function index(Request $request)
    {
        $query = Mensaje::latest();

        $filtro = $request->input('filtro');

        match ($filtro) {
            'hoy' => $query->whereDate('created_at', today()),
            'semana' => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]),
            'mes' => $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year),
            default => null,
        };

        if ($request->filled('desde')) {
            $query->whereDate('created_at', '>=', $request->input('desde'));
        }

        if ($request->filled('hasta')) {
            $query->whereDate('created_at', '<=', $request->input('hasta'));
        }

        $mensajes = $query->paginate(20)->withQueryString();

        return view('admin.mensajes.index', compact('mensajes', 'filtro'));
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
