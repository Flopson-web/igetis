@extends('layouts.public')

@section('titulo', 'Inicio')
@section('descripcion', 'IGETIS — Capacitación especializada en salud y áreas afines. Impulsa tu crecimiento profesional con formación académica de vanguardia en Cochabamba, Bolivia.')

@section('contenido')

<style>
/* ═══════════════════════════════════════════════════════════════
   HERO
════════════════════════════════════════════════════════════════ */
.hero {
    position: relative; min-height: 100vh;
    display: flex; align-items: center; overflow: hidden;
}
.hero-bg {
    position: absolute; inset: 0;
    background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1920&q=80');
    background-size: cover; background-position: center;
    transform: scale(1.05); transition: transform 8s ease;
}
.hero-bg.loaded { transform: scale(1); }
.hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg,
        rgba(8,14,32,.96) 0%,
        rgba(21,58,107,.86) 55%,
        rgba(8,14,32,.72) 100%);
}
.hero-dots {
    position: absolute; inset: 0; z-index: 0;
    background-image: radial-gradient(rgba(255,255,255,.06) 1px, transparent 1px);
    background-size: 32px 32px;
}
.hero-accent {
    position: absolute; bottom: 0; left: 0; right: 0; height: 4px;
    background: linear-gradient(to right, transparent 0%, #F97316 40%, #fb923c 60%, transparent 100%);
    opacity: .5; z-index: 2;
}

.hero-content {
    position: relative; z-index: 1;
    width: 100%; max-width: 1200px; margin: 0 auto;
    padding: 8rem 1.5rem 6rem;
    display: grid; grid-template-columns: 1fr; gap: 3rem; align-items: center;
}
.hero-eyebrow {
    display: inline-flex; align-items: center; gap: .5rem;
    background: rgba(249,115,22,.14); border: 1px solid rgba(249,115,22,.3);
    color: #fb923c; font-size: .75rem; font-weight: 700;
    letter-spacing: .1em; text-transform: uppercase;
    padding: .4rem 1rem; border-radius: 9999px; margin-bottom: 1.5rem;
}
.hero-title {
    font-size: clamp(2.4rem, 6vw, 4.25rem); font-weight: 900;
    color: white; line-height: 1.08; max-width: 680px;
    margin-bottom: 1.5rem; letter-spacing: -.03em;
}
.hero-title span { color: #fb923c; }
.hero-subtitle {
    font-size: clamp(1rem, 2vw, 1.125rem); color: rgba(255,255,255,.7);
    max-width: 500px; line-height: 1.8; margin-bottom: 2.5rem;
}
.hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 2.75rem; }
.hero-trust {
    display: flex; gap: 2rem; flex-wrap: wrap;
    border-top: 1px solid rgba(255,255,255,.1); padding-top: 1.75rem;
}
.hero-trust-item {
    display: flex; align-items: center; gap: .5rem;
    font-size: .8rem; color: rgba(255,255,255,.55); font-weight: 500;
}

/* Floating credential cards */
.hero-floats { display: none; }
.float-card {
    background: rgba(255,255,255,.07);
    backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,.12); border-radius: 1rem;
    padding: 1rem 1.25rem; display: flex; align-items: center; gap: .875rem;
    min-width: 205px; cursor: default; transition: background .2s;
}
.float-card:hover { background: rgba(255,255,255,.11); }
.float-icon {
    width: 44px; height: 44px; border-radius: .625rem; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
}
.float-val { font-size: 1.5rem; font-weight: 900; color: white; line-height: 1; }
.float-lbl { font-size: .72rem; color: rgba(255,255,255,.5); margin-top: .15rem; }

.float-card-1 { animation: flt 3.4s ease-in-out infinite; }
.float-card-2 { animation: flt 3.4s ease-in-out infinite .45s; }
.float-card-3 { animation: flt 3.4s ease-in-out infinite .9s; }
@keyframes flt {
    0%,100% { transform: translateY(0); }
    50%      { transform: translateY(-7px); }
}
@media (prefers-reduced-motion: reduce) {
    .float-card-1,.float-card-2,.float-card-3 { animation: none; }
    .hero-scroll { animation: none; }
}

