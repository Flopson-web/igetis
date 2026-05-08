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
                    <div class="form-group" style="margin-bottom:1.25rem;">
                        <label class="form-label">Título <span class="required">*</span></label>
                        <input type="text" name="titulo" value="{{ old('titulo') }}"
                               class="form-input {{ $errors->has('titulo') ? 'error' : '' }}"
                               placeholder="Ej: Abordaje Integral de las Coagulopatías" required>
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

            {{-- Evento --}}
            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header">
                    <span class="card-title">Fechas y evento</span>
                </div>
                <div class="card-body">
                    <div class="form-grid-3" style="margin-bottom:1.25rem;">
                        <div class="form-group">
                            <label class="form-label">Tipo de curso</label>
                            <input type="text" name="tipo" value="{{ old('tipo') }}"
                                   class="form-input" placeholder="Ej: Internacional, Nacional">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Fecha inicio</label>
                            <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}"
                                   class="form-input {{ $errors->has('fecha_inicio') ? 'error' : '' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Fecha fin</label>
                            <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}"
                                   class="form-input {{ $errors->has('fecha_fin') ? 'error' : '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Certificación</label>
                        <input type="text" name="certificacion" value="{{ old('certificacion') }}"
                               class="form-input" placeholder="Ej: Certificado con Valor Curricular — 30 horas académicas">
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
                                   class="form-input" placeholder="Ej: 30 horas">
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

            {{-- Docentes del curso --}}
            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header" style="display:flex; align-items:center; justify-content:space-between;">
                    <span class="card-title">Expositores / Docentes del curso</span>
                    <button type="button" onclick="agregarDocente()" class="btn btn-ghost" style="font-size:0.8rem; padding:0.375rem 0.75rem;">
                        + Agregar
                    </button>
                </div>
                <div class="card-body">
                    <div id="docentes-lista" style="display:flex; flex-direction:column; gap:0.875rem;">
                        @if (old('docente_nombre'))
                            @foreach (old('docente_nombre') as $i => $nombre)
                                <div class="docente-fila" style="background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:0.625rem; padding:0.875rem;">
                                    <div style="display:grid; grid-template-columns:56px 1fr 1fr 1fr auto; gap:0.5rem; align-items:start;">
                                        <div>
                                            <label class="form-label" style="font-size:0.72rem;">Foto</label>
                                            <div class="docente-foto-wrap">
                                                <div class="foto-circle" onclick="this.nextElementSibling.click()" style="width:48px;height:48px;border-radius:50%;background:#e2e8f0;cursor:pointer;display:flex;align-items:center;justify-content:center;overflow:hidden;border:2px dashed #cbd5e1;position:relative;" title="Subir foto">
                                                    <svg width="18" height="18" fill="none" stroke="#94a3b8" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                                </div>
                                                <input type="file" name="docente_foto[]" accept="image/jpeg,image/png,image/webp" style="display:none;" onchange="previewDocFoto(this)">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="form-label" style="font-size:0.72rem;">Nombre</label>
                                            <input type="text" name="docente_nombre[]" value="{{ $nombre }}" class="form-input" placeholder="Nombre completo">
                                        </div>
                                        <div>
                                            <label class="form-label" style="font-size:0.72rem;">Especialidad</label>
                                            <input type="text" name="docente_especialidad[]" value="{{ old('docente_especialidad')[$i] ?? '' }}" class="form-input" placeholder="Ej: Especialista en Hemostasia">
                                        </div>
                                        <div>
                                            <label class="form-label" style="font-size:0.72rem;">Rol</label>
                                            <input type="text" name="docente_rol[]" value="{{ old('docente_rol')[$i] ?? '' }}" class="form-input" placeholder="Ej: Expositora principal">
                                        </div>
                                        <div style="padding-top:1.55rem;">
                                            <button type="button" onclick="this.closest('.docente-fila').remove(); checkEmpty('docentes-lista','docentes-empty')" style="background:none; border:none; cursor:pointer; color:#ef4444; padding:0.4rem;">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <p id="docentes-empty" style="font-size:0.8rem; color:#9ca3af; {{ old('docente_nombre') ? 'display:none;' : '' }}">
                        Haz clic en "Agregar" para incluir expositores.
                    </p>
                </div>
            </div>

            {{-- Programa / Agenda --}}
            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header" style="display:flex; align-items:center; justify-content:space-between;">
                    <span class="card-title">Programa / Agenda</span>
                    <button type="button" onclick="agregarAgenda()" class="btn btn-ghost" style="font-size:0.8rem; padding:0.375rem 0.75rem;">
                        + Agregar día
                    </button>
                </div>
                <div class="card-body">
                    <div id="agenda-lista" style="display:flex; flex-direction:column; gap:0.75rem;">
                        @if (old('agenda_titulo'))
                            @foreach (old('agenda_titulo') as $i => $titulo)
                                <div class="agenda-fila" style="display:grid; grid-template-columns:1fr 2fr auto; gap:0.5rem; align-items:start;">
                                    <div>
                                        <label class="form-label" style="font-size:0.75rem;">Título</label>
                                        <input type="text" name="agenda_titulo[]" value="{{ $titulo }}" class="form-input" placeholder="Ej: Día 1">
                                    </div>
                                    <div>
                                        <label class="form-label" style="font-size:0.75rem;">Tema / Descripción</label>
                                        <input type="text" name="agenda_descripcion[]" value="{{ old('agenda_descripcion')[$i] ?? '' }}" class="form-input" placeholder="Ej: Fundamentos y rol del laboratorio">
                                    </div>
                                    <div style="padding-top:1.6rem;">
                                        <button type="button" onclick="this.closest('.agenda-fila').remove()" style="background:none; border:none; cursor:pointer; color:#ef4444; padding:0.4rem;">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <p id="agenda-empty" style="font-size:0.8rem; color:#9ca3af; {{ old('agenda_titulo') ? 'display:none;' : '' }}">
                        Haz clic en "Agregar día" para estructurar el programa.
                    </p>
                </div>
            </div>

            {{-- Precios --}}
            <div class="card" style="margin-bottom:1.25rem;">
                <div class="card-header" style="display:flex; align-items:center; justify-content:space-between;">
                    <span class="card-title">Precios / Inversión</span>
                    <button type="button" onclick="agregarPrecio()" class="btn btn-ghost" style="font-size:0.8rem; padding:0.375rem 0.75rem;">
                        + Agregar precio
                    </button>
                </div>
                <div class="card-body">
                    <div id="precios-lista" style="display:flex; flex-direction:column; gap:0.5rem;">
                        @if (old('precio_tipo'))
                            @foreach (old('precio_tipo') as $i => $tipo)
                                <div class="precio-fila" style="display:grid; grid-template-columns:2fr 1fr auto; gap:0.5rem; align-items:center;">
                                    <input type="text" name="precio_tipo[]" value="{{ $tipo }}" class="form-input" placeholder="Ej: Profesionales Bioquímicos">
                                    <input type="text" name="precio_monto[]" value="{{ old('precio_monto')[$i] ?? '' }}" class="form-input" placeholder="Ej: 150 Bs">
                                    <button type="button" onclick="this.closest('.precio-fila').remove()" style="background:none; border:none; cursor:pointer; color:#ef4444; padding:0.4rem;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <p id="precios-empty" style="font-size:0.8rem; color:#9ca3af; {{ old('precio_tipo') ? 'display:none;' : '' }}">
                        Haz clic en "Agregar precio" para definir tarifas por tipo de participante.
                    </p>
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

