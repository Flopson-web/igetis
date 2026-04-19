@extends('layouts.public')

@section('titulo', 'Inicio')
@section('descripcion', 'IGETIS — Formación profesional en gestión y tecnología para profesionales que quieren avanzar.')

@section('contenido')

<style>
    /* ── Hero ──────────────────────────────────────────────── */
    .hero {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    .hero-bg {
        position: absolute; inset: 0;
        background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        transform: scale(1.05);
        transition: transform 8s ease;
    }
    .hero-bg.loaded { transform: scale(1); }
    .hero-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(15,23,42,.88) 0%, rgba(30,77,140,.75) 60%, rgba(15,23,42,.6) 100%);
    }
    .hero-content {
        position: relative; z-index: 1;
        width: 100%; max-width: 1200px;
        margin: 0 auto; padding: 0 1.5rem;
        padding-top: 7rem; padding-bottom: 6rem;
    }
    .hero-eyebrow {
        display: inline-flex; align-items: center; gap: 0.5rem;
        background: rgba(249,115,22,.15);
        border: 1px solid rgba(249,115,22,.3);
        color: #fb923c;
        font-size: 0.78rem; font-weight: 700;
        letter-spacing: 0.1em; text-transform: uppercase;
        padding: 0.4rem 1rem; border-radius: 9999px;
        margin-bottom: 1.5rem;
    }
    .hero-title {
        font-size: clamp(2.25rem, 6vw, 4rem);
        font-weight: 900;
        color: white;
        line-height: 1.1;
        max-width: 700px;
        margin-bottom: 1.5rem;
        letter-spacing: -0.02em;
    }
    .hero-title span { color: #fb923c; }
    .hero-subtitle {
        font-size: clamp(1rem, 2vw, 1.2rem);
        color: rgba(255,255,255,.75);
        max-width: 520px;
        line-height: 1.75;
        margin-bottom: 2.5rem;
    }
    .hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; }
    .hero-scroll {
        position: absolute; bottom: 2rem; left: 50%;
        transform: translateX(-50%);
        display: flex; flex-direction: column; align-items: center;
        gap: 0.5rem; color: rgba(255,255,255,.5); font-size: 0.75rem;
        animation: bounce 2s ease infinite;
    }
    @keyframes bounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(6px); }
    }

    /* ── Stats ──────────────────────────────────────────────── */
    .stats-bar {
        background: white;
        box-shadow: 0 4px 24px rgba(0,0,0,.1);
        position: relative; z-index: 2;
    }
    .stats-grid {
        max-width: 1200px; margin: 0 auto;
        display: grid; grid-template-columns: repeat(4, 1fr);
        padding: 0 1.5rem;
    }
    .stat-item {
        padding: 2rem 1.5rem;
        text-align: center;
        border-right: 1px solid #f1f5f9;
        transition: background 0.2s;
    }
    .stat-item:last-child { border-right: none; }
    .stat-item:hover { background: #f8fafc; }
    .stat-number {
        font-size: 2.25rem; font-weight: 900;
        color: var(--azul); line-height: 1;
        margin-bottom: 0.4rem;
    }
    .stat-label { font-size: 0.85rem; color: #6b7280; font-weight: 500; }

    /* ── Features ───────────────────────────────────────────── */
    .feature-card {
        background: white; border-radius: 1.25rem;
        padding: 2rem; border: 1px solid #f1f5f9;
        transition: all 0.25s;
    }
    .feature-card:hover {
        border-color: #bfdbfe;
        box-shadow: 0 8px 32px rgba(30,77,140,.1);
        transform: translateY(-4px);
    }
    .feature-icon {
        width: 52px; height: 52px; border-radius: 0.875rem;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 1.25rem;
    }

    /* ── CTA section ────────────────────────────────────────── */
    .cta-section {
        position: relative; overflow: hidden;
        padding: 6rem 1.5rem;
        text-align: center;
    }
    .cta-bg {
        position: absolute; inset: 0;
        background-image: url('https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=1920&q=80');
        background-size: cover; background-position: center;
    }
    .cta-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(15,23,42,.92) 0%, rgba(30,77,140,.88) 100%);
    }
    .cta-content { position: relative; z-index: 1; max-width: 640px; margin: 0 auto; }

    @media (max-width: 768px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .stat-item { border-right: none; border-bottom: 1px solid #f1f5f9; }
        .stat-item:nth-child(odd) { border-right: 1px solid #f1f5f9; }
        .stat-item:nth-last-child(-n+2) { border-bottom: none; }
        .hero-content { padding-top: 8rem; }
    }
    @media (max-width: 480px) {
        .stats-grid { grid-template-columns: 1fr 1fr; }
    }
</style>

{{-- ── HERO ──────────────────────────────────────────────────── --}}
<section class="hero">
    <div class="hero-bg" id="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-eyebrow animate-fade-up">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            Instituto de excelencia profesional
        </div>
        <h1 class="hero-title animate-fade-up delay-100">
            Transforma tu carrera con <span>formación real</span>
        </h1>
        <p class="hero-subtitle animate-fade-up delay-200">
            {{ $config['hero_texto'] }}
        </p>
        <div class="hero-actions animate-fade-up delay-300">
            <a href="{{ route('cursos.index') }}" class="btn btn-naranja btn-lg">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Ver cursos
            </a>
            <a href="{{ route('contacto.index') }}" class="btn btn-ghost-white btn-lg">Contáctanos</a>
        </div>
    </div>
    <div class="hero-scroll">
        <span>Explorar</span>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
    </div>
</section>

{{-- ── STATS ──────────────────────────────────────────────────── --}}
<div class="stats-bar">
    <div class="stats-grid">
        <div class="stat-item animate-fade-up">
            <div class="stat-number">+500</div>
            <div class="stat-label">Estudiantes formados</div>
        </div>
        <div class="stat-item animate-fade-up delay-100">
            <div class="stat-number">+50</div>
            <div class="stat-label">Cursos disponibles</div>
        </div>
        <div class="stat-item animate-fade-up delay-200">
            <div class="stat-number">+10</div>
            <div class="stat-label">Años de experiencia</div>
        </div>
        <div class="stat-item animate-fade-up delay-300">
            <div class="stat-number">98%</div>
            <div class="stat-label">Satisfacción</div>
        </div>
    </div>
</div>

{{-- ── POR QUÉ IGETIS ─────────────────────────────────────────── --}}
<section class="section" style="background: #f8fafc;">
    <div class="container">
        <div style="text-align:center; margin-bottom:3.5rem;">
            <span class="section-label">Nuestras ventajas</span>
            <h2 class="section-title">¿Por qué elegir IGETIS?</h2>
            <p class="section-subtitle" style="margin:0 auto;">Formación práctica diseñada para el mercado laboral real.</p>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%,240px),1fr)); gap:1.5rem;">
            @foreach ([
                ['bg'=>'linear-gradient(135deg,#dbeafe,#bfdbfe)', 'color'=>'#1d4ed8',
                 'icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                 'titulo'=>'Enfoque práctico','texto'=>'Aprende haciendo. Proyectos reales desde el primer día.'],
                ['bg'=>'linear-gradient(135deg,#fef9c3,#fde68a)', 'color'=>'#92400e',
                 'icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
                 'titulo'=>'Docentes expertos','texto'=>'Profesionales en activo con experiencia real en el sector.'],
                ['bg'=>'linear-gradient(135deg,#dcfce7,#bbf7d0)', 'color'=>'#15803d',
                 'icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                 'titulo'=>'Horario flexible','texto'=>'Presencial, online y blended. Tú decides cuándo y cómo.'],
                ['bg'=>'linear-gradient(135deg,#fce7f3,#fbcfe8)', 'color'=>'#be185d',
                 'icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>',
                 'titulo'=>'Certificación','texto'=>'Certificado reconocido que acredita tus nuevas competencias.'],
            ] as $f)
                <div class="feature-card">
                    <div class="feature-icon" style="background:{{ $f['bg'] }};">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="{{ $f['color'] }}">{!! $f['icon'] !!}</svg>
                    </div>
                    <h3 style="font-size:1rem; font-weight:700; color:#111827; margin-bottom:0.5rem;">{{ $f['titulo'] }}</h3>
                    <p style="font-size:0.875rem; color:#6b7280; line-height:1.65;">{{ $f['texto'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── CURSOS DESTACADOS ──────────────────────────────────────── --}}
@if ($cursos->isNotEmpty())
<section class="section" style="background:white;">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:3rem; flex-wrap:wrap; gap:1rem;">
            <div>
                <span class="section-label">Formación</span>
                <h2 class="section-title" style="margin-bottom:0;">Cursos destacados</h2>
            </div>
            <a href="{{ route('cursos.index') }}" class="btn btn-outline">
                Ver todos
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid-3">
            @foreach ($cursos as $curso)
                <div class="card course-card">
                    <div class="course-img-wrap">
                        @if ($curso->imagen)
                            <img src="{{ asset('storage/' . $curso->imagen) }}" alt="{{ $curso->titulo }}">
                        @else
                            <div class="course-img-placeholder" style="background:linear-gradient(135deg,#1E4D8C,#2E6DB4);">📚</div>
                        @endif
                        @if ($curso->modalidad)
                            <span style="position:absolute; top:0.875rem; left:0.875rem;" class="badge badge-naranja">{{ $curso->modalidad }}</span>
                        @endif
                    </div>
                    <div class="course-body">
                        <div style="display:flex; gap:0.4rem; flex-wrap:wrap; margin-bottom:0.75rem;">
                            @foreach ($curso->categorias as $cat)
                                <span class="badge badge-blue">{{ $cat->nombre }}</span>
                            @endforeach
                        </div>
                        <h3 style="font-size:1.05rem; font-weight:700; color:#111827; margin-bottom:0.5rem; line-height:1.4;">{{ $curso->titulo }}</h3>
                        <p style="font-size:0.875rem; color:#6b7280; line-height:1.65; flex:1; margin-bottom:1.25rem;">{{ Str::limit($curso->descripcion, 100) }}</p>
                        @if ($curso->duracion)
                            <div style="display:flex; align-items:center; gap:0.4rem; font-size:0.8rem; color:#9ca3af; margin-bottom:1.25rem;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                {{ $curso->duracion }}
                            </div>
                        @endif
                        <a href="{{ route('cursos.show', $curso->slug) }}" class="btn btn-primary" style="justify-content:center; width:100%;">Ver curso</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── BANNER IMAGEN ──────────────────────────────────────────── --}}
<section style="position:relative; padding:5rem 1.5rem; overflow:hidden; text-align:center;">
    <div style="position:absolute; inset:0; background-image:url('https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=1920&q=80'); background-size:cover; background-position:center; background-attachment:fixed;"></div>
    <div style="position:absolute; inset:0; background:rgba(30,77,140,.82);"></div>
    <div style="position:relative; z-index:1; max-width:700px; margin:0 auto;">
        <span class="section-label" style="color:#fb923c;">Tu próximo paso</span>
        <h2 style="font-size:clamp(1.75rem,4vw,2.75rem); font-weight:900; color:white; margin:0.75rem 0 1.25rem; line-height:1.2;">
            Invierte en ti. El conocimiento es el mejor activo.
        </h2>
        <p style="color:rgba(255,255,255,.75); font-size:1.05rem; line-height:1.7; margin-bottom:2.5rem;">
            Únete a cientos de profesionales que ya dieron el salto con IGETIS.
        </p>
        <a href="{{ route('cursos.index') }}" class="btn btn-naranja btn-lg">Explorar cursos</a>
    </div>
</section>

{{-- ── ARTÍCULOS RECIENTES ─────────────────────────────────────── --}}
@if ($articulos->isNotEmpty())
<section class="section" style="background:#f8fafc;">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:3rem; flex-wrap:wrap; gap:1rem;">
            <div>
                <span class="section-label">Blog</span>
                <h2 class="section-title" style="margin-bottom:0;">Últimas publicaciones</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="btn btn-outline">
                Ver blog
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid-3">
            @foreach ($articulos as $articulo)
                <a href="{{ route('blog.show', $articulo->slug) }}" style="text-decoration:none; display:flex;">
                    <div class="card" style="width:100%;">
                        <div class="blog-card-img">
                            @if ($articulo->imagen)
                                <img src="{{ asset('storage/' . $articulo->imagen) }}" alt="{{ $articulo->titulo }}">
                            @else
                                <div style="height:200px; background:linear-gradient(135deg,#F97316,#EA6C0A); display:flex; align-items:center; justify-content:center; font-size:3.5rem;">✍️</div>
                            @endif
                        </div>
                        <div style="padding:1.5rem; flex:1; display:flex; flex-direction:column;">
                            <div style="display:flex; align-items:center; gap:0.5rem; font-size:0.78rem; color:#9ca3af; margin-bottom:0.75rem;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                {{ $articulo->publicado_en->format('d M Y') }}
                                @if ($articulo->autor)
                                    <span>·</span> {{ $articulo->autor }}
                                @endif
                            </div>
                            <h3 style="font-size:1rem; font-weight:700; color:#111827; line-height:1.4; flex:1; margin-bottom:1rem;">{{ $articulo->titulo }}</h3>
                            <span style="font-size:0.85rem; font-weight:600; color:var(--azul); display:flex; align-items:center; gap:0.3rem;">
                                Leer más
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── CTA FINAL ───────────────────────────────────────────────── --}}
<section class="cta-section">
    <div class="cta-bg"></div>
    <div class="cta-overlay"></div>
    <div class="cta-content">
        <span class="section-label" style="color:#fb923c;">¿Listo para empezar?</span>
        <h2 style="font-size:clamp(1.75rem,4vw,2.75rem); font-weight:900; color:white; margin:0.75rem 0 1.25rem; line-height:1.2;">
            Habla con nosotros hoy
        </h2>
        <p style="color:rgba(255,255,255,.75); font-size:1.05rem; line-height:1.7; margin-bottom:2.5rem;">
            Te asesoramos sin compromiso y te ayudamos a encontrar el programa que mejor se adapta a tus objetivos.
        </p>
        <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
            <a href="{{ route('contacto.index') }}" class="btn btn-naranja btn-lg">Solicitar información</a>
            <a href="{{ route('cursos.index') }}" class="btn btn-white btn-lg" style="color:var(--azul);">Ver cursos</a>
        </div>
    </div>
</section>

<script>
    // Ken Burns effect on hero
    const heroBg = document.getElementById('hero-bg');
    if (heroBg) setTimeout(() => heroBg.classList.add('loaded'), 100);
</script>

@endsection
