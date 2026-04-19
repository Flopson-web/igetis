@extends('layouts.admin')

@section('titulo', 'Nuevo Curso')
@section('subtitulo', 'Completa los datos del nuevo curso')

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

        <form method="POST" action="{{ route('admin.cursos.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Información principal --}}
            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header">
                    <span class="card-title">Información principal</span>
                </div>
                <div class="card-body">
                    <div class="form-section">
                        <div class="form-group" style="margin-bottom:1.25rem;">
                            <label class="form-label">Título <span class="required">*</span></label>
                            <input type="text" name="titulo" value="{{ old('titulo') }}"
                                   class="form-input {{ $errors->has('titulo') ? 'error' : '' }}"
                                   placeholder="Ej: Gestión de Proyectos con Metodologías Ágiles" required>
                        </div>
                        <div class="form-group" style="margin-bottom:1.25rem;">
                            <label class="form-label">Descripción <span class="required">*</span></label>
                            <textarea name="descripcion" rows="5"
                                      class="form-textarea {{ $errors->has('descripcion') ? 'error' : '' }}"
                                      placeholder="Descripción general del curso..." required>{{ old('descripcion') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Objetivos</label>
                            <textarea name="objetivos" rows="4" class="form-textarea"
                                      placeholder="¿Qué aprenderán los participantes?">{{ old('objetivos') }}</textarea>
                        </div>
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
                            <input type="text" name="dirigido_a" value="{{ old('dirigido_a') }}"
                                   class="form-input" placeholder="Ej: Profesionales del área">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Duración</label>
                            <input type="text" name="duracion" value="{{ old('duracion') }}"
                                   class="form-input" placeholder="Ej: 40 horas">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Modalidad</label>
                            <select name="modalidad" class="form-select">
                                <option value="">Seleccionar...</option>
                                @foreach (['Presencial', 'Virtual', 'Híbrida'] as $opcion)
                                    <option value="{{ $opcion }}" {{ old('modalidad') === $opcion ? 'selected' : '' }}>{{ $opcion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">URL de video <span style="font-weight:400; color:#94a3b8;">(YouTube / Vimeo)</span></label>
                        <input type="url" name="video_url" value="{{ old('video_url') }}"
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
                        <label for="imagen_input" class="file-upload-area">
                            <svg width="32" height="32" style="margin:0 auto 0.75rem; display:block; color:#94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p id="imagen_nombre" style="font-size:0.825rem; color:#64748b; font-weight:500;">Haz clic para seleccionar imagen</p>
                            <p style="font-size:0.72rem; color:#94a3b8; margin-top:0.25rem;">JPG, PNG, WebP o GIF · Máx. 2 MB</p>
                        </label>
                        <input id="imagen_input" type="file" name="imagen" accept="image/jpeg,image/png,image/webp,image/gif" style="display:none;"
                               onchange="document.getElementById('imagen_nombre').textContent = this.files[0] ? '✓ ' + this.files[0].name : 'Haz clic para seleccionar imagen'">
                    </div>

                    @if ($categorias->count())
                        <div class="form-group">
                            <label class="form-label">Categorías</label>
                            <div style="display:flex; flex-wrap:wrap; gap:0.625rem; margin-top:0.25rem;">
                                @foreach ($categorias as $categoria)
                                    <label style="display:flex; align-items:center; gap:0.375rem; font-size:0.825rem; color:#374151; cursor:pointer; padding:0.375rem 0.75rem; border:1.5px solid #e2e8f0; border-radius:0.5rem; transition:all 0.15s;"
                                           onmouseover="this.style.borderColor='#1E4D8C'"
                                           onmouseout="if(!this.querySelector('input').checked) this.style.borderColor='#e2e8f0'">
                                        <input type="checkbox" name="categorias[]" value="{{ $categoria->id }}"
                                               {{ in_array($categoria->id, old('categorias', [])) ? 'checked' : '' }}
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
                        <input type="checkbox" name="visible" value="1" {{ old('visible', true) ? 'checked' : '' }}>
                        <div>
                            <div style="font-size:0.875rem; font-weight:600; color:#0f172a;">Publicar curso</div>
                            <div style="font-size:0.75rem; color:#64748b;">Visible en el sitio web para todos los visitantes</div>
                        </div>
                    </label>
                    <div style="display:flex; gap:0.75rem; flex-shrink:0;">
                        <a href="{{ route('admin.cursos.index') }}" class="btn btn-ghost btn-lg">Cancelar</a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Guardar curso
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>

@endsection
