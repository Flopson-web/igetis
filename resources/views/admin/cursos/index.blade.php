@extends('layouts.admin')

@section('titulo', 'Cursos')
@section('subtitulo', 'Gestión de cursos del sitio')

@section('contenido')

    <div style="display:flex; justify-content:flex-end; margin-bottom:1.5rem;">
        <a href="{{ route('admin.cursos.create') }}"
           style="background:#1E4D8C; color:white; padding:0.625rem 1.25rem; border-radius:0.5rem; font-size:0.875rem; text-decoration:none; font-weight:600;">
            + Nuevo curso
        </a>
    </div>

    <div style="background:white; border-radius:0.75rem; box-shadow:0 1px 3px rgba(0,0,0,.1); overflow:hidden;">
        <table style="width:100%; border-collapse:collapse; font-size:0.875rem;">
            <thead>
                <tr style="background:#f9fafb; border-bottom:1px solid #e5e7eb;">
                    <th style="padding:0.875rem 1rem; text-align:left; font-weight:600; color:#374151;">Título</th>
                    <th style="padding:0.875rem 1rem; text-align:left; font-weight:600; color:#374151;">Categorías</th>
                    <th style="padding:0.875rem 1rem; text-align:left; font-weight:600; color:#374151;">Modalidad</th>
                    <th style="padding:0.875rem 1rem; text-align:left; font-weight:600; color:#374151;">Duración</th>
                    <th style="padding:0.875rem 1rem; text-align:center; font-weight:600; color:#374151;">Visible</th>
                    <th style="padding:0.875rem 1rem; text-align:right; font-weight:600; color:#374151;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cursos as $curso)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:0.875rem 1rem; color:#1f2937; font-weight:500;">
                            {{ $curso->titulo }}
                        </td>
                        <td style="padding:0.875rem 1rem; color:#6b7280;">
                            {{ $curso->categorias->pluck('nombre')->join(', ') ?: '—' }}
                        </td>
                        <td style="padding:0.875rem 1rem; color:#6b7280;">
                            {{ $curso->modalidad ?: '—' }}
                        </td>
                        <td style="padding:0.875rem 1rem; color:#6b7280;">
                            {{ $curso->duracion ?: '—' }}
                        </td>
                        <td style="padding:0.875rem 1rem; text-align:center;">
                            <form method="POST" action="{{ route('admin.cursos.visibilidad', $curso) }}" style="display:inline;">
                                @csrf @method('PATCH')
                                <button type="submit"
                                        style="padding:0.25rem 0.75rem; border-radius:9999px; font-size:0.75rem; font-weight:600; border:none; cursor:pointer;
                                               background:{{ $curso->visible ? '#dcfce7' : '#fee2e2' }};
                                               color:{{ $curso->visible ? '#15803d' : '#dc2626' }};">
                                    {{ $curso->visible ? 'Sí' : 'No' }}
                                </button>
                            </form>
                        </td>
                        <td style="padding:0.875rem 1rem; text-align:right; white-space:nowrap;">
                            <a href="{{ route('admin.cursos.edit', $curso) }}"
                               style="color:#1E4D8C; font-weight:600; text-decoration:none; margin-right:1rem;">
                                Editar
                            </a>
                            <form method="POST" action="{{ route('admin.cursos.destroy', $curso) }}" style="display:inline;"
                                  onsubmit="return confirm('¿Eliminar este curso?')">
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
                        <td colspan="6" style="padding:2rem; text-align:center; color:#6b7280;">
                            No hay cursos registrados.
                            <a href="{{ route('admin.cursos.create') }}" style="color:#1E4D8C; font-weight:600;">Crear el primero</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($cursos->hasPages())
        <div style="margin-top:1.5rem;">
            {{ $cursos->links() }}
        </div>
    @endif

@endsection
