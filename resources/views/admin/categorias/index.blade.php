@extends('layouts.admin')

@section('titulo', 'Categorías')
@section('subtitulo', 'Gestión de categorías de cursos')

@section('contenido')

    <div style="display:grid; grid-template-columns:1fr 360px; gap:2rem; align-items:start;">

        {{-- Tabla de categorías --}}
        <div style="background:white; border-radius:0.75rem; box-shadow:0 1px 3px rgba(0,0,0,.1); overflow:hidden;">
            <table style="width:100%; border-collapse:collapse; font-size:0.875rem;">
                <thead>
                    <tr style="background:#f9fafb; border-bottom:1px solid #e5e7eb;">
                        <th style="padding:0.875rem 1rem; text-align:left; font-weight:600; color:#374151;">Nombre</th>
                        <th style="padding:0.875rem 1rem; text-align:left; font-weight:600; color:#374151;">Slug</th>
                        <th style="padding:0.875rem 1rem; text-align:center; font-weight:600; color:#374151;">Cursos</th>
                        <th style="padding:0.875rem 1rem; text-align:right; font-weight:600; color:#374151;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categorias as $categoria)
                        <tr style="border-bottom:1px solid #f3f4f6;">
                            <td style="padding:0.875rem 1rem; color:#1f2937; font-weight:500;">
                                {{ $categoria->nombre }}
                            </td>
                            <td style="padding:0.875rem 1rem; color:#6b7280; font-family:monospace; font-size:0.8rem;">
                                {{ $categoria->slug }}
                            </td>
                            <td style="padding:0.875rem 1rem; text-align:center; color:#6b7280;">
                                {{ $categoria->cursos_count }}
                            </td>
                            <td style="padding:0.875rem 1rem; text-align:right;">
                                <form method="POST" action="{{ route('admin.categorias.destroy', $categoria) }}"
                                      style="display:inline;"
                                      onsubmit="return confirm('¿Eliminar esta categoría? Se desvinculará de los cursos asociados.')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            style="color:#dc2626; font-weight:600; background:none; border:none; cursor:pointer; font-size:0.875rem;">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding:2rem; text-align:center; color:#6b7280;">
                                No hay categorías registradas. Crea la primera usando el formulario.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Formulario nueva categoría --}}
        <div style="background:white; border-radius:0.75rem; padding:1.5rem; box-shadow:0 1px 3px rgba(0,0,0,.1);">
            <h3 style="font-size:1rem; font-weight:700; color:#1f2937; margin:0 0 1.25rem;">Nueva categoría</h3>

            <form method="POST" action="{{ route('admin.categorias.store') }}">
                @csrf

                @error('nombre')
                    <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:0.5rem; padding:0.625rem 0.875rem; margin-bottom:1rem; font-size:0.875rem; color:#dc2626;">
                        {{ $message }}
                    </div>
                @enderror

                <div style="margin-bottom:1rem;">
                    <label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.375rem;">
                        Nombre <span style="color:#dc2626;">*</span>
                    </label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}"
                           placeholder="Ej: Seguridad Industrial"
                           style="width:100%; padding:0.625rem 0.875rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.875rem; outline:none;"
                           required>
                    <p style="font-size:0.75rem; color:#9ca3af; margin:0.25rem 0 0;">
                        El slug se genera automáticamente.
                    </p>
                </div>

                <button type="submit"
                        style="width:100%; background:#1E4D8C; color:white; padding:0.625rem 1rem; border-radius:0.5rem; font-size:0.875rem; font-weight:600; border:none; cursor:pointer;">
                    Crear categoría
                </button>
            </form>
        </div>

    </div>

@endsection
