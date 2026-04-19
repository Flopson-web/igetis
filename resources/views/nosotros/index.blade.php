@extends('layouts.public')
@section('titulo', 'Nosotros')
@section('descripcion', 'Conoce al equipo de IGETIS, nuestra misión, visión y dónde encontrarnos')

@section('contenido')
<style>
    .nosotros-hero {
        position: relative; padding: 5rem 1.5rem 4rem;
        background: linear-gradient(135deg, #0f172a 0%, #1E4D8C 100%);
        overflow: hidden;
    }
    .nosotros-hero-img {
        position: absolute; right: 0; top: 0; bottom: 0; width: 45%;
        background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80');
        background-size: cover; background-position: center;
        mask-image: linear-gradient(to right, transparent, black 40%);
        -webkit-mask-image: linear-gradient(to right, transparent, black 40%);
        opacity: 0.2;
    }

    /* Misión / Visión */
    .mv-card {
        background: white; border-radius: 1.25rem; padding: 2.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,.06), 0 4px 12px rgba(0,0,0,.06);
        border-top: 4px solid var(--azul); flex: 1;
    }
    .mv-card.naranja { border-top-color: var(--naranja); }
    .mv-icon {
        width: 52px; height: 52px; border-radius: 0.875rem;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 1.25rem;
    }

    /* Docentes */
    .docente-card {
        background: white; border-radius: 1.25rem; overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,.06), 0 4px 12px rgba(0,0,0,.06);
        transition: transform 0.25s, box-shadow 0.25s;
        display: flex; flex-direction: column;
    }
    .docente-card:hover { transform: translateY(-5px); box-shadow: 0 8px 30px rgba(0,0,0,.12); }
    .docente-foto {
        height: 220px; overflow: hidden; position: relative; flex-shrink: 0;
    }
    .docente-foto img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
    .docente-card:hover .docente-foto img { transform: scale(1.06); }
    .docente-foto-placeholder {
        height: 220px; display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, #1E4D8C, #2E6DB4);
        font-size: 4rem; flex-shrink: 0;
    }
    .docente-body { padding: 1.5rem; flex: 1; display: flex; flex-direction: column; }

    /* Info contacto */
    .info-item {
        display: flex; align-items: flex-start; gap: 1rem;
        padding: 1.25rem; border-radius: 0.875rem;
        background: #f8fafc; border: 1px solid #f1f5f9; margin-bottom: 0.875rem;
        transition: all 0.2s;
    }
    .info-item:hover { border-color: #bfdbfe; background: #f0f7ff; }
    .info-icon {
        width: 44px; height: 44px; border-radius: 0.625rem; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
    }

    /* Redes sociales */
    .social-btn {
        display: inline-flex; align-items: center; gap: 0.625rem;
        padding: 0.75rem 1.25rem; border-radius: 0.625rem;
        font-size: 0.875rem; font-weight: 600; text-decoration: none;
        transition: all 0.2s; border: 1.5px solid #e5e7eb; color: #374151;
        background: white;
    }
    .social-btn:hover { border-color: var(--azul); color: var(--azul); transform: translateY(-2px); }

    @media (max-width: 768px) {
        .nosotros-hero-img { display: none; }
        .mv-grid { flex-direction: column; }
    }
</style>

{{-- Hero --}}
<section class="nosotros-hero">
    <div class="nosotros-hero-img"></div>
    <div style="position:absolute; inset:0; opacity:.04; background-image:radial-gradient(circle at 20% 50%, white 1px, transparent 1px); background-size:32px 32px;"></div>
    <div class="container" style="position:relative; z-index:1;">
        <span class="section-label">Quiénes somos</span>
        <h1 style="font-size:clamp(1.75rem,5vw,2.75rem); font-weight:900; color:white; margin:0.5rem 0 0.75rem; letter-spacing:-0.02em;">
            Sobre IGETIS
        </h1>
        <p style="color:rgba(255,255,255,.7); font-size:1rem; max-width:480px; line-height:1.7;">
            Somos un instituto comprometido con la formación de profesionales capaces de transformar su entorno.
        </p>
    </div>
</section>

{{-- Misión y Visión --}}
@if ($config['mision'] || $config['vision'])
<section class="section" style="background:#f8fafc;">
    <div class="container">
        <div style="text-align:center; margin-bottom:3rem;">
            <span class="section-label">Nuestra razón de ser</span>
            <h2 class="section-title">Misión y Visión</h2>
        </div>
        <div class="mv-grid" style="display:flex; gap:1.75rem; flex-wrap:wrap;">
            @if ($config['mision'])
            <div class="mv-card animate-fade-up">
                <div class="mv-icon" style="background:#dbeafe;">
                    <svg width="26" height="26" fill="none" stroke="#1d4ed8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 style="font-size:1.25rem; font-weight:800; color:#111827; margin-bottom:0.875rem;">Misión</h3>
                <p style="color:#6b7280; line-height:1.8; font-size:0.95rem;">{{ $config['mision'] }}</p>
            </div>
            @endif
            @if ($config['vision'])
            <div class="mv-card naranja animate-fade-up delay-100">
                <div class="mv-icon" style="background:#ffedd5;">
                    <svg width="26" height="26" fill="none" stroke="#c2410c" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h3 style="font-size:1.25rem; font-weight:800; color:#111827; margin-bottom:0.875rem;">Visión</h3>
                <p style="color:#6b7280; line-height:1.8; font-size:0.95rem;">{{ $config['vision'] }}</p>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

{{-- Valores --}}
<section class="section" style="background:white;">
    <div class="container">
        <div style="text-align:center; margin-bottom:3rem;">
            <span class="section-label">Lo que nos define</span>
            <h2 class="section-title">Nuestros valores</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%,220px),1fr)); gap:1.5rem;">
            @foreach ([
                ['bg'=>'linear-gradient(135deg,#dbeafe,#bfdbfe)','color'=>'#1d4ed8',
                 'icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                 'titulo'=>'Excelencia','texto'=>'Comprometidos con los más altos estándares académicos y profesionales.'],
                ['bg'=>'linear-gradient(135deg,#dcfce7,#bbf7d0)','color'=>'#15803d',
                 'icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
                 'titulo'=>'Comunidad','texto'=>'Construimos redes de profesionales que se apoyan y crecen juntos.'],
                ['bg'=>'linear-gradient(135deg,#fef9c3,#fde68a)','color'=>'#92400e',
                 'icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>',
                 'titulo'=>'Innovación','texto'=>'Actualizamos constantemente nuestros programas al ritmo del mercado.'],
                ['bg'=>'linear-gradient(135deg,#fce7f3,#fbcfe8)','color'=>'#be185d',
                 'icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
                 'titulo'=>'Compromiso','texto'=>'Acompañamos a cada estudiante en su proceso de crecimiento personal y profesional.'],
            ] as $v)
                <div style="background:white; border-radius:1.25rem; padding:2rem; border:1px solid #f1f5f9; transition:all 0.25s;"
                     onmouseover="this.style.boxShadow='0 8px 32px rgba(30,77,140,.1)'; this.style.borderColor='#bfdbfe'; this.style.transform='translateY(-4px)'"
                     onmouseout="this.style.boxShadow=''; this.style.borderColor='#f1f5f9'; this.style.transform=''">
                    <div style="width:52px; height:52px; border-radius:0.875rem; background:{{ $v['bg'] }}; display:flex; align-items:center; justify-content:center; margin-bottom:1.25rem;">
                        <svg width="24" height="24" fill="none" stroke="{{ $v['color'] }}" viewBox="0 0 24 24">{!! $v['icon'] !!}</svg>
                    </div>
                    <h3 style="font-size:1rem; font-weight:700; color:#111827; margin-bottom:0.5rem;">{{ $v['titulo'] }}</h3>
                    <p style="font-size:0.875rem; color:#6b7280; line-height:1.65;">{{ $v['texto'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Equipo docente --}}
@if ($docentes->isNotEmpty())
<section class="section" style="background:#f8fafc;">
    <div class="container">
        <div style="text-align:center; margin-bottom:3rem;">
            <span class="section-label">Nuestro equipo</span>
            <h2 class="section-title">Docentes y especialistas</h2>
            <p class="section-subtitle" style="margin:0 auto;">Profesionales con experiencia real en sus sectores, comprometidos con tu aprendizaje.</p>
        </div>
        <div class="grid-3">
            @foreach ($docentes as $docente)
                <div class="docente-card">
                    <div class="docente-foto">
                        @if ($docente->foto)
                            <img src="{{ asset('storage/' . $docente->foto) }}" alt="{{ $docente->nombre }}">
                        @else
                            <div class="docente-foto-placeholder">👤</div>
                        @endif
                    </div>
                    <div class="docente-body">
                        <h3 style="font-size:1.05rem; font-weight:700; color:#111827; margin-bottom:0.25rem;">{{ $docente->nombre }}</h3>
                        @if ($docente->cargo)
                            <p style="font-size:0.8rem; font-weight:600; color:var(--naranja); margin-bottom:0.875rem; text-transform:uppercase; letter-spacing:0.05em;">{{ $docente->cargo }}</p>
                        @endif
                        @if ($docente->bio)
                            <p style="font-size:0.875rem; color:#6b7280; line-height:1.65; flex:1;">{{ Str::limit($docente->bio, 140) }}</p>
                        @endif
                        @if ($docente->linkedin)
                            <a href="{{ $docente->linkedin }}" target="_blank" rel="noopener"
                               style="display:inline-flex; align-items:center; gap:0.4rem; font-size:0.8rem; font-weight:600; color:#0077b5; text-decoration:none; margin-top:1rem;">
                                <svg width="16" height="16" fill="#0077b5" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                LinkedIn
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Contacto + Ubicación --}}
<section class="section" style="background:white;">
    <div class="container">
        <div style="text-align:center; margin-bottom:3rem;">
            <span class="section-label">Encuéntranos</span>
            <h2 class="section-title">Información de contacto</h2>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%,320px),1fr)); gap:2rem; align-items:start;">

            {{-- Info --}}
            <div>
                @if ($config['direccion'])
                <div class="info-item">
                    <div class="info-icon" style="background:#dbeafe;">
                        <svg width="20" height="20" fill="none" stroke="#1d4ed8" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <p style="font-size:0.72rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:#9ca3af; margin-bottom:0.25rem;">Dirección</p>
                        <p style="font-size:0.95rem; font-weight:600; color:#111827;">{{ $config['direccion'] }}</p>
                    </div>
                </div>
                @endif

                @if ($config['telefono'])
                <div class="info-item">
                    <div class="info-icon" style="background:#dcfce7;">
                        <svg width="20" height="20" fill="none" stroke="#15803d" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8a19.79 19.79 0 01-3.07-8.67A2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.91a16 16 0 006.18 6.18l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                    </div>
                    <div>
                        <p style="font-size:0.72rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:#9ca3af; margin-bottom:0.25rem;">Teléfono</p>
                        <a href="tel:{{ $config['telefono'] }}" style="font-size:0.95rem; font-weight:600; color:#111827; text-decoration:none;">{{ $config['telefono'] }}</a>
                    </div>
                </div>
                @endif

                @if ($config['email'])
                <div class="info-item">
                    <div class="info-icon" style="background:#fef9c3;">
                        <svg width="20" height="20" fill="none" stroke="#92400e" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div>
                        <p style="font-size:0.72rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:#9ca3af; margin-bottom:0.25rem;">Correo</p>
                        <a href="mailto:{{ $config['email'] }}" style="font-size:0.9rem; font-weight:600; color:var(--azul); text-decoration:none; word-break:break-all;">{{ $config['email'] }}</a>
                    </div>
                </div>
                @endif

                {{-- Redes sociales --}}
                @if ($config['facebook'] || $config['instagram'] || $config['linkedin'] || $config['whatsapp'])
                <div style="margin-top:1.5rem;">
                    <p style="font-size:0.75rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#9ca3af; margin-bottom:1rem;">Síguenos</p>
                    <div style="display:flex; flex-wrap:wrap; gap:0.625rem;">
                        @if ($config['facebook'])
                            <a href="{{ $config['facebook'] }}" target="_blank" rel="noopener" class="social-btn">
                                <svg width="18" height="18" fill="#1877F2" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                Facebook
                            </a>
                        @endif
                        @if ($config['instagram'])
                            <a href="{{ $config['instagram'] }}" target="_blank" rel="noopener" class="social-btn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><defs><linearGradient id="ig" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" style="stop-color:#f09433"/><stop offset="25%" style="stop-color:#e6683c"/><stop offset="50%" style="stop-color:#dc2743"/><stop offset="75%" style="stop-color:#cc2366"/><stop offset="100%" style="stop-color:#bc1888"/></linearGradient></defs><rect width="20" height="20" x="2" y="2" rx="5" ry="5" fill="url(#ig)"/><path fill="white" d="M12 7a5 5 0 100 10A5 5 0 0012 7zm0 8.2A3.2 3.2 0 118.8 12 3.2 3.2 0 0112 15.2zm5.2-8.4a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0z"/></svg>
                                Instagram
                            </a>
                        @endif
                        @if ($config['linkedin'])
                            <a href="{{ $config['linkedin'] }}" target="_blank" rel="noopener" class="social-btn">
                                <svg width="18" height="18" fill="#0077b5" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                LinkedIn
                            </a>
                        @endif
                        @if ($config['whatsapp'])
                            <a href="https://wa.me/{{ $config['whatsapp'] }}" target="_blank" rel="noopener" class="social-btn">
                                <svg width="18" height="18" fill="#25D366" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                WhatsApp
                            </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            {{-- CTA contacto --}}
            <div style="background:linear-gradient(135deg,#0f172a,#1E4D8C); border-radius:1.25rem; padding:2.5rem; text-align:center;">
                <div style="font-size:3rem; margin-bottom:1rem;">💬</div>
                <h3 style="font-size:1.25rem; font-weight:800; color:white; margin-bottom:0.75rem; line-height:1.3;">¿Tienes alguna pregunta?</h3>
                <p style="color:rgba(255,255,255,.65); font-size:0.9rem; line-height:1.7; margin-bottom:2rem;">
                    Nuestro equipo está disponible para orientarte sin compromiso sobre cualquier programa.
                </p>
                <a href="{{ route('contacto.index') }}" class="btn btn-naranja" style="display:block; text-align:center; justify-content:center;">
                    Contactar ahora
                </a>
                @if ($config['whatsapp'])
                    <a href="https://wa.me/{{ $config['whatsapp'] }}?text={{ rawurlencode('Hola, me gustaría recibir información sobre los cursos de IGETIS.') }}"
                       target="_blank" rel="noopener"
                       style="display:block; margin-top:0.875rem; font-size:0.82rem; color:rgba(255,255,255,.6); text-decoration:none; transition:color 0.2s;"
                       onmouseover="this.style.color='rgba(255,255,255,1)'"
                       onmouseout="this.style.color='rgba(255,255,255,.6)'">
                        o escríbenos por WhatsApp →
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