.hero-scroll {
    position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%);
    display: flex; flex-direction: column; align-items: center; gap: .4rem;
    color: rgba(255,255,255,.35); font-size: .7rem; font-weight: 600;
    text-transform: uppercase; letter-spacing: .1em;
    animation: scroll-bounce 2.4s ease infinite;
}
@keyframes scroll-bounce {
    0%,100% { transform: translateX(-50%) translateY(0); }
    50%      { transform: translateX(-50%) translateY(7px); }
}

/* ═══════════════════════════════════════════════════════════════
   STATS  (dark navy background)
════════════════════════════════════════════════════════════════ */
.stats-bar { background: #0F172A; position: relative; overflow: hidden; }
.stats-texture {
    position: absolute; inset: 0; pointer-events: none;
    background-image: radial-gradient(rgba(255,255,255,.04) 1px, transparent 1px);
    background-size: 28px 28px;
}
.stats-grid {
    position: relative; z-index: 1;
    max-width: 1200px; margin: 0 auto;
    display: grid; grid-template-columns: repeat(4,1fr); padding: 0 1.5rem;
}
.stat-item {
    padding: 2.75rem 1.5rem; text-align: center;
    border-right: 1px solid rgba(255,255,255,.06);
    transition: background .2s; cursor: default;
}
.stat-item:last-child { border-right: none; }
.stat-item:hover { background: rgba(255,255,255,.025); }
.stat-icon-wrap {
    width: 46px; height: 46px; border-radius: .75rem;
    background: rgba(249,115,22,.12);
    display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;
}
.stat-num {
    font-size: 2.75rem; font-weight: 900;
    color: #F97316; line-height: 1; margin-bottom: .4rem;
}
.stat-lbl { font-size: .82rem; color: rgba(255,255,255,.5); font-weight: 500; }

/* ═══════════════════════════════════════════════════════════════
   FEATURE CARDS
════════════════════════════════════════════════════════════════ */
.feature-card {
    background: white; border-radius: 1.25rem; padding: 2rem;
    border: 1px solid #f1f5f9; border-left: 3px solid transparent;
    transition: all .25s; cursor: default;
}
.feature-card:hover {
    border-color: #dbeafe; border-left-color: var(--azul);
    box-shadow: 0 8px 32px rgba(30,77,140,.1); transform: translateY(-4px);
}
.feat-icon {
    width: 52px; height: 52px; border-radius: .875rem;
    background: #EFF6FF;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 1.25rem;
}

/* ═══════════════════════════════════════════════════════════════
   CTA
════════════════════════════════════════════════════════════════ */
.cta-section { position: relative; overflow: hidden; padding: 6rem 1.5rem; text-align: center; }
.cta-bg {
    position: absolute; inset: 0;
    background-image: url('https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=1920&q=80');
    background-size: cover; background-position: center;
}
.cta-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(8,14,32,.95) 0%, rgba(21,58,107,.9) 100%);
}
.cta-content { position: relative; z-index: 1; max-width: 640px; margin: 0 auto; }

/* Placeholders (sin emojis) */
.course-placeholder {
    height: 200px; display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg,#1E4D8C,#2E6DB4); flex-shrink: 0;
}
.blog-placeholder {
    height: 200px; display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg,#F97316,#EA6C0A);
}

/* ═══════════════════════════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════════════════════════════ */
@media (min-width: 900px) {
    .hero-content { grid-template-columns: 1fr auto; }
    .hero-floats  { display: flex; flex-direction: column; gap: 1rem; align-self: center; padding-top: 2rem; }
}
@media (max-width: 768px) {
    .stats-grid { grid-template-columns: repeat(2,1fr); }
    .stat-item  { border-right: none; border-bottom: 1px solid rgba(255,255,255,.06); }
    .stat-item:nth-child(odd)          { border-right: 1px solid rgba(255,255,255,.06); }
    .stat-item:nth-last-child(-n+2)    { border-bottom: none; }
}
</style>

