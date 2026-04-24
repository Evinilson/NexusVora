@once
<style>
    /* ── GLOBAL FOOTER STYLES ── */
    footer {
        background: var(--navy2);
        border-top: 1px solid var(--navy-border);
        padding: 64px 5vw 40px;
    }

    .footer-inner {
        max-width: 1100px;
        margin: 0 auto;
    }

    .footer-top {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 48px;
        padding-bottom: 48px;
        border-bottom: 1px solid var(--navy-border);
    }

    .footer-brand p {
        max-width: 280px;
        margin-top: 16px;
        font-size: 0.875rem;
        line-height: 1.7;
        color: var(--text-muted);
    }

    .footer-col h5 {
        margin-bottom: 18px;
        color: #fff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    .footer-col ul {
        display: flex;
        flex-direction: column;
        gap: 10px;
        list-style: none;
    }

    .footer-col ul a {
        color: var(--text-muted);
        font-size: 0.875rem;
        text-decoration: none;
        transition: color .2s ease;
    }

    .footer-col ul a:hover {
        color: var(--cyan);
    }

    .footer-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding-top: 32px;
    }

    .footer-bottom p {
        color: var(--text-muted);
        font-size: 0.8rem;
    }

    .footer-bottom a {
        text-decoration: none;
        color: inherit;
        transition: color .2s ease;
    }

    .footer-bottom a:hover {
        color: var(--cyan);
    }

    /* ── LOGO STYLES (Shared) ── */
    .nav-logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
    .nav-logo-text { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 1.3rem; letter-spacing: -0.02em; }
    .nav-logo-text span:first-child { color: #DCEBFF; transition: color 0.3s ease; }
    .nav-logo-text span:last-child { color: var(--cyan); }

    @media (max-width: 900px) {
        .footer-top { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 640px) {
        .footer-top { grid-template-columns: 1fr; }
        .footer-bottom { align-items: flex-start; flex-direction: column; }
    }
</style>
@endonce

@php
    $homeUrl = route('home');
    $servicesUrl = route('services');
@endphp

<footer>
    <div class="footer-inner">
        <div class="footer-top">
            <div class="footer-brand">
                <a href="{{ $homeUrl }}" class="nav-logo">
                    <svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 30px; height: 30px;">
                        <defs>
                            <linearGradient id="ng2" x1="0" y1="0" x2="60" y2="60" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#00D4FF"/>
                                <stop offset="50%" stop-color="#4A6CF7"/>
                                <stop offset="100%" stop-color="#8B3FDB"/>
                            </linearGradient>
                        </defs>
                        <circle cx="30" cy="30" r="7" stroke="url(#ng2)" stroke-width="2.5" fill="none"/>
                        <circle cx="30" cy="30" r="3" fill="url(#ng2)"/>
                        <line x1="30" y1="23" x2="30" y2="10" stroke="url(#ng2)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="30" cy="8" r="3" fill="url(#ng2)"/>
                        <line x1="30" y1="37" x2="30" y2="50" stroke="url(#ng2)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="30" cy="52" r="3" fill="url(#ng2)"/>
                        <line x1="23" y1="30" x2="10" y2="30" stroke="url(#ng2)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="8" cy="30" r="3" fill="url(#ng2)"/>
                        <line x1="37" y1="30" x2="50" y2="30" stroke="url(#ng2)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="52" cy="30" r="3" fill="url(#ng2)"/>
                        <line x1="25" y1="25" x2="16" y2="16" stroke="url(#ng2)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="13.5" cy="13.5" r="3" fill="url(#ng2)"/>
                        <line x1="35" y1="35" x2="44" y2="44" stroke="url(#ng2)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="46.5" cy="46.5" r="3" fill="url(#ng2)"/>
                        <line x1="35" y1="25" x2="44" y2="16" stroke="url(#ng2)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="46.5" cy="13.5" r="3" fill="url(#ng2)"/>
                        <line x1="25" y1="35" x2="16" y2="44" stroke="url(#ng2)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="13.5" cy="46.5" r="3" fill="url(#ng2)"/>
                    </svg>
                    <span class="nav-logo-text"><span>Nexus</span><span>Vora</span></span>
                </a>
                <p>Agência de marketing digital full-service focada em PMEs e concessionários automóveis da região do Porto, Gaia e Maia.</p>
            </div>

            <div class="footer-col">
                <h5>Serviços</h5>
                <ul>
                    <li><a href="{{ $servicesUrl }}#web">Desenvolvimento Web</a></li>
                    <li><a href="{{ $servicesUrl }}#social">Redes Sociais</a></li>
                    <li><a href="{{ $servicesUrl }}#google">Google Ads</a></li>
                    <li><a href="{{ $servicesUrl }}#meta">Meta Ads</a></li>
                    <li><a href="{{ $servicesUrl }}#seo">SEO</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h5>Empresa</h5>
                <ul>
                    <li><a href="{{ $homeUrl }}#porquenos">Sobre Nós</a></li>
                    <li><a href="{{ $homeUrl }}#portfolio">Portfólio</a></li>
                    <li><a href="{{ $homeUrl }}#portfolio">Casos de Sucesso</a></li>
                    <li><a href="{{ $homeUrl }}#cta-final">Contacto</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h5>Contacto</h5>
                <ul>
                    <li><a href="{{ $homeUrl }}#cta-final">Porto / Gaia / Maia</a></li>
                    <li><a href="mailto:geral@nexusvora.pt">geral@nexusvora.pt</a></li>
                    <li><a href="tel:+351220000000">+351 220 000 000</a></li>
                    <li><a href="https://www.linkedin.com" target="_blank" rel="noreferrer">LinkedIn</a></li>
                    <li><a href="https://www.instagram.com" target="_blank" rel="noreferrer">Instagram</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2026 NexusVora. Todos os direitos reservados.</p>
            <p><a href="{{ route('privacidade') }}">Política de Privacidade</a> · <a href="{{ route('termos') }}">Termos de Serviço</a></p>
        </div>
    </div>
</footer>
