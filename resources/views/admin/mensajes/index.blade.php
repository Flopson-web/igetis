@extends('layouts.admin')

@section('titulo', 'Mensajes')
@section('subtitulo', 'Consultas recibidas desde el formulario de contacto')

@section('contenido')

    @php $noLeidos = $mensajes->where('leido', false)->count(); @endphp

    @if ($noLeidos > 0)
        <div style="background:#eff6ff; border:1px solid #bfdbfe; border-radius:0.5rem; padding:0.75rem 1rem; margin-bottom:1.5rem; font-size:0.875rem; color:#1d4ed8;">
            Tienes <strong>{{ $noLeidos }}</strong> {{ $noLeidos === 1 ? 'mensaje sin leer' : 'mensajes sin leer' }}.
        </div>
    @endif

    <div style="display:flex; flex-direction:column; gap:1rem;">
        @forelse ($mensajes as $mensaje)
            <div style="background:white; border-radius:0.75rem; padding:1.5rem; box-shadow:0 1px 3px rgba(0,0,0,.1);
                        border-left:4px solid {{ $mensaje->leido ? '#e5e7eb' : '#1E4D8C' }};">

                <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:1rem; flex-wrap:wrap;">

                    {{-- Info del remitente --}}
                    <div>
                        <p style="font-weight:700; color:#1f2937; margin:0; font-size:0.95rem;">
                            {{ $mensaje->nombre }}
                            @if (! $mensaje->leido)
                                <span style="background:#dbeafe; color:#1d4ed8; font-size:0.7rem; font-weight:600; padding:0.15rem 0.5rem; border-radius:9999px; margin-left:0.5rem;">
                                    Nuevo
                                </span>
                            @endif
                        </p>
                        <p style="color:#6b7280; font-size:0.8rem; margin:0.2rem 0 0;">
                            <a href="mailto:{{ $mensaje->email }}" style="color:#1E4D8C; text-decoration:none;">{{ $mensaje->email }}</a>
                            @if ($mensaje->telefono)
                                · {{ $mensaje->telefono }}
                            @endif
                        </p>
                        <p style="color:#9ca3af; font-size:0.75rem; margin:0.2rem 0 0;">
                            {{ $mensaje->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    {{-- Acciones --}}
                    <div style="display:flex; gap:0.75rem; align-items:center; flex-shrink:0;">
                        <form method="POST" action="{{ route('admin.mensajes.leido', $mensaje) }}">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    style="font-size:0.8rem; font-weight:600; padding:0.375rem 0.875rem; border-radius:0.375rem; border:1px solid #d1d5db; background:white; cursor:pointer; color:#374151;">
                                {{ $mensaje->leido ? 'Marcar no leído' : 'Marcar leído' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.mensajes.destroy', $mensaje) }}"
                              onsubmit="return confirm('¿Eliminar este mensaje?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    style="font-size:0.8rem; font-weight:600; padding:0.375rem 0.875rem; border-radius:0.375rem; border:none; background:#fee2e2; cursor:pointer; color:#dc2626;">
                                Eliminar
                            </button>
                        </form>
                    </div>

                </div>

                {{-- Cuerpo del mensaje --}}
                <div style="margin-top:1rem; padding-top:1rem; border-top:1px solid #f3f4f6;">
                    <p style="color:#374151; font-size:0.875rem; margin:0; white-space:pre-line;">{{ $mensaje->mensaje }}</p>
                </div>

            </div>
        @empty
            <div style="background:white; border-radius:0.75rem; padding:3rem; text-align:center; box-shadow:0 1px 3px rgba(0,0,0,.1);">
                <p style="color:#6b7280; font-size:0.875rem; margin:0;">No hay mensajes recibidos todavía.</p>
            </div>
        @endforelse
    </div>

    @if ($mensajes->hasPages())
        <div style="margin-top:1.5rem;">
            {{ $mensajes->links() }}
        </div>
    @endif

@endsection
