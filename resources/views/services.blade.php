<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('partials.site-head')
  <title>Serviços Digitais para Empresas no Porto | NexusVora</title>
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
      /* NexusAI premium palette */
      --ai-gold: #F5A623;
      --ai-amber: #FF6B35;
      --ai-grad: linear-gradient(135deg, #F5A623, #FF6B35, #8B3FDB);
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


    /* ── PAGE HEADER ── */
    .page-header {
      padding: 140px 5vw 72px;
      background: var(--navy2);
      position: relative; overflow: hidden; text-align: center;
    }
    .page-header::before {
      content: '';
      position: absolute; top: -140px; left: 50%; transform: translateX(-50%);
      width: 800px; height: 600px;
      background: radial-gradient(circle, rgba(74,108,247,0.13) 0%, transparent 70%);
    }
    .hero-dots {
      position: absolute; inset: 0;
      background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
      background-size: 40px 40px;
      mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 20%, transparent 100%);
    }
    .page-header-inner { position: relative; z-index: 1; max-width: 680px; margin: 0 auto; }
    .section-tag {
      font-size: 0.72rem; font-weight: 700; letter-spacing: 0.12em;
      text-transform: uppercase; color: var(--cyan); margin-bottom: 14px;
    }
    .page-header h1 {
      font-size: clamp(1.9rem, 3.5vw, 3rem); font-weight: 800;
      color: #fff; letter-spacing: -0.03em; margin-bottom: 20px;
    }
    .grad-text {
      background: var(--grad);
      -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .page-header p {
      font-size: 1.02rem; color: var(--text-muted); line-height: 1.75; text-wrap: pretty;
    }

    /* ── SERVICE HUB ── */
    .service-hub { padding: 0 5vw 88px; background: var(--navy2); position: relative; }
    .service-hub-inner { max-width: 1100px; margin: 0 auto; }
    .service-hub-intro { display:flex; justify-content:space-between; gap:28px; align-items:end; margin-bottom:26px; }
    .service-hub-intro h2 { font-size:clamp(1.45rem,2.6vw,2.15rem); color:#fff; letter-spacing:-.025em; max-width:560px; }
    .service-hub-intro p { max-width:370px; color:var(--text-muted); line-height:1.65; font-size:.9rem; }
    .service-card-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; }
    .service-hub-card {
      position:relative; display:flex; min-height:238px; flex-direction:column; padding:24px;
      overflow:hidden; border:1px solid var(--navy-border); border-radius:18px;
      background:linear-gradient(145deg, rgba(17,25,54,.96), rgba(10,15,46,.84));
      color:var(--text); text-decoration:none; isolation:isolate;
      transition:transform .32s ease, border-color .32s ease, box-shadow .32s ease;
    }
    .service-hub-card::before { content:''; position:absolute; inset:0; opacity:0; z-index:-1; background:radial-gradient(circle at 100% 0, var(--card-glow), transparent 58%); transition:opacity .32s ease; }
    .service-hub-card::after { content:''; position:absolute; left:0; right:0; top:0; height:2px; background:var(--card-grad); transform:scaleX(.25); transform-origin:left; transition:transform .32s ease; }
    .service-hub-card:hover { transform:translateY(-7px); border-color:var(--card-border); box-shadow:0 22px 46px rgba(0,0,0,.28); }
    .service-hub-card:hover::before { opacity:1; }
    .service-hub-card:hover::after { transform:scaleX(1); }
    .service-hub-icon { width:46px; height:46px; display:grid; place-items:center; margin-bottom:24px; border:1px solid var(--card-border); border-radius:13px; background:var(--card-bg); color:var(--card-color); transition:transform .32s ease; }
    .service-hub-card:hover .service-hub-icon { transform:rotate(-5deg) scale(1.07); }
    .service-hub-card h3 { color:#fff; font-size:1.08rem; letter-spacing:-.015em; margin-bottom:8px; }
    .service-hub-card p { color:var(--text-muted); font-size:.83rem; line-height:1.6; }
    .service-hub-link { display:flex; align-items:center; gap:8px; margin-top:auto; padding-top:20px; color:var(--card-color); font-size:.79rem; font-weight:800; letter-spacing:.02em; }
    .service-hub-link svg { transition:transform .25s ease; }
    .service-hub-card:hover .service-hub-link svg { transform:translateX(4px); }

    /* ── SERVICE NAV PILLS ── */
    .service-nav {
      position: sticky; top: 72px; z-index: 90;
      background: rgba(6,11,32,0.97);
      backdrop-filter: blur(16px);
      border-bottom: 1px solid var(--navy-border);
      padding: 0 5vw;
    }
    .service-nav-inner {
      max-width: 1100px; margin: 0 auto;
      display: flex; overflow-x: auto;
      scrollbar-width: none;
      -ms-overflow-style: none;
      mask-image: linear-gradient(to right, transparent, black 5%, black 95%, transparent);
      -webkit-mask-image: linear-gradient(to right, transparent, black 5%, black 95%, transparent);
    }
    .service-nav-inner::-webkit-scrollbar { display: none; }
    .service-pill {
      display: flex; align-items: center; gap: 8px;
      padding: 16px 18px;
      font-size: 0.83rem; font-weight: 600;
      color: var(--text-muted); text-decoration: none;
      border-bottom: 2px solid transparent;
      white-space: nowrap;
      transition: color .2s, border-color .2s;
    }
    .service-pill:hover { color: #fff; }
    .service-pill.active { color: var(--cyan); border-bottom-color: var(--cyan); }
    .service-pill.ai-pill.active { color: var(--ai-gold); border-bottom-color: var(--ai-gold); }
    .pill-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }

    /* ── SHARED SERVICE SECTION ── */
    .service-section {
      padding: 96px 5vw;
      border-bottom: 1px solid var(--navy-border);
      scroll-margin-top: 140px; /* Offset for sticky headers */
    }
    .service-section:nth-child(even) { background: var(--navy); }
    .service-section:nth-child(odd) { background: var(--navy2); }

    .service-inner {
      max-width: 1100px; margin: 0 auto;
    }

    /* Layout: 2-col (content + sidebar) */
    .two-col {
      display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 72px; align-items: start;
    }
    .two-col.reverse { direction: rtl; }
    .two-col.reverse > * { direction: ltr; }

    .service-number {
      font-size: 0.7rem; font-weight: 700; letter-spacing: 0.12em;
      text-transform: uppercase; color: var(--text-muted); margin-bottom: 10px;
      display: flex; align-items: center; gap: 10px;
    }
    .service-number::before { content: ''; display: inline-block; width: 22px; height: 1px; background: currentColor; }

    .service-icon-wrap {
      width: 54px; height: 54px; border-radius: 14px;
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 18px; flex-shrink: 0;
    }

    .service-content h2 {
      font-size: clamp(1.55rem, 2.6vw, 2.15rem); font-weight: 800;
      color: #fff; letter-spacing: -0.02em; margin-bottom: 8px; text-wrap: pretty;
    }
    .service-subtitle {
      font-size: 0.95rem; color: var(--cyan); font-weight: 600; margin-bottom: 18px;
    }
    .service-desc {
      font-size: 0.93rem; color: var(--text-muted); line-height: 1.8;
      margin-bottom: 28px; text-wrap: pretty;
    }

    /* Area grid */
    .areas-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.72rem; font-weight: 700; letter-spacing: 0.1em;
      text-transform: uppercase; color: var(--text-muted); margin-bottom: 14px;
    }
    .areas-grid {
      display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 28px;
    }
    .area-item {
      background: rgba(255,255,255,0.03);
      border: 1px solid var(--navy-border);
      border-radius: 10px; padding: 14px 16px;
      transition: border-color .2s, background .2s;
    }
    .area-item:hover { border-color: rgba(74,108,247,0.25); background: rgba(74,108,247,0.05); }
    .area-item h4 { font-size: 0.85rem; font-weight: 700; color: #fff; margin-bottom: 4px; }
    .area-item p { font-size: 0.78rem; color: var(--text-muted); line-height: 1.5; }

    /* Included list */
    .included-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.72rem; font-weight: 700; letter-spacing: 0.1em;
      text-transform: uppercase; color: var(--text-muted); margin-bottom: 12px;
    }
    .check-list { list-style: none; display: flex; flex-direction: column; gap: 9px; margin-bottom: 28px; }
    .check-list li {
      display: flex; gap: 10px; align-items: flex-start;
      font-size: 0.88rem; color: var(--text); line-height: 1.5;
    }
    .chk {
      width: 18px; height: 18px; flex-shrink: 0; margin-top: 1px;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
    }

    /* Table */
    .info-table {
      width: 100%; border-collapse: collapse; margin-bottom: 28px;
      font-size: 0.85rem;
    }
    .info-table th {
      text-align: left; padding: 10px 14px;
      background: rgba(255,255,255,0.04);
      color: var(--text-muted); font-weight: 600; font-size: 0.75rem;
      letter-spacing: 0.06em; text-transform: uppercase;
      border-bottom: 1px solid var(--navy-border);
    }
    .info-table td {
      padding: 11px 14px; color: var(--text);
      border-bottom: 1px solid rgba(255,255,255,0.04);
      line-height: 1.5;
    }
    .info-table td:first-child { color: var(--text-muted); font-weight: 500; }
    .info-table tr:last-child td { border-bottom: none; }

    /* CTA buttons */
    .btn-primary {
      display: inline-flex; align-items: center; gap: 8px;
      background: var(--grad); color: #fff;
      font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 0.92rem;
      padding: 14px 26px; border-radius: 10px; text-decoration: none;
      transition: opacity .2s, transform .2s, box-shadow .2s;
      box-shadow: 0 8px 28px rgba(74,108,247,0.3);
    }
    .btn-primary:hover { opacity: .9; transform: translateY(-2px); box-shadow: 0 14px 36px rgba(74,108,247,0.42); }
    .btn-ai {
      background: var(--ai-grad);
      box-shadow: 0 8px 28px rgba(245,166,35,0.3);
    }
    .btn-ai:hover { box-shadow: 0 14px 36px rgba(245,166,35,0.42); }
    .btn-ghost {
      display: inline-flex; align-items: center; gap: 8px;
      background: transparent; color: var(--text);
      font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 600; font-size: 0.92rem;
      padding: 14px 22px; border-radius: 10px; margin-left: 12px;
      border: 1px solid var(--navy-border); text-decoration: none;
      transition: border-color .2s, color .2s, background .2s;
    }
    .btn-ghost:hover { border-color: rgba(255,255,255,0.2); background: rgba(255,255,255,0.04); color: #fff; }

    /* ── SIDEBAR CARDS ── */
    .sidebar-card {
      background: var(--navy-card);
      border: 1px solid var(--navy-border);
      border-radius: 20px; padding: 30px;
      position: relative; overflow: hidden;
    }
    .sidebar-card::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0;
      height: 2px; background: var(--grad);
    }
    .sidebar-card + .sidebar-card { margin-top: 16px; }

    .card-section-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.72rem; font-weight: 700; letter-spacing: 0.1em;
      text-transform: uppercase; color: var(--text-muted); margin-bottom: 16px;
    }

    /* Results grid */
    .results-grid {
      display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 20px;
    }
    .result-item {
      background: rgba(255,255,255,0.03);
      border: 1px solid rgba(255,255,255,0.06);
      border-radius: 12px; padding: 16px;
    }
    .result-val {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 1.55rem; font-weight: 800;
      background: var(--grad);
      -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
      line-height: 1; margin-bottom: 5px;
    }
    .result-label { font-size: 0.75rem; color: var(--text-muted); line-height: 1.4; }

    /* Process steps */
    .process-steps { display: flex; flex-direction: column; gap: 0; }
    .process-step {
      display: flex; gap: 14px; align-items: flex-start;
      padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.04);
    }
    .process-step:last-child { border-bottom: none; }
    .step-num {
      width: 24px; height: 24px; flex-shrink: 0;
      border-radius: 6px;
      background: rgba(74,108,247,0.12);
      border: 1px solid rgba(74,108,247,0.2);
      display: flex; align-items: center; justify-content: center;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.68rem; font-weight: 800; color: var(--cyan); margin-top: 2px;
    }
    .step-text { font-size: 0.83rem; color: var(--text); line-height: 1.55; }
    .step-text strong { color: #fff; font-weight: 700; display: block; margin-bottom: 1px; }

    /* ══════════════════════════════
       NEXUSAI: PREMIUM SECTION
    ══════════════════════════════ */
    #nexusai {
      background: linear-gradient(180deg, #07091A 0%, #0D0B1E 100%) !important;
      position: relative; overflow: hidden;
    }
    #nexusai::before {
      content: '';
      position: absolute; top: -200px; left: 50%; transform: translateX(-50%);
      width: 900px; height: 600px;
      background: radial-gradient(ellipse, rgba(245,166,35,0.07) 0%, rgba(139,63,219,0.06) 40%, transparent 70%);
      pointer-events: none;
    }

    .ai-badge {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(245,166,35,0.1);
      border: 1px solid rgba(245,166,35,0.3);
      border-radius: 100px; padding: 5px 14px;
      font-size: 0.72rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase;
      color: var(--ai-gold); margin-bottom: 14px;
    }
    .ai-badge-dot {
      width: 6px; height: 6px; border-radius: 50%;
      background: var(--ai-gold);
      animation: pulse 2s infinite;
    }
    @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(1.4)} }

    .ai-title { color: #fff; }
    .ai-grad-text {
      background: var(--ai-grad);
      -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .ai-subtitle { color: var(--ai-gold) !important; }

    .ai-feature-grid {
      display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 28px;
    }
    .ai-feature {
      background: rgba(245,166,35,0.04);
      border: 1px solid rgba(245,166,35,0.12);
      border-radius: 12px; padding: 18px;
      transition: border-color .2s, background .2s;
    }
    .ai-feature:hover { border-color: rgba(245,166,35,0.28); background: rgba(245,166,35,0.07); }
    .ai-feature-icon {
      width: 34px; height: 34px; border-radius: 8px;
      background: rgba(245,166,35,0.1);
      border: 1px solid rgba(245,166,35,0.2);
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 10px;
    }
    .ai-feature h4 { font-size: 0.85rem; font-weight: 700; color: #fff; margin-bottom: 5px; }
    .ai-feature p { font-size: 0.78rem; color: var(--text-muted); line-height: 1.5; }

    .ai-sidebar::before { background: var(--ai-grad) !important; }

    .ai-result-val {
      background: var(--ai-grad) !important;
      -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .ai-step-num {
      background: rgba(245,166,35,0.12) !important;
      border-color: rgba(245,166,35,0.25) !important;
      color: var(--ai-gold) !important;
    }

    /* Before/after table for AI */
    .before-after {
      width: 100%; border-collapse: collapse; margin-bottom: 28px; font-size: 0.84rem;
    }
    .before-after th {
      padding: 10px 14px; font-size: 0.72rem; letter-spacing: 0.08em; text-transform: uppercase;
      font-weight: 700; border-bottom: 1px solid var(--navy-border);
    }
    .before-after th:first-child { color: #F87171; background: rgba(248,113,113,0.06); border-radius: 8px 0 0 0; }
    .before-after th:last-child { color: #4ADE80; background: rgba(74,222,128,0.06); border-radius: 0 8px 0 0; }
    .before-after td { padding: 10px 14px; border-bottom: 1px solid rgba(255,255,255,0.04); line-height: 1.5; }
    .before-after td:first-child { color: rgba(248,113,113,0.8); background: rgba(248,113,113,0.03); }
    .before-after td:last-child { color: rgba(74,222,128,0.9); background: rgba(74,222,128,0.03); }
    .before-after tr:last-child td { border-bottom: none; }

    /* Tráfego sub-blocks */
    .sub-service {
      background: rgba(255,255,255,0.02);
      border: 1px solid var(--navy-border);
      border-radius: 14px; padding: 24px; margin-bottom: 16px;
    }
    .sub-service-header {
      display: flex; align-items: center; gap: 12px; margin-bottom: 12px;
    }
    .sub-service-icon {
      width: 36px; height: 36px; border-radius: 9px;
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .sub-service h3 {
      font-size: 1rem; font-weight: 800; color: #fff;
    }
    .sub-service p { font-size: 0.85rem; color: var(--text-muted); line-height: 1.65; margin-bottom: 14px; }
    .sub-results {
      display: flex; gap: 10px; flex-wrap: wrap;
    }
    .sub-result-chip {
      display: flex; flex-direction: column;
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.07);
      border-radius: 8px; padding: 8px 12px;
      font-size: 0.72rem;
    }
    .sub-result-chip strong {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.95rem; font-weight: 800;
      background: var(--grad);
      -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
      margin-bottom: 1px;
    }
    .sub-result-chip span { color: var(--text-muted); }

    /* Integration quote */
    .integration-quote {
      background: linear-gradient(135deg, rgba(74,108,247,0.08), rgba(139,63,219,0.06));
      border: 1px solid rgba(74,108,247,0.2);
      border-left: 3px solid var(--blue);
      border-radius: 0 12px 12px 0; padding: 16px 20px;
      margin: 20px 0 28px;
      font-size: 0.88rem; color: var(--text-muted); line-height: 1.65; font-style: italic;
    }
    .integration-quote strong { color: var(--cyan); font-style: normal; }

    /* Estratégia deliverables */
    .deliverables-grid {
      display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 28px;
    }
    .deliverable {
      display: flex; gap: 10px; align-items: flex-start;
      background: rgba(255,255,255,0.03);
      border: 1px solid var(--navy-border);
      border-radius: 10px; padding: 14px;
    }
    .deliverable-icon {
      width: 30px; height: 30px; flex-shrink: 0; border-radius: 7px;
      display: flex; align-items: center; justify-content: center;
    }
    .deliverable-body h4 { font-size: 0.82rem; font-weight: 700; color: #fff; margin-bottom: 2px; }
    .deliverable-body p { font-size: 0.74rem; color: var(--text-muted); line-height: 1.4; }

    /* ── FINAL CTA (Project Sync) ── */
    .final-cta { background: var(--navy2); padding: 100px 5vw; }
    .cta-box {
      max-width: 1100px; margin: 0 auto;
      background: linear-gradient(135deg, rgba(74,108,247,0.14), rgba(139,63,219,0.09));
      border: 1px solid rgba(74,108,247,0.24);
      border-radius: 24px; padding: 72px 56px;
      text-align: center; position: relative; overflow: hidden;
    }
    .cta-box::before {
      content: ''; position: absolute; top: -80px; left: 50%; transform: translateX(-50%);
      width: 500px; height: 300px;
      background: radial-gradient(circle, rgba(74,108,247,0.18), transparent 70%);
    }
    .cta-box h2 {
      font-size: clamp(1.6rem, 2.8vw, 2.5rem); font-weight: 800; color: #fff;
      letter-spacing: -0.02em; margin-bottom: 14px; position: relative; z-index: 1; text-wrap: pretty;
    }
    .cta-box p {
      font-size: 1rem; color: var(--text-muted); max-width: 460px;
      margin: 0 auto 36px; line-height: 1.7; position: relative; z-index: 1;
    }
    .cta-actions { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; position: relative; z-index: 1; }


    /* scroll fade */
    .fade-up { opacity: 0; transform: translateY(28px); transition: opacity .55s ease, transform .55s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }

    @media (max-width: 960px) {
      .two-col, .two-col.reverse { grid-template-columns: 1fr; direction: ltr; gap: 40px; }
      .areas-grid, .ai-feature-grid, .deliverables-grid { grid-template-columns: 1fr; }
      .results-grid { grid-template-columns: 1fr 1fr; }
      .nav-links { display: none; }
      .footer-top { grid-template-columns: 1fr 1fr; }
      .service-card-grid { grid-template-columns:repeat(2,1fr); }
      .service-hub-intro { align-items:start; flex-direction:column; }
    }

    @media (max-width: 640px) {
      .footer-top { grid-template-columns: 1fr; }
      .footer-bottom { align-items: flex-start; flex-direction: column; }
      .service-hub { padding-bottom:58px; }
      .service-card-grid { grid-template-columns:1fr; }
      .service-hub-card { min-height:210px; }
    }
  </style>
</head>
<body>

@include('partials.site-header')

<!-- PAGE HEADER -->
<div class="page-header">
  <div class="hero-dots"></div>
  <div class="page-header-inner">
    <div class="section-tag">Serviços</div>
    <h1>Tecnologia que ajuda a sua empresa<br>a <span class="grad-text">vender, organizar e crescer.</span></h1>
    <p>Desenvolvimento web, software, e-commerce, marketing digital, marca e automação com IA. Escolha o serviço de que a sua empresa precisa.</p>
  </div>
</div>

<!-- SERVICE HUB: each card leads to an indexable service page -->
<section class="service-hub" aria-labelledby="service-hub-title">
  <div class="service-hub-inner">
    <div class="service-hub-intro fade-up">
      <h2 id="service-hub-title">Escolha o próximo passo<br><span class="grad-text">para a sua empresa.</span></h2>
      <p>Cada serviço tem uma página própria, com uma solução clara, casos de utilização e um caminho direto para avançar.</p>
    </div>
    <div class="service-card-grid">
      <a class="service-hub-card fade-up" href="{{ route('service.websites') }}" style="--card-color:#00D4FF;--card-border:rgba(0,212,255,.28);--card-bg:rgba(0,212,255,.1);--card-glow:rgba(0,212,255,.18);--card-grad:linear-gradient(90deg,#00D4FF,#4A6CF7)">
        <span class="service-hub-icon"><svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="13" rx="2"/><path d="M8 21h8M12 17v4"/></svg></span>
        <h3>Criação de Sites no Porto</h3><p>Websites profissionais, rápidos e preparados para captar contactos.</p><span class="service-hub-link">Explorar serviço <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
      </a>
      <a class="service-hub-card fade-up" href="{{ route('service.software') }}" style="--card-color:#7C9CFF;--card-border:rgba(124,156,255,.3);--card-bg:rgba(74,108,247,.12);--card-glow:rgba(74,108,247,.2);--card-grad:linear-gradient(90deg,#4A6CF7,#8B3FDB)">
        <span class="service-hub-icon"><svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="4" y="4" width="16" height="16" rx="3"/><path d="M8 9h8M8 13h5M8 17h3"/></svg></span>
        <h3>Software à Medida</h3><p>Sistemas e plataformas criados à volta do processo real do seu negócio.</p><span class="service-hub-link">Explorar serviço <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
      </a>
      <a class="service-hub-card fade-up" href="{{ route('service.integrations') }}" style="--card-color:#B08CFF;--card-border:rgba(176,140,255,.3);--card-bg:rgba(139,63,219,.11);--card-glow:rgba(139,63,219,.2);--card-grad:linear-gradient(90deg,#8B3FDB,#00D4FF)">
        <span class="service-hub-icon"><svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6" cy="12" r="3"/><circle cx="18" cy="6" r="3"/><circle cx="18" cy="18" r="3"/><path d="m8.5 10.5 7-3M8.5 13.5l7 3"/></svg></span>
        <h3>Integrações & Sistemas</h3><p>Ligue ferramentas, dados e equipas sem duplicação de trabalho.</p><span class="service-hub-link">Explorar serviço <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
      </a>
      <a class="service-hub-card fade-up" href="{{ route('service.automation') }}" style="--card-color:#F5A623;--card-border:rgba(245,166,35,.32);--card-bg:rgba(245,166,35,.1);--card-glow:rgba(245,166,35,.19);--card-grad:linear-gradient(90deg,#F5A623,#FF6B35,#8B3FDB)">
        <span class="service-hub-icon"><svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2a10 10 0 1 0 10 10"/><path d="M12 6v6l4 2"/><circle cx="19" cy="5" r="2"/></svg></span>
        <h3>Automação & IA</h3><p>Menos tarefas repetitivas, respostas mais rápidas e processos sob controlo.</p><span class="service-hub-link">Explorar serviço <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
      </a>
      <a class="service-hub-card fade-up" href="{{ route('service.ecommerce') }}" style="--card-color:#2DE2A6;--card-border:rgba(45,226,166,.28);--card-bg:rgba(45,226,166,.09);--card-glow:rgba(45,226,166,.16);--card-grad:linear-gradient(90deg,#2DE2A6,#00D4FF)">
        <span class="service-hub-icon"><svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 3h2l2 13h10l2-9H7"/><circle cx="9" cy="20" r="1"/><circle cx="17" cy="20" r="1"/></svg></span>
        <h3>E-commerce & Operações</h3><p>Stock, encomendas, lojas online e fluxos operacionais prontos a escalar.</p><span class="service-hub-link">Explorar serviço <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
      </a>
      <a class="service-hub-card fade-up" href="{{ route('service.seo') }}" style="--card-color:#00D4FF;--card-border:rgba(0,212,255,.28);--card-bg:rgba(0,212,255,.09);--card-glow:rgba(0,212,255,.17);--card-grad:linear-gradient(90deg,#00D4FF,#8B3FDB)">
        <span class="service-hub-icon"><svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="6"/><path d="m16 16 4 4M8 11h6"/></svg></span>
        <h3>SEO no Porto</h3><p>Visibilidade orgânica para ser encontrado por clientes certos.</p><span class="service-hub-link">Explorar serviço <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
      </a>
      <a class="service-hub-card fade-up" href="{{ route('service.ads') }}" style="--card-color:#A7B9FF;--card-border:rgba(167,185,255,.3);--card-bg:rgba(74,108,247,.1);--card-glow:rgba(74,108,247,.2);--card-grad:linear-gradient(90deg,#4A6CF7,#00D4FF,#8B3FDB)">
        <span class="service-hub-icon"><svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 19V9m5 10V5m5 14v-7m5 7V3"/></svg></span>
        <h3>Google Ads & Captação</h3><p>Campanhas, landing pages e medição para transformar procura em oportunidades comerciais qualificadas.</p><span class="service-hub-link">Explorar serviço <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
      </a>
      <a class="service-hub-card fade-up" href="{{ route('service.social') }}" style="--card-color:#FF78C8;--card-border:rgba(255,120,200,.3);--card-bg:rgba(255,120,200,.1);--card-glow:rgba(255,120,200,.18);--card-grad:linear-gradient(90deg,#FF78C8,#8B3FDB)">
        <span class="service-hub-icon"><svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 11.5a8.4 8.4 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 0 1-.9-3.8A8.5 8.5 0 0 1 8.7 3.9a8.4 8.4 0 0 1 3.8-.9h.5a8.5 8.5 0 0 1 8 8z"/></svg></span>
        <h3>Gestão de Redes Sociais</h3><p>Estratégia e conteúdos consistentes para comunicar com o público certo.</p><span class="service-hub-link">Explorar serviço <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
      </a>
      <a class="service-hub-card fade-up" href="{{ route('service.ai') }}" style="--card-color:#F5A623;--card-border:rgba(245,166,35,.32);--card-bg:rgba(245,166,35,.1);--card-glow:rgba(245,166,35,.19);--card-grad:linear-gradient(90deg,#F5A623,#FF6B35)">
        <span class="service-hub-icon"><svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3v3m0 12v3m9-9h-3M6 12H3m15.36-6.36-2.12 2.12M7.76 16.24l-2.12 2.12m12.72 0-2.12-2.12M7.76 7.76 5.64 5.64"/><circle cx="12" cy="12" r="5"/></svg></span>
        <h3>Inteligência Artificial</h3><p>IA aplicada a tarefas reais, com dados, limites e validação definidos.</p><span class="service-hub-link">Explorar serviço <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
      </a>
      <a class="service-hub-card fade-up" href="{{ route('service.branding') }}" style="--card-color:#B08CFF;--card-border:rgba(176,140,255,.3);--card-bg:rgba(176,140,255,.1);--card-glow:rgba(176,140,255,.18);--card-grad:linear-gradient(90deg,#8B3FDB,#00D4FF)">
        <span class="service-hub-icon"><svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3a9 9 0 1 0 0 18h1.2a2 2 0 0 0 1.5-3.3 1.8 1.8 0 0 1 1.4-3h.8A4.1 4.1 0 0 0 21 10.6C21 6.4 17 3 12 3z"/><circle cx="7.5" cy="10" r="1"/><circle cx="11" cy="7" r="1"/><circle cx="16" cy="8" r="1"/></svg></span>
        <h3>Branding & Identidade</h3><p>Posicionamento e identidade visual alinhados com o valor da empresa.</p><span class="service-hub-link">Explorar serviço <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
      </a>
      <a class="service-hub-card fade-up" href="{{ route('service.trafego') }}" style="--card-color:#00D4FF;--card-border:rgba(0,212,255,.28);--card-bg:rgba(0,212,255,.1);--card-glow:rgba(0,212,255,.18);--card-grad:linear-gradient(90deg,#00D4FF,#4A6CF7)">
        <span class="service-hub-icon"><svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 11v2a1 1 0 0 0 1 1h2l4 5V5l-4 5H4a1 1 0 0 0-1 1zM14 9a5 5 0 0 1 0 6m3-9a9 9 0 0 1 0 12"/></svg></span>
        <h3>Tráfego, Leads & Conversões</h3><p>Google Ads, Meta Ads, SEO e otimização de conversão para atrair procura e acompanhar resultados.</p><span class="service-hub-link">Explorar serviço <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
      </a>
    </div>
  </div>
</section>

<!-- FINAL CTA (Project Sync) -->
<div class="final-cta">
  <div class="cta-box">
    <h2>Não sabe por onde começar?<br><span class="grad-text">Nós ajudamos.</span></h2>
    <p>Marque uma conversa gratuita. Analisamos o seu negócio e recomendamos os serviços com maior impacto para si, sem compromisso.</p>
    <div class="cta-actions">
      <a href="{{ route('home') }}#cta-final" class="btn-primary">
        Pedir Diagnóstico Grátis
        <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
      <a href="{{ route('home') }}" class="btn-ghost">← Voltar ao início</a>
    </div>
  </div>
</div>

@include('partials.site-footer')

<script>
  const fadeObserver = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.1 });
  document.querySelectorAll('.fade-up').forEach(el => fadeObserver.observe(el));

</script>
</body>
</html>
