@extends('layouts.admin')

@section('titulo', 'Nuevo Artículo')
@section('subtitulo', 'Redacta un nuevo artículo para el blog')

@section('contenido')

    <div style="max-width:800px;">

        <div style="margin-bottom:1.5rem;">
            <a href="{{ route('admin.articulos.index') }}"
               style="color:#1E4D8C; font-size:0.875rem; text-decoration:none; font-weight:500;">
                ← Volver al blog
            </a>
        </div>

        <form method="POST" action="{{ route('admin.articulos.store') }}" enctype="multipart/form-data"
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

            {{-- Título --}}
            <div style="margin-bottom:1.25rem;">
                <label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.375rem;">
                    Título <span style="color:#dc2626;">*</span>
                </label>
                <input type="text" name="titulo" value="{{ old('titulo') }}"
                       style="width:100%; padding:0.625rem 0.875rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.875rem; outline:none;"
                       required>
            </div>

            {{-- Fila: Autor / Fecha --}}
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1.25rem;">
                <div>
                    <label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.375rem;">
                        Autor <span style="color:#dc2626;">*</span>
                    </label>
                    <input type="text" name="autor" value="{{ old('autor') }}"
                           style="width:100%; padding:0.625rem 0.875rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.875rem; outline:none;"
                           required>
                </div>
                <div>
                    <label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.375rem;">
                        Fecha de publicación
                    </label>
                    <input type="date" name="publicado_en" value="{{ old('publicado_en', now()->format('Y-m-d')) }}"
                           style="width:100%; padding:0.625rem 0.875rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.875rem; outline:none;">
                    <p style="font-size:0.75rem; color:#9ca3af; margin:0.25rem 0 0;">Si se deja vacío se usa la fecha actual.</p>
                </div>
            </div>

            {{-- Imagen --}}
            <div style="margin-bottom:1.25rem;">
                <label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.375rem;">
                    Imagen de portada
                </label>
                <input type="file" name="imagen" accept="image/*" style="font-size:0.875rem; color:#374151;">
                <p style="font-size:0.75rem; color:#9ca3af; margin:0.25rem 0 0;">JPG, PNG o WebP. Máx. 2 MB.</p>
            </div>

            {{-- Cuerpo --}}
            <div style="margin-bottom:2rem;">
                <label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.375rem;">
                    Contenido <span style="color:#dc2626;">*</span>
                </label>
                <textarea name="cuerpo" rows="14"
                          style="width:100%; padding:0.625rem 0.875rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.875rem; outline:none; resize:vertical; font-family:inherit;"
                          required>{{ old('cuerpo') }}</textarea>
            </div>

            {{-- Botones --}}
            <div style="display:flex; gap:0.75rem;">
                <button type="submit"
                        style="background:#1E4D8C; color:white; padding:0.625rem 1.5rem; border-radius:0.5rem; font-size:0.875rem; font-weight:600; border:none; cursor:pointer;">
                    Publicar artículo
                </button>
                <a href="{{ route('admin.articulos.index') }}"
                   style="background:#f3f4f6; color:#374151; padding:0.625rem 1.5rem; border-radius:0.5rem; font-size:0.875rem; font-weight:600; text-decoration:none;">
                    Cancelar
                </a>
            </div>

        </form>

    </div>

@endsection
