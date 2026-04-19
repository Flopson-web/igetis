@extends('layouts.admin')

@section('titulo', 'Categorías')
@section('subtitulo', 'Gestión de categorías de cursos')

@section('contenido')

    <div style="display:grid; grid-template-columns:1fr 340px; gap:1.5rem; align-items:start;">

        {{-- Tabla --}}
        <div class="card">
            <div class="card-header">
                <span class="card-title">Todas las categorías</span>
                <span class="badge badge-gray">{{ $categorias->count() }} en total</span>
            </div>
            <div style="overflow-x:auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Slug</th>
                            <th style="text-align:center;">Cursos</th>
                            <th style="text-align:right;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categorias as $categoria)
                            <tr>
                                <td style="font-weight:600; color:#0f172a;">{{ $categoria->nombre }}</td>
                                <td>
                                    <code style="font-size:0.78rem; color:#64748b; background:#f1f5f9; padding:0.2rem 0.5rem; border-radius:0.25rem;">{{ $categoria->slug }}</code>
                                </td>
                                <td style="text-align:center;">
                                    <span class="badge badge-blue">{{ $categoria->cursos_count }}</span>
                                </td>
                                <td style="text-align:right;">
                                    <form method="POST" action="{{ route('admin.categorias.destroy', $categoria) }}"
                                          style="display:inline;"
                                          onsubmit="return confirm('¿Eliminar esta categoría? Se desvinculará de los cursos asociados.')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 6l-1 14H6L5 6m5 0V4h4v2"/></svg>
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding:3rem; text-align:center; color:#94a3b8;">
                                    No hay categorías. Crea la primera usando el formulario.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Formulario nueva categoría --}}
        <div class="card">
            <div class="card-header">
                <span class="card-title">Nueva categoría</span>
            </div>
            <div class="card-body">
                @error('nombre')
                    <div class="alert alert-error" style="margin-bottom:1rem;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $message }}
                    </div>
                @enderror

                <form method="POST" action="{{ route('admin.categorias.store') }}">
                    @csrf
                    <div class="form-group" style="margin-bottom:1.25rem;">
                        <label class="form-label">Nombre <span class="required">*</span></label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}"
                               class="form-input {{ $errors->has('nombre') ? 'error' : '' }}"
                               placeholder="Ej: Seguridad Industrial" required>
                        <span class="form-hint">El slug se genera automáticamente.</span>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Crear categoría
                    </button>
                </form>
            </div>
        </div>

    </div>

@endsection
