@extends('layouts.admin')

@section('titulo', 'Dashboard')
@section('subtitulo', 'Bienvenido al panel de gestión de IGETIS')

@section('contenido')

    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap:1.5rem; margin-bottom:2rem;">

        <a href="{{ route('admin.cursos.index') }}"
           style="background:white; border-radius:0.75rem; padding:1.5rem; box-shadow:0 1px 3px rgba(0,0,0,.1); text-decoration:none; display:block; transition:box-shadow .2s;"
           onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,.15)'"
           onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,.1)'">
            <div style="color:#1E4D8C; margin-bottom:0.75rem;">
                <svg style="width:2rem;height:2rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <p style="font-size:1.5rem; font-weight:700; color:#1f2937; margin:0;">{{ \App\Models\Curso::count() }}</p>
            <p style="font-size:0.875rem; color:#6b7280; margin:0.25rem 0 0;">Cursos</p>
        </a>

        <a href="{{ route('admin.articulos.index') }}"
           style="background:white; border-radius:0.75rem; padding:1.5rem; box-shadow:0 1px 3px rgba(0,0,0,.1); text-decoration:none; display:block; transition:box-shadow .2s;"
           onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,.15)'"
           onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,.1)'">
            <div style="color:#1E4D8C; margin-bottom:0.75rem;">
                <svg style="width:2rem;height:2rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
            <p style="font-size:1.5rem; font-weight:700; color:#1f2937; margin:0;">{{ \App\Models\Articulo::count() }}</p>
            <p style="font-size:0.875rem; color:#6b7280; margin:0.25rem 0 0;">Artículos</p>
        </a>

        <a href="{{ route('admin.categorias.index') }}"
           style="background:white; border-radius:0.75rem; padding:1.5rem; box-shadow:0 1px 3px rgba(0,0,0,.1); text-decoration:none; display:block; transition:box-shadow .2s;"
           onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,.15)'"
           onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,.1)'">
            <div style="color:#1E4D8C; margin-bottom:0.75rem;">
                <svg style="width:2rem;height:2rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <p style="font-size:1.5rem; font-weight:700; color:#1f2937; margin:0;">{{ \App\Models\Categoria::count() }}</p>
            <p style="font-size:0.875rem; color:#6b7280; margin:0.25rem 0 0;">Categorías</p>
        </a>

        <a href="{{ route('admin.mensajes.index') }}"
           style="background:white; border-radius:0.75rem; padding:1.5rem; box-shadow:0 1px 3px rgba(0,0,0,.1); text-decoration:none; display:block; transition:box-shadow .2s;"
           onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,.15)'"
           onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,.1)'">
            <div style="color:#1E4D8C; margin-bottom:0.75rem;">
                <svg style="width:2rem;height:2rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <p style="font-size:1.5rem; font-weight:700; color:#1f2937; margin:0;">{{ \App\Models\Mensaje::count() }}</p>
            <p style="font-size:0.875rem; color:#6b7280; margin:0.25rem 0 0;">Mensajes</p>
        </a>

    </div>

@endsection
