@extends('layouts.admin')

@section('titulo', 'Docentes')
@section('subtitulo', 'Equipo docente visible en la página Nosotros')

@section('topbar_action')
    <a href="{{ route('admin.docentes.create') }}" class="topbar-btn topbar-btn-primary">
        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nuevo docente
    </a>
@endsection

@section('contenido')

    <div class="card">
        <div class="card-header">
            <span class="card-title">Todos los docentes</span>
            <span class="badge badge-gray">{{ $docentes->total() }} en total</span>
        </div>
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cargo</th>
                        <th style="text-align:center;">Orden</th>
                        <th style="text-align:center;">Visible</th>
                        <th style="text-align:right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($docentes as $docente)
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center; gap:0.75rem;">
                                    @if ($docente->foto)
                                        <img src="{{ asset('storage/' . $docente->foto) }}" alt="{{ $docente->nombre }}"
                                             style="width:36px; height:36px; border-radius:9999px; object-fit:cover; flex-shrink:0;">
                                    @else
                                        <div style="width:36px; height:36px; border-radius:9999px; background:linear-gradient(135deg,#1E4D8C,#2E6DB4); display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.8rem; color:white; flex-shrink:0;">
                                            {{ strtoupper(substr($docente->nombre, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span style="font-weight:600; color:#0f172a;">{{ $docente->nombre }}</span>
                                </div>
                            </td>
                            <td style="color:#64748b; font-size:0.825rem;">{{ $docente->cargo ?: '—' }}</td>
                            <td style="text-align:center; color:#64748b; font-size:0.825rem;">{{ $docente->orden }}</td>
                            <td style="text-align:center;">
                                <form method="POST" action="{{ route('admin.docentes.visibilidad', $docente) }}" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="badge {{ $docente->visible ? 'badge-green' : 'badge-red' }}" style="border:none; cursor:pointer; font-family:inherit;">
                                        {{ $docente->visible ? 'Sí' : 'No' }}
                                    </button>
                                </form>
                            </td>
                            <td style="text-align:right; white-space:nowrap;">
                                <a href="{{ route('admin.docentes.edit', $docente) }}" class="btn btn-ghost btn-sm">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Editar
                                </a>
                                <form method="POST" action="{{ route('admin.docentes.destroy', $docente) }}" style="display:inline;"
                                      onsubmit="return confirm('¿Eliminar este docente?')">
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
                                No hay docentes registrados.
                                <a href="{{ route('admin.docentes.create') }}" style="color:#1E4D8C; font-weight:600; text-decoration:none;">Agregar el primero →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($docentes->hasPages())
        <div style="margin-top:1.5rem;">{{ $docentes->links() }}</div>
    @endif

@endsection
