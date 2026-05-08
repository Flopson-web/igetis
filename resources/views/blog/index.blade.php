@extends('layouts.public')
@section('titulo', 'Blog')
@section('descripcion', 'Artículos y recursos sobre gestión y tecnología')

@section('contenido')
<style>
    .blog-hero {
        position: relative; padding: 5rem 1.5rem 4rem;
        background: linear-gradient(135deg, #0f172a 0%, #1E4D8C 100%);
        overflow: hidden;
    }
    .blog-hero-img {
        position: absolute; right: 0; top: 0; bottom: 0; width: 40%;
        background-image: url('https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=800&q=80');
        background-size: cover; background-position: center;
        mask-image: linear-gradient(to right, transparent, black 40%);
        -webkit-mask-image: linear-gradient(to right, transparent, black 40%);
        opacity: 0.2;
    }
    @media (max-width: 768px) { .blog-hero-img { display: none; } }
</style>

<section class="blog-hero">
    <div class="blog-hero-img"></div>
    <div style="position:absolute; inset:0; opacity:.04; background-image:radial-gradient(circle at 20% 50%, white 1px, transparent 1px); background-size:32px 32px;"></div>
    <div class="container" style="position:relative; z-index:1;">
        <span class="section-label">Recursos</span>
        <h1 style="font-size:clamp(1.75rem,5vw,2.75rem); font-weight:900; color:white; margin:0.5rem 0 0.75rem; letter-spacing:-0.02em;">Blog</h1>
        <p style="color:rgba(255,255,255,.7); font-size:1rem; max-width:440px; line-height:1.7;">
            Artículos, novedades y recursos del sector profesional.
        </p>
    </div>
</section>

<section class="section" style="background:#f8fafc;">
    <div class="container">
        {{-- Buscador --}}
        <form method="GET" action="{{ route('blog.index') }}"
              style="display:flex; gap:0.625rem; max-width:520px; margin-bottom:2.5rem; flex-wrap:wrap;">
            <div style="flex:1; min-width:0; position:relative;">
                <svg style="position:absolute; left:0.875rem; top:50%; transform:translateY(-50%); color:#9ca3af;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" name="buscar" value="{{ request('buscar') }}"
                       placeholder="Buscar artículos..."
                       style="width:100%; padding:0.7rem 1rem 0.7rem 2.5rem; border:1.5px solid #e5e7eb; border-radius:0.625rem; font-size:0.9rem; outline:none; font-family:inherit;"
                       onfocus="this.style.borderColor='#1E4D8C'" onblur="this.style.borderColor='#e5e7eb'">
            </div>
            <button type="submit" class="btn btn-primary" style="padding:0.7rem 1.25rem;">Buscar</button>
            @if (request('buscar'))
                <a href="{{ route('blog.index') }}" class="btn btn-outline" style="padding:0.7rem 1rem;">✕</a>
            @endif
        </form>

        @forelse ($articulos as $articulo)
            @if ($loop->first) <div class="grid-3"> @endif

            <a href="{{ route('blog.show', $articulo->slug) }}" style="text-decoration:none; display:flex;">
                <div class="card" style="width:100%;">
                    <div class="blog-card-img">
                        @if ($articulo->imagen)
                            <img src="{{ asset('storage/' . $articulo->imagen) }}" alt="{{ $articulo->titulo }}">
                        @else
                            <div style="height:200px; background:linear-gradient(135deg,#F97316,#EA6C0A); display:flex; align-items:center; justify-content:center;">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.5)" stroke-width="1.5">
                                    <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div style="padding:1.5rem; flex:1; display:flex; flex-direction:column;">
                        <div style="display:flex; align-items:center; gap:0.4rem; font-size:0.78rem; color:#9ca3af; margin-bottom:0.75rem;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            {{ $articulo->publicado_en->format('d M Y') }}
                            @if ($articulo->autor) <span>·</span> {{ $articulo->autor }} @endif
                        </div>
                        <h3 style="font-size:1rem; font-weight:700; color:#111827; line-height:1.4; flex:1; margin-bottom:1rem;">{{ $articulo->titulo }}</h3>
                        <span style="font-size:0.85rem; font-weight:600; color:var(--azul); display:flex; align-items:center; gap:0.3rem;">
                            Leer artículo
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </span>
                    </div>
                </div>
            </a>

            @if ($loop->last) </div> @endif
        @empty
            <div style="text-align:center; padding:4rem 2rem; background:white; border-radius:1rem; border:1.5px dashed #e5e7eb;">
                <div style="width:56px; height:56px; background:#EFF6FF; border-radius:1rem; display:flex; align-items:center; justify-content:center; margin:0 auto 1.25rem;">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <p style="color:#6b7280; margin-bottom:{{ request('buscar') ? '1.5rem' : '0' }};">
                    {{ request('buscar') ? 'No se encontraron artículos.' : 'Aún no hay artículos publicados.' }}
                </p>
                @if (request('buscar'))
                    <a href="{{ route('blog.index') }}" class="btn btn-primary">Ver todos</a>
                @endif
            </div>
        @endforelse

        @if ($articulos->hasPages())
            <div style="margin-top:2.5rem; display:flex; justify-content:center; gap:0.5rem; flex-wrap:wrap;">
                @if ($articulos->onFirstPage())
                    <span style="padding:0.5rem 1rem; border-radius:0.5rem; font-size:0.875rem; color:#9ca3af; background:#f3f4f6;">← Anterior</span>
                @else
                    <a href="{{ $articulos->previousPageUrl() }}" style="padding:0.5rem 1rem; border-radius:0.5rem; font-size:0.875rem; background:white; color:var(--azul); text-decoration:none; border:1.5px solid #e5e7eb;">← Anterior</a>
                @endif
                @foreach ($articulos->links()->elements[0] ?? [] as $page => $url)
                    <a href="{{ $url }}" style="padding:0.5rem 0.875rem; border-radius:0.5rem; font-size:0.875rem; text-decoration:none; background:{{ $articulos->currentPage()==$page ? 'var(--azul)' : 'white' }}; color:{{ $articulos->currentPage()==$page ? 'white' : '#374151' }}; border:1.5px solid {{ $articulos->currentPage()==$page ? 'var(--azul)' : '#e5e7eb' }};">{{ $page }}</a>
                @endforeach
                @if ($articulos->hasMorePages())
                    <a href="{{ $articulos->nextPageUrl() }}" style="padding:0.5rem 1rem; border-radius:0.5rem; font-size:0.875rem; background:white; color:var(--azul); text-decoration:none; border:1.5px solid #e5e7eb;">Siguiente →</a>
                @else
                    <span style="padding:0.5rem 1rem; border-radius:0.5rem; font-size:0.875rem; color:#9ca3af; background:#f3f4f6;">Siguiente →</span>
                @endif
            </div>
        @endif
    </div>
</section>
@endsection
