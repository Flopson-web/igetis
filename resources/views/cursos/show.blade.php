@extends('layouts.public')

@section('titulo', $curso->titulo)
@section('descripcion', Str::limit($curso->descripcion, 160))

@php
    $waMensaje = 'Hola, me interesa el curso: ' . $curso->titulo . '. ¿Me pueden dar más información?';
    $waNumeroConfig = preg_replace('/\D/', '', \App\Models\Configuracion::get('whatsapp_numero', ''));
@endphp
@section('whatsapp_url', $waNumeroConfig ? 'https://wa.me/' . $waNumeroConfig . '?text=' . rawurlencode($waMensaje) : '#')
@section('whatsapp_label', '¿Te interesa? ¡Contáctanos!')

@section('contenido')

<style>
    .curso-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1E4D8C 100%);
        padding: 4rem 1.5rem 3rem;
        position: relative; overflow: hidden;
    }
    .curso-hero-pattern {
        position: absolute; inset: 0; opacity: 0.05;
        background-image: radial-gradient(circle, white 1px, transparent 1px);
        background-size: 30px 30px;
    }
    .curso-hero-content { position: relative; z-index: 1; }

    .info-pill {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-size: 0.8rem; font-weight: 600;
        padding: 0.35rem 0.85rem; border-radius: 9999px;
    }
    .info-pill-blue { background: rgba(255,255,255,.15); color: white; }
    .info-pill-orange { background: #F97316; color: white; }

    .detail-box {
        background: white; border-radius: 1rem;
        padding: 1.5rem; box-shadow: 0 1px 4px rgba(0,0,0,.08);
        margin-bottom: 1.25rem;
    }
    .detail-box h2 {
        font-size: 1rem; font-weight: 700; color: #1E4D8C;
        margin: 0 0 1rem; padding-bottom: 0.625rem;
        border-bottom: 2px solid #eff6ff;
    }

    .agenda-item {
        display: flex; gap: 1rem; padding: 0.875rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .agenda-item:last-child { border-bottom: none; padding-bottom: 0; }
    .agenda-num {
        width: 36px; height: 36px; border-radius: 50%; flex-shrink: 0;
        background: linear-gradient(135deg, #1E4D8C, #2E6DB4);
        color: white; font-weight: 800; font-size: 0.8rem;
        display: flex; align-items: center; justify-content: center;
    }

    .docente-item {
        display: flex; align-items: flex-start; gap: 0.875rem;
        padding: 0.75rem 0; border-bottom: 1px solid #f1f5f9;
    }
    .docente-item:last-child { border-bottom: none; padding-bottom: 0; }
    .docente-avatar {
        width: 44px; height: 44px; border-radius: 50%; flex-shrink: 0;
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; font-weight: 800; color: #1E4D8C;
    }

    .precio-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 0.625rem 0; border-bottom: 1px solid #f1f5f9;
    }
    .precio-row:last-child { border-bottom: none; }
    .precio-monto {
        font-size: 1rem; font-weight: 800; color: #1E4D8C;
    }

    .sidebar-card {
        background: white; border-radius: 1rem;
        padding: 1.5rem; box-shadow: 0 4px 20px rgba(0,0,0,.1);
        border-top: 4px solid #1E4D8C;
        position: sticky; top: 6rem;
    }
    .meta-row {
        display: flex; align-items: center; gap: 0.75rem;
        padding: 0.75rem 0; border-bottom: 1px solid #f3f4f6;
    }
    .meta-row:last-of-type { border-bottom: none; }
    .meta-icon {
        width: 36px; height: 36px; border-radius: 0.5rem; flex-shrink: 0;
        background: #eff6ff; display: flex; align-items: center; justify-content: center;
    }
</style>

{{-- Breadcrumb --}}
<div style="background:white; border-bottom:1px solid #e5e7eb; padding:0.75rem 1.25rem;">
    <div class="container" style="font-size:0.8rem; color:#6b7280;">
        <a href="{{ route('home') }}" style="color:#1E4D8C; text-decoration:none;">Inicio</a>
        <span style="margin:0 0.5rem;">›</span>
        <a href="{{ route('cursos.index') }}" style="color:#1E4D8C; text-decoration:none;">Cursos</a>
        <span style="margin:0 0.5rem;">›</span>
        <span>{{ Str::limit($curso->titulo, 50) }}</span>
    </div>
</div>

{{-- Hero del curso --}}
<div class="curso-hero">
    <div class="curso-hero-pattern"></div>
    <div class="container curso-hero-content">
        <div style="display:flex; flex-wrap:wrap; gap:0.5rem; margin-bottom:1.25rem;">
            @if ($curso->tipo)
                <span class="info-pill info-pill-orange">{{ $curso->tipo }}</span>
            @endif
            @foreach ($curso->categorias as $cat)
                <span class="info-pill info-pill-blue">{{ $cat->nombre }}</span>
            @endforeach
            @if ($curso->modalidad)
                <span class="info-pill info-pill-blue">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    {{ $curso->modalidad }}
                </span>
            @endif
        </div>

        <h1 style="font-size:clamp(1.5rem,4vw,2.25rem); font-weight:900; color:white; margin:0 0 1rem; line-height:1.2; max-width:700px;">
            {{ $curso->titulo }}
        </h1>

        @if ($curso->fecha_inicio)
            <div style="display:flex; align-items:center; gap:0.5rem; color:rgba(255,255,255,.8); font-size:0.9rem; font-weight:600;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                @if ($curso->fecha_fin && !$curso->fecha_inicio->equalTo($curso->fecha_fin))
                    {{ $curso->fecha_inicio->translatedFormat('d') }} al {{ $curso->fecha_fin->translatedFormat('d \d\e F \d\e Y') }}
                @else
                    {{ $curso->fecha_inicio->translatedFormat('d \d\e F \d\e Y') }}
                @endif
            </div>
        @endif
    </div>
</div>

<section class="section" style="background:#f8fafc;">
    <div class="container">
        <div class="layout-sidebar">

            {{-- Contenido principal --}}
            <div class="layout-sidebar-main">

                {{-- Imagen --}}
                @if ($curso->imagen)
                    <img src="{{ asset('storage/' . $curso->imagen) }}"
                         alt="{{ $curso->titulo }}"
                         style="width:100%; max-height:380px; object-fit:cover; border-radius:1rem; margin-bottom:1.25rem; box-shadow:0 4px 16px rgba(0,0,0,.1);">
                @endif

                {{-- Video --}}
                @if ($curso->video_url)
                    <div style="position:relative; padding-bottom:56.25%; height:0; margin-bottom:1.25rem; border-radius:1rem; overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,.1);">
                        <iframe src="{{ $curso->video_url }}"
                                style="position:absolute; top:0; left:0; width:100%; height:100%; border:none;"
                                allowfullscreen></iframe>
                    </div>
                @endif

                {{-- Descripcion --}}
                <div class="detail-box">
                    <h2>Descripcion</h2>
                    <div style="color:#374151; line-height:1.8; font-size:0.95rem;">
                        {!! nl2br(e($curso->descripcion)) !!}
                    </div>
                </div>

                {{-- Objetivos --}}
                @if ($curso->objetivos)
                    <div class="detail-box">
                        <h2>Objetivos del curso</h2>
                        <div style="color:#374151; line-height:1.8; font-size:0.95rem;">
                            {!! nl2br(e($curso->objetivos)) !!}
                        </div>
                    </div>
                @endif

                {{-- Agenda --}}
                @if ($curso->agenda && count($curso->agenda))
                    <div class="detail-box">
                        <h2>Programa</h2>
                        @foreach ($curso->agenda as $i => $item)
                            <div class="agenda-item">
                                <div class="agenda-num">{{ $i + 1 }}</div>
                                <div>
                                    <div style="font-weight:700; font-size:0.9rem; color:#111827; margin-bottom:0.2rem;">{{ $item['titulo'] }}</div>
                                    @if (!empty($item['descripcion']))
                                        <div style="font-size:0.85rem; color:#6b7280; line-height:1.6;">{{ $item['descripcion'] }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Docentes --}}
                @if ($curso->docentes_curso && count($curso->docentes_curso))
                    <div class="detail-box">
                        <h2>Expositores</h2>
                        @foreach ($curso->docentes_curso as $docente)
                            <div class="docente-item">
                                @if (!empty($docente['foto']))
                                    <img src="{{ asset('storage/' . $docente['foto']) }}"
                                         alt="{{ $docente['nombre'] }}"
                                         style="width:44px;height:44px;border-radius:50%;object-fit:cover;flex-shrink:0;border:2px solid #e2e8f0;">
                                @else
                                    <div class="docente-avatar">{{ mb_strtoupper(mb_substr($docente['nombre'], 0, 1)) }}</div>
                                @endif
                                <div>
                                    <div style="font-weight:700; font-size:0.9rem; color:#111827;">{{ $docente['nombre'] }}</div>
                                    @if (!empty($docente['especialidad']))
                                        <div style="font-size:0.8rem; color:#6b7280;">{{ $docente['especialidad'] }}</div>
                                    @endif
                                    @if (!empty($docente['rol']))
                                        <span style="font-size:0.75rem; font-weight:600; color:#1E4D8C; background:#eff6ff; padding:0.15rem 0.5rem; border-radius:9999px; display:inline-block; margin-top:0.25rem;">{{ $docente['rol'] }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Dirigido a --}}
                @if ($curso->dirigido_a)
                    <div class="detail-box">
                        <h2>Dirigido a</h2>
                        <div style="color:#374151; line-height:1.8; font-size:0.95rem;">
                            {!! nl2br(e($curso->dirigido_a)) !!}
                        </div>
                    </div>
                @endif

            </div>

            {{-- Sidebar --}}
            <aside class="layout-sidebar-aside">
                <div class="sidebar-card">
                    <h3 style="font-size:1rem; font-weight:700; color:#1f2937; margin:0 0 1rem;">Informacion del curso</h3>

                    @if ($curso->fecha_inicio)
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1E4D8C" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            </div>
                            <div>
                                <p style="font-size:0.72rem; color:#9ca3af; margin:0; text-transform:uppercase; letter-spacing:.05em;">Fecha</p>
                                <p style="font-size:0.875rem; font-weight:600; color:#1f2937; margin:0;">
                                    @if ($curso->fecha_fin && !$curso->fecha_inicio->equalTo($curso->fecha_fin))
                                        {{ $curso->fecha_inicio->translatedFormat('d') }} - {{ $curso->fecha_fin->translatedFormat('d \d\e F, Y') }}
                                    @else
                                        {{ $curso->fecha_inicio->translatedFormat('d \d\e F, Y') }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endif

                    @if ($curso->modalidad)
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1E4D8C" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                            </div>
                            <div>
                                <p style="font-size:0.72rem; color:#9ca3af; margin:0; text-transform:uppercase; letter-spacing:.05em;">Modalidad</p>
                                <p style="font-size:0.875rem; font-weight:600; color:#1f2937; margin:0;">{{ $curso->modalidad }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($curso->duracion)
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1E4D8C" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div>
                                <p style="font-size:0.72rem; color:#9ca3af; margin:0; text-transform:uppercase; letter-spacing:.05em;">Duracion</p>
                                <p style="font-size:0.875rem; font-weight:600; color:#1f2937; margin:0;">{{ $curso->duracion }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($curso->certificacion)
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1E4D8C" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            </div>
                            <div>
                                <p style="font-size:0.72rem; color:#9ca3af; margin:0; text-transform:uppercase; letter-spacing:.05em;">Certificacion</p>
                                <p style="font-size:0.875rem; font-weight:600; color:#1f2937; margin:0;">{{ $curso->certificacion }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($curso->categorias->isNotEmpty())
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1E4D8C" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                            </div>
                            <div>
                                <p style="font-size:0.72rem; color:#9ca3af; margin:0; text-transform:uppercase; letter-spacing:.05em;">Area</p>
                                <p style="font-size:0.875rem; font-weight:600; color:#1f2937; margin:0;">
                                    {{ $curso->categorias->pluck('nombre')->join(', ') }}
                                </p>
                            </div>
                        </div>
                    @endif

                    {{-- Precios --}}
                    @if ($curso->precios && count($curso->precios))
                        <div style="margin-top:1.25rem; padding-top:1.25rem; border-top:2px solid #eff6ff;">
                            <p style="font-size:0.72rem; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:.08em; margin:0 0 0.75rem;">Inversion</p>
                            @foreach ($curso->precios as $precio)
                                <div class="precio-row">
                                    <span style="font-size:0.85rem; color:#374151;">{{ $precio['tipo'] }}</span>
                                    <span class="precio-monto">{{ $precio['precio'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <a href="{{ $waNumeroConfig ? 'https://wa.me/' . $waNumeroConfig . '?text=' . rawurlencode($waMensaje) : route('contacto.index') }}"
                       class="btn btn-naranja"
                       style="display:block; text-align:center; margin-top:1.5rem; font-size:1rem; padding:0.875rem;"
                       target="{{ $waNumeroConfig ? '_blank' : '_self' }}">
                        Inscribirme / Consultar
                    </a>
                    <a href="{{ route('cursos.index') }}"
                       style="display:block; text-align:center; margin-top:0.75rem; font-size:0.875rem; color:#6b7280; text-decoration:none;">
                        ← Volver a cursos
                    </a>
                </div>
            </aside>

        </div>
    </div>
</section>

@endsection
