@php
    $siteUrl = url('/');
    $currentUrl = url()->current();
    $logoUrl = asset('img/logo/logo_100X100.png');
    $faviconPngUrl = asset('favicon.png');
    $faviconSvgUrl = asset('favicon.svg');
    $faviconIcoUrl = asset('favicon.ico');

    $seo = [
        'home' => [
            'title' => 'NexusVora - Agência Full-Service | Web, Marketing Digital e IA',
            'description' => 'NexusVora é uma agência de marketing digital full-service em Portugal, especializada em desenvolvimento web, SEO, Google Ads, Meta Ads, redes sociais e automação com IA.',
        ],
        'services' => [
            'title' => 'Serviços - NexusVora | Marketing Digital Full-Service',
            'description' => 'Conheça os serviços da NexusVora: desenvolvimento web, gestão de redes sociais, Google Ads, Meta Ads, SEO, automação com IA, marca e estratégia digital.',
        ],
        'precos' => [
            'title' => 'Preços - NexusVora | Transparência Total',
            'description' => 'Preços claros e transparentes para desenvolvimento web, marketing digital e pacotes de horas. NexusVora, agência de marketing digital em Portugal.',
        ],
        'sobre' => [
            'title' => 'Quem Somos - NexusVora | Agência de Marketing Digital',
            'description' => 'Saiba mais sobre a NexusVora, uma agência de marketing digital em Portugal focada em crescimento, performance, estratégia e soluções digitais para empresas.',
        ],
        'contacto' => [
            'title' => 'Contacto - NexusVora',
            'description' => 'Fale com a NexusVora para pedir um diagnóstico gratuito sobre website, SEO, Google Ads, Meta Ads, redes sociais, automação com IA e estratégia digital.',
        ],
        'privacidade' => [
            'title' => 'Política de Privacidade - NexusVora',
            'description' => 'Consulte a política de privacidade da NexusVora e saiba como recolhemos, tratamos e protegemos os seus dados pessoais.',
        ],
        'termos' => [
            'title' => 'Termos de Serviço - NexusVora',
            'description' => 'Consulte os termos de serviço da NexusVora, incluindo condições de utilização, serviços prestados, responsabilidades e informação legal.',
        ],
    ];

    $routeName = request()->route()?->getName();
    $pageSeo = $seo[$routeName] ?? $seo['home'];
    $description = $pageSeo['description'];
    $pageTitle = $pageSeo['title'];
    $schema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                '@id' => "{$siteUrl}/#organization",
                'name' => 'NexusVora',
                'url' => $siteUrl,
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $logoUrl,
                    'width' => 100,
                    'height' => 100,
                ],
            ],
            [
                '@type' => 'WebSite',
                '@id' => "{$siteUrl}/#website",
                'url' => $siteUrl,
                'name' => 'NexusVora',
                'publisher' => ['@id' => "{$siteUrl}/#organization"],
                'inLanguage' => 'pt-PT',
            ],
            [
                '@type' => 'WebPage',
                '@id' => "{$currentUrl}#webpage",
                'url' => $currentUrl,
                'name' => $pageTitle,
                'description' => $description,
                'isPartOf' => ['@id' => "{$siteUrl}/#website"],
                'about' => ['@id' => "{$siteUrl}/#organization"],
                'inLanguage' => 'pt-PT',
            ],
        ],
    ];
