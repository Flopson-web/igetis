@extends('layouts.admin')

@section('titulo', 'Nuevo Curso')
@section('subtitulo', 'Completa los datos del nuevo curso')

@section('contenido')

    <div style="max-width:800px;">

        <div style="margin-bottom:1.5rem;">
            <a href="{{ route('admin.cursos.index') }}"
               style="color:#1E4D8C; font-size:0.875rem; text-decoration:none; font-weight:500;">
                ← Volver a cursos
            </a>
        </div>

        <form method="POST" action="{{ route('admin.cursos.store') }}" enctype="multipart/form-data"
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

            {{-- Descripción --}}
            <div style="margin-bottom:1.25rem;">
                <label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.375rem;">
                    Descripción <span style="color:#dc2626;">*</span>
                </label>
                <textarea name="descripcion" rows="5"
                          style="width:100%; padding:0.625rem 0.875rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.875rem; outline:none; resize:vertical;"
                          required>{{ old('descripcion') }}</textarea>
            </div>

            {{-- Objetivos --}}
            <div style="margin-bottom:1.25rem;">
                <label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.375rem;">
                    Objetivos
                </label>
                <textarea name="objetivos" rows="4"
                          style="width:100%; padding:0.625rem 0.875rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.875rem; outline:none; resize:vertical;">{{ old('objetivos') }}</textarea>
            </div>

            {{-- Fila: Dirigido a / Duración / Modalidad --}}
            <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:1rem; margin-bottom:1.25rem;">
                <div>
                    <label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.375rem;">
                        Dirigido a
                    </label>
                    <input type="text" name="dirigido_a" value="{{ old('dirigido_a') }}"
                           style="width:100%; padding:0.625rem 0.875rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.875rem; outline:none;">
                </div>
                <div>
                    <label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.375rem;">
                        Duración
                    </label>
                    <input type="text" name="duracion" value="{{ old('duracion') }}" placeholder="Ej: 40 horas"
                           style="width:100%; padding:0.625rem 0.875rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.875rem; outline:none;">
                </div>
                <div>
                    <label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.375rem;">
                        Modalidad
                    </label>
                    <select name="modalidad"
                            style="width:100%; padding:0.625rem 0.875rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.875rem; outline:none; background:white;">
                        <option value="">Seleccionar...</option>
                        <option value="Presencial"  {{ old('modalidad') === 'Presencial'  ? 'selected' : '' }}>Presencial</option>
                        <option value="Virtual"     {{ old('modalidad') === 'Virtual'     ? 'selected' : '' }}>Virtual</option>
                        <option value="Híbrida"     {{ old('modalidad') === 'Híbrida'     ? 'selected' : '' }}>Híbrida</option>
                    </select>
                </div>
            </div>

            {{-- URL de video --}}
            <div style="margin-bottom:1.25rem;">
                <label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.375rem;">
                    URL de video (YouTube / Vimeo)
                </label>
                <input type="url" name="video_url" value="{{ old('video_url') }}"
                       style="width:100%; padding:0.625rem 0.875rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.875rem; outline:none;">
            </div>

            {{-- Imagen --}}
            <div style="margin-bottom:1.25rem;">
                <label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.5rem;">
                    Imagen de portada
                </label>
                <label for="imagen_input"
                       style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.5rem 1rem; background:#f3f4f6; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.875rem; font-weight:600; color:#374151; cursor:pointer;">
                    <svg style="width:1rem;height:1rem;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    Cargar imagen
                </label>
                <input id="imagen_input" type="file" name="imagen"
                       accept="image/jpeg,image/png,image/webp,image/gif"
                       style="display:none;"
                       onchange="document.getElementById('imagen_nombre').textContent = this.files[0] ? this.files[0].name : 'Ninguna imagen seleccionada'">
                <p id="imagen_nombre" style="font-size:0.8rem; color:#6b7280; margin:0.4rem 0 0;">Ninguna imagen seleccionada</p>
                <p style="font-size:0.75rem; color:#9ca3af; margin:0.15rem 0 0;">JPG, PNG, WebP o GIF · Máx. 2 MB</p>
            </div>

            {{-- Categorías --}}
            @if ($categorias->count())
                <div style="margin-bottom:1.25rem;">
                    <label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.5rem;">
                        Categorías
                    </label>
                    <div style="display:flex; flex-wrap:wrap; gap:0.5rem;">
                        @foreach ($categorias as $categoria)
                            <label style="display:flex; align-items:center; gap:0.375rem; font-size:0.875rem; color:#374151; cursor:pointer;">
                                <input type="checkbox" name="categorias[]" value="{{ $categoria->id }}"
                                       {{ in_array($categoria->id, old('categorias', [])) ? 'checked' : '' }}>
                                {{ $categoria->nombre }}
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Visible --}}
            <div style="margin-bottom:2rem;">
                <label style="display:flex; align-items:center; gap:0.5rem; font-size:0.875rem; color:#374151; cursor:pointer;">
                    <input type="hidden" name="visible" value="0">
                    <input type="checkbox" name="visible" value="1" {{ old('visible', true) ? 'checked' : '' }}>
                    <span style="font-weight:600;">Publicar curso (visible en el sitio)</span>
                </label>
            </div>

            {{-- Botones --}}
            <div style="display:flex; gap:0.75rem;">
                <button type="submit"
                        style="background:#1E4D8C; color:white; padding:0.625rem 1.5rem; border-radius:0.5rem; font-size:0.875rem; font-weight:600; border:none; cursor:pointer;">
                    Guardar curso
                </button>
                <a href="{{ route('admin.cursos.index') }}"
                   style="background:#f3f4f6; color:#374151; padding:0.625rem 1.5rem; border-radius:0.5rem; font-size:0.875rem; font-weight:600; text-decoration:none;">
                    Cancelar
                </a>
            </div>

        </form>

    </div>

@endsection
