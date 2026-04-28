<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('partials.site-head')
  <title>Quem Somos — NexusVora | Agência de Marketing Digital</title>

  <style>
    :root {
      --cyan: #00d4ff;
      --blue: #4a6cf7;
      --purple: #8b3fdb;
      --navy: #0a0f2e;
      --navy-2: #060b20;
      --navy-card: #111936;
      --navy-card-hover: #151e42;
      --navy-border: rgba(255,255,255,0.07);
      --navy-border-hover: rgba(255,255,255,0.14);
      --text: #e8eaf6;
      --text-muted: #8892b0;
      --grad: linear-gradient(135deg, #00d4ff, #4a6cf7, #8b3fdb);
    }

    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body {
      background: var(--navy);
      color: var(--text);
      font-family: 'Inter', sans-serif;
      overflow-x: hidden;
      line-height: 1.7;
    }

    /* ─── ANIMATED BG ─── */
    .bg-orbs {
      position: fixed; inset: 0;
      pointer-events: none; z-index: 0; overflow: hidden;
    }
    .orb {
      position: absolute; border-radius: 50%;
      filter: blur(80px);
      animation: orbFloat 12s ease-in-out infinite;
    }
    .orb-1 { width:500px; height:500px; background:rgba(74,108,247,0.07); top:-100px; left:-150px; animation-delay:0s; }
    .orb-2 { width:400px; height:400px; background:rgba(139,63,219,0.06); bottom:10%; right:-100px; animation-delay:-4s; }
    .orb-3 { width:300px; height:300px; background:rgba(0,212,255,0.05); top:50%; left:40%; animation-delay:-8s; }
    @keyframes orbFloat {
      0%,100% { transform:translateY(0) scale(1); }
      33%      { transform:translateY(-30px) scale(1.05); }
      66%      { transform:translateY(20px) scale(0.97); }
    }

    /* ─── HERO ─── */
    .hero {
      position: relative; z-index: 1;
      min-height: 92vh;
      display: flex; align-items: center; justify-content: center;
      padding: 8rem 2rem 4rem;
      text-align: center; overflow: hidden;
    }
    .hero-inner { max-width: 820px; margin: 0 auto; }
    .hero-badge {
      display: inline-flex; align-items: center; gap: 0.5rem;
      background: rgba(74,108,247,0.1); border: 1px solid rgba(74,108,247,0.2);
      color: var(--blue); font-size: 0.72rem; font-weight: 700;
      letter-spacing: 0.1em; text-transform: uppercase;
      padding: 0.4rem 1rem; border-radius: 100px; margin-bottom: 2rem;
      opacity: 0; animation: fadeUp 0.8s ease 0.2s forwards;
    }
    .hero-badge::before {
      content: ''; width: 7px; height: 7px; border-radius: 50%;
      background: var(--cyan); animation: pulse 2s ease-in-out infinite;
    }
    @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.4;transform:scale(0.7)} }
    .hero h1 {
      font-size: clamp(2.5rem, 6vw, 4.5rem); font-weight: 900;
      line-height: 1.1; letter-spacing: -0.03em; margin-bottom: 1.5rem;
      opacity: 0; animation: fadeUp 0.9s ease 0.35s forwards;
    }
    .hero h1 .line2 {
      display: block; background: var(--grad);
      -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .hero-sub {
      font-size: clamp(1rem, 2vw, 1.125rem); color: var(--text-muted);
      max-width: 580px; margin: 0 auto 2.5rem; line-height: 1.75;
      opacity: 0; animation: fadeUp 0.9s ease 0.5s forwards;
    }
    .hero-ctas {
      display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap;
      opacity: 0; animation: fadeUp 0.9s ease 0.65s forwards;
    }
    .btn-primary {
      display: inline-flex; align-items: center; gap: 0.4rem;
      background: var(--grad); color: #fff; text-decoration: none;
      padding: 0.8rem 1.75rem; border-radius: 10px;
      font-size: 0.9rem; font-weight: 700;
      transition: opacity 0.2s, transform 0.2s;
    }
    .btn-primary:hover { opacity: 0.88; transform: translateY(-1px); }
    .btn-secondary {
      display: inline-flex; align-items: center; gap: 0.4rem;
      background: transparent; color: var(--text-muted); text-decoration: none;
      padding: 0.8rem 1.75rem; border-radius: 10px;
      font-size: 0.9rem; font-weight: 600;
      border: 1px solid var(--navy-border);
      transition: all 0.2s;
    }
    .btn-secondary:hover { border-color: var(--navy-border-hover); color: var(--text); transform: translateY(-1px); }
    .hero-scroll {
      position: absolute; bottom: 2.5rem; left: 50%; transform: translateX(-50%);
      display: flex; flex-direction: column; align-items: center; gap: 0.4rem;
      opacity: 0; animation: fadeIn 1s ease 1.2s forwards;
    }
    .hero-scroll span { font-size: 0.7rem; color: var(--text-muted); letter-spacing: 0.1em; text-transform: uppercase; }
    .scroll-line {
      width: 1px; height: 40px;
      background: linear-gradient(to bottom, var(--blue), transparent);
      animation: scrollPulse 2s ease-in-out infinite;
    }
    @keyframes scrollPulse { 0%,100%{opacity:1;transform:scaleY(1)} 50%{opacity:0.3;transform:scaleY(0.6)} }
    @keyframes fadeUp { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }
    @keyframes fadeIn  { from{opacity:0} to{opacity:1} }

    /* ─── STATS BAR ─── */
    .stats-bar {
      position: relative; z-index: 1;
      background: var(--navy-2);
      border-top: 1px solid var(--navy-border);
      border-bottom: 1px solid var(--navy-border);
      padding: 2rem;
    }
    .stats-inner {
      max-width: 1000px; margin: 0 auto;
      display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;
    }
    .stat-item {
      text-align: center; padding: 1rem;
      border-right: 1px solid var(--navy-border);
    }
    .stat-item:last-child { border-right: none; }
    .stat-val {
      font-size: clamp(1.75rem, 3vw, 2.5rem); font-weight: 900;
      background: var(--grad);
      -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
      line-height: 1; margin-bottom: 0.3rem; display: block;
    }
    .stat-lbl { font-size: 0.8rem; color: var(--text-muted); line-height: 1.4; }

    /* ─── SECTION BASE ─── */
    section { position: relative; z-index: 1; }
    .container { max-width: 1100px; margin: 0 auto; padding: 0 2rem; }

    /* Reveal animations */
    .reveal       { opacity:0; transform:translateY(40px);   transition:opacity .75s cubic-bezier(.16,1,.3,1),transform .75s cubic-bezier(.16,1,.3,1); }
    .reveal-left  { opacity:0; transform:translateX(-40px);  transition:opacity .75s cubic-bezier(.16,1,.3,1),transform .75s cubic-bezier(.16,1,.3,1); }
    .reveal-right { opacity:0; transform:translateX(40px);   transition:opacity .75s cubic-bezier(.16,1,.3,1),transform .75s cubic-bezier(.16,1,.3,1); }
    .reveal.visible,.reveal-left.visible,.reveal-right.visible { opacity:1; transform:none; }
    .delay-1 { transition-delay:.1s!important; }
    .delay-2 { transition-delay:.2s!important; }
    .delay-3 { transition-delay:.3s!important; }
    .delay-4 { transition-delay:.4s!important; }
    .delay-5 { transition-delay:.5s!important; }

    /* Section labels */
    .section-label {
      font-size: 0.72rem; font-weight: 700; letter-spacing: 0.12em;
      text-transform: uppercase; color: var(--blue); margin-bottom: 1rem; display: block;
    }
    .section-title {
      font-size: clamp(1.75rem, 3.5vw, 2.75rem); font-weight: 800;
      letter-spacing: -0.025em; line-height: 1.2; margin-bottom: 1.25rem;
    }
    .section-title .grad {
      background: var(--grad);
      -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .section-desc { color: var(--text-muted); font-size: 1rem; line-height: 1.75; max-width: 560px; }

    /* ─── MISSÃO ─── */
    .mission-section { padding: 7rem 0; }
    .mission-grid { display:grid; grid-template-columns:1fr 1fr; gap:4rem; align-items:center; }
    .mission-visual { position: relative; }
    .mission-card-main {
      background: var(--navy-card); border: 1px solid var(--navy-border);
      border-radius: 20px; padding: 2.5rem;
      position: relative; overflow: hidden;
    }
    .mission-card-main::before {
      content: ''; position: absolute; top:0; left:0; right:0; height:3px; background:var(--grad);
    }
    .mission-card-main blockquote {
      font-size: clamp(1.1rem, 2vw, 1.375rem); font-weight: 600;
      line-height: 1.6; color: var(--text); font-style: italic; margin-bottom: 1.5rem;
    }
    .mission-card-main blockquote span {
      background: var(--grad);
      -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
      font-style: normal;
    }
    .mission-tag {
      display: inline-flex; align-items: center; gap: 0.4rem;
      font-size: 0.78rem; color: var(--text-muted); font-weight: 500;
    }
    .mission-tag::before { content: '—'; color: var(--blue); }
    .mission-float-card {
      position: absolute; bottom: -1.5rem; right: -1.5rem;
      background: var(--navy-2); border: 1px solid var(--navy-border);
      border-radius: 14px; padding: 1rem 1.25rem;
      display: flex; align-items: center; gap: 0.75rem;
      box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }
    .mfc-icon {
      width:36px; height:36px; border-radius:8px;
      background:rgba(0,212,255,0.1); border:1px solid rgba(0,212,255,0.2);
      display:flex; align-items:center; justify-content:center; font-size:1rem;
    }
    .mfc-text .val { font-size:1rem; font-weight:800; color:var(--cyan); }
    .mfc-text .lbl { font-size:0.72rem; color:var(--text-muted); }

    /* ─── VALORES ─── */
    .values-section {
      padding: 7rem 0; background: var(--navy-2);
      border-top: 1px solid var(--navy-border); border-bottom: 1px solid var(--navy-border);
    }
    .values-header { text-align:center; margin-bottom:4rem; }
    .values-header .section-desc { margin: 0 auto; }
    .values-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1.25rem; }
    .value-card {
      background: var(--navy-card); border: 1px solid var(--navy-border);
      border-radius: 16px; padding: 2rem;
      transition: border-color .3s, transform .3s, background .3s; cursor: default;
    }
    .value-card:hover { border-color:var(--navy-border-hover); background:var(--navy-card-hover); transform:translateY(-4px); }
    .value-icon {
      width:48px; height:48px; border-radius:12px;
      background:rgba(74,108,247,0.1); border:1px solid rgba(74,108,247,0.15);
      display:flex; align-items:center; justify-content:center;
      font-size:1.25rem; margin-bottom:1.25rem;
    }
    .value-card h3 { font-size:1.0625rem; font-weight:700; margin-bottom:.6rem; color:var(--text); }
    .value-card p  { font-size:0.875rem; color:var(--text-muted); line-height:1.65; }

    /* ─── COMO TRABALHAMOS ─── */
    .process-section { padding: 7rem 0; }
    .process-layout { display:grid; grid-template-columns:1fr 1.4fr; gap:5rem; align-items:start; }
    .process-sticky { position:sticky; top:90px; }
    .process-steps-list { display:flex; flex-direction:column; gap:0; }
    .p-step {
      display:flex; gap:1.25rem; padding:1.5rem 0;
      border-bottom:1px solid var(--navy-border); transition:opacity .3s;
    }
    .p-step:last-child { border-bottom:none; }
    .p-step-num {
      width:40px; height:40px; border-radius:10px;
      background:var(--navy-card); border:1px solid var(--navy-border);
      color:var(--blue); font-size:0.8rem; font-weight:800;
      display:flex; align-items:center; justify-content:center; flex-shrink:0;
      transition:background .3s, border-color .3s;
    }
    .p-step:hover .p-step-num { background:rgba(74,108,247,0.15); border-color:rgba(74,108,247,0.3); }
    .p-step-body h4 { font-size:.9375rem; font-weight:700; color:var(--text); margin-bottom:.3rem; }
    .p-step-body p  { font-size:.845rem; color:var(--text-muted); line-height:1.6; }

    /* ─── SERVIÇOS HIGHLIGHT ─── */
    .services-section {
      padding: 7rem 0; background: var(--navy-2);
      border-top: 1px solid var(--navy-border); border-bottom: 1px solid var(--navy-border);
    }
    .services-header { text-align:center; margin-bottom:3.5rem; }
    .services-header .section-desc { margin: 0 auto; }
    .services-cards { display:grid; grid-template-columns:repeat(3,1fr); gap:1rem; }
    .srv-card {
      background: var(--navy-card); border: 1px solid var(--navy-border);
      border-radius: 14px; padding: 1.5rem; text-decoration: none; display: block;
      transition: border-color .25s, transform .25s, background .25s;
    }
    .srv-card:hover { border-color:var(--navy-border-hover); background:var(--navy-card-hover); transform:translateY(-3px); }
    .srv-card-icon {
      width:40px; height:40px; border-radius:10px;
      background:rgba(74,108,247,0.1); border:1px solid rgba(74,108,247,0.15);
      display:flex; align-items:center; justify-content:center;
      font-size:1.1rem; margin-bottom:1rem;
    }
    .srv-card h3 { font-size:.9375rem; font-weight:700; color:var(--text); margin-bottom:.4rem; }
    .srv-card p  { font-size:.8125rem; color:var(--text-muted); line-height:1.6; margin-bottom:.85rem; }
    .srv-card .srv-link {
      font-size:.78rem; font-weight:600; color:var(--cyan);
      display:flex; align-items:center; gap:.3rem; transition:gap .2s;
    }
    .srv-card:hover .srv-link { gap:.55rem; }

    /* ─── DIFERENCIAIS ─── */
    .diff-section { padding: 7rem 0; }
    .diff-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:1.25rem; }
    .diff-item {
      background: var(--navy-card); border: 1px solid var(--navy-border);
      border-radius: 14px; padding: 1.75rem 2rem;
      display: flex; gap: 1.25rem; align-items: flex-start;
      transition: border-color .25s, background .25s;
    }
    .diff-item:hover { border-color:var(--navy-border-hover); background:var(--navy-card-hover); }
    .diff-item-icon {
      width:44px; height:44px; border-radius:10px;
      background:rgba(74,108,247,0.1); border:1px solid rgba(74,108,247,0.15);
      display:flex; align-items:center; justify-content:center;
      font-size:1.1rem; flex-shrink:0;
    }
    .diff-item h4 { font-size:.9375rem; font-weight:700; color:var(--text); margin-bottom:.4rem; }
    .diff-item p  { font-size:.845rem; color:var(--text-muted); line-height:1.65; }

    /* ─── CTA FINAL ─── */
    .cta-section { padding: 4rem 0; }
    .cta-card {
      background: var(--grad); border-radius: 20px; padding: 3.5rem 3rem;
      text-align: center; position: relative; overflow: hidden;
    }
    .cta-card::before {
      content: ''; position: absolute; inset: 0;
      background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .cta-card h2 {
      font-size: clamp(1.5rem, 3vw, 2.2rem); font-weight: 800; color: #fff;
      letter-spacing: -0.02em; margin-bottom: 0.75rem; position: relative;
    }
    .cta-card p {
      color: rgba(255,255,255,0.8); font-size: 0.95rem; max-width: 480px;
      margin: 0 auto 2rem; line-height: 1.7; position: relative;
    }
    .cta-btns { display:flex; gap:.75rem; justify-content:center; flex-wrap:wrap; position:relative; }
    .btn-white {
      background: #fff; color: var(--navy); text-decoration: none;
      padding: .85rem 2rem; border-radius: 10px; font-size: .9rem; font-weight: 800;
      transition: opacity .2s, transform .2s;
      display: inline-flex; align-items: center; gap: .4rem;
    }
    .btn-white:hover { opacity: .9; transform: translateY(-2px); }
    .btn-outline-white {
      background: rgba(255,255,255,0.1); border: 1.5px solid rgba(255,255,255,0.3);
      color: #fff; text-decoration: none;
      padding: .85rem 2rem; border-radius: 10px; font-size: .9rem; font-weight: 700;
      transition: background .2s, transform .2s;
      display: inline-flex; align-items: center; gap: .4rem;
    }
    .btn-outline-white:hover { background: rgba(255,255,255,0.2); transform: translateY(-2px); }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 900px) {
      .mission-grid   { grid-template-columns:1fr; gap:2.5rem; }
      .mission-float-card { position:static; margin-top:1rem; width:fit-content; }
      .process-layout { grid-template-columns:1fr; gap:2.5rem; }
      .process-sticky { position:static; }
      .values-grid    { grid-template-columns:repeat(2,1fr); }
      .services-cards { grid-template-columns:repeat(2,1fr); }
      .diff-grid      { grid-template-columns:1fr; }
    }
    @media (max-width: 640px) {
      .stats-inner { grid-template-columns:repeat(2,1fr); }
      .stat-item { border-right:none; border-bottom:1px solid var(--navy-border); }
      .stat-item:nth-child(odd)     { border-right:1px solid var(--navy-border); }
      .stat-item:nth-last-child(-n+2) { border-bottom:none; }
      .values-grid    { grid-template-columns:1fr; }
      .services-cards { grid-template-columns:1fr; }
      .cta-card { padding:2.5rem 1.5rem; }
      .hero { min-height:85vh; padding:6rem 1.25rem 3rem; }
      .container { padding:0 1.25rem; }
      .mission-section,.values-section,.process-section,
      .services-section,.diff-section,.cta-section { padding:4.5rem 0; }
    }
  </style>
