@extends('layouts.admin')

@section('titulo', 'Editar Docente')
@section('subtitulo', $docente->nombre)

@section('topbar_action')
    <a href="{{ route('admin.docentes.index') }}" class="topbar-btn" style="background:#f1f5f9; color:#475569;">
        ← Volver
    </a>
@endsection

@section('contenido')

    <div style="max-width:680px;">

        @if ($errors->any())
            <div class="alert alert-error">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <div>@foreach ($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.docentes.update', $docente) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header"><span class="card-title">Datos personales</span></div>
                <div class="card-body">
                    <div class="form-grid-2" style="margin-bottom:1.25rem;">
                        <div class="form-group">
                            <label class="form-label">Nombre completo <span class="required">*</span></label>
                            <input type="text" name="nombre" value="{{ old('nombre', $docente->nombre) }}"
                                   class="form-input {{ $errors->has('nombre') ? 'error' : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Cargo / Especialidad</label>
                            <input type="text" name="cargo" value="{{ old('cargo', $docente->cargo) }}"
                                   class="form-input" placeholder="Ej: Especialista en Gestión de Proyectos">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom:1.25rem;">
                        <label class="form-label">Biografía</label>
                        <textarea name="bio" rows="5" class="form-textarea">{{ old('bio', $docente->bio) }}</textarea>
                    </div>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">LinkedIn <span style="font-weight:400; color:#94a3b8;">(URL)</span></label>
                            <input type="url" name="linkedin" value="{{ old('linkedin', $docente->linkedin) }}"
                                   class="form-input" placeholder="https://linkedin.com/in/...">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Orden de aparición</label>
                            <input type="number" name="orden" value="{{ old('orden', $docente->orden) }}"
                                   class="form-input" min="0" max="999">
                            <span class="form-hint">Menor número = aparece primero.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header"><span class="card-title">Foto</span></div>
                <div class="card-body">
                    @if ($docente->foto)
                        <div style="display:flex; align-items:center; gap:1rem; padding:0.875rem; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:0.625rem; margin-bottom:0.875rem;">
                            <img src="{{ Storage::url($docente->foto) }}" alt="{{ $docente->nombre }}"
                                 style="width:64px; height:64px; border-radius:9999px; object-fit:cover; flex-shrink:0;">
                            <div>
                                <div style="font-size:0.8rem; font-weight:600; color:#374151;">Foto actual</div>
                                <div style="font-size:0.72rem; color:#94a3b8;">Sube una nueva para reemplazarla</div>
                            </div>
                        </div>
                    @endif
                    <label for="foto_input" class="file-upload-area">
                        <svg width="28" height="28" style="margin:0 auto 0.625rem; display:block; color:#94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        <p id="foto_nombre" style="font-size:0.825rem; color:#64748b; font-weight:500;">Haz clic para {{ $docente->foto ? 'cambiar' : 'seleccionar' }} foto</p>
                        <p style="font-size:0.72rem; color:#94a3b8; margin-top:0.25rem;">JPG, PNG, WebP · Máx. 2 MB</p>
                    </label>
                    <input id="foto_input" type="file" name="foto" accept="image/jpeg,image/png,image/webp" style="display:none;"
                           onchange="document.getElementById('foto_nombre').textContent = this.files[0] ? '✓ ' + this.files[0].name : 'Haz clic para cambiar foto'">
                </div>
            </div>

            <div class="card">
                <div class="card-body" style="display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap;">
                    <label class="toggle-switch" style="flex:1; min-width:220px;">
                        <input type="hidden" name="visible" value="0">
                        <input type="checkbox" name="visible" value="1" {{ old('visible', $docente->visible) ? 'checked' : '' }}>
                        <div>
                            <div style="font-size:0.875rem; font-weight:600; color:#0f172a;">Visible en el sitio</div>
                            <div style="font-size:0.75rem; color:#64748b;">Aparece en la página Nosotros</div>
                        </div>
                    </label>
                    <div style="display:flex; gap:0.75rem; flex-shrink:0;">
                        <a href="{{ route('admin.docentes.index') }}" class="btn btn-ghost btn-lg">Cancelar</a>
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
