@php
  $contactUrl = route('contacto');
  $servicesUrl = route('services');

  $webPlans = [
    [
      'name' => 'Essencial',
      'slug' => 'essencial',
      'category' => 'web',
      'old' => '699€',
      'discount' => '-29%',
      'price' => '499',
      'tone' => '#00D4FF',
      'desc' => 'Ideal para PMEs que precisam de uma presença profissional online pela primeira vez ou para um redesign simples.',
      'features' => [
        'Site até 5 páginas, design personalizado',
        'Responsivo: mobile, tablet e desktop',
        'SEO técnico base + SSL incluído',
        'CMS para gestão autónoma',
        'Hosting + domínio 1.º ano incluído',
        'Formação de 1 hora ao cliente',
      ],
    ],
    [
      'name' => 'Profissional',
      'slug' => 'profissional',
      'category' => 'web',
      'old' => '1 249€',
      'discount' => '-28%',
      'price' => '899',
      'tone' => '#4A6CF7',
      'popular' => true,
      'desc' => 'Para negócios que precisam de mais páginas, blog ou landing page de alta conversão integrada.',
      'features' => [
        'Tudo do plano Essencial',
        'Até 12 páginas + blog integrado',
        'Landing page de alta conversão',
        'Formulários avançados + CRM básico',
        'Google Analytics 4 configurado',
        'Manutenção mensal 6 meses incluída',
        'Formação de 2 horas + suporte prioritário',
        'MBWay, Multibanco, Visa/MC e PayPal',
      ],
    ],
    [
      'name' => 'E-commerce',
      'slug' => 'ecommerce',
      'category' => 'web',
      'old' => '1 699€',
      'discount' => '-24%',
      'price' => '1 299',
      'tone' => '#8B3FDB',
      'desc' => 'Para negócios que querem vender online: loja completa com gestão de stock, pagamentos e experiência de compra otimizada.',
      'features' => [
        'Tudo do plano Profissional',
        'Loja online com produtos ilimitados',
        'MBWay, Multibanco, Visa/MC e PayPal',
        'Gestão de stock + notificações email',
        'SEO de produto e categoria',
        'Manutenção mensal 12 meses incluída',
      ],
    ],
  ];

  $marketingPlans = [
    [
      'name' => 'Starter',
      'slug' => 'starter',
      'category' => 'marketing',
      'old' => '449€/mês',
      'discount' => '-33%',
      'price' => '299',
      'suffix' => '/mês',
      'tone' => '#00D4FF',
      'desc' => 'Para negócios que querem uma presença digital ativa com redes sociais e primeiros passos em tráfego pago.',
      'bonus' => ['Site Essencial', '499€'],
      'features' => [
        'Gestão de 1 rede social (8 posts/mês)',
        'Google Ads ou Meta Ads (gestão básica)',
        'Relatório mensal de desempenho',
        'Criativos digitais incluídos',
        'Suporte por email e WhatsApp',
      ],
    ],
    [
      'name' => 'Growth',
      'slug' => 'growth',
      'category' => 'marketing',
      'old' => '749€/mês',
      'discount' => '-33%',
      'price' => '499',
      'suffix' => '/mês',
      'tone' => '#4A6CF7',
      'popular' => true,
      'desc' => 'Para PMEs que querem uma estratégia digital completa: redes sociais, tráfego pago e SEO integrados.',
      'bonus' => ['Site Profissional', '899€'],
      'features' => [
        'Tudo do plano Starter',
        'Gestão de 2 redes sociais (16 posts/mês)',
        'Google Ads + Meta Ads (gestão completa)',
        'SEO on-page mensal',
        'Reels / vídeos curtos (4/mês)',
        'Reunião mensal de estratégia',
        'Dashboard de resultados em tempo real',
        'MBWay, Multibanco, Visa/MC e PayPal',
      ],
    ],
    [
      'name' => 'Full-Service',
      'slug' => 'full-service',
      'category' => 'marketing',
      'old' => '1 099€/mês',
      'discount' => '-27%',
      'price' => '799',
      'suffix' => '/mês',
      'tone' => '#8B3FDB',
      'desc' => 'Para empresas que querem delegar toda a presença digital: do site às redes sociais, ads, SEO e automação.',
      'bonus' => ['Site E-commerce / Premium', '1 299€'],
      'features' => [
        'Tudo do plano Growth',
        'Gestão de 3+ redes sociais',
        'Email marketing automatizado',
        'NexusAI básico: chatbot + automações',
        'MBWay, Multibanco, Visa/MC e PayPal',
        'SEO avançado + link building',
        'Gestor de conta dedicado',
        'Reuniões quinzenais + relatório semanal',
      ],
    ],
  ];

  $hourPlans = [
    [
      'name' => 'Pacote Básico',
      'slug' => '5h',
      'category' => 'horas',
      'hours' => '5',
      'hoursSuffix' => 'h',
      'old' => '25€/h',
      'discount' => '-20%',
      'rate' => '20',
      'total' => '100€',
      'tone' => '#00D4FF',
      'features' => ['Atualizações de conteúdo', 'Correções e ajustes pontuais', 'Consultoria estratégica', 'Válido 3 meses após aquisição'],
    ],
    [
      'name' => 'Pacote Médio',
      'slug' => '10h',
      'category' => 'horas',
      'hours' => '10',
      'hoursSuffix' => 'h',
      'old' => '25€/h',
      'discount' => '-32%',
      'rate' => '17',
      'total' => '170€',
      'saving' => 'Poupa 80€ vs tarifa normal',
      'tone' => '#4A6CF7',
      'popular' => true,
      'features' => ['Tudo do Pacote Básico', 'Novas funcionalidades no site', 'Configuração de automações simples', 'Válido 6 meses após aquisição'],
    ],
    [
      'name' => 'Pacote Avançado',
      'slug' => '20h',
      'category' => 'horas',
      'hours' => '20',
      'hoursSuffix' => 'h+',
      'old' => '25€/h',
      'discount' => '-40%',
      'rate' => '15',
      'total' => '300€',
      'saving' => 'Poupa 200€ vs tarifa normal',
      'tone' => '#8B3FDB',
      'features' => ['Tudo do Pacote Médio', 'Projetos de maior dimensão', 'Prioridade máxima de agendamento', 'Válido 12 meses após aquisição'],
    ],
  ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('partials.site-head')
  <title>Preços - NexusVora | Transparência Total</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --cyan: #00D4FF;
      --blue: #4A6CF7;
      --purple: #8B3FDB;
      --navy: #0A0F2E;
      --navy2: #060B20;
      --navy-card: #111936;
      --navy-border: rgba(255,255,255,0.07);
      --text: #E8EAF6;
      --text-muted: #8892B0;
      --grad: linear-gradient(135deg, #00D4FF, #4A6CF7, #8B3FDB);
    }
    html { scroll-behavior: smooth; }
    body {
      font-family: 'Inter', sans-serif;
      background: var(--navy2);
      color: var(--text);
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
    }
    h1,h2,h3,h4,h5 { font-family: 'Plus Jakarta Sans', sans-serif; line-height: 1.15; }
    .page-header {
      padding: 140px 5vw 72px;
      text-align: center;
      position: relative;
      overflow: hidden;
      background: var(--navy2);
    }
    .page-header::before {
      content: '';
      position: absolute;
      top: -140px;
      left: 50%;
      transform: translateX(-50%);
      width: 800px;
      height: 600px;
      background: radial-gradient(circle, rgba(74,108,247,0.13) 0%, transparent 70%);
      pointer-events: none;
    }
    .page-header::after {
      content: '';
      position: absolute;
      inset: 0;
      background-image: radial-gradient(circle, rgba(255,255,255,0.055) 1px, transparent 1px);
      background-size: 36px 36px;
      mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 10%, transparent 80%);
      pointer-events: none;
    }
    .page-header-inner { position: relative; z-index: 1; max-width: 680px; margin: 0 auto; }
    .section-tag {
      display: inline-block;
      background: rgba(0,212,255,0.08);
      border: 1px solid rgba(0,212,255,0.2);
      border-radius: 999px;
      padding: 4px 14px;
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--cyan);
      margin-bottom: 18px;
    }
    .page-header h1 {
      font-size: clamp(2rem, 4vw, 3.2rem);
      font-weight: 800;
      color: #fff;
      letter-spacing: -0.03em;
      margin-bottom: 16px;
      text-wrap: pretty;
    }
    .grad-text,
    .price-grad {
      background: var(--grad);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .page-header p { font-size: 1.05rem; color: var(--text-muted); line-height: 1.7; }
    .pricing-section { padding: 80px 5vw; }
    .pricing-section + .pricing-section { border-top: 1px solid var(--navy-border); }
    .section-inner { max-width: 1100px; margin: 0 auto; }
    .section-label { display: flex; align-items: center; gap: 14px; margin-bottom: 10px; }
    .section-label-num {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.72rem;
      font-weight: 800;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--text-muted);
    }
    .section-label-line { flex: 1; height: 1px; background: var(--navy-border); }
    .section-heading {
      font-size: clamp(1.5rem, 2.5vw, 2rem);
      font-weight: 800;
      color: #fff;
      margin-bottom: 8px;
      letter-spacing: -0.02em;
    }
    .section-sub {
      font-size: 0.92rem;
      color: var(--text-muted);
      line-height: 1.65;
      margin-bottom: 48px;
      max-width: 600px;
    }
    .plans-grid,
    .hours-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 20px;
      align-items: start;
    }
    .plan-card,
    .hour-card {
      background: var(--navy-card);
      border: 1px solid var(--navy-border);
      border-radius: 20px;
      padding: 32px;
      position: relative;
      overflow: hidden;
      transition: transform .25s, border-color .25s, box-shadow .25s;
    }
    .plan-card:hover,
    .hour-card:hover {
      transform: translateY(-4px);
      border-color: rgba(74,108,247,0.3);
      box-shadow: 0 20px 60px rgba(0,0,0,0.34);
    }
    .plan-card::before,
    .hour-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 2px;
      background: var(--grad);
      opacity: 0;
      transition: opacity .25s;
    }
    .plan-card:hover::before,
    .hour-card:hover::before,
    .plan-card.popular::before,
    .hour-card.popular::before { opacity: 1; }
    .plan-card.popular,
    .hour-card.popular {
      background: linear-gradient(160deg, rgba(74,108,247,0.13) 0%, rgba(139,63,219,0.08) 100%);
      border-color: rgba(74,108,247,0.35);
      box-shadow: 0 8px 40px rgba(74,108,247,0.18);
    }
    .popular-badge {
      position: absolute;
      top: 20px;
      right: 20px;
      background: var(--grad);
      color: #fff;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.65rem;
      font-weight: 800;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      padding: 3px 10px;
      border-radius: 999px;
    }
    .plan-name,
    .hour-pack-name {
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--text-muted);
      margin-bottom: 14px;
      padding-right: 96px;
    }
    .plan-card.popular .plan-name { color: var(--cyan); }
    .plan-old-price,
    .hour-old-rate {
      font-size: 0.85rem;
      color: var(--text-muted);
      text-decoration: line-through;
      margin-bottom: 4px;
    }
    .plan-discount-badge {
      display: inline-block;
      background: rgba(74,222,128,0.12);
      border: 1px solid rgba(74,222,128,0.25);
      border-radius: 999px;
      padding: 2px 9px;
      font-size: 0.68rem;
      font-weight: 700;
      color: #4ADE80;
      margin-left: 8px;
      vertical-align: middle;
      text-decoration: none;
    }
    .plan-price {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 2.8rem;
      font-weight: 800;
      color: #fff;
      letter-spacing: -0.03em;
      line-height: 1;
    }
    .plan-price sup { font-size: 1.1rem; font-weight: 700; vertical-align: top; padding-top: 8px; }
    .plan-price-suffix,
    .hour-rate-suffix { font-size: 0.88rem; color: var(--text-muted); font-weight: 400; margin-left: 4px; }
    .plan-desc { font-size: 0.84rem; color: var(--text-muted); line-height: 1.6; margin: 14px 0 22px; }
    .site-bonus {
      background: rgba(0,212,255,0.06);
      border: 1px solid rgba(0,212,255,0.18);
      border-radius: 10px;
      padding: 12px 14px;
      margin-bottom: 22px;
    }
    .site-bonus-label {
      font-size: 0.67rem;
      font-weight: 700;
      letter-spacing: 0.09em;
      text-transform: uppercase;
      color: var(--cyan);
      margin-bottom: 5px;
    }
    .site-bonus-content { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 6px; }
    .site-bonus-name { font-size: 0.82rem; font-weight: 600; color: #fff; }
    .site-bonus-old { font-size: 0.72rem; color: var(--text-muted); text-decoration: line-through; margin-right: 4px; }
    .site-bonus-val { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 0.9rem; font-weight: 800; }
    .plan-includes {
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--text-muted);
      margin-bottom: 12px;
    }
    .plan-features,
    .hour-features { list-style: none; display: flex; flex-direction: column; gap: 9px; margin-bottom: 28px; }
    .plan-features li,
    .hour-features li {
      display: flex;
      gap: 10px;
      align-items: flex-start;
      font-size: 0.84rem;
      color: var(--text);
      line-height: 1.45;
    }
    .chk {
      width: 17px;
      height: 17px;
      border-radius: 5px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 1px;
    }
    .plan-cta,
    .enterprise-cta,
    .btn-primary,
    .btn-ghost {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      text-decoration: none;
      transition: opacity .2s, transform .2s, border-color .2s, color .2s;
    }
    .plan-cta {
      width: 100%;
      background: var(--grad);
      color: #fff;
      font-weight: 700;
      font-size: 0.88rem;
      padding: 13px 20px;
      border-radius: 10px;
    }
    .plan-cta:hover,
    .enterprise-cta:hover,
    .btn-primary:hover { opacity: .88; transform: translateY(-1px); }
    .plan-cta.ghost {
      background: transparent;
      color: var(--text);
      border: 1px solid var(--navy-border);
    }
    .plan-cta.ghost:hover,
    .btn-ghost:hover { border-color: rgba(74,108,247,0.4); color: #fff; }
    .enterprise-card {
      margin-top: 20px;
      background: linear-gradient(135deg, rgba(74,108,247,0.07), rgba(139,63,219,0.05));
      border: 1px solid rgba(74,108,247,0.2);
      border-radius: 20px;
      padding: 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 32px;
      flex-wrap: wrap;
    }
    .enterprise-card-body h3 { font-size: 1.1rem; font-weight: 800; color: #fff; margin-bottom: 6px; }
    .enterprise-card-body p { font-size: 0.88rem; color: var(--text-muted); line-height: 1.6; max-width: 520px; }
    .enterprise-cta,
    .btn-primary {
      background: var(--grad);
      color: #fff;
      font-weight: 700;
      font-size: 0.9rem;
      padding: 13px 24px;
      border-radius: 10px;
    }
    .hour-card { text-align: center; }
    .hour-pack-name { padding-right: 0; margin-bottom: 16px; }
    .hour-count {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 3.5rem;
      font-weight: 800;
      color: #fff;
      letter-spacing: -0.04em;
      line-height: 1;
    }
    .hour-count span { font-size: 1.2rem; color: var(--text-muted); font-weight: 500; }
    .hour-rate-wrap { margin: 16px 0 8px; }
    .hour-rate { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 2rem; font-weight: 800; letter-spacing: -0.03em; }
    .hour-rate sup { font-size: 0.85rem; }
    .hour-total { font-size: 0.82rem; color: var(--text-muted); margin-bottom: 20px; }
    .hour-total strong { color: var(--text); font-weight: 600; }
    .hour-saving {
      display: inline-block;
      background: rgba(74,222,128,0.1);
      border: 1px solid rgba(74,222,128,0.22);
      border-radius: 999px;
      padding: 3px 12px;
      font-size: 0.72rem;
      font-weight: 700;
      color: #4ADE80;
      margin-bottom: 20px;
    }
    .hour-features { text-align: left; }
    .market-note {
      background: rgba(74,108,247,0.06);
      border: 1px solid rgba(74,108,247,0.16);
      border-left: 3px solid var(--blue);
      border-radius: 0 12px 12px 0;
      padding: 18px 22px;
      margin-top: 48px;
      font-size: 0.85rem;
      color: var(--text-muted);
      line-height: 1.65;
    }
    .market-note strong { color: var(--cyan); }
    .final-cta { background: var(--navy2); padding: 100px 5vw; }
    .cta-box {
      max-width: 1100px;
      margin: 0 auto;
      background: linear-gradient(135deg, rgba(74,108,247,0.14), rgba(139,63,219,0.09));
      border: 1px solid rgba(74,108,247,0.24);
      border-radius: 24px;
      padding: 72px 56px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .cta-box::before {
      content: '';
      position: absolute;
      top: -80px;
      left: 50%;
      transform: translateX(-50%);
      width: 500px;
      height: 300px;
      background: radial-gradient(circle, rgba(74,108,247,0.18), transparent 70%);
    }
    .cta-box h2,
    .cta-box p,
    .cta-actions { position: relative; z-index: 1; }
    .cta-box h2 {
      font-size: clamp(1.6rem, 2.8vw, 2.5rem);
      font-weight: 800;
      color: #fff;
      letter-spacing: -0.02em;
      margin-bottom: 14px;
      text-wrap: pretty;
    }
    .cta-box p {
      font-size: 1rem;
      color: var(--text-muted);
      max-width: 480px;
      margin: 0 auto 36px;
      line-height: 1.7;
    }
    .cta-actions { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
    .btn-ghost {
      border: 1px solid rgba(255,255,255,0.15);
      color: var(--text);
      font-weight: 600;
      font-size: 0.9rem;
      padding: 14px 28px;
      border-radius: 10px;
    }
    .fade-up { opacity: 0; transform: translateY(24px); transition: opacity .5s ease, transform .5s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }
    @media (max-width: 960px) {
      .plans-grid,
      .hours-grid { grid-template-columns: 1fr; }
      .enterprise-card { flex-direction: column; align-items: flex-start; }
      .cta-box { padding: 48px 28px; }
    }
  </style>
</head>
<body>
@include('partials.site-header')

<main>
<div class="page-header">
  <div class="page-header-inner">
    <div class="section-tag">Preços</div>
    <h1>Investimento claro.<br><span class="grad-text">Sem surpresas.</span></h1>
    <p>Preços transparentes para cada fase do crescimento do seu negócio: desde o primeiro site até à automação completa com IA.</p>
  </div>
</div>

<section class="pricing-section" id="web">
  <div class="section-inner">
    <div class="section-label fade-up"><span class="section-label-num">01 · Desenvolvimento Web</span><span class="section-label-line"></span></div>
    <h2 class="section-heading fade-up">Sites profissionais com preço justo</h2>
    <p class="section-sub fade-up">Projetos únicos, entregues em 30 dias, com tudo incluído: design, SEO técnico, hosting e formação.</p>
    <div class="plans-grid">
      @foreach ($webPlans as $plan)
        @include('partials.pricing-card', ['plan' => $plan])
      @endforeach
    </div>
    <div class="enterprise-card fade-up">
      <div class="enterprise-card-body">
        <h3>Soluções Personalizadas &amp; Plataformas à Medida</h3>
        <p>Para empresas com requisitos específicos: sistemas SaaS, integrações complexas, concessionários multi-stock ou plataformas de reservas. Orçamento personalizado após análise.</p>
      </div>
      <a href="{{ $contactUrl }}" class="enterprise-cta">Pedir orçamento @include('partials.pricing-arrow')</a>
    </div>
    <div class="market-note fade-up">
      <strong>Contexto de mercado:</strong> Em Portugal, o custo de criação de um site profissional por uma agência varia entre <strong>500€ e 5.000€+</strong>. Os preços NexusVora incluem design personalizado, SEO técnico, hosting e formação.
    </div>
  </div>
</section>

<section class="pricing-section" id="marketing">
  <div class="section-inner">
    <div class="section-label fade-up"><span class="section-label-num">02 · Marketing Digital</span><span class="section-label-line"></span></div>
    <h2 class="section-heading fade-up">Planos mensais com site incluído</h2>
    <p class="section-sub fade-up">Contrato mínimo de 6 meses. Todos os planos incluem o site correspondente, sem custo adicional.</p>
    <div class="plans-grid">
      @foreach ($marketingPlans as $plan)
        @include('partials.pricing-card', ['plan' => $plan])
      @endforeach
    </div>
    <div class="market-note fade-up">
      <strong>Contrato mínimo de 6 meses.</strong> O marketing digital requer consistência para gerar resultados. Contexto de mercado: <strong>gestão de redes sociais em Portugal custa tipicamente 150€ a 600€/mês</strong>; os planos NexusVora integram redes sociais, ads e SEO num único preço.
    </div>
  </div>
</section>

<section class="pricing-section" id="horas">
  <div class="section-inner">
    <div class="section-label fade-up"><span class="section-label-num">03 · Pacotes de Horas</span><span class="section-label-line"></span></div>
    <h2 class="section-heading fade-up">Flexibilidade quando precisa</h2>
    <p class="section-sub fade-up">Para projetos pontuais, atualizações, consultorias ou tarefas específicas. Quanto maior o pacote, menor o valor por hora.</p>
    <div class="hours-grid">
      @foreach ($hourPlans as $plan)
        <div class="hour-card fade-up @if(! empty($plan['popular'])) popular @endif">
          @if(! empty($plan['popular']))<div class="popular-badge">Mais popular</div>@endif
          <div class="hour-pack-name">{{ $plan['name'] }}</div>
          <div class="hour-count">{{ $plan['hours'] }}<span>{{ $plan['hoursSuffix'] }}</span></div>
          <div class="hour-rate-wrap">
            <div class="hour-old-rate">{{ $plan['old'] }} <span class="plan-discount-badge">{{ $plan['discount'] }}</span></div>
            <div class="hour-rate price-grad"><sup>€</sup>{{ $plan['rate'] }}<span class="hour-rate-suffix">/hora</span></div>
          </div>
          <div class="hour-total">Total: <strong>{{ $plan['total'] }}</strong></div>
          @if(! empty($plan['saving']))<span class="hour-saving">{{ $plan['saving'] }}</span>@endif
          <ul class="hour-features">
            @foreach ($plan['features'] as $feature)
              <li>@include('partials.pricing-check', ['tone' => $plan['tone']]) {{ $feature }}</li>
            @endforeach
          </ul>
          <a href="{{ route('contacto', ['plano' => $plan['slug'], 'categoria' => $plan['category']]) }}" class="plan-cta @if(empty($plan['popular'])) ghost @endif">Adquirir @include('partials.pricing-arrow')</a>
        </div>
      @endforeach
    </div>
    <div class="market-note fade-up">
      <strong>Contexto de mercado:</strong> A tarifa horária de referência para profissionais de marketing digital em Portugal ronda os <strong>25€/hora</strong>. Os pacotes NexusVora oferecem descontos progressivos de até 40%.
    </div>
  </div>
</section>

<section class="final-cta">
  <div class="cta-box">
    <h2>Ainda com dúvidas sobre qual o plano certo?</h2>
    <p>Agende uma chamada gratuita de 30 minutos. Analisamos o seu negócio e recomendamos a solução ideal, sem compromisso.</p>
    <div class="cta-actions">
      <a href="{{ $contactUrl }}" class="btn-primary">Pedir diagnóstico grátis @include('partials.pricing-arrow')</a>
      <a href="{{ $servicesUrl }}" class="btn-ghost">Ver todos os serviços</a>
    </div>
  </div>
</section>
</main>

@include('partials.site-footer')

<script>
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.08 });

  document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>
</body>
</html>