<script>
function agregarDocente() {
    const lista = document.getElementById('docentes-lista');
    document.getElementById('docentes-empty').style.display = 'none';
    const fila = document.createElement('div');
    fila.className = 'docente-fila';
    fila.style.cssText = 'background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:0.625rem; padding:0.875rem;';
    fila.innerHTML = `
        <div style="display:grid; grid-template-columns:56px 1fr 1fr 1fr auto; gap:0.5rem; align-items:start;">
            <div>
                <label class="form-label" style="font-size:0.72rem;">Foto</label>
                <div class="docente-foto-wrap">
                    <div class="foto-circle" onclick="this.nextElementSibling.click()" style="width:48px;height:48px;border-radius:50%;background:#e2e8f0;cursor:pointer;display:flex;align-items:center;justify-content:center;overflow:hidden;border:2px dashed #cbd5e1;position:relative;" title="Subir foto">
                        <svg width="18" height="18" fill="none" stroke="#94a3b8" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                    </div>
                    <input type="file" name="docente_foto[]" accept="image/jpeg,image/png,image/webp" style="display:none;" onchange="previewDocFoto(this)">
                </div>
            </div>
            <div>
                <label class="form-label" style="font-size:0.72rem;">Nombre</label>
                <input type="text" name="docente_nombre[]" class="form-input" placeholder="Nombre completo">
            </div>
            <div>
                <label class="form-label" style="font-size:0.72rem;">Especialidad</label>
                <input type="text" name="docente_especialidad[]" class="form-input" placeholder="Ej: Especialista en Hemostasia">
            </div>
            <div>
                <label class="form-label" style="font-size:0.72rem;">Rol</label>
                <input type="text" name="docente_rol[]" class="form-input" placeholder="Ej: Expositora principal">
            </div>
            <div style="padding-top:1.55rem;">
                <button type="button" onclick="this.closest('.docente-fila').remove(); checkEmpty('docentes-lista','docentes-empty')" style="background:none; border:none; cursor:pointer; color:#ef4444; padding:0.4rem;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
        </div>`;
    lista.appendChild(fila);
}