{{-- ══════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════ --}}
<section class="hero">
    <div class="hero-bg" id="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-dots"></div>
    <div class="hero-accent"></div>

    <div class="hero-content">

        {{-- Left: text --}}
        <div>
            <div class="hero-eyebrow animate-fade-up">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                Capacitación de alto nivel en salud
            </div>

            <h1 class="hero-title animate-fade-up delay-100">
                Impulsa tu carrera con <span>formación especializada</span>
            </h1>

            <p class="hero-subtitle animate-fade-up delay-200">
                {{ $config['hero_texto'] }}
            </p>

            <div class="hero-actions animate-fade-up delay-300">
                <a href="{{ route('cursos.index') }}" class="btn btn-naranja btn-lg">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Ver cursos
                </a>
                <a href="{{ route('contacto.index') }}" class="btn btn-ghost-white btn-lg">Contáctanos</a>
            </div>

            <div class="hero-trust animate-fade-up delay-400">
                <div class="hero-trust-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fb923c" stroke-width="2.5">
                        <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Certificación avalada
                </div>
                <div class="hero-trust-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fb923c" stroke-width="2.5">
                        <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Docentes especializados
                </div>
                <div class="hero-trust-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fb923c" stroke-width="2.5">
                        <rect x="2" y="3" width="20" height="14" rx="2"/>
                        <line x1="8" y1="21" x2="16" y2="21"/>
                        <line x1="12" y1="17" x2="12" y2="21"/>
                    </svg>
                    Online y presencial
                </div>
            </div>
        </div>

        {{-- Right: floating credential cards (desktop only) --}}
        <div class="hero-floats">
            <div class="float-card float-card-1">
                <div class="float-icon" style="background:rgba(249,115,22,.18);">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fb923c" stroke-width="2.5">
                        <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="float-val">+500</div>
                    <div class="float-lbl">Profesionales capacitados</div>
                </div>
            </div>
            <div class="float-card float-card-2">
                <div class="float-icon" style="background:rgba(30,77,140,.25);">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#93c5fd" stroke-width="2.5">
                        <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <div class="float-val">Cert.</div>
                    <div class="float-lbl">Certificación reconocida</div>
                </div>
            </div>
            <div class="float-card float-card-3">
                <div class="float-icon" style="background:rgba(22,163,74,.18);">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2.5">
                        <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </div>
                <div>
                    <div class="float-val">98%</div>
                    <div class="float-lbl">Satisfacción de alumnos</div>
                </div>
            </div>
        </div>

    </div>

    <div class="hero-scroll">
        <span>Explorar</span>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     STATS  (dark background + animated counters)
═══════════════════════════════════════════════ --}}
<div class="stats-bar">
    <div class="stats-texture"></div>
    <div class="stats-grid">

        <div class="stat-item">
            <div class="stat-icon-wrap">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2">
                    <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div class="stat-num" data-counter="500" data-suffix="+">500+</div>
            <div class="stat-lbl">Profesionales formados</div>
        </div>

        <div class="stat-item">
            <div class="stat-icon-wrap">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2">
                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div class="stat-num" data-counter="50" data-suffix="+">50+</div>
            <div class="stat-lbl">Cursos especializados</div>
        </div>

        <div class="stat-item">
            <div class="stat-icon-wrap">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>
            <div class="stat-num" data-counter="10" data-suffix="+">10+</div>
            <div class="stat-lbl">Años de experiencia</div>
        </div>

        <div class="stat-item">
            <div class="stat-icon-wrap">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2">
                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            </div>
            <div class="stat-num" data-counter="98" data-suffix="%">98%</div>
            <div class="stat-lbl">Índice de satisfacción</div>
        </div>

    </div>
</div>