@endphp

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="index, follow, max-image-preview:large">
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ $currentUrl }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="NexusVora">
<meta property="og:url" content="{{ $currentUrl }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $logoUrl }}">
<meta property="og:locale" content="pt_PT">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $logoUrl }}">
<link rel="icon" href="{{ $faviconPngUrl }}" type="image/png" sizes="96x96">
<link rel="icon" href="{{ $faviconSvgUrl }}" type="image/svg+xml">
<link rel="shortcut icon" href="{{ $faviconIcoUrl }}">
<link rel="apple-touch-icon" href="{{ $faviconPngUrl }}">
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800;900&display=swap" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"></noscript>
<link rel="stylesheet" href="https://cdn.kiprotect.com/klaro/v0.7/klaro.min.css">
<script defer src="{{ asset('js/klaro-config.js') }}"></script>
<script defer src="https://cdn.kiprotect.com/klaro/v0.7/klaro.js"></script>
<style>
    .cookie-preferences-button {
        position: fixed;
        left: 18px;
        bottom: 18px;
        z-index: 9998;
        border: 1px solid rgba(0,212,255,0.24);
        border-radius: 8px;
        background: rgba(17,25,54,0.86);
        color: #fff;
        font: 700 0.8rem/1.2 'Inter', sans-serif;
        padding: 0.7rem 0.9rem;
        cursor: pointer;
        box-shadow: 0 14px 34px rgba(0,0,0,0.34), inset 0 1px 0 rgba(255,255,255,0.06);
        backdrop-filter: blur(14px);
    }

    .cookie-preferences-button:hover,
    .cookie-preferences-button:focus-visible {
        border-color: rgba(0,212,255,0.5);
        background: rgba(20,31,68,0.94);
        outline: 2px solid rgba(0,212,255,0.65);
        outline-offset: 2px;
    }

    .klaro {
        --cookie-navy: #0A0F2E;
        --cookie-card: #111936;
        --cookie-panel: rgba(17,25,54,0.96);
        --cookie-border: rgba(255,255,255,0.09);
        --cookie-muted: #98A3C2;
        --cookie-cyan: #00D4FF;
        --cookie-blue: #4A6CF7;
        --cookie-purple: #8B3FDB;
        font-family: 'Inter', sans-serif !important;
        color: #E8EAF6 !important;
    }

    .klaro .cookie-notice:not(.cookie-modal-notice),
    .klaro .cookie-modal .cm-modal {
        border: 1px solid var(--cookie-border) !important;
        border-radius: 14px !important;
        background: linear-gradient(180deg, rgba(17,25,54,0.98), rgba(10,15,46,0.98)) !important;
        color: #E8EAF6 !important;
        box-shadow: 0 24px 70px rgba(0,0,0,0.46), inset 0 1px 0 rgba(255,255,255,0.05) !important;
        backdrop-filter: blur(18px);
    }

    .klaro .cookie-notice:not(.cookie-modal-notice) {
        right: 18px !important;
        bottom: 18px !important;
        max-width: 430px !important;
        padding: 1rem !important;
    }

    .klaro .cookie-notice p,
    .klaro .cookie-modal p,
    .klaro .cookie-modal .cm-purpose-description,
    .klaro .cookie-modal .cm-service-description,
    .klaro .cookie-modal .cm-list-description {
        color: var(--cookie-muted) !important;
        font-size: 0.86rem !important;
        line-height: 1.55 !important;
    }

    .klaro .cookie-notice strong,
    .klaro .cookie-modal strong,
    .klaro .cookie-modal h1,
    .klaro .cookie-modal h2,
    .klaro .cookie-modal .title,
    .klaro .cookie-modal .cm-list-title {
        color: #fff !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        letter-spacing: 0 !important;
    }

    .klaro .cookie-modal h1,
    .klaro .cookie-modal .title {
        font-size: clamp(1.45rem, 3vw, 2rem) !important;
        font-weight: 800 !important;
        line-height: 1.12 !important;
    }

    .klaro .cookie-notice a,
    .klaro .cookie-modal a {
        color: var(--cookie-cyan) !important;
        font-weight: 700 !important;
        text-decoration: none !important;
    }

    .klaro .cookie-notice a:hover,
    .klaro .cookie-modal a:hover {
        color: #8EDBFF !important;
        text-decoration: underline !important;
        text-underline-offset: 3px !important;
    }

    .klaro .cookie-modal .cm-modal {
        max-width: 680px !important;
        overflow: hidden !important;
    }

    .klaro .cookie-modal .cm-header,
    .klaro .cookie-modal .cm-body,
    .klaro .cookie-modal .cm-footer {
        background: transparent !important;
        border-color: var(--cookie-border) !important;
    }

    .klaro .cookie-modal .cm-header {
        padding: 1.35rem 1.45rem 1rem !important;
    }

    .klaro .cookie-modal .cm-body {
        padding: 1rem 1.45rem !important;
    }

    .klaro .cookie-modal .cm-footer,
    .klaro .cookie-notice .cn-buttons {
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 0.65rem !important;
        align-items: center !important;
        justify-content: flex-end !important;
        padding: 1rem 1.45rem 1.2rem !important;
    }

    .klaro .cookie-notice .cn-buttons {
        padding: 0.85rem 0 0 !important;
    }

    .klaro .cm-btn,
    .klaro .cookie-notice .cm-btn {
        min-height: 38px !important;
        border: 1px solid rgba(255,255,255,0.12) !important;
        border-radius: 8px !important;
        background: rgba(255,255,255,0.07) !important;
        color: #fff !important;
        font: 800 0.85rem/1 'Plus Jakarta Sans', sans-serif !important;
        padding: 0.7rem 0.9rem !important;
        transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease !important;
    }

    .klaro .cm-btn:hover,
    .klaro .cm-btn:focus-visible {
        transform: translateY(-1px);
        border-color: rgba(0,212,255,0.38) !important;
        outline: none !important;
        box-shadow: 0 10px 24px rgba(0,0,0,0.25) !important;
    }

    .klaro .cm-btn.cm-btn-success,
    .klaro .cm-btn-success {
        border-color: transparent !important;
        background: linear-gradient(135deg, var(--cookie-cyan), var(--cookie-blue), var(--cookie-purple)) !important;
    }

    .klaro .cm-btn.cm-btn-info,
    .klaro .cm-btn-info {
        border-color: rgba(0,212,255,0.24) !important;
        background: rgba(0,212,255,0.09) !important;
        color: var(--cookie-cyan) !important;
    }

    .klaro .cm-btn.cm-btn-danger,
    .klaro .cm-btn-danger {
        border-color: rgba(255,255,255,0.12) !important;
        background: rgba(255,255,255,0.08) !important;
        color: #E8EAF6 !important;
    }

    .klaro .cookie-modal .cm-list-input:checked + .cm-list-label .slider,
    .klaro .cookie-modal .cm-list-input.required:checked + .cm-list-label .slider,
    .klaro .cookie-modal .cm-list-input.only-required + .cm-list-label .slider {
        background: linear-gradient(135deg, var(--cookie-cyan), var(--cookie-blue)) !important;
    }

    .klaro .cookie-modal .cm-list-input + .cm-list-label .slider {
        background: rgba(255,255,255,0.12) !important;
        border: 1px solid rgba(255,255,255,0.12) !important;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.24) !important;
    }

    .klaro .cookie-modal .cm-list-input + .cm-list-label .slider::before {
        background: #fff !important;
        box-shadow: 0 3px 10px rgba(0,0,0,0.28) !important;
    }

    .klaro .cookie-modal .cm-list-label,
    .klaro .cookie-modal .cm-purpose,
    .klaro .cookie-modal .cm-service {
        border-color: var(--cookie-border) !important;
    }

    .klaro .cookie-modal .cm-powered-by {
        display: none !important;
    }

    .klaro .cookie-modal .hide,
    .klaro .cookie-modal .cm-header .close {
        color: #fff !important;
        opacity: 0.75 !important;
    }

    .klaro .cookie-modal .hide:hover,
    .klaro .cookie-modal .cm-header .close:hover {
        opacity: 1 !important;
    }

    @media (max-width: 640px) {
        .cookie-preferences-button {
            left: 12px;
            bottom: 12px;
            padding: 0.55rem 0.7rem;
        }

        .klaro .cookie-notice:not(.cookie-modal-notice) {
            left: 12px !important;
            right: 12px !important;
            bottom: 62px !important;
            max-width: none !important;
        }

        .klaro .cookie-modal .cm-modal {
            width: calc(100vw - 24px) !important;
            max-height: calc(100vh - 24px) !important;
        }

        .klaro .cookie-modal .cm-footer,
        .klaro .cookie-notice .cn-buttons {
            justify-content: stretch !important;
        }

        .klaro .cm-btn,
        .klaro .cookie-notice .cm-btn {
            flex: 1 1 100% !important;
        }
    }
</style>