</head>
<body>

<div class="bg-orbs">
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>
  <div class="orb orb-3"></div>
</div>

@include('partials.site-header')

<!-- ─── HERO ─── -->
<section class="hero">
  <div class="hero-inner">
    <div class="hero-badge">Quem Somos</div>
    <h1>
      Não somos mais<br>
      <span class="line2">uma agência.</span>
    </h1>
    <p class="hero-sub">Somos o parceiro estratégico que o seu negócio precisava. Uma equipa focada em resultados reais, com a expertise, os processos e as ferramentas para transformar a sua presença digital numa máquina de crescimento.</p>
    <div class="hero-ctas">
      <a href="{{ route('services') }}" class="btn-primary">Ver os nossos serviços →</a>
      <a href="{{ route('home') }}#cta-final" class="btn-secondary">Falar connosco</a>
    </div>
  </div>
  <div class="hero-scroll">
    <span>Scroll</span>
    <div class="scroll-line"></div>
  </div>
</section>

<!-- ─── STATS BAR ─── -->
<div class="stats-bar">
  <div class="stats-inner">
    <div class="stat-item reveal delay-1">
      <span class="stat-val" data-target="240" data-suffix="%+">0%+</span>
      <span class="stat-lbl">Crescimento médio de tráfego orgânico</span>
    </div>
    <div class="stat-item reveal delay-2">
      <span class="stat-val" data-target="4.2" data-suffix="×">0×</span>
      <span class="stat-lbl">ROAS médio em campanhas pagas</span>
    </div>
    <div class="stat-item reveal delay-3">
      <span class="stat-val" data-target="72" data-suffix="h">0h</span>
      <span class="stat-lbl">Tempo máximo de resposta garantido</span>
    </div>
    <div class="stat-item reveal delay-4">
      <span class="stat-val" data-target="5" data-suffix=" serviços">0</span>
      <span class="stat-lbl">Áreas de atuação integradas</span>
    </div>
  </div>
