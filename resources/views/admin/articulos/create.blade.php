@extends('layouts.admin')

@section('titulo', 'Nuevo Artículo')
@section('subtitulo', 'Redacta un nuevo artículo para el blog')

@section('topbar_action')
    <a href="{{ route('admin.articulos.index') }}" class="topbar-btn" style="background:#f1f5f9; color:#475569;">
        ← Volver
    </a>
@endsection

@section('contenido')

    <div style="max-width:860px;">

        @if ($errors->any())
            <div class="alert alert-error">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.articulos.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Cabecera --}}
            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header">
                    <span class="card-title">Información del artículo</span>
                </div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom:1.25rem;">
                        <label class="form-label">Título <span class="required">*</span></label>
                        <input type="text" name="titulo" value="{{ old('titulo') }}"
                               class="form-input {{ $errors->has('titulo') ? 'error' : '' }}"
                               placeholder="Escribe un título atractivo..." required>
                    </div>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Autor <span class="required">*</span></label>
                            <input type="text" name="autor" value="{{ old('autor') }}"
                                   class="form-input {{ $errors->has('autor') ? 'error' : '' }}"
                                   placeholder="Nombre del autor" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Fecha de publicación</label>
                            <input type="date" name="publicado_en"
                                   value="{{ old('publicado_en', now()->format('Y-m-d')) }}"
                                   class="form-input">
                            <span class="form-hint">Si se deja vacío se usa la fecha actual.</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Imagen --}}
            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header">
                    <span class="card-title">Imagen de portada</span>
                </div>
                <div class="card-body">
                    <label for="imagen_input" class="file-upload-area">
                        <svg width="32" height="32" style="margin:0 auto 0.75rem; display:block; color:#94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p id="imagen_nombre" style="font-size:0.825rem; color:#64748b; font-weight:500;">Haz clic para seleccionar imagen</p>
                        <p style="font-size:0.72rem; color:#94a3b8; margin-top:0.25rem;">JPG, PNG, WebP o GIF · Máx. 2 MB</p>
                    </label>
                    <input id="imagen_input" type="file" name="imagen" accept="image/jpeg,image/png,image/webp,image/gif" style="display:none;"
                           onchange="document.getElementById('imagen_nombre').textContent = this.files[0] ? '✓ ' + this.files[0].name : 'Haz clic para seleccionar imagen'">
                </div>
            </div>

            {{-- Contenido --}}
            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header">
                    <span class="card-title">Contenido</span>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Cuerpo del artículo <span class="required">*</span></label>
                        <textarea name="cuerpo" rows="16" class="form-textarea {{ $errors->has('cuerpo') ? 'error' : '' }}"
                                  placeholder="Escribe el contenido del artículo aquí..." required>{{ old('cuerpo') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Guardar --}}
            <div class="card">
                <div class="card-body" style="display:flex; justify-content:flex-end; gap:0.75rem;">
                    <a href="{{ route('admin.articulos.index') }}" class="btn btn-ghost btn-lg">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Publicar artículo
                    </button>
                </div>
            </div>

        </form>
    </div>

@endsection
