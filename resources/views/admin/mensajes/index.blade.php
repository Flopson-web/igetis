@extends('layouts.admin')

@section('titulo', 'Mensajes')
@section('subtitulo', 'Consultas recibidas desde el formulario de contacto')

@section('contenido')

    @php $noLeidos = $mensajes->where('leido', false)->count(); @endphp

    @if ($noLeidos > 0)
        <div class="alert" style="background:#eff6ff; border-color:#bfdbfe; color:#1d4ed8; margin-bottom:1.5rem;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Tienes <strong>{{ $noLeidos }}</strong> {{ $noLeidos === 1 ? 'mensaje sin leer' : 'mensajes sin leer' }}.
        </div>
    @endif

    <div style="display:flex; flex-direction:column; gap:1rem;">
        @forelse ($mensajes as $mensaje)
            <div class="card" style="border-left: 4px solid {{ $mensaje->leido ? '#e2e8f0' : '#1E4D8C' }};">
                <div class="card-body">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:1rem; flex-wrap:wrap; margin-bottom:1rem;">

                        {{-- Remitente --}}
                        <div style="display:flex; align-items:flex-start; gap:0.875rem;">
                            <div style="width:40px; height:40px; border-radius:9999px; background:linear-gradient(135deg,#1E4D8C,#2E6DB4); display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.9rem; color:white; flex-shrink:0;">
                                {{ strtoupper(substr($mensaje->nombre, 0, 1)) }}
                            </div>
                            <div>
                                <div style="display:flex; align-items:center; gap:0.5rem; flex-wrap:wrap;">
                                    <span style="font-weight:700; color:#0f172a; font-size:0.925rem;">{{ $mensaje->nombre }}</span>
                                    @if (! $mensaje->leido)
                                        <span class="badge badge-blue">Nuevo</span>
                                    @endif
                                </div>
                                <div style="font-size:0.8rem; color:#64748b; margin-top:0.2rem;">
                                    <a href="mailto:{{ $mensaje->email }}" style="color:#1E4D8C; text-decoration:none;">{{ $mensaje->email }}</a>
                                    @if ($mensaje->telefono)
                                        <span style="color:#cbd5e1; margin:0 0.25rem;">·</span>{{ $mensaje->telefono }}
                                    @endif
                                </div>
                                <div style="font-size:0.72rem; color:#94a3b8; margin-top:0.2rem;">
                                    {{ $mensaje->created_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>

                        {{-- Acciones --}}
                        <div style="display:flex; gap:0.625rem; align-items:center; flex-shrink:0;">
                            <form method="POST" action="{{ route('admin.mensajes.leido', $mensaje) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-ghost btn-sm">
                                    @if ($mensaje->leido)
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        Marcar no leído
                                    @else
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        Marcar leído
                                    @endif
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.mensajes.destroy', $mensaje) }}"
                                  onsubmit="return confirm('¿Eliminar este mensaje?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 6l-1 14H6L5 6m5 0V4h4v2"/></svg>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Mensaje --}}
                    <div style="padding:1rem; background:#f8fafc; border-radius:0.625rem; border:1px solid #f1f5f9;">
                        <p style="color:#374151; font-size:0.875rem; line-height:1.7; white-space:pre-line; margin:0;">{{ $mensaje->mensaje }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-body" style="padding:3rem; text-align:center;">
                    <div style="width:56px; height:56px; background:#f1f5f9; border-radius:9999px; display:flex; align-items:center; justify-content:center; margin:0 auto 1rem;">
                        <svg width="24" height="24" fill="none" stroke="#94a3b8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <p style="color:#94a3b8; font-size:0.875rem;">No hay mensajes recibidos todavía.</p>
                </div>
            </div>
        @endforelse
    </div>

    @if ($mensajes->hasPages())
        <div style="margin-top:1.5rem;">{{ $mensajes->links() }}</div>
    @endif

@endsection