</div>

<!-- ─── MISSÃO ─── -->
<section class="mission-section">
  <div class="container">
    <div class="mission-grid">
      <div class="reveal-left">
        <span class="section-label">A Nossa Missão</span>
        <h2 class="section-title">Crescimento real,<br><span class="grad">não promessas vazias</span></h2>
        <p class="section-desc">A NexusVora nasceu com uma premissa simples: as empresas merecem um parceiro de marketing digital que fala a linguagem dos resultados. Não de impressões, não de seguidores — de negócio, faturação e crescimento mensurável.</p>
        <br>
        <p class="section-desc">Combinamos estratégia, criatividade e tecnologia para criar ecossistemas digitais que trabalham em conjunto. Do site à automação com IA, da campanha de publicidade ao SEO — tudo integrado, tudo orientado a um único objetivo: <strong style="color:var(--text);">fazer o seu negócio crescer.</strong></p>
      </div>
      <div class="reveal-right">
        <div class="mission-visual">
          <div class="mission-card-main">
            <blockquote>
              "O nosso trabalho não é fazer sites bonitos ou publicar nas redes sociais. É <span>transformar investimento em crescimento real e mensurável.</span>"
            </blockquote>
            <span class="mission-tag">NexusVora — A nossa promessa</span>
          </div>
          <div class="mission-float-card">
            <div class="mfc-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/><line x1="2" y1="20" x2="22" y2="20"/></svg>
            </div>
            <div class="mfc-text">
              <div class="val">100% Transparente</div>
              <div class="lbl">Relatórios mensais detalhados</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ─── VALORES ─── -->
