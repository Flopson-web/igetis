@extends('layouts.public')

@section('titulo', $articulo->titulo)
@section('descripcion', Str::limit(strip_tags($articulo->cuerpo), 160))

@section('contenido')

    {{-- Breadcrumb --}}
    <div style="background:white; border-bottom:1px solid #e5e7eb; padding:0.75rem 1.25rem;">
        <div class="container" style="font-size:0.8rem; color:#6b7280;">
            <a href="{{ route('home') }}" style="color:#1E4D8C; text-decoration:none;">Inicio</a>
            <span style="margin:0 0.5rem;">›</span>
            <a href="{{ route('blog.index') }}" style="color:#1E4D8C; text-decoration:none;">Blog</a>
            <span style="margin:0 0.5rem;">›</span>
            <span>{{ Str::limit($articulo->titulo, 50) }}</span>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="layout-sidebar">

                {{-- Artículo --}}
                <article class="layout-sidebar-main">
                    <div style="background:white; border-radius:0.875rem; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,.08);">

                        @if ($articulo->imagen)
                            <img src="{{ asset('storage/' . $articulo->imagen) }}"
                                 alt="{{ $articulo->titulo }}"
                                 style="width:100%; max-height:420px; object-fit:cover;">
                        @endif

                        <div style="padding:1.75rem;">
                            <p style="font-size:0.82rem; color:#9ca3af; margin:0 0 1rem;">
                                {{ $articulo->publicado_en->format('d \d\e F \d\e Y') }}
                                @if($articulo->autor)
                                    · Por <strong style="color:#374151;">{{ $articulo->autor }}</strong>
                                @endif
                            </p>

                            <h1 style="font-size:clamp(1.375rem,4vw,1.875rem); font-weight:800; color:#1f2937; margin:0 0 1.75rem; line-height:1.3;">
                                {{ $articulo->titulo }}
                            </h1>

                            <div style="color:#374151; line-height:1.85; font-size:1rem;">
                                {!! nl2br(e($articulo->cuerpo)) !!}
                            </div>
                        </div>
                    </div>

                    <div style="margin-top:1.5rem;">
                        <a href="{{ route('blog.index') }}"
                           style="color:#1E4D8C; text-decoration:none; font-size:0.9rem; font-weight:600;">
                            ← Volver al blog
                        </a>
                    </div>
                </article>

                {{-- Sidebar recientes --}}
                @if ($recientes->isNotEmpty())
                    <aside class="layout-sidebar-aside">
                        <div class="sidebar-sticky">
                            <div style="background:white; border-radius:0.875rem; padding:1.25rem; box-shadow:0 1px 4px rgba(0,0,0,.08);">
                                <h3 style="font-size:0.875rem; font-weight:700; color:#374151; text-transform:uppercase; letter-spacing:.05em; margin:0 0 1.25rem;">
                                    Artículos recientes
                                </h3>
                                <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:1rem;">
                                    @foreach ($recientes as $rec)
                                        <li style="padding-bottom:1rem; border-bottom:1px solid #f3f4f6;">
                                            <a href="{{ route('blog.show', $rec->slug) }}"
                                               style="text-decoration:none; color:#1f2937; font-weight:600; font-size:0.875rem; line-height:1.4; display:block; margin-bottom:0.25rem;">
                                                {{ $rec->titulo }}
                                            </a>
                                            <span style="font-size:0.75rem; color:#9ca3af;">
                                                {{ $rec->publicado_en->format('d M Y') }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div style="margin-top:1.5rem; background:#1E4D8C; border-radius:0.875rem; padding:1.5rem; text-align:center;">
                                <p style="color:#bfdbfe; font-size:0.875rem; margin:0 0 1rem; line-height:1.5;">
                                    ¿Te interesa formarte con nosotros?
                                </p>
                                <a href="{{ route('cursos.index') }}" class="btn btn-naranja"
                                   style="display:block; text-align:center; font-size:0.875rem; padding:0.625rem;">
                                    Ver cursos
                                </a>
                            </div>
                        </div>
                    </aside>
                @endif

            </div>
        </div>
    </section>

@endsection