{{-- ══════════════════════════════════════════════
     POR QUÉ IGETIS
═══════════════════════════════════════════════ --}}
<section class="section" style="background:#f8fafc;">
    <div class="container">
        <div style="text-align:center; margin-bottom:3.5rem;">
            <span class="section-label">Nuestras ventajas</span>
            <h2 class="section-title">¿Por qué elegir IGETIS?</h2>
            <p class="section-subtitle" style="margin:0 auto;">Formación especializada en salud, diseñada para el mercado laboral real.</p>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%,240px),1fr)); gap:1.5rem;">
            @foreach ([
                ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                 'titulo'=>'Enfoque práctico',
                 'texto'=>'Aprende con proyectos reales y casos clínicos desde el primer módulo.'],
                ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
                 'titulo'=>'Docentes expertos',
                 'texto'=>'Profesionales activos con experiencia real en el sector salud y áreas afines.'],
                ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                 'titulo'=>'Horario flexible',
                 'texto'=>'Presencial, online y blended. Aprende a tu ritmo sin descuidar tu trabajo.'],
                ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>',
                 'titulo'=>'Certificación',
                 'texto'=>'Certificado reconocido que acredita tus competencias ante empleadores.'],
            ] as $f)
                <div class="feature-card">
                    <div class="feat-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8">{!! $f['icon'] !!}</svg>
                    </div>
                    <h3 style="font-size:1rem; font-weight:700; color:#111827; margin-bottom:.5rem;">{{ $f['titulo'] }}</h3>
                    <p style="font-size:.875rem; color:#6b7280; line-height:1.65;">{{ $f['texto'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     CURSOS DESTACADOS
═══════════════════════════════════════════════ --}}
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
                            <div class="course-placeholder">
                                <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.5)" stroke-width="1.5">
                                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        @endif
                        <div style="position:absolute; top:.875rem; left:.875rem; display:flex; gap:.4rem;">
                            @if ($curso->tipo)
                                <span class="badge badge-naranja">{{ $curso->tipo }}</span>
                            @elseif ($curso->modalidad)
                                <span class="badge badge-naranja">{{ $curso->modalidad }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="course-body">
                        <div style="display:flex; gap:.4rem; flex-wrap:wrap; margin-bottom:.75rem;">
                            @foreach ($curso->categorias as $cat)
                                <span class="badge badge-blue">{{ $cat->nombre }}</span>
                            @endforeach
                        </div>
                        <h3 style="font-size:1.05rem; font-weight:700; color:#111827; margin-bottom:.5rem; line-height:1.4;">{{ $curso->titulo }}</h3>
                        <p style="font-size:.875rem; color:#6b7280; line-height:1.65; flex:1; margin-bottom:1rem;">{{ Str::limit($curso->descripcion, 100) }}</p>
                        <div style="display:flex; flex-wrap:wrap; gap:.75rem; margin-bottom:1.25rem;">
                            @if ($curso->fecha_inicio)
                                <div style="display:flex; align-items:center; gap:.35rem; font-size:.78rem; color:#1E4D8C; font-weight:600;">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    @if ($curso->fecha_fin && !$curso->fecha_inicio->equalTo($curso->fecha_fin))
                                        {{ $curso->fecha_inicio->translatedFormat('d') }}-{{ $curso->fecha_fin->translatedFormat('d M Y') }}
                                    @else
                                        {{ $curso->fecha_inicio->translatedFormat('d M Y') }}
                                    @endif
                                </div>
                            @endif
                            @if ($curso->duracion)
                                <div style="display:flex; align-items:center; gap:.35rem; font-size:.78rem; color:#9ca3af;">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    {{ $curso->duracion }}
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('cursos.show', $curso->slug) }}" class="btn btn-primary" style="justify-content:center; width:100%;">Ver curso</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════
     BANNER PARALLAX
