@php
    $seo = [
        'home' => [
            'description' => 'NexusVora é uma agência de marketing digital full-service em Portugal, especializada em desenvolvimento web, SEO, Google Ads, Meta Ads, redes sociais e automação com IA.',
        ],
        'services' => [
            'description' => 'Conheça os serviços da NexusVora: desenvolvimento web, gestão de redes sociais, Google Ads, Meta Ads, SEO, automação com IA, marca e estratégia digital.',
        ],
        'sobre' => [
            'description' => 'Saiba mais sobre a NexusVora, uma agência de marketing digital em Portugal focada em crescimento, performance, estratégia e soluções digitais para empresas.',
        ],
        'privacidade' => [
            'description' => 'Consulte a política de privacidade da NexusVora e saiba como recolhemos, tratamos e protegemos os seus dados pessoais.',
        ],
        'termos' => [
            'description' => 'Consulte os termos de serviço da NexusVora, incluindo condições de utilização, serviços prestados, responsabilidades e informação legal.',
        ],
    ];

    $routeName = request()->route()?->getName();
    $description = $seo[$routeName]['description'] ?? $seo['home']['description'];
@endphp

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ url()->current() }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="NexusVora">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:description" content="{{ $description }}">
<meta name="twitter:card" content="summary">
<meta name="twitter:description" content="{{ $description }}">
<link rel="icon" type="image/svg+xml" href='data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" fill="none"%3E%3Cdefs%3E%3ClinearGradient id="ng" x1="0" y1="0" x2="60" y2="60" gradientUnits="userSpaceOnUse"%3E%3Cstop offset="0%25" stop-color="%2300D4FF"/%3E%3Cstop offset="50%25" stop-color="%234A6CF7"/%3E%3Cstop offset="100%25" stop-color="%238B3FDB"/%3E%3C/linearGradient%3E%3C/defs%3E%3Ccircle cx="30" cy="30" r="7" stroke="url(%23ng)" stroke-width="2.5" fill="none"/%3E%3Ccircle cx="30" cy="30" r="3" fill="url(%23ng)"/%3E%3Cline x1="30" y1="23" x2="30" y2="10" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="30" cy="8" r="3" fill="url(%23ng)"/%3E%3Cline x1="30" y1="37" x2="30" y2="50" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="30" cy="52" r="3" fill="url(%23ng)"/%3E%3Cline x1="23" y1="30" x2="10" y2="30" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="8" cy="30" r="3" fill="url(%23ng)"/%3E%3Cline x1="37" y1="30" x2="50" y2="30" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="52" cy="30" r="3" fill="url(%23ng)"/%3E%3Cline x1="25" y1="25" x2="16" y2="16" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="13.5" cy="13.5" r="3" fill="url(%23ng)"/%3E%3Cline x1="35" y1="35" x2="44" y2="44" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="46.5" cy="46.5" r="3" fill="url(%23ng)"/%3E%3Cline x1="35" y1="25" x2="44" y2="16" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="46.5" cy="13.5" r="3" fill="url(%23ng)"/%3E%3Cline x1="25" y1="35" x2="16" y2="44" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="13.5" cy="46.5" r="3" fill="url(%23ng)"/%3E%3C/svg%3E'>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800;900&display=swap" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"></noscript>
