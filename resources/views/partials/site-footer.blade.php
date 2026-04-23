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
            <p>Política de Privacidade · Termos de Serviço</p>
        </div>
    </div>
</footer>
