@extends('layouts.admin')

@section('titulo', 'Editar Curso')
@section('subtitulo', $curso->titulo)

@section('topbar_action')
    <a href="{{ route('admin.cursos.index') }}" class="topbar-btn" style="background:#f1f5f9; color:#475569;">
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

        <form method="POST" action="{{ route('admin.cursos.update', $curso) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Información principal --}}
            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header">
                    <span class="card-title">Información principal</span>
                </div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom:1.25rem;">
                        <label class="form-label">Título <span class="required">*</span></label>
                        <input type="text" name="titulo" value="{{ old('titulo', $curso->titulo) }}"
                               class="form-input {{ $errors->has('titulo') ? 'error' : '' }}" required>
                    </div>
                    <div class="form-group" style="margin-bottom:1.25rem;">
                        <label class="form-label">Descripción <span class="required">*</span></label>
                        <textarea name="descripcion" rows="5"
                                  class="form-textarea {{ $errors->has('descripcion') ? 'error' : '' }}"
                                  required>{{ old('descripcion', $curso->descripcion) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Objetivos</label>
                        <textarea name="objetivos" rows="4" class="form-textarea">{{ old('objetivos', $curso->objetivos) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Detalles --}}
            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header">
                    <span class="card-title">Detalles del curso</span>
                </div>
                <div class="card-body">
                    <div class="form-grid-3" style="margin-bottom:1.25rem;">
                        <div class="form-group">
                            <label class="form-label">Dirigido a</label>
                            <input type="text" name="dirigido_a" value="{{ old('dirigido_a', $curso->dirigido_a) }}"
                                   class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Duración</label>
                            <input type="text" name="duracion" value="{{ old('duracion', $curso->duracion) }}"
                                   class="form-input" placeholder="Ej: 40 horas">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Modalidad</label>
                            <select name="modalidad" class="form-select">
                                <option value="">Seleccionar...</option>
                                @foreach (['Presencial', 'Virtual', 'Híbrida'] as $opcion)
                                    <option value="{{ $opcion }}" {{ old('modalidad', $curso->modalidad) === $opcion ? 'selected' : '' }}>{{ $opcion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">URL de video <span style="font-weight:400; color:#94a3b8;">(YouTube / Vimeo)</span></label>
                        <input type="url" name="video_url" value="{{ old('video_url', $curso->video_url) }}"
                               class="form-input" placeholder="https://www.youtube.com/watch?v=...">
                    </div>
                </div>
            </div>

            {{-- Imagen y categorías --}}
            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header">
                    <span class="card-title">Imagen y categorías</span>
                </div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom:1.5rem;">
                        <label class="form-label">Imagen de portada</label>
                        @if ($curso->imagen)
                            <div style="margin-bottom:0.875rem; display:flex; align-items:center; gap:1rem; padding:0.875rem; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:0.625rem;">
                                <img src="{{ Storage::url($curso->imagen) }}" alt="Imagen actual"
                                     style="height:64px; width:96px; border-radius:0.375rem; object-fit:cover;">
                                <div>
                                    <div style="font-size:0.8rem; font-weight:600; color:#374151;">Imagen actual</div>
                                    <div style="font-size:0.72rem; color:#94a3b8;">Sube una nueva para reemplazarla</div>
                                </div>
                            </div>
                        @endif
                        <label for="imagen_input" class="file-upload-area">
                            <svg width="28" height="28" style="margin:0 auto 0.625rem; display:block; color:#94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            <p id="imagen_nombre" style="font-size:0.825rem; color:#64748b; font-weight:500;">Haz clic para {{ $curso->imagen ? 'cambiar' : 'seleccionar' }} imagen</p>
                            <p style="font-size:0.72rem; color:#94a3b8; margin-top:0.25rem;">JPG, PNG, WebP o GIF · Máx. 2 MB</p>
                        </label>
                        <input id="imagen_input" type="file" name="imagen" accept="image/jpeg,image/png,image/webp,image/gif" style="display:none;"
                               onchange="document.getElementById('imagen_nombre').textContent = this.files[0] ? '✓ ' + this.files[0].name : 'Haz clic para cambiar imagen'">
                    </div>

                    @if ($categorias->count())
                        <div class="form-group">
                            <label class="form-label">Categorías</label>
                            <div style="display:flex; flex-wrap:wrap; gap:0.625rem; margin-top:0.25rem;">
                                @foreach ($categorias as $categoria)
                                    <label style="display:flex; align-items:center; gap:0.375rem; font-size:0.825rem; color:#374151; cursor:pointer; padding:0.375rem 0.75rem; border:1.5px solid #e2e8f0; border-radius:0.5rem; transition:all 0.15s;">
                                        <input type="checkbox" name="categorias[]" value="{{ $categoria->id }}"
                                               {{ in_array($categoria->id, old('categorias', $curso->categorias->pluck('id')->toArray())) ? 'checked' : '' }}
                                               style="accent-color:#1E4D8C;">
                                        {{ $categoria->nombre }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Visibilidad y guardar --}}
            <div class="card">
                <div class="card-body" style="display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap;">
                    <label class="toggle-switch" style="flex:1; min-width:250px;">
                        <input type="hidden" name="visible" value="0">
                        <input type="checkbox" name="visible" value="1"
                               {{ old('visible', $curso->visible) ? 'checked' : '' }}>
                        <div>
                            <div style="font-size:0.875rem; font-weight:600; color:#0f172a;">Publicar curso</div>
                            <div style="font-size:0.75rem; color:#64748b;">Visible en el sitio web para todos los visitantes</div>
                        </div>
                    </label>
                    <div style="display:flex; gap:0.75rem; flex-shrink:0;">
                        <a href="{{ route('admin.cursos.index') }}" class="btn btn-ghost btn-lg">Cancelar</a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Guardar cambios
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>

@endsection
