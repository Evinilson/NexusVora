@php
    $homeUrl = route('home');
    $servicesUrl = route('services');
    $isHome = request()->routeIs('home');
    $isServices = request()->routeIs('services');
@endphp

@once
<style>
    /* ── Hamburger button ── */
    .nav-hamburger {
        display: none;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 5px;
        width: 40px;
        height: 40px;
        padding: 8px;
        background: none;
        border: 1px solid var(--navy-border);
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.2s ease, border-color 0.2s ease;
        z-index: 101;
    }

    .nav-hamburger:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.15);
    }

    .nav-hamburger span {
        display: block;
        width: 20px;
        height: 2px;
        background: var(--text);
        border-radius: 2px;
        transition: transform 0.35s cubic-bezier(0.23, 1, 0.32, 1),
                    opacity 0.25s ease,
                    width 0.25s ease;
        transform-origin: center;
    }

    .nav-hamburger.is-open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    .nav-hamburger.is-open span:nth-child(2) { opacity: 0; width: 0; }
    .nav-hamburger.is-open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

    /* ── Mobile menu overlay ── */
    .mobile-menu {
        position: fixed;
        top: 72px;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 98;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: rgba(6, 11, 32, 0.97);
        backdrop-filter: blur(24px);
        opacity: 0;
        pointer-events: none;
        transform: translateY(-10px);
        transition: opacity 0.35s ease, transform 0.35s ease;
        overflow: hidden;
    }

    .mobile-menu.is-open {
        opacity: 1;
        pointer-events: all;
        transform: translateY(0);
    }

    .mobile-menu-glow {
        position: absolute;
        top: -80px;
        left: 50%;
        transform: translateX(-50%);
        width: 500px;
        height: 400px;
        background: radial-gradient(circle, rgba(74, 108, 247, 0.12) 0%, transparent 70%);
        pointer-events: none;
    }

    .mobile-menu-inner {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        padding: 0 24px;
    }

    .mobile-nav-links {
        list-style: none;
        text-align: center;
        width: 100%;
        margin-bottom: 36px;
    }

    .mobile-nav-links li {
        opacity: 0;
        transform: translateY(16px);
        transition: opacity 0.35s ease, transform 0.35s ease;
    }

    .mobile-menu.is-open .mobile-nav-links li:nth-child(1) { opacity: 1; transform: translateY(0); transition-delay: 0.06s; }
    .mobile-menu.is-open .mobile-nav-links li:nth-child(2) { opacity: 1; transform: translateY(0); transition-delay: 0.12s; }
    .mobile-menu.is-open .mobile-nav-links li:nth-child(3) { opacity: 1; transform: translateY(0); transition-delay: 0.18s; }
    .mobile-menu.is-open .mobile-nav-links li:nth-child(4) { opacity: 1; transform: translateY(0); transition-delay: 0.24s; }

    .mobile-nav-links a {
        display: block;
        padding: 16px 24px;
        color: var(--text-muted);
        font-family: "Plus Jakarta Sans", sans-serif;
        font-size: 1.55rem;
        font-weight: 700;
        letter-spacing: -0.02em;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .mobile-nav-links a:hover { color: #fff; }

    .mobile-menu-divider {
        width: 48px;
        height: 2px;
        background: var(--grad);
        border-radius: 999px;
        margin-bottom: 36px;
        opacity: 0;
        transition: opacity 0.35s ease 0.28s;
    }

    .mobile-menu.is-open .mobile-menu-divider { opacity: 1; }

    .mobile-cta {
        opacity: 0;
        transform: translateY(12px);
        padding: 16px 40px;
        border-radius: 10px;
        font-size: 1rem;
        box-shadow: 0 8px 32px rgba(74, 108, 247, 0.35);
        transition: opacity 0.35s ease 0.32s, transform 0.35s ease 0.32s,
                    box-shadow 0.2s ease;
    }

    .mobile-menu.is-open .mobile-cta { opacity: 1; transform: translateY(0); }

    @media (max-width: 900px) {
        .nav-links { display: none; }
        .nav-hamburger { display: flex; }
    }
</style>
@endonce

<nav>
    <a href="{{ $homeUrl }}" class="nav-logo" aria-label="NexusVora">
        <svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="ng" x1="0" y1="0" x2="60" y2="60" gradientUnits="userSpaceOnUse">
                    <stop offset="0%" stop-color="#00D4FF"/>
                    <stop offset="50%" stop-color="#4A6CF7"/>
                    <stop offset="100%" stop-color="#8B3FDB"/>
                </linearGradient>
            </defs>
            <circle cx="30" cy="30" r="7" stroke="url(#ng)" stroke-width="2.5" fill="none"/>
            <circle cx="30" cy="30" r="3" fill="url(#ng)"/>
            <line x1="30" y1="23" x2="30" y2="10" stroke="url(#ng)" stroke-width="2" stroke-linecap="round"/>
            <circle cx="30" cy="8" r="3" fill="url(#ng)"/>
            <line x1="30" y1="37" x2="30" y2="50" stroke="url(#ng)" stroke-width="2" stroke-linecap="round"/>
            <circle cx="30" cy="52" r="3" fill="url(#ng)"/>
            <line x1="23" y1="30" x2="10" y2="30" stroke="url(#ng)" stroke-width="2" stroke-linecap="round"/>
            <circle cx="8" cy="30" r="3" fill="url(#ng)"/>
            <line x1="37" y1="30" x2="50" y2="30" stroke="url(#ng)" stroke-width="2" stroke-linecap="round"/>
            <circle cx="52" cy="30" r="3" fill="url(#ng)"/>
            <line x1="25" y1="25" x2="16" y2="16" stroke="url(#ng)" stroke-width="2" stroke-linecap="round"/>
            <circle cx="13.5" cy="13.5" r="3" fill="url(#ng)"/>
            <line x1="35" y1="35" x2="44" y2="44" stroke="url(#ng)" stroke-width="2" stroke-linecap="round"/>
            <circle cx="46.5" cy="46.5" r="3" fill="url(#ng)"/>
            <line x1="35" y1="25" x2="44" y2="16" stroke="url(#ng)" stroke-width="2" stroke-linecap="round"/>
            <circle cx="46.5" cy="13.5" r="3" fill="url(#ng)"/>
            <line x1="25" y1="35" x2="16" y2="44" stroke="url(#ng)" stroke-width="2" stroke-linecap="round"/>
            <circle cx="13.5" cy="46.5" r="3" fill="url(#ng)"/>
        </svg>
        <span class="nav-logo-text"><span>Nexus</span><span>Vora</span></span>
    </a>

    <ul class="nav-links">
        <li><a href="{{ $servicesUrl }}" @class(['active' => $isServices])>Serviços</a></li>
        <li><a href="{{ $homeUrl }}#porquenos">Porquê Nós</a></li>
        <li><a href="{{ $homeUrl }}#depoimentos">Clientes</a></li>
        <li><a href="{{ $homeUrl }}#portfolio">Portfólio</a></li>
    </ul>

    <a href="{{ $homeUrl }}#cta-final" class="nav-cta">Fale Connosco</a>

    <button class="nav-hamburger" aria-label="Abrir menu" aria-expanded="false" aria-controls="mobile-menu">
        <span></span>
        <span></span>
        <span></span>
    </button>
</nav>

<div class="mobile-menu" id="mobile-menu" aria-hidden="true">
    <div class="mobile-menu-glow"></div>
    <div class="mobile-menu-inner">
        <ul class="mobile-nav-links">
            <li><a href="{{ $servicesUrl }}">Serviços</a></li>
            <li><a href="{{ $homeUrl }}#porquenos">Porquê Nós</a></li>
            <li><a href="{{ $homeUrl }}#depoimentos">Clientes</a></li>
            <li><a href="{{ $homeUrl }}#portfolio">Portfólio</a></li>
        </ul>
        <div class="mobile-menu-divider"></div>
        <a href="{{ $homeUrl }}#cta-final" class="btn-primary mobile-cta">
            Fale Connosco
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>
</div>

@once
<script>
    (function () {
        const hamburger = document.querySelector(".nav-hamburger");
        const mobileMenu = document.getElementById("mobile-menu");
        const mobileLinks = mobileMenu.querySelectorAll("a");

        function openMenu() {
            hamburger.classList.add("is-open");
            mobileMenu.classList.add("is-open");
            hamburger.setAttribute("aria-expanded", "true");
            mobileMenu.setAttribute("aria-hidden", "false");
            document.body.style.overflow = "hidden";
        }

        function closeMenu() {
            hamburger.classList.remove("is-open");
            mobileMenu.classList.remove("is-open");
            hamburger.setAttribute("aria-expanded", "false");
            mobileMenu.setAttribute("aria-hidden", "true");
            document.body.style.overflow = "";
        }

        hamburger.addEventListener("click", () => {
            hamburger.classList.contains("is-open") ? closeMenu() : openMenu();
        });

        mobileLinks.forEach((link) => link.addEventListener("click", closeMenu));

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") closeMenu();
        });
    })();
</script>
@endonce
