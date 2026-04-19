@extends('layouts.admin')

@section('titulo', 'Editar Artículo')
@section('subtitulo', $articulo->titulo)

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

        <form method="POST" action="{{ route('admin.articulos.update', $articulo) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Cabecera --}}
            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header">
                    <span class="card-title">Información del artículo</span>
                </div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom:1.25rem;">
                        <label class="form-label">Título <span class="required">*</span></label>
                        <input type="text" name="titulo" value="{{ old('titulo', $articulo->titulo) }}"
                               class="form-input {{ $errors->has('titulo') ? 'error' : '' }}" required>
                    </div>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Autor <span class="required">*</span></label>
                            <input type="text" name="autor" value="{{ old('autor', $articulo->autor) }}"
                                   class="form-input {{ $errors->has('autor') ? 'error' : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Fecha de publicación</label>
                            <input type="date" name="publicado_en"
                                   value="{{ old('publicado_en', $articulo->publicado_en?->format('Y-m-d')) }}"
                                   class="form-input">
                            <span class="form-hint">Vacío = guardar como borrador.</span>
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
                    @if ($articulo->imagen)
                        <div style="margin-bottom:0.875rem; display:flex; align-items:center; gap:1rem; padding:0.875rem; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:0.625rem;">
                            <img src="{{ Storage::url($articulo->imagen) }}" alt="Imagen actual"
                                 style="height:64px; width:96px; border-radius:0.375rem; object-fit:cover;">
                            <div>
                                <div style="font-size:0.8rem; font-weight:600; color:#374151;">Imagen actual</div>
                                <div style="font-size:0.72rem; color:#94a3b8;">Sube una nueva para reemplazarla</div>
                            </div>
                        </div>
                    @endif
                    <label for="imagen_input" class="file-upload-area">
                        <svg width="28" height="28" style="margin:0 auto 0.625rem; display:block; color:#94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        <p id="imagen_nombre" style="font-size:0.825rem; color:#64748b; font-weight:500;">Haz clic para {{ $articulo->imagen ? 'cambiar' : 'seleccionar' }} imagen</p>
                        <p style="font-size:0.72rem; color:#94a3b8; margin-top:0.25rem;">JPG, PNG, WebP o GIF · Máx. 2 MB</p>
                    </label>
                    <input id="imagen_input" type="file" name="imagen" accept="image/jpeg,image/png,image/webp,image/gif" style="display:none;"
                           onchange="document.getElementById('imagen_nombre').textContent = this.files[0] ? '✓ ' + this.files[0].name : 'Haz clic para cambiar imagen'">
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
                        <textarea name="cuerpo" rows="16"
                                  class="form-textarea {{ $errors->has('cuerpo') ? 'error' : '' }}"
                                  required>{{ old('cuerpo', $articulo->cuerpo) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Guardar --}}
            <div class="card">
                <div class="card-body" style="display:flex; justify-content:flex-end; gap:0.75rem;">
                    <a href="{{ route('admin.articulos.index') }}" class="btn btn-ghost btn-lg">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Guardar cambios
                    </button>
                </div>
            </div>

        </form>
    </div>

@endsection