<section class="values-section">
  <div class="container">
    <div class="values-header reveal">
      <span class="section-label">Os Nossos Valores</span>
      <h2 class="section-title">O que nos <span class="grad">define</span></h2>
      <p class="section-desc">Os princípios que guiam cada decisão, cada campanha e cada relação com os nossos clientes.</p>
    </div>
    <div class="values-grid">
      <div class="value-card reveal delay-1">
        <div class="value-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
        </div>
        <h3>Orientados a Resultados</h3>
        <p>Cada ação tem um objetivo mensurável. Nunca investimos tempo ou dinheiro sem saber o impacto esperado e sem conseguir medir o retorno real.</p>
      </div>
      <div class="value-card reveal delay-2">
        <div class="value-icon" style="background:rgba(0,212,255,0.08);border-color:rgba(0,212,255,0.15);">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
        </div>
        <h3>Transparência Total</h3>
        <p>Relatórios mensais detalhados, sem métricas de vaidade. Sabem sempre o que fizemos, o que funcionou e o que estamos a otimizar.</p>
      </div>
      <div class="value-card reveal delay-3">
        <div class="value-icon" style="background:rgba(139,63,219,0.08);border-color:rgba(139,63,219,0.15);">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#8B3FDB" stroke-width="1.8" stroke-linecap="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <h3>Parceiros, Não Fornecedores</h3>
        <p>Tratamos o vosso negócio como se fosse nosso. O vosso crescimento é o nosso crescimento — por isso investimos na vossa estratégia a longo prazo.</p>
      </div>
      <div class="value-card reveal delay-1">
        <div class="value-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
        </div>
        <h3>Velocidade e Rigor</h3>
        <p>Agimos rápido sem comprometer a qualidade. Respostas em menos de 72 horas, execução com atenção obsessiva ao detalhe e aos dados.</p>
      </div>
      <div class="value-card reveal delay-2">
        <div class="value-icon" style="background:rgba(0,212,255,0.08);border-color:rgba(0,212,255,0.15);">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/><line x1="2" y1="20" x2="22" y2="20"/></svg>
        </div>
        <h3>Decisões Baseadas em Dados</h3>
        <p>Nada é feito por intuição. Cada decisão estratégica é suportada por dados reais, testes A/B e análise contínua de performance.</p>
      </div>
      <div class="value-card reveal delay-3">
        <div class="value-icon" style="background:rgba(139,63,219,0.08);border-color:rgba(139,63,219,0.15);">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#8B3FDB" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
        </div>
        <h3>Inovação Constante</h3>
        <p>O digital muda todos os dias. A nossa equipa está sempre na vanguarda — de novas plataformas a ferramentas de IA que criam vantagem competitiva real.</p>
      </div>
    </div>
  </div>