═══════════════════════════════════════════════ --}}
<section style="position:relative; padding:5.5rem 1.5rem; overflow:hidden; text-align:center;">
    <div style="position:absolute; inset:0; background-image:url('https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=1920&q=80'); background-size:cover; background-position:center; background-attachment:fixed;"></div>
    <div style="position:absolute; inset:0; background:linear-gradient(135deg,rgba(21,58,107,.9),rgba(8,14,32,.85));"></div>
    <div style="position:absolute; inset:0; background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px); background-size:30px 30px;"></div>
    <div style="position:relative; z-index:1; max-width:680px; margin:0 auto;">
        <span class="section-label" style="color:#fb923c;">Tu próximo paso</span>
        <h2 style="font-size:clamp(1.75rem,4vw,2.75rem); font-weight:900; color:white; margin:.75rem 0 1.25rem; line-height:1.15;">
            Invierte en ti. El conocimiento es el mejor activo.
        </h2>
        <p style="color:rgba(255,255,255,.7); font-size:1.05rem; line-height:1.75; margin-bottom:2.5rem;">
            Únete a cientos de profesionales de la salud que ya dieron el salto con IGETIS.
        </p>
        <a href="{{ route('cursos.index') }}" class="btn btn-naranja btn-lg">Explorar cursos</a>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     ARTÍCULOS RECIENTES
═══════════════════════════════════════════════ --}}
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
                                <div class="blog-placeholder">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.5)" stroke-width="1.5">
                                        <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div style="padding:1.5rem; flex:1; display:flex; flex-direction:column;">
                            <div style="display:flex; align-items:center; gap:.5rem; font-size:.78rem; color:#9ca3af; margin-bottom:.75rem;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                {{ $articulo->publicado_en->format('d M Y') }}
                                @if ($articulo->autor)
                                    <span>·</span> {{ $articulo->autor }}
                                @endif
                            </div>
                            <h3 style="font-size:1rem; font-weight:700; color:#111827; line-height:1.4; flex:1; margin-bottom:1rem;">{{ $articulo->titulo }}</h3>
                            <span style="font-size:.85rem; font-weight:600; color:var(--azul); display:flex; align-items:center; gap:.3rem;">
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

{{-- ══════════════════════════════════════════════
     CTA FINAL
═══════════════════════════════════════════════ --}}
<section class="cta-section">
    <div class="cta-bg"></div>
    <div class="cta-overlay"></div>
    <div class="cta-content">
        <span class="section-label" style="color:#fb923c;">¿Listo para empezar?</span>
        <h2 style="font-size:clamp(1.75rem,4vw,2.75rem); font-weight:900; color:white; margin:.75rem 0 1.25rem; line-height:1.15;">
            Habla con nosotros hoy
        </h2>
        <p style="color:rgba(255,255,255,.7); font-size:1.05rem; line-height:1.75; margin-bottom:2.5rem;">
            Te asesoramos sin compromiso y te ayudamos a encontrar el programa que mejor se adapta a tus objetivos.
        </p>
        <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
            <a href="{{ route('contacto.index') }}" class="btn btn-naranja btn-lg">Solicitar información</a>
            <a href="{{ route('cursos.index') }}" class="btn btn-white btn-lg" style="color:var(--azul);">Ver cursos</a>
        </div>
    </div>
</section>

<script>
    // Ken Burns hero
    const heroBg = document.getElementById('hero-bg');
    if (heroBg) setTimeout(() => heroBg.classList.add('loaded'), 100);

    // Animated stat counters (Intersection Observer)
    (function () {
        if (!window.IntersectionObserver || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
        function ease(t) { return 1 - Math.pow(1 - t, 3); }
        function run(el) {
            const target = parseInt(el.dataset.counter, 10);
            const suffix = el.dataset.suffix || '';
            const dur    = 1400;
            const t0     = performance.now();
            (function tick(now) {
                const p = Math.min((now - t0) / dur, 1);
                el.textContent = Math.round(ease(p) * target) + suffix;
                if (p < 1) requestAnimationFrame(tick);
            })(t0);
        }
        const io = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting) { run(e.target); io.unobserve(e.target); } });
        }, { threshold: 0.6 });
        document.querySelectorAll('[data-counter]').forEach(el => io.observe(el));
    })();
</script>

@endsection
