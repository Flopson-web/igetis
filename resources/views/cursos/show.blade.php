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

    <section class="section">
        <div class="container">
            <div class="layout-sidebar">

                {{-- Contenido principal --}}
                <div class="layout-sidebar-main">
                    <div style="display:flex; gap:0.5rem; flex-wrap:wrap; margin-bottom:1rem;">
                        @foreach ($curso->categorias as $cat)
                            <span class="badge badge-blue">{{ $cat->nombre }}</span>
                        @endforeach
                        @if ($curso->modalidad)
                            <span class="badge badge-naranja">{{ $curso->modalidad }}</span>
                        @endif
                    </div>

                    <h1 style="font-size:clamp(1.5rem,4vw,2rem); font-weight:800; color:#1f2937; margin:0 0 1.5rem; line-height:1.25;">
                        {{ $curso->titulo }}
                    </h1>

                    @if ($curso->imagen)
                        <img src="{{ asset('storage/' . $curso->imagen) }}"
                             alt="{{ $curso->titulo }}"
                             style="width:100%; max-height:400px; object-fit:cover; border-radius:0.875rem; margin-bottom:2rem;">
                    @endif

                    @if ($curso->video_url)
                        <div style="position:relative; padding-bottom:56.25%; height:0; margin-bottom:2rem; border-radius:0.875rem; overflow:hidden;">
                            <iframe src="{{ $curso->video_url }}"
                                    style="position:absolute; top:0; left:0; width:100%; height:100%; border:none;"
                                    allowfullscreen></iframe>
                        </div>
                    @endif

                    <div style="background:white; border-radius:0.875rem; padding:1.5rem; box-shadow:0 1px 4px rgba(0,0,0,.08); margin-bottom:1.5rem;">
                        <h2 style="font-size:1.1rem; font-weight:700; color:#1E4D8C; margin:0 0 1rem;">Descripción</h2>
                        <div style="color:#374151; line-height:1.75; font-size:0.95rem;">
                            {!! nl2br(e($curso->descripcion)) !!}
                        </div>
                    </div>

                    @if ($curso->objetivos)
                        <div style="background:white; border-radius:0.875rem; padding:1.5rem; box-shadow:0 1px 4px rgba(0,0,0,.08); margin-bottom:1.5rem;">
                            <h2 style="font-size:1.1rem; font-weight:700; color:#1E4D8C; margin:0 0 1rem;">Objetivos del curso</h2>
                            <div style="color:#374151; line-height:1.75; font-size:0.95rem;">
                                {!! nl2br(e($curso->objetivos)) !!}
                            </div>
                        </div>
                    @endif

                    @if ($curso->dirigido_a)
                        <div style="background:white; border-radius:0.875rem; padding:1.5rem; box-shadow:0 1px 4px rgba(0,0,0,.08);">
                            <h2 style="font-size:1.1rem; font-weight:700; color:#1E4D8C; margin:0 0 1rem;">¿A quién va dirigido?</h2>
                            <div style="color:#374151; line-height:1.75; font-size:0.95rem;">
                                {!! nl2br(e($curso->dirigido_a)) !!}
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sidebar CTA --}}
                <aside class="layout-sidebar-aside">
                    <div class="sidebar-sticky">
                        <div style="background:white; border-radius:0.875rem; padding:1.5rem; box-shadow:0 4px 16px rgba(0,0,0,.1); border-top:4px solid #1E4D8C;">
                            <h3 style="font-size:1rem; font-weight:700; color:#1f2937; margin:0 0 1.25rem;">Información del curso</h3>

                            @if ($curso->duracion)
                                <div style="display:flex; align-items:center; gap:0.75rem; padding:0.75rem 0; border-bottom:1px solid #f3f4f6;">
                                    <span style="font-size:1.25rem;">⏱</span>
                                    <div>
                                        <p style="font-size:0.75rem; color:#9ca3af; margin:0; text-transform:uppercase; letter-spacing:.05em;">Duración</p>
                                        <p style="font-size:0.9rem; font-weight:600; color:#1f2937; margin:0;">{{ $curso->duracion }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($curso->modalidad)
                                <div style="display:flex; align-items:center; gap:0.75rem; padding:0.75rem 0; border-bottom:1px solid #f3f4f6;">
                                    <span style="font-size:1.25rem;">🖥</span>
                                    <div>
                                        <p style="font-size:0.75rem; color:#9ca3af; margin:0; text-transform:uppercase; letter-spacing:.05em;">Modalidad</p>
                                        <p style="font-size:0.9rem; font-weight:600; color:#1f2937; margin:0;">{{ $curso->modalidad }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($curso->categorias->isNotEmpty())
                                <div style="display:flex; align-items:center; gap:0.75rem; padding:0.75rem 0; border-bottom:1px solid #f3f4f6;">
                                    <span style="font-size:1.25rem;">🏷</span>
                                    <div>
                                        <p style="font-size:0.75rem; color:#9ca3af; margin:0; text-transform:uppercase; letter-spacing:.05em;">Áreas</p>
                                        <p style="font-size:0.9rem; font-weight:600; color:#1f2937; margin:0;">
                                            {{ $curso->categorias->pluck('nombre')->join(', ') }}
                                        </p>
                                    </div>
                                </div>
                            @endif

                            <a href="{{ route('contacto.index') }}" class="btn btn-naranja"
                               style="display:block; text-align:center; margin-top:1.25rem; font-size:1rem; padding:0.875rem;">
                                Solicitar información
                            </a>
                            <a href="{{ route('cursos.index') }}"
                               style="display:block; text-align:center; margin-top:0.75rem; font-size:0.875rem; color:#6b7280; text-decoration:none;">
                                ← Volver a cursos
                            </a>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </section>

@endsection