</section>

<!-- ─── COMO TRABALHAMOS ─── -->
<section class="process-section">
  <div class="container">
    <div class="process-layout">
      <div class="process-sticky reveal-left">
        <span class="section-label">Como Trabalhamos</span>
        <h2 class="section-title">Um processo<br><span class="grad">pensado para resultados</span></h2>
        <p class="section-desc">Desde o primeiro contacto até aos relatórios mensais — cada etapa foi desenhada para maximizar o retorno do investimento e garantir que nunca fica sem saber o que está a acontecer.</p>
        <br>
        <a href="{{ route('home') }}#cta-final" class="btn-primary" style="margin-top:0.5rem; display:inline-flex;">Começar agora →</a>
      </div>
      <div class="process-steps-list">
        <div class="p-step reveal delay-1">
          <div class="p-step-num">01</div>
          <div class="p-step-body">
            <h4>Diagnóstico Gratuito</h4>
            <p>Analisamos a vossa presença digital atual, identificamos oportunidades imediatas e percebemos os objetivos reais do negócio. Sem compromisso, com total honestidade.</p>
          </div>
        </div>
        <div class="p-step reveal delay-2">
          <div class="p-step-num">02</div>
          <div class="p-step-body">
            <h4>Proposta Estratégica</h4>
            <p>Criamos uma proposta personalizada com os serviços certos para os vossos objetivos, com budget realista e projeção de resultados esperados.</p>
          </div>
        </div>
        <div class="p-step reveal delay-3">
          <div class="p-step-num">03</div>
          <div class="p-step-body">
            <h4>Onboarding e Configuração</h4>
            <p>Em menos de uma semana, a equipa está integrada, os acessos configurados e a estratégia em execução. Rápido, organizado e sem complicações.</p>
          </div>
        </div>
        <div class="p-step reveal delay-4">
          <div class="p-step-num">04</div>
          <div class="p-step-body">
            <h4>Execução e Otimização</h4>
            <p>Executamos com rigor e otimizamos continuamente com base nos dados. Cada campanha, cada post, cada página é analisada e melhorada semana a semana.</p>
          </div>
        </div>
        <div class="p-step reveal delay-5">
          <div class="p-step-num">05</div>
          <div class="p-step-body">
            <h4>Relatórios e Alinhamento Mensal</h4>
            <p>Reunião mensal de alinhamento estratégico com relatório detalhado. Sabem sempre o que está a funcionar, o que estamos a otimizar e o plano para o mês seguinte.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ─── SERVIÇOS ─── -->
