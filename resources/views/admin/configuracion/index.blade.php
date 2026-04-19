@extends('layouts.admin')

@section('titulo', 'Configuración')
@section('subtitulo', 'Datos generales del sitio web')

@section('contenido')

    <div style="max-width:700px;">

        <form method="POST" action="{{ route('admin.configuracion.update') }}"
              style="background:white; border-radius:0.75rem; padding:2rem; box-shadow:0 1px 3px rgba(0,0,0,.1);">
            @csrf

            @if ($errors->any())
                <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:0.5rem; padding:0.75rem 1rem; margin-bottom:1.5rem; font-size:0.875rem; color:#dc2626;">
                    <ul style="margin:0; padding-left:1.25rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Información general --}}
            <h3 style="font-size:0.875rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 1.25rem;">
                Información general
            </h3>

            @foreach ($campos as $clave => $campo)

                @if ($clave === 'facebook')
                    <hr style="border:none; border-top:1px solid #f3f4f6; margin:1.5rem 0;">
                    <h3 style="font-size:0.875rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 1.25rem;">
                        Redes sociales
                    </h3>
                @endif

                <div style="margin-bottom:1.25rem;">
                    <label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.375rem;">
                        {{ $campo['label'] }}
                    </label>

                    @if ($campo['type'] === 'textarea')
                        <textarea name="{{ $clave }}" rows="3"
                                  style="width:100%; padding:0.625rem 0.875rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.875rem; outline:none; resize:vertical; font-family:inherit;">{{ old($clave, $valores[$clave] ?? '') }}</textarea>
                    @else
                        <input type="{{ $campo['type'] }}" name="{{ $clave }}"
                               value="{{ old($clave, $valores[$clave] ?? '') }}"
                               style="width:100%; padding:0.625rem 0.875rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.875rem; outline:none;">
                    @endif

                    @error($clave)
                        <p style="color:#dc2626; font-size:0.75rem; margin:0.25rem 0 0;">{{ $message }}</p>
                    @enderror
                </div>

            @endforeach

            <div style="margin-top:2rem; padding-top:1.5rem; border-top:1px solid #f3f4f6;">
                <button type="submit"
                        style="background:#1E4D8C; color:white; padding:0.625rem 1.5rem; border-radius:0.5rem; font-size:0.875rem; font-weight:600; border:none; cursor:pointer;">
                    Guardar configuración
                </button>
            </div>

        </form>

    </div>

@endsection