function previewDocFoto(input) {
    if (!input.files || !input.files[0]) return;
    const wrap = input.closest('.docente-foto-wrap');
    const circle = wrap.querySelector('.foto-circle');
    const reader = new FileReader();
    reader.onload = e => {
        let img = circle.querySelector('img');
        if (!img) {
            img = document.createElement('img');
            img.style.cssText = 'width:100%;height:100%;object-fit:cover;border-radius:50%;position:absolute;inset:0;';
            circle.appendChild(img);
        }
        img.src = e.target.result;
        const icon = circle.querySelector('svg');
        if (icon) icon.style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
}

function agregarAgenda() {
    const lista = document.getElementById('agenda-lista');
    document.getElementById('agenda-empty').style.display = 'none';
    const fila = document.createElement('div');
    fila.className = 'agenda-fila';
    fila.style.cssText = 'display:grid; grid-template-columns:1fr 2fr auto; gap:0.5rem; align-items:start;';
    fila.innerHTML = `
        <div>
            <label class="form-label" style="font-size:0.75rem;">Título</label>
            <input type="text" name="agenda_titulo[]" class="form-input" placeholder="Ej: Día 1">
        </div>
        <div>
            <label class="form-label" style="font-size:0.75rem;">Tema / Descripción</label>
            <input type="text" name="agenda_descripcion[]" class="form-input" placeholder="Ej: Fundamentos y rol del laboratorio">
        </div>
        <div style="padding-top:1.6rem;">
            <button type="button" onclick="this.closest('.agenda-fila').remove(); checkEmpty('agenda-lista','agenda-empty')" style="background:none; border:none; cursor:pointer; color:#ef4444; padding:0.4rem;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>`;
    lista.appendChild(fila);
}

function agregarPrecio() {
    const lista = document.getElementById('precios-lista');
    document.getElementById('precios-empty').style.display = 'none';
    const fila = document.createElement('div');
    fila.className = 'precio-fila';
    fila.style.cssText = 'display:grid; grid-template-columns:2fr 1fr auto; gap:0.5rem; align-items:center;';
    fila.innerHTML = `
        <input type="text" name="precio_tipo[]" class="form-input" placeholder="Ej: Profesionales Bioquímicos">
        <input type="text" name="precio_monto[]" class="form-input" placeholder="Ej: 150 Bs">
        <button type="button" onclick="this.closest('.precio-fila').remove(); checkEmpty('precios-lista','precios-empty')" style="background:none; border:none; cursor:pointer; color:#ef4444; padding:0.4rem;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>`;
    lista.appendChild(fila);
}

function checkEmpty(listaId, emptyId) {
    const lista = document.getElementById(listaId);
    if (!lista.children.length) {
        document.getElementById(emptyId).style.display = '';
    }
}
</script>

@endsection
