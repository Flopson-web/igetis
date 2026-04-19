@extends('layouts.admin')

@section('titulo', 'Dashboard')
@section('subtitulo', 'Resumen general del sitio')

@section('contenido')

    {{-- Stat cards --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px,1fr)); gap:1.25rem; margin-bottom:2rem;">

        <a href="{{ route('admin.cursos.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#dbeafe;">
                <svg fill="none" stroke="#1d4ed8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div class="stat-number">{{ \App\Models\Curso::count() }}</div>
            <div class="stat-label">Cursos publicados</div>
        </a>

        <a href="{{ route('admin.articulos.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#dcfce7;">
                <svg fill="none" stroke="#15803d" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </div>
            <div class="stat-number">{{ \App\Models\Articulo::count() }}</div>
            <div class="stat-label">Artículos en blog</div>
        </a>

        <a href="{{ route('admin.categorias.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#fef9c3;">
                <svg fill="none" stroke="#92400e" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
            <div class="stat-number">{{ \App\Models\Categoria::count() }}</div>
            <div class="stat-label">Categorías</div>
        </a>

        <a href="{{ route('admin.mensajes.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#fee2e2;">
                <svg fill="none" stroke="#dc2626" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div class="stat-number">{{ \App\Models\Mensaje::where('leido', false)->count() }}</div>
            <div class="stat-label">Mensajes sin leer</div>
        </a>

        <a href="{{ route('admin.docentes.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#f3e8ff;">
                <svg fill="none" stroke="#7c3aed" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div class="stat-number">{{ \App\Models\Docente::count() }}</div>
            <div class="stat-label">Docentes activos</div>
        </a>

    </div>

    {{-- Quick links --}}
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem;">

        <div class="card">
            <div class="card-header">
                <span class="card-title">Acciones rápidas</span>
            </div>
            <div class="card-body" style="display:flex; flex-direction:column; gap:0.625rem;">
                <a href="{{ route('admin.cursos.create') }}" class="btn btn-primary" style="justify-content:center;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Nuevo curso
                </a>
                <a href="{{ route('admin.articulos.create') }}" class="btn btn-ghost" style="justify-content:center;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Nuevo artículo
                </a>
                <a href="{{ route('admin.mensajes.index') }}" class="btn btn-ghost" style="justify-content:center;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Ver mensajes
                </a>
                <a href="{{ route('home') }}" target="_blank" class="btn btn-outline" style="justify-content:center;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Ver sitio web
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <span class="card-title">Estado del sitio</span>
            </div>
            <div class="card-body">
                @php
                    $cursosVisibles = \App\Models\Curso::where('visible', true)->count();
                    $articulosPublicados = \App\Models\Articulo::whereNotNull('publicado_en')->count();
                    $mensajesTotal = \App\Models\Mensaje::count();
                    $mensajesNoLeidos = \App\Models\Mensaje::where('leido', false)->count();
                @endphp
                <div style="display:flex; flex-direction:column; gap:0.875rem;">
                    <div style="display:flex; justify-content:space-between; align-items:center; padding-bottom:0.875rem; border-bottom:1px solid #f1f5f9;">
                        <span style="font-size:0.825rem; color:#64748b;">Cursos visibles</span>
                        <span class="badge badge-green">{{ $cursosVisibles }}</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center; padding-bottom:0.875rem; border-bottom:1px solid #f1f5f9;">
                        <span style="font-size:0.825rem; color:#64748b;">Artículos publicados</span>
                        <span class="badge badge-blue">{{ $articulosPublicados }}</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center; padding-bottom:0.875rem; border-bottom:1px solid #f1f5f9;">
                        <span style="font-size:0.825rem; color:#64748b;">Mensajes sin leer</span>
                        <span class="badge {{ $mensajesNoLeidos > 0 ? 'badge-red' : 'badge-gray' }}">{{ $mensajesNoLeidos }}</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <span style="font-size:0.825rem; color:#64748b;">Total mensajes</span>
                        <span class="badge badge-gray">{{ $mensajesTotal }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