<section class="services-section">
  <div class="container">
    <div class="services-header reveal">
      <span class="section-label">O Que Fazemos</span>
      <h2 class="section-title">Uma suite completa de<br><span class="grad">serviços integrados</span></h2>
      <p class="section-desc">Cada serviço foi pensado para funcionar em conjunto — porque o crescimento real acontece quando todos os canais trabalham como um só.</p>
    </div>
    <div class="services-cards">
      <a href="{{ route('services') }}#web" class="srv-card reveal delay-1">
        <div class="srv-card-icon" style="background:rgba(0,212,255,0.1);border-color:rgba(0,212,255,0.2);">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round"><rect x="3" y="4" width="18" height="13" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
        </div>
        <h3>Desenvolvimento Web</h3>
        <p>Sites, lojas online e plataformas que convertem visitantes em clientes 24/7.</p>
        <span class="srv-link">Saber mais →</span>
      </a>
      <a href="{{ route('services') }}#social" class="srv-card reveal delay-2">
        <div class="srv-card-icon" style="background:rgba(74,108,247,0.1);border-color:rgba(74,108,247,0.2);">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round"><rect x="2" y="2" width="9" height="9" rx="1.5"/><rect x="13" y="2" width="9" height="9" rx="1.5"/><rect x="2" y="13" width="9" height="9" rx="1.5"/><rect x="13" y="13" width="9" height="9" rx="1.5"/></svg>
        </div>
        <h3>Gestão de Redes Sociais</h3>
        <p>Conteúdo estratégico e gestão diária que constrói comunidade e gera negócio.</p>
        <span class="srv-link">Saber mais →</span>
      </a>
      <a href="{{ route('services') }}#trafego" class="srv-card reveal delay-3">
        <div class="srv-card-icon" style="background:rgba(139,63,219,0.1);border-color:rgba(139,63,219,0.2);">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8B3FDB" stroke-width="1.8" stroke-linecap="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </div>
        <h3>Tráfego, Leads &amp; Conversões</h3>
        <p>Google Ads, Meta Ads e SEO integrados numa estratégia que nunca para.</p>
        <span class="srv-link">Saber mais →</span>
      </a>
      <a href="{{ route('services') }}#nexusai" class="srv-card reveal delay-1">
        <div class="srv-card-icon" style="background:rgba(245,166,35,0.1);border-color:rgba(245,166,35,0.25);">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#F5A623" stroke-width="1.8" stroke-linecap="round"><path d="M12 2a10 10 0 1 0 10 10"/><path d="M12 6v6l4 2"/><circle cx="19" cy="5" r="3" fill="#F5A623" opacity=".3"/><circle cx="19" cy="5" r="1.5" fill="#F5A623"/></svg>
        </div>
        <h3>NexusAI</h3>
        <p>Automação inteligente e IA aplicada para o negócio trabalhar enquanto dorme.</p>
        <span class="srv-link" style="color:var(--cyan);">Saber mais →</span>
      </a>
      <a href="{{ route('services') }}#marca" class="srv-card reveal delay-2">
        <div class="srv-card-icon" style="background:rgba(74,108,247,0.1);border-color:rgba(74,108,247,0.2);">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        </div>
        <h3>Marca &amp; Estratégia Digital</h3>
        <p>Identidade visual e plano estratégico completo para crescer com direção clara.</p>
        <span class="srv-link">Saber mais →</span>
      </a>
      <div class="srv-card reveal delay-3" style="background:rgba(74,108,247,0.04);border-style:dashed;cursor:default;">
        <div class="srv-card-icon" style="background:rgba(74,108,247,0.1);border-color:rgba(74,108,247,0.2);">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
        </div>
        <h3>Estratégia Integrada 360°</h3>
        <p>Todos os serviços a trabalhar em conjunto numa única estratégia coerente e orientada ao crescimento.</p>
        <span class="srv-link">Ver estratégia →</span>
      </div>
    </div>
  </div>
