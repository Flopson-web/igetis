@extends('layouts.admin')

@section('titulo', 'Blog')
@section('subtitulo', 'Gestión de artículos del blog')

@section('topbar_action')
    <a href="{{ route('admin.articulos.create') }}" class="topbar-btn topbar-btn-primary">
        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nuevo artículo
    </a>
@endsection

@section('contenido')

    <div class="card">
        <div class="card-header">
            <span class="card-title">Todos los artículos</span>
            <span class="badge badge-gray">{{ $articulos->total() }} en total</span>
        </div>
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Estado</th>
                        <th>Publicado</th>
                        <th style="text-align:right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($articulos as $articulo)
                        <tr>
                            <td style="font-weight:600; color:#0f172a; max-width:320px;">{{ $articulo->titulo }}</td>
                            <td style="color:#64748b; font-size:0.825rem;">{{ $articulo->autor ?: '—' }}</td>
                            <td>
                                @if ($articulo->publicado_en)
                                    <span class="badge badge-green">Publicado</span>
                                @else
                                    <span class="badge badge-yellow">Borrador</span>
                                @endif
                            </td>
                            <td style="color:#64748b; font-size:0.825rem;">
                                {{ $articulo->publicado_en?->format('d/m/Y') ?? '—' }}
                            </td>
                            <td style="text-align:right; white-space:nowrap;">
                                <a href="{{ route('admin.articulos.edit', $articulo) }}" class="btn btn-ghost btn-sm">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Editar
                                </a>
                                <form method="POST" action="{{ route('admin.articulos.destroy', $articulo) }}"
                                      style="display:inline;" onsubmit="return confirm('¿Eliminar este artículo?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 6l-1 14H6L5 6m5 0V4h4v2"/></svg>
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding:3rem; text-align:center; color:#94a3b8;">
                                No hay artículos registrados.
                                <a href="{{ route('admin.articulos.create') }}" style="color:#1E4D8C; font-weight:600; text-decoration:none;">Crear el primero →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($articulos->hasPages())
        <div style="margin-top:1.5rem;">{{ $articulos->links() }}</div>
    @endif

@endsection
