@extends('layouts.public')
@section('titulo', 'Cursos')
@section('descripcion', 'Explora todos nuestros cursos de formación profesional')

@section('contenido')
<style>
    .page-hero {
        position: relative; padding: 5rem 1.5rem 4rem;
        background: linear-gradient(135deg, #0f172a 0%, #1E4D8C 100%);
        overflow: hidden;
    }
    .page-hero-pattern {
        position: absolute; inset: 0; opacity: 0.06;
        background-image: radial-gradient(circle at 25% 25%, white 1px, transparent 1px),
                          radial-gradient(circle at 75% 75%, white 1px, transparent 1px);
        background-size: 40px 40px;
    }
    .page-hero-img {
        position: absolute; right: 0; top: 0; bottom: 0; width: 45%;
        background-image: url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80');
        background-size: cover; background-position: center;
        mask-image: linear-gradient(to right, transparent 0%, black 40%);
        -webkit-mask-image: linear-gradient(to right, transparent 0%, black 40%);
        opacity: 0.25;
    }
    .filter-card {
        background: white; border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,.06), 0 4px 12px rgba(0,0,0,.06);
    }
    .filter-link {
        display: block; padding: 0.5rem 0.875rem; border-radius: 0.5rem;
        font-size: 0.875rem; text-decoration: none; transition: all 0.15s;
        color: #374151; font-weight: 500;
    }
    .filter-link:hover { background: #f0f7ff; color: var(--azul); }
    .filter-link.active { background: var(--azul); color: white; font-weight: 700; }
    @media (max-width: 768px) { .page-hero-img { display: none; } }
</style>

{{-- Hero --}}
<section class="page-hero">
    <div class="page-hero-pattern"></div>
    <div class="page-hero-img"></div>
    <div class="container" style="position:relative; z-index:1;">
        <span class="section-label">Formación profesional</span>
        <h1 style="font-size:clamp(1.75rem,5vw,2.75rem); font-weight:900; color:white; margin:0.5rem 0 0.75rem; letter-spacing:-0.02em;">
            Nuestros cursos
        </h1>
        <p style="color:rgba(255,255,255,.7); font-size:1rem; max-width:460px; line-height:1.7;">
            Formación práctica y especializada para profesionales que buscan avanzar.
        </p>
    </div>
</section>

<section class="section" style="background:#f8fafc;">
    <div class="container">
        <div class="layout-sidebar">

            {{-- Sidebar --}}
            <aside class="layout-sidebar-aside">
                <div class="filter-card" style="margin-bottom:1.25rem;">
                    <p style="font-size:0.72rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#9ca3af; margin-bottom:1rem;">Categorías</p>
                    <div style="display:flex; flex-direction:column; gap:0.25rem;">
                        <a href="{{ route('cursos.index', request()->except('categoria')) }}"
                           class="filter-link {{ !request('categoria') ? 'active' : '' }}">
                            Todas las categorías
                        </a>
                        @foreach ($categorias as $cat)
                            <a href="{{ route('cursos.index', array_merge(request()->query(), ['categoria' => $cat->slug])) }}"
                               class="filter-link {{ request('categoria') === $cat->slug ? 'active' : '' }}">
                                {{ $cat->nombre }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- CTA lateral --}}
                <div style="background:linear-gradient(135deg,var(--azul),var(--azul-dark)); border-radius:1rem; padding:1.5rem; text-align:center;">
                    <div style="font-size:2rem; margin-bottom:0.75rem;">🎓</div>
                    <p style="color:white; font-weight:700; font-size:0.95rem; margin-bottom:0.5rem;">¿No encuentras lo que buscas?</p>
                    <p style="color:rgba(255,255,255,.7); font-size:0.8rem; margin-bottom:1.25rem; line-height:1.5;">Contáctanos y te orientamos.</p>
                    <a href="{{ route('contacto.index') }}" class="btn btn-naranja" style="display:block; text-align:center; font-size:0.875rem; padding:0.625rem;">Contactar</a>
                </div>
            </aside>

            {{-- Main --}}
            <div class="layout-sidebar-main">
                {{-- Buscador --}}
                <form method="GET" action="{{ route('cursos.index') }}"
                      style="display:flex; gap:0.625rem; margin-bottom:2rem; flex-wrap:wrap;">
                    @if (request('categoria'))
                        <input type="hidden" name="categoria" value="{{ request('categoria') }}">
                    @endif
                    <div style="flex:1; min-width:0; position:relative;">
                        <svg style="position:absolute; left:0.875rem; top:50%; transform:translateY(-50%); color:#9ca3af;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <input type="text" name="buscar" value="{{ request('buscar') }}"
                               placeholder="Buscar cursos..."
                               style="width:100%; padding:0.7rem 1rem 0.7rem 2.5rem; border:1.5px solid #e5e7eb; border-radius:0.625rem; font-size:0.9rem; outline:none; transition:border-color 0.15s; font-family:inherit;"
                               onfocus="this.style.borderColor='#1E4D8C'" onblur="this.style.borderColor='#e5e7eb'">
                    </div>
                    <button type="submit" class="btn btn-primary" style="padding:0.7rem 1.25rem;">Buscar</button>
                    @if (request()->hasAny(['buscar','categoria']))
                        <a href="{{ route('cursos.index') }}" class="btn btn-outline" style="padding:0.7rem 1rem;">✕</a>
                    @endif
                </form>

                @forelse ($cursos as $curso)
                    @if ($loop->first) <div class="grid-3"> @endif

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
                            <h3 style="font-size:1rem; font-weight:700; color:#111827; margin-bottom:0.5rem; line-height:1.4;">{{ $curso->titulo }}</h3>
                            <p style="font-size:0.875rem; color:#6b7280; line-height:1.65; flex:1; margin-bottom:1rem;">{{ Str::limit($curso->descripcion, 100) }}</p>
                            @if ($curso->duracion)
                                <div style="display:flex; align-items:center; gap:0.4rem; font-size:0.8rem; color:#9ca3af; margin-bottom:1rem;">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    {{ $curso->duracion }}
                                </div>
                            @endif
                            <a href="{{ route('cursos.show', $curso->slug) }}" class="btn btn-primary" style="justify-content:center; width:100%;">Ver curso</a>
                        </div>
                    </div>

                    @if ($loop->last) </div> @endif
                @empty
                    <div style="text-align:center; padding:4rem 2rem; background:white; border-radius:1rem; border:1.5px dashed #e5e7eb;">
                        <div style="font-size:3.5rem; margin-bottom:1rem;">🔍</div>
                        <p style="color:#6b7280; margin-bottom:1.5rem;">No se encontraron cursos con esos criterios.</p>
                        <a href="{{ route('cursos.index') }}" class="btn btn-primary">Ver todos</a>
                    </div>
                @endforelse

                @if ($cursos->hasPages())
                    <div style="margin-top:2.5rem; display:flex; justify-content:center; gap:0.5rem; flex-wrap:wrap;">
                        @if ($cursos->onFirstPage())
                            <span style="padding:0.5rem 1rem; border-radius:0.5rem; font-size:0.875rem; color:#9ca3af; background:#f3f4f6;">← Ant.</span>
                        @else
                            <a href="{{ $cursos->previousPageUrl() }}" style="padding:0.5rem 1rem; border-radius:0.5rem; font-size:0.875rem; background:white; color:var(--azul); text-decoration:none; border:1.5px solid #e5e7eb;">← Ant.</a>
                        @endif
                        @foreach ($cursos->links()->elements[0] ?? [] as $page => $url)
                            <a href="{{ $url }}" style="padding:0.5rem 0.875rem; border-radius:0.5rem; font-size:0.875rem; text-decoration:none; background:{{ $cursos->currentPage()==$page ? 'var(--azul)' : 'white' }}; color:{{ $cursos->currentPage()==$page ? 'white' : '#374151' }}; border:1.5px solid {{ $cursos->currentPage()==$page ? 'var(--azul)' : '#e5e7eb' }};">{{ $page }}</a>
                        @endforeach
                        @if ($cursos->hasMorePages())
                            <a href="{{ $cursos->nextPageUrl() }}" style="padding:0.5rem 1rem; border-radius:0.5rem; font-size:0.875rem; background:white; color:var(--azul); text-decoration:none; border:1.5px solid #e5e7eb;">Sig. →</a>
                        @else
                            <span style="padding:0.5rem 1rem; border-radius:0.5rem; font-size:0.875rem; color:#9ca3af; background:#f3f4f6;">Sig. →</span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