</section>

<!-- ─── DIFERENCIAIS ─── -->
<section class="diff-section">
  <div class="container">
    <div style="text-align:center; margin-bottom:3.5rem;" class="reveal">
      <span class="section-label">Porquê a NexusVora</span>
      <h2 class="section-title">O que nos torna <span class="grad">diferentes</span></h2>
    </div>
    <div class="diff-grid">
      <div class="diff-item reveal delay-1">
        <div class="diff-item-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/><line x1="2" y1="20" x2="22" y2="20"/></svg>
        </div>
        <div>
          <h4>Relatórios que fazem sentido</h4>
          <p>Sem métricas de vaidade. Reportamos o que impacta o negócio — leads gerados, custo por aquisição, retorno real do investimento e crescimento de receita.</p>
        </div>
      </div>
      <div class="diff-item reveal delay-2">
        <div class="diff-item-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
        </div>
        <div>
          <h4>Estratégia verdadeiramente integrada</h4>
          <p>O SEO alimenta as campanhas pagas. O conteúdo das redes sociais torna-se publicidade. O site é otimizado para converter. Tudo funciona em conjunto.</p>
        </div>
      </div>
      <div class="diff-item reveal delay-3">
        <div class="diff-item-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round"><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><line x1="9" y1="1" x2="9" y2="4"/><line x1="15" y1="1" x2="15" y2="4"/><line x1="9" y1="20" x2="9" y2="23"/><line x1="15" y1="20" x2="15" y2="23"/><line x1="20" y1="9" x2="23" y2="9"/><line x1="20" y1="14" x2="23" y2="14"/><line x1="1" y1="9" x2="4" y2="9"/><line x1="1" y1="14" x2="4" y2="14"/></svg>
        </div>
        <div>
          <h4>Tecnologia e IA ao serviço do crescimento</h4>
          <p>A nossa abordagem incorpora automação inteligente e ferramentas de IA para que o negócio escale sem escalar os custos operacionais proporcionalmente.</p>
        </div>
      </div>
      <div class="diff-item reveal delay-4">
        <div class="diff-item-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <div>
          <h4>Sem contratos longos nem amarras</h4>
          <p>Ficam porque os resultados justificam — não porque um contrato os obriga. Flexibilidade total com compromisso real com a performance.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ─── CTA FINAL ─── -->
