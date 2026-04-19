@extends('layouts.admin')

@section('titulo', 'Configuración')
@section('subtitulo', 'Datos generales del sitio web')

@section('contenido')

    <div style="max-width:720px;">

        <form method="POST" action="{{ route('admin.configuracion.update') }}">
            @csrf

            @if ($errors->any())
                <div class="alert alert-error">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <div>@foreach ($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
                </div>
            @endif

            @php
                $sociales = ['facebook', 'instagram', 'linkedin'];
                $institucionales = ['mision', 'vision'];
            @endphp

            {{-- Información de contacto --}}
            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header"><span class="card-title">Información de contacto</span></div>
                <div class="card-body">
                    @foreach ($campos as $clave => $campo)
                        @if (in_array($clave, $sociales) || in_array($clave, $institucionales)) @continue @endif
                        <div class="form-group" style="margin-bottom:1.125rem;">
                            <label class="form-label">{{ $campo['label'] }}</label>
                            @if ($campo['type'] === 'textarea')
                                <textarea name="{{ $clave }}" rows="3"
                                          class="form-textarea {{ $errors->has($clave) ? 'error' : '' }}">{{ old($clave, $valores[$clave] ?? '') }}</textarea>
                            @else
                                <input type="{{ $campo['type'] }}" name="{{ $clave }}"
                                       value="{{ old($clave, $valores[$clave] ?? '') }}"
                                       class="form-input {{ $errors->has($clave) ? 'error' : '' }}">
                            @endif
                            @error($clave)<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Misión y Visión --}}
            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header"><span class="card-title">Misión y Visión</span></div>
                <div class="card-body">
                    @foreach ($campos as $clave => $campo)
                        @if (!in_array($clave, $institucionales)) @continue @endif
                        <div class="form-group" style="margin-bottom:1.125rem;">
                            <label class="form-label">{{ $campo['label'] }}</label>
                            <textarea name="{{ $clave }}" rows="4"
                                      class="form-textarea {{ $errors->has($clave) ? 'error' : '' }}"
                                      placeholder="Describe la {{ strtolower($campo['label']) }} de IGETIS...">{{ old($clave, $valores[$clave] ?? '') }}</textarea>
                            @error($clave)<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Redes sociales --}}
            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header"><span class="card-title">Redes sociales</span></div>
                <div class="card-body">
                    @foreach ($campos as $clave => $campo)
                        @if (!in_array($clave, $sociales)) @continue @endif
                        <div class="form-group" style="margin-bottom:1.125rem;">
                            <label class="form-label">{{ $campo['label'] }}</label>
                            <input type="{{ $campo['type'] }}" name="{{ $clave }}"
                                   value="{{ old($clave, $valores[$clave] ?? '') }}"
                                   class="form-input {{ $errors->has($clave) ? 'error' : '' }}"
                                   placeholder="https://...">
                            @error($clave)<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Guardar --}}
            <div class="card">
                <div class="card-body" style="display:flex; justify-content:flex-end;">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Guardar configuración
                    </button>
                </div>
            </div>

        </form>
    </div>

@endsection
