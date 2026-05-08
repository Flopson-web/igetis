@extends('layouts.public')
@section('titulo', 'Contacto')
@section('descripcion', 'Contacta con IGETIS para más información sobre nuestros cursos')

@php $waNumeroContacto = preg_replace('/\D/', '', \App\Models\Configuracion::get('whatsapp_numero', '')); @endphp

@section('contenido')
<style>
    .contacto-hero {
        position: relative;
        background: linear-gradient(135deg, #0f172a 0%, #1E4D8C 100%);
        padding: 5rem 1.5rem 4rem;
        overflow: hidden;
    }
    .contacto-hero-img {
        position: absolute; right: 0; top: 0; bottom: 0; width: 45%;
        background-image: url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80');
        background-size: cover; background-position: center;
        mask-image: linear-gradient(to right, transparent, black 35%);
        -webkit-mask-image: linear-gradient(to right, transparent, black 35%);
        opacity: 0.2;
    }
    .input-group { display: flex; flex-direction: column; gap: 0.4rem; }
    .input-label { font-size: 0.85rem; font-weight: 600; color: #374151; }
    .input-field {
        padding: 0.75rem 1rem; border: 1.5px solid #e5e7eb; border-radius: 0.625rem;
        font-size: 0.9rem; outline: none; transition: border-color 0.15s, box-shadow 0.15s;
        font-family: inherit; width: 100%; box-sizing: border-box; background: white;
    }
    .input-field:focus { border-color: #1E4D8C; box-shadow: 0 0 0 3px rgba(30,77,140,.1); }
    .input-error { border-color: #f87171 !important; }
    .error-msg { font-size: 0.78rem; color: #dc2626; margin-top: 0.25rem; }
    .contact-info-item {
        display: flex; align-items: flex-start; gap: 1rem;
        padding: 1.25rem; border-radius: 0.875rem;
        background: #f8fafc; border: 1px solid #f1f5f9;
        margin-bottom: 0.875rem; transition: all 0.2s;
    }
    .contact-info-item:hover { border-color: #bfdbfe; background: #f0f7ff; }
    .contact-icon {
        width: 42px; height: 42px; border-radius: 0.625rem; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
    }
    @media (max-width: 768px) { .contacto-hero-img { display: none; } }
</style>

<section class="contacto-hero">
    <div class="contacto-hero-img"></div>
    <div style="position:absolute; inset:0; opacity:.04; background-image:radial-gradient(circle at 20% 50%, white 1px, transparent 1px); background-size:32px 32px;"></div>
    <div class="container" style="position:relative; z-index:1;">
        <span class="section-label">Estamos aquí</span>
        <h1 style="font-size:clamp(1.75rem,5vw,2.75rem); font-weight:900; color:white; margin:0.5rem 0 0.75rem; letter-spacing:-0.02em;">
            Hablemos
        </h1>
        <p style="color:rgba(255,255,255,.7); font-size:1rem; max-width:440px; line-height:1.7;">
            Cuéntanos qué necesitas y te orientamos sin compromiso.
        </p>
    </div>
</section>

<section class="section" style="background:#f8fafc;">
    <div class="container">
        <div class="layout-sidebar">

            {{-- Formulario --}}
            <div class="layout-sidebar-main">
                <div style="background:white; border-radius:1.25rem; padding:2.5rem; box-shadow:0 1px 3px rgba(0,0,0,.06), 0 4px 12px rgba(0,0,0,.06);">
                    <h2 style="font-size:1.375rem; font-weight:800; color:#111827; margin-bottom:0.375rem;">Envíanos un mensaje</h2>
                    <p style="color:#6b7280; font-size:0.875rem; margin-bottom:2rem; line-height:1.6;">Te responderemos lo antes posible.</p>

                    <form method="POST" action="{{ route('contacto.store') }}" style="display:flex; flex-direction:column; gap:1.25rem;" id="contacto-form">
                        @csrf
                        {{-- honeypot: invisible para humanos, los bots lo llenan --}}
                        <div style="position:absolute;left:-9999px;top:-9999px;opacity:0;pointer-events:none;" aria-hidden="true">
                            <input type="text" name="_website_url" value="" tabindex="-1" autocomplete="off">
                        </div>
                        @if(config('services.recaptcha.site_key'))
                            <input type="hidden" name="recaptcha_token" id="recaptcha_token">
                        @endif
                        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%,200px),1fr)); gap:1.25rem;">
                            <div class="input-group">
                                <label class="input-label">Nombre *</label>
                                <input type="text" name="nombre" value="{{ old('nombre') }}"
                                       placeholder="Tu nombre completo"
                                       class="input-field {{ $errors->has('nombre') ? 'input-error' : '' }}">
                                @error('nombre') <span class="error-msg">{{ $message }}</span> @enderror
                            </div>
                            <div class="input-group">
                                <label class="input-label">Correo electrónico *</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       placeholder="tu@correo.com"
                                       class="input-field {{ $errors->has('email') ? 'input-error' : '' }}">
                                @error('email') <span class="error-msg">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="input-group">
                            <label class="input-label">Teléfono <span style="font-weight:400; color:#9ca3af;">(opcional)</span></label>
                            <input type="tel" name="telefono" value="{{ old('telefono') }}"
                                   placeholder="+591 70 000 000"
                                   class="input-field" style="max-width:300px;">
                        </div>

                        <div class="input-group">
                            <label class="input-label">Mensaje *</label>
                            <textarea name="mensaje" rows="5"
                                      placeholder="¿En qué podemos ayudarte? Cuéntanos sobre el curso que te interesa..."
                                      class="input-field {{ $errors->has('mensaje') ? 'input-error' : '' }}"
                                      style="resize:vertical;">{{ old('mensaje') }}</textarea>
                            @error('mensaje') <span class="error-msg">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <button type="submit" class="btn btn-naranja btn-lg" style="width:100%; justify-content:center;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                                Enviar mensaje
                            </button>
                        </div>
                    </form>

                    @if ($waNumeroContacto)
                        <div style="margin-top:1.5rem; padding-top:1.5rem; border-top:1px solid #f1f5f9; text-align:center;">
                            <p style="font-size:0.8rem; color:#9ca3af; margin-bottom:1rem;">— o contacta directamente —</p>
                            <a href="https://wa.me/{{ $waNumeroContacto }}?text={{ rawurlencode('Hola, me gustaría recibir información sobre los cursos de IGETIS.') }}"
                               target="_blank" rel="noopener"
                               style="display:inline-flex; align-items:center; gap:0.625rem; background:#25D366; color:white;
                                      font-weight:700; font-size:0.9rem; padding:0.75rem 1.75rem;
                                      border-radius:0.625rem; text-decoration:none; transition:all 0.2s;
                                      box-shadow:0 4px 14px rgba(37,211,102,.35);"
                               onmouseover="this.style.background='#1da851'; this.style.transform='translateY(-2px)'"
                               onmouseout="this.style.background='#25D366'; this.style.transform='translateY(0)'">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="20" height="20">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                Contactar por WhatsApp
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Info lateral --}}
            <aside class="layout-sidebar-aside">
                <div class="sidebar-sticky">
                    <div style="background:white; border-radius:1.25rem; padding:1.75rem; box-shadow:0 1px 3px rgba(0,0,0,.06), 0 4px 12px rgba(0,0,0,.06); margin-bottom:1.25rem;">
                        <h3 style="font-size:1rem; font-weight:700; color:#111827; margin-bottom:1.5rem;">Información de contacto</h3>

                        @if ($config['telefono'])
                            <div class="contact-info-item">
                                <div class="contact-icon" style="background:#dbeafe;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8a19.79 19.79 0 01-3.07-8.67A2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.91a16 16 0 006.18 6.18l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                                </div>
                                <div>
                                    <p style="font-size:0.72rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:#9ca3af; margin-bottom:0.25rem;">Teléfono</p>
                                    <p style="font-size:0.95rem; font-weight:600; color:#111827;">{{ $config['telefono'] }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($config['email'])
                            <div class="contact-info-item">
                                <div class="contact-icon" style="background:#dcfce7;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                </div>
                                <div>
                                    <p style="font-size:0.72rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:#9ca3af; margin-bottom:0.25rem;">Correo</p>
                                    <a href="mailto:{{ $config['email'] }}" style="font-size:0.9rem; font-weight:600; color:#1E4D8C; text-decoration:none; word-break:break-all;">{{ $config['email'] }}</a>
                                </div>
                            </div>
                        @endif

                        @if ($config['horario'])
                            <div class="contact-info-item" style="margin-bottom:0;">
                                <div class="contact-icon" style="background:#fef9c3;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#92400e" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </div>
                                <div>
                                    <p style="font-size:0.72rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:#9ca3af; margin-bottom:0.25rem;">Horario</p>
                                    <p style="font-size:0.9rem; font-weight:600; color:#111827;">{{ $config['horario'] }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div style="background:linear-gradient(135deg,#f0f7ff,#e0f2fe); border:1px solid #bfdbfe; border-radius:1rem; padding:1.25rem;">
                        <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:0.75rem;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            <span style="font-size:0.82rem; font-weight:700; color:#1d4ed8;">Consejo</span>
                        </div>
                        <p style="font-size:0.82rem; color:#1e40af; line-height:1.6;">
                            Menciona el curso que te interesa en tu mensaje y te enviamos el programa completo.
                        </p>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
@if(config('services.recaptcha.site_key'))
@push('scripts')
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
<script>
grecaptcha.ready(function () {
    document.getElementById('contacto-form').addEventListener('submit', function (e) {
        e.preventDefault();
        var form = this;
        grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', { action: 'contacto' })
            .then(function (token) {
                document.getElementById('recaptcha_token').value = token;
                form.submit();
            });
    });
});
</script>
@endpush
@endif

@endsection