<section class="cta-section">
  <div class="container">
    <div class="cta-card reveal">
      <h2>Prontos para crescer juntos?</h2>
      <p>Uma conversa de 30 minutos pode ser o início de uma grande transformação para o vosso negócio. Sem compromisso, com total transparência.</p>
      <div class="cta-btns">
        <a href="{{ route('home') }}#cta-final" class="btn-white">Pedir diagnóstico gratuito →</a>
        <a href="{{ route('services') }}" class="btn-outline-white">Ver todos os serviços</a>
      </div>
    </div>
  </div>
</section>

@include('partials.site-footer')

<script>
  /* ─── SCROLL REVEAL ─── */
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });

  document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => revealObserver.observe(el));

  /* ─── COUNTER ANIMATION ─── */
  function animateCounter(el) {
    const target = parseFloat(el.dataset.target);
    const suffix = el.dataset.suffix || '';
    const isDecimal = target % 1 !== 0;
    const duration = 1800;
    const start = performance.now();
    function update(now) {
      const elapsed = now - start;
      const progress = Math.min(elapsed / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      const current = target * eased;
      el.textContent = (isDecimal ? current.toFixed(1) : Math.round(current)) + suffix;
      if (progress < 1) requestAnimationFrame(update);
    }
    requestAnimationFrame(update);
  }

  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        counterObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  document.querySelectorAll('.stat-val[data-target]').forEach(el => counterObserver.observe(el));

</script>

</body>
</html>
