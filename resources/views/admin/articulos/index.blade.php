@extends('layouts.admin')

@section('titulo', 'Blog')
@section('subtitulo', 'Gestión de artículos del blog')

@section('contenido')

    <div style="display:flex; justify-content:flex-end; margin-bottom:1.5rem;">
        <a href="{{ route('admin.articulos.create') }}"
           style="background:#1E4D8C; color:white; padding:0.625rem 1.25rem; border-radius:0.5rem; font-size:0.875rem; text-decoration:none; font-weight:600;">
            + Nuevo artículo
        </a>
    </div>

    <div style="background:white; border-radius:0.75rem; box-shadow:0 1px 3px rgba(0,0,0,.1); overflow:hidden;">
        <table style="width:100%; border-collapse:collapse; font-size:0.875rem;">
            <thead>
                <tr style="background:#f9fafb; border-bottom:1px solid #e5e7eb;">
                    <th style="padding:0.875rem 1rem; text-align:left; font-weight:600; color:#374151;">Título</th>
                    <th style="padding:0.875rem 1rem; text-align:left; font-weight:600; color:#374151;">Autor</th>
                    <th style="padding:0.875rem 1rem; text-align:left; font-weight:600; color:#374151;">Publicado</th>
                    <th style="padding:0.875rem 1rem; text-align:right; font-weight:600; color:#374151;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articulos as $articulo)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:0.875rem 1rem; color:#1f2937; font-weight:500;">
                            {{ $articulo->titulo }}
                        </td>
                        <td style="padding:0.875rem 1rem; color:#6b7280;">
                            {{ $articulo->autor }}
                        </td>
                        <td style="padding:0.875rem 1rem; color:#6b7280;">
                            {{ $articulo->publicado_en?->format('d/m/Y') ?? '—' }}
                        </td>
                        <td style="padding:0.875rem 1rem; text-align:right; white-space:nowrap;">
                            <a href="{{ route('admin.articulos.edit', $articulo) }}"
                               style="color:#1E4D8C; font-weight:600; text-decoration:none; margin-right:1rem;">
                                Editar
                            </a>
                            <form method="POST" action="{{ route('admin.articulos.destroy', $articulo) }}"
                                  style="display:inline;"
                                  onsubmit="return confirm('¿Eliminar este artículo?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="color:#dc2626; font-weight:600; background:none; border:none; cursor:pointer; font-size:0.875rem;">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding:2rem; text-align:center; color:#6b7280;">
                            No hay artículos registrados.
                            <a href="{{ route('admin.articulos.create') }}" style="color:#1E4D8C; font-weight:600;">Crear el primero</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($articulos->hasPages())
        <div style="margin-top:1.5rem;">
            {{ $articulos->links() }}
        </div>
    @endif

@endsection
