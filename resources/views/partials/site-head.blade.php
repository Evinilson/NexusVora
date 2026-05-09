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
