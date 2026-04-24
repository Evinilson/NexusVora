<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Serviços — NexusVora | Marketing Digital Full-Service</title>
  <meta name="description" content="Desenvolvimento web, gestão de redes sociais, Google Ads, Meta Ads, SEO, automação com IA e estratégia de marca. NexusVora — agência de marketing digital full-service." />
  <link rel="icon" type="image/svg+xml" href='data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" fill="none"%3E%3Cdefs%3E%3ClinearGradient id="ng" x1="0" y1="0" x2="60" y2="60" gradientUnits="userSpaceOnUse"%3E%3Cstop offset="0%25" stop-color="%2300D4FF"/%3E%3Cstop offset="50%25" stop-color="%234A6CF7"/%3E%3Cstop offset="100%25" stop-color="%238B3FDB"/%3E%3C/linearGradient%3E%3C/defs%3E%3Ccircle cx="30" cy="30" r="7" stroke="url(%23ng)" stroke-width="2.5" fill="none"/%3E%3Ccircle cx="30" cy="30" r="3" fill="url(%23ng)"/%3E%3Cline x1="30" y1="23" x2="30" y2="10" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="30" cy="8" r="3" fill="url(%23ng)"/%3E%3Cline x1="30" y1="37" x2="30" y2="50" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="30" cy="52" r="3" fill="url(%23ng)"/%3E%3Cline x1="23" y1="30" x2="10" y2="30" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="8" cy="30" r="3" fill="url(%23ng)"/%3E%3Cline x1="37" y1="30" x2="50" y2="30" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="52" cy="30" r="3" fill="url(%23ng)"/%3E%3Cline x1="25" y1="25" x2="16" y2="16" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="13.5" cy="13.5" r="3" fill="url(%23ng)"/%3E%3Cline x1="35" y1="35" x2="44" y2="44" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="46.5" cy="46.5" r="3" fill="url(%23ng)"/%3E%3Cline x1="35" y1="25" x2="44" y2="16" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="46.5" cy="13.5" r="3" fill="url(%23ng)"/%3E%3Cline x1="25" y1="35" x2="16" y2="44" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="13.5" cy="46.5" r="3" fill="url(%23ng)"/%3E%3C/svg%3E'>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
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
       NEXUSAI — PREMIUM SECTION
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
    }

    @media (max-width: 640px) {
      .footer-top { grid-template-columns: 1fr; }
      .footer-bottom { align-items: flex-start; flex-direction: column; }
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
    <h1>Tudo o que o seu negócio precisa<br>para <span class="grad-text">crescer online</span></h1>
    <p>Cinco serviços complementares, uma estratégia integrada. Cada canal potencia o outro — para resultados consistentes e mensuráveis.</p>
  </div>
</div>

<!-- SERVICE NAV PILLS -->
<div class="service-nav">
  <div class="service-nav-inner">
    <a href="#web" class="service-pill active" data-section="web">
      <span class="pill-dot" style="background:#00D4FF"></span>Desenvolvimento Web
    </a>
    <a href="#social" class="service-pill" data-section="social">
      <span class="pill-dot" style="background:#4A6CF7"></span>Redes Sociais
    </a>
    <a href="#trafego" class="service-pill" data-section="trafego">
      <span class="pill-dot" style="background:#8B3FDB"></span>Tráfego & Leads
    </a>
    <a href="#nexusai" class="service-pill ai-pill" data-section="nexusai">
      <span class="pill-dot" style="background:#F5A623"></span>NexusAI
    </a>
    <a href="#marca" class="service-pill" data-section="marca">
      <span class="pill-dot" style="background:#4A6CF7"></span>Marca & Estratégia
    </a>
  </div>
</div>

<!-- ══════════════════════════════════════
     01 · DESENVOLVIMENTO WEB
══════════════════════════════════════ -->
<section class="service-section" id="web" data-section="web">
  <div class="service-inner">
    <div class="service-number">01</div>
    <div class="two-col">
      <div class="service-content fade-up">
        <div class="service-icon-wrap" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.2);">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round"><rect x="3" y="4" width="18" height="13" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
        </div>
        <h2>Desenvolvimento Web<br>Profissional</h2>
        <div class="service-subtitle">Criação de sites, lojas online e plataformas digitais para empresas que querem crescer</div>
        <p class="service-desc">O vosso site é o vosso melhor comercial — trabalha 24 horas por dia, 7 dias por semana. Na NexusVora desenvolvemos sites profissionais para todo o tipo de negócios, desde PMEs e concessionários até e-commerce e plataformas SaaS, sempre com a tecnologia certa para cada cliente e foco num único objetivo: converter visitantes em clientes.</p>

        <div class="areas-title">Áreas de atuação</div>
        <div class="areas-grid">
          <div class="area-item">
            <h4>Sites Institucionais</h4>
            <p>Design personalizado, estrutura SEO e foco em conversão. A sua marca representada com profissionalismo 24/7.</p>
          </div>
          <div class="area-item">
            <h4>Landing Pages</h4>
            <p>Páginas de alta conversão para campanhas de Ads, lançamentos de produto ou captação de leads qualificados.</p>
          </div>
          <div class="area-item">
            <h4>Lojas Online / E-commerce</h4>
            <p>Lojas prontas para vender — gestão de stock, pagamentos e experiência de compra otimizada.</p>
          </div>
          <div class="area-item">
            <h4>Sites para Concessionários</h4>
            <p>Especialistas em sites para automóvel — fichas de viaturas, formulários de test drive e pesquisa de stock.</p>
          </div>
          <div class="area-item">
            <h4>Plataformas & SaaS</h4>
            <p>Aplicações web personalizadas — integrações, automatizações e sistemas internos à medida.</p>
          </div>
          <div class="area-item">
            <h4>Redesign & Migração</h4>
            <p>Site desatualizado? Redesign profissional mantendo o histórico SEO e melhorando a performance.</p>
          </div>
        </div>

        <div class="included-title">Sempre incluído</div>
        <ul class="check-list">
          <li><span class="chk" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Design 100% personalizado — sem templates genéricos</li>
          <li><span class="chk" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Site responsivo — mobile, tablet e desktop</li>
          <li><span class="chk" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>SEO técnico base desde o primeiro dia</li>
          <li><span class="chk" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Certificado SSL, hosting e domínio configurado</li>
          <li><span class="chk" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Manutenção mensal — atualizações, backups e segurança</li>
          <li><span class="chk" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Formação ao cliente para gestão autónoma</li>
        </ul>

        <a href="{{ route('home') }}#cta-final" class="btn-primary">
          Quero o meu site
          <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>

      <div class="service-visual fade-up">
        <div class="sidebar-card">
          <div class="card-section-title">Resultados Típicos</div>
          <div class="results-grid">
            <div class="result-item"><div class="result-val">+180%</div><div class="result-label">Taxa de conversão vs. site anterior</div></div>
            <div class="result-item"><div class="result-val">&lt;2s</div><div class="result-label">Tempo de carregamento médio</div></div>
            <div class="result-item"><div class="result-val">98/100</div><div class="result-label">Score PageSpeed Insights</div></div>
            <div class="result-item"><div class="result-val">30 dias</div><div class="result-label">Prazo médio de entrega</div></div>
          </div>
          <div class="card-section-title" style="padding-top:16px;border-top:1px solid var(--navy-border);">Para cada perfil</div>
          <table class="info-table">
            <thead><tr><th>O seu perfil</th><th>A nossa abordagem</th></tr></thead>
            <tbody>
              <tr><td>Quer gerir o site sozinho</td><td>CMS intuitivo com formação incluída</td></tr>
              <tr><td>Precisa de funcionalidades específicas</td><td>Desenvolvimento à medida</td></tr>
              <tr><td>Tem loja online</td><td>E-commerce otimizado para vender</td></tr>
              <tr><td>Site desatualizado</td><td>Redesign com foco em conversão e SEO</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════
     02 · REDES SOCIAIS
══════════════════════════════════════ -->
<section class="service-section" id="social" data-section="social">
  <div class="service-inner">
    <div class="service-number">02</div>
    <div class="two-col reverse">
      <div class="service-content fade-up">
        <div class="service-icon-wrap" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.2);">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round"><rect x="2" y="2" width="9" height="9" rx="1.5"/><rect x="13" y="2" width="9" height="9" rx="1.5"/><rect x="2" y="13" width="9" height="9" rx="1.5"/><rect x="13" y="13" width="9" height="9" rx="1.5"/></svg>
        </div>
        <h2>Gestão de Redes Sociais<br>Profissional</h2>
        <div class="service-subtitle">Conteúdo estratégico, criativos de alto nível e gestão diária para marcas que querem crescer no digital</div>
        <p class="service-desc">A presença nas redes sociais é frequentemente o primeiro contacto que um potencial cliente tem com a sua marca. Na NexusVora não nos limitamos a publicar conteúdo — criamos estratégias editoriais completas que constroem comunidade, geram confiança e transformam seguidores em clientes.</p>

        <div class="areas-title">Plataformas que gerimos</div>
        <table class="info-table">
          <thead><tr><th>Plataforma</th><th>Foco</th></tr></thead>
          <tbody>
            <tr><td>Instagram</td><td>Identidade visual, reels de alto impacto e crescimento de comunidade</td></tr>
            <tr><td>Facebook</td><td>Alcance orgânico, gestão de página e integração com Meta Ads</td></tr>
            <tr><td>TikTok</td><td>Conteúdo viral, tendências e alcance a novas audiências</td></tr>
            <tr><td>YouTube</td><td>Vídeos longos, shorts e construção de autoridade de marca</td></tr>
          </tbody>
        </table>

        <div class="areas-title">Tipo de conteúdo que produzimos</div>
        <div class="areas-grid">
          <div class="area-item">
            <h4>Posts & Infográficos</h4>
            <p>Design gráfico personalizado, alinhado com a identidade visual da marca.</p>
          </div>
          <div class="area-item">
            <h4>Reels & Vídeos Curtos</h4>
            <p>Formato de maior alcance orgânico. Guião, edição e legendas otimizadas.</p>
          </div>
          <div class="area-item">
            <h4>Stories</h4>
            <p>Conteúdo dinâmico que mantém a marca no topo da atenção diariamente.</p>
          </div>
          <div class="area-item">
            <h4>Criativos para Ads</h4>
            <p>Peças desenvolvidas especificamente para campanhas pagas, com foco em conversão.</p>
          </div>
        </div>

        <div class="included-title">Sempre incluído</div>
        <ul class="check-list">
          <li><span class="chk" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Estratégia de conteúdo mensal personalizada</li>
          <li><span class="chk" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Calendário editorial com aprovação prévia pelo cliente</li>
          <li><span class="chk" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Design gráfico 100% personalizado — sem templates</li>
          <li><span class="chk" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Gestão de comentários e mensagens diretas</li>
          <li><span class="chk" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Integração estratégica com campanhas pagas</li>
          <li><span class="chk" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Reunião mensal de alinhamento estratégico</li>
        </ul>
        <a href="{{ route('home') }}#cta-final" class="btn-primary">
          Pedir proposta gratuita
          <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>
      <div class="service-visual fade-up">
        <div class="sidebar-card">
          <div class="card-section-title">Resultados Típicos</div>
          <div class="results-grid">
            <div class="result-item"><div class="result-val">+320%</div><div class="result-label">Crescimento de seguidores em 6 meses</div></div>
            <div class="result-item"><div class="result-val">4.8%</div><div class="result-label">Taxa de engagement média</div></div>
            <div class="result-item"><div class="result-val">16×</div><div class="result-label">Publicações mensais mínimo</div></div>
            <div class="result-item"><div class="result-val">48h</div><div class="result-label">Aprovação prévia antes de publicar</div></div>
          </div>
          <div class="card-section-title" style="padding-top:16px;border-top:1px solid var(--navy-border);">O que nos diferencia</div>
          <div class="process-steps">
            <div class="process-step">
              <div class="step-num">✓</div>
              <div class="step-text"><strong>Aprovação prévia de todos os conteúdos</strong>Controlo total sobre o que sai em nome da sua marca</div>
            </div>
            <div class="process-step">
              <div class="step-num">✓</div>
              <div class="step-text"><strong>Criativos de alto nível — sem templates</strong>Cada peça desenhada de raiz para a sua identidade</div>
            </div>
            <div class="process-step">
              <div class="step-num">✓</div>
              <div class="step-text"><strong>Sem métricas de vaidade</strong>Reportamos o que realmente impacta o negócio</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════
     03 · TRÁFEGO, LEADS E CONVERSÕES
══════════════════════════════════════ -->
<section class="service-section" id="trafego" data-section="trafego">
  <div class="service-inner">
    <div class="service-number">03</div>
    <div class="two-col">
      <div class="service-content fade-up">
        <div class="service-icon-wrap" style="background:rgba(139,63,219,0.1);border:1px solid rgba(139,63,219,0.2);">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#8B3FDB" stroke-width="1.8" stroke-linecap="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </div>
        <h2>Tráfego, Leads<br>e Conversões</h2>
        <div class="service-subtitle">Google Ads, Meta Ads e SEO numa estratégia integrada que faz o seu negócio crescer todos os dias</div>
        <p class="service-desc">Não basta estar online — é preciso ser encontrado pelas pessoas certas, no momento certo. Na NexusVora combinamos publicidade paga e SEO numa estratégia única: o Google Ads e o Meta Ads geram resultados imediatos, o SEO constrói autoridade duradoura, e os três juntos criam um funil de crescimento contínuo.</p>

        <!-- Google Ads -->
        <div class="sub-service">
          <div class="sub-service-header">
            <div class="sub-service-icon" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.2);">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            </div>
            <h3>Google Ads — Seja encontrado por quem quer comprar</h3>
          </div>
          <p>Gerimos campanhas Search, Display e Performance Max com segmentação precisa e foco em conversões reais — não apenas cliques. Cada euro investido é rastreado e justificado.</p>
          <div class="sub-results">
            <div class="sub-result-chip"><strong>3.2×</strong><span>ROAS médio 90 dias</span></div>
            <div class="sub-result-chip"><strong>-41%</strong><span>Custo por clique</span></div>
            <div class="sub-result-chip"><strong>+89%</strong><span>Leads qualificados</span></div>
          </div>
        </div>

        <!-- Meta Ads -->
        <div class="sub-service">
          <div class="sub-service-header">
            <div class="sub-service-icon" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.2);">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </div>
            <h3>Meta Ads — Facebook e Instagram</h3>
          </div>
          <p>Campanhas que cobrem todo o funil — do awareness à conversão — com criativos de alto impacto, segmentação avançada e retargeting para recuperar quem ainda não converteu.</p>
          <div class="sub-results">
            <div class="sub-result-chip"><strong>4.2×</strong><span>ROAS médio</span></div>
            <div class="sub-result-chip"><strong>-38%</strong><span>Custo por lead</span></div>
            <div class="sub-result-chip"><strong>+210%</strong><span>Alcance vs. orgânico</span></div>
          </div>
        </div>

        <!-- SEO -->
        <div class="sub-service">
          <div class="sub-service-header">
            <div class="sub-service-icon" style="background:rgba(139,63,219,0.1);border:1px solid rgba(139,63,219,0.2);">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#8B3FDB" stroke-width="2" stroke-linecap="round"><path d="m3 3 7.07 16.97 2.51-7.39 7.39-2.51L3 3z"/><path d="m13 13 6 6"/></svg>
            </div>
            <h3>SEO — Visibilidade orgânica que não para de crescer</h3>
          </div>
          <p>SEO técnico, criação de conteúdo e construção de autoridade. Tráfego qualificado todos os meses, sem depender exclusivamente de publicidade paga.</p>
          <div class="sub-results">
            <div class="sub-result-chip"><strong>+240%</strong><span>Tráfego orgânico 6m</span></div>
            <div class="sub-result-chip"><strong>Top 3</strong><span>Google keywords</span></div>
            <div class="sub-result-chip"><strong>∞</strong><span>Sem custo p/ clique</span></div>
          </div>
        </div>

        <div class="integration-quote">
          <strong>Os dados do SEO melhoram as campanhas pagas.</strong> Os melhores anúncios tornam-se conteúdo orgânico. Uma estratégia alimenta a outra — e é por isso que funcionamos diferente.
        </div>

        <a href="{{ route('home') }}#cta-final" class="btn-primary">
          Falar com especialista
          <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>

      <div class="service-visual fade-up">
        <div class="sidebar-card">
          <div class="card-section-title">Porquê uma estratégia integrada?</div>
          <table class="info-table">
            <thead><tr><th>Canal</th><th>O que faz</th><th>Quando</th></tr></thead>
            <tbody>
              <tr><td>Google Ads</td><td>Captura quem já quer comprar</td><td>Imediato</td></tr>
              <tr><td>Meta Ads</td><td>Encontra quem ainda não te conhece</td><td>Curto prazo</td></tr>
              <tr><td>SEO</td><td>Constrói autoridade orgânica duradoura</td><td>Médio/longo</td></tr>
            </tbody>
          </table>
          <div class="card-section-title" style="padding-top:16px;border-top:1px solid var(--navy-border);">O que está sempre incluído</div>
          <div class="process-steps">
            <div class="process-step">
              <div class="step-num">1</div>
              <div class="step-text"><strong>Auditoria e configuração</strong>Setup completo de conta, pixel, conversões e rastreio</div>
            </div>
            <div class="process-step">
              <div class="step-num">2</div>
              <div class="step-text"><strong>Testes A/B contínuos</strong>Audiências, criativos e copy testados sistematicamente</div>
            </div>
            <div class="process-step">
              <div class="step-num">3</div>
              <div class="step-text"><strong>Otimização semanal</strong>Ajustes de lances, keywords negativas e orçamentos</div>
            </div>
            <div class="process-step">
              <div class="step-num">4</div>
              <div class="step-text"><strong>Relatório mensal detalhado</strong>ROAS, CPL e recomendações de escala transparentes</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════
     04 · NEXUSAI — PREMIUM
══════════════════════════════════════ -->
<section class="service-section" id="nexusai" data-section="nexusai">
  <div class="service-inner">
    <div class="service-number" style="color:#F5A623;">04</div>
    <div class="two-col reverse">
      <div class="service-content fade-up">
        <div class="ai-badge"><span class="ai-badge-dot"></span>Produto Premium</div>
        <div class="service-icon-wrap" style="background:rgba(245,166,35,0.1);border:1px solid rgba(245,166,35,0.25);">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#F5A623" stroke-width="1.8" stroke-linecap="round"><path d="M12 2a10 10 0 1 0 10 10"/><path d="M12 6v6l4 2"/><circle cx="19" cy="5" r="3" fill="#F5A623" opacity=".3"/><circle cx="19" cy="5" r="1.5" fill="#F5A623"/></svg>
        </div>
        <h2 class="ai-title"><span class="ai-grad-text">NexusAI</span> — O seu negócio<br>a trabalhar enquanto dorme</h2>
        <div class="service-subtitle ai-subtitle">Automação de processos, integrações inteligentes e IA aplicada para PMEs que querem crescer sem crescer a equipa</div>
        <p class="service-desc">A maioria das PMEs perde horas por semana em tarefas repetitivas que uma máquina faz em segundos. Na NexusVora implementamos sistemas de automação inteligente com inteligência artificial que eliminam o trabalho manual, respondem a clientes 24/7, qualificam leads automaticamente e integram todas as ferramentas do seu negócio numa única operação fluída.</p>

        <div class="areas-title">O que automatizamos para si</div>
        <div class="ai-feature-grid">
          <div class="ai-feature">
            <div class="ai-feature-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#F5A623" stroke-width="1.8" stroke-linecap="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
            <h4>Chatbots & Assistentes com IA</h4>
            <p>Responde a clientes, qualifica leads e agenda reuniões 24/7 — mesmo enquanto a sua equipa dorme.</p>
          </div>
          <div class="ai-feature">
            <div class="ai-feature-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#F5A623" stroke-width="1.8" stroke-linecap="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            </div>
            <h4>Automação de Processos</h4>
            <p>Conecta CRM, email, redes sociais, faturação e formulários em fluxos automáticos sem erros.</p>
          </div>
          <div class="ai-feature">
            <div class="ai-feature-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#F5A623" stroke-width="1.8" stroke-linecap="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <h4>Email Marketing Automatizado</h4>
            <p>Sequências que se adaptam ao comportamento — mensagem certa, pessoa certa, momento certo.</p>
          </div>
          <div class="ai-feature">
            <div class="ai-feature-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#F5A623" stroke-width="1.8" stroke-linecap="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            </div>
            <h4>Lead Scoring com IA</h4>
            <p>A IA analisa e pontua cada lead — a sua equipa comercial foca-se apenas nos que vão fechar.</p>
          </div>
          <div class="ai-feature">
            <div class="ai-feature-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#F5A623" stroke-width="1.8" stroke-linecap="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><path d="M17.5 17.5l3 3M17.5 20.5l3-3"/></svg>
            </div>
            <h4>Integrações entre Sistemas</h4>
            <p>CRM, ERP, e-commerce, plataformas de reservas — todos os dados fluem automaticamente.</p>
          </div>
          <div class="ai-feature">
            <div class="ai-feature-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#F5A623" stroke-width="1.8" stroke-linecap="round"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
            </div>
            <h4>Relatórios & Analytics Automáticos</h4>
            <p>Dashboards em tempo real que agregam Google Ads, Meta, SEO — sem trabalho manual.</p>
          </div>
        </div>

        <a href="{{ route('home') }}#cta-final" class="btn-primary btn-ai">
          Saber mais sobre NexusAI
          <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>

      <div class="service-visual fade-up">
        <div class="sidebar-card ai-sidebar" style="border-color:rgba(245,166,35,0.2);">
          <style>.sidebar-card.ai-sidebar::before{background:var(--ai-grad)!important;}</style>
          <div class="card-section-title" style="color:var(--ai-gold);">Antes vs. Depois do NexusAI</div>
          <table class="before-after">
            <thead>
              <tr><th>Antes</th><th>Depois</th></tr>
            </thead>
            <tbody>
              <tr><td>Responder manualmente a cada lead</td><td>Chatbot com IA qualifica e responde 24/7</td></tr>
              <tr><td>Relatórios manuais que demoram horas</td><td>Dashboard automático em tempo real</td></tr>
              <tr><td>Leads perdidos fora do horário</td><td>Nenhum lead escapa — o sistema nunca dorme</td></tr>
              <tr><td>Ferramentas desconectadas</td><td>Todos os sistemas integrados e sincronizados</td></tr>
              <tr><td>Equipa sobrecarregada</td><td>Equipa focada no que gera valor real</td></tr>
            </tbody>
          </table>
          <div class="card-section-title" style="padding-top:16px;border-top:1px solid var(--navy-border);color:var(--ai-gold);">Sempre incluído</div>
          <div class="process-steps">
            <div class="process-step">
              <div class="step-num ai-step-num" style="background:rgba(245,166,35,0.12);border-color:rgba(245,166,35,0.25);color:var(--ai-gold);">1</div>
              <div class="step-text"><strong>Diagnóstico de processos</strong>Mapeamos todas as tarefas repetitivas e oportunidades de automação</div>
            </div>
            <div class="process-step">
              <div class="step-num" style="background:rgba(245,166,35,0.12);border-color:rgba(245,166,35,0.25);color:var(--ai-gold);">2</div>
              <div class="step-text"><strong>Implementação completa</strong>Configuração e integração com as ferramentas que já usa</div>
            </div>
            <div class="process-step">
              <div class="step-num" style="background:rgba(245,166,35,0.12);border-color:rgba(245,166,35,0.25);color:var(--ai-gold);">3</div>
              <div class="step-text"><strong>Formação da equipa</strong>Para gerir o sistema de forma autónoma</div>
            </div>
            <div class="process-step">
              <div class="step-num" style="background:rgba(245,166,35,0.12);border-color:rgba(245,166,35,0.25);color:var(--ai-gold);">4</div>
              <div class="step-text"><strong>Suporte e otimização contínua</strong>Relatório mensal de desempenho das automações</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════
     05 · MARCA, ESTRATÉGIA & VISÃO
══════════════════════════════════════ -->
<section class="service-section" id="marca" data-section="marca">
  <div class="service-inner">
    <div class="service-number">05</div>
    <div class="two-col">
      <div class="service-content fade-up">
        <div class="service-icon-wrap" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.2);">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        </div>
        <h2>Marca, Estratégia<br>&amp; Visão Digital</h2>
        <div class="service-subtitle">Do zero ao plano — construímos a identidade da sua marca e a estratégia que a faz crescer com consistência</div>
        <p class="service-desc">Antes de investir um único euro em publicidade ou redes sociais, há duas perguntas que precisam de resposta: Quem é a sua marca? e Onde quer chegar? Na NexusVora começamos pelo princípio — construímos a identidade visual completa e a estratégia digital que transforma essa marca numa máquina de crescimento.</p>

        <div class="areas-title">Identidade Visual — entregamos</div>
        <div class="deliverables-grid">
          <div class="deliverable">
            <div class="deliverable-icon" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.2);">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
            </div>
            <div class="deliverable-body"><h4>Logótipo Profissional</h4><p>Versão primária, secundária e ícone para todos os contextos</p></div>
          </div>
          <div class="deliverable">
            <div class="deliverable-icon" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.2);">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M4.22 4.22l2.12 2.12M17.66 17.66l2.12 2.12M2 12h3M19 12h3M4.22 19.78l2.12-2.12M17.66 6.34l2.12-2.12"/></svg>
            </div>
            <div class="deliverable-body"><h4>Guia de Identidade Visual</h4><p>Paleta de cores, tipografia e regras de uso da marca</p></div>
          </div>
          <div class="deliverable">
            <div class="deliverable-icon" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.2);">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"><rect x="2" y="2" width="9" height="9" rx="1.5"/><rect x="13" y="2" width="9" height="9" rx="1.5"/><rect x="2" y="13" width="9" height="9" rx="1.5"/><rect x="13" y="13" width="9" height="9" rx="1.5"/></svg>
            </div>
            <div class="deliverable-body"><h4>Templates Redes Sociais</h4><p>Posts, stories e capas prontos a usar com a sua identidade</p></div>
          </div>
          <div class="deliverable">
            <div class="deliverable-icon" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.2);">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <div class="deliverable-body"><h4>Manual de Marca Completo</h4><p>O documento definitivo para consistência em todos os pontos de contacto</p></div>
          </div>
        </div>

        <div class="areas-title">Estratégia & Visão Digital</div>
        <ul class="check-list">
          <li><span class="chk" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Diagnóstico digital completo — análise honesta do ponto de partida</li>
          <li><span class="chk" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Análise de concorrência — oportunidades que os outros não viram</li>
          <li><span class="chk" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Definição de público-alvo e personas detalhadas</li>
          <li><span class="chk" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Plano de marketing anual — calendário com ações para 12 meses</li>
          <li><span class="chk" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Roadmap de crescimento com milestones e métricas definidas</li>
        </ul>

        <div class="integration-quote" style="border-left-color:var(--blue);">
          <strong>Uma marca bem construída e uma estratégia clara</strong> transformam todos os outros serviços em investimentos com retorno previsível. Sem esta base, tudo o resto é adivinhação.
        </div>

        <a href="{{ route('home') }}#cta-final" class="btn-primary">
          Pedir proposta gratuita
          <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>

      <div class="service-visual fade-up">
        <div class="sidebar-card">
          <div class="card-section-title">Para quem é este serviço</div>
          <div class="process-steps">
            <div class="process-step">
              <div class="step-num">→</div>
              <div class="step-text"><strong>Negócios a arrancar do zero</strong>Começar bem é metade do caminho</div>
            </div>
            <div class="process-step">
              <div class="step-num">→</div>
              <div class="step-text"><strong>Empresas a reposicionar a marca</strong>Quando o negócio cresceu mas a marca ficou para trás</div>
            </div>
            <div class="process-step">
              <div class="step-num">→</div>
              <div class="step-text"><strong>PMEs sem identidade visual definida</strong>Profissionalizar a imagem para competir a sério</div>
            </div>
            <div class="process-step">
              <div class="step-num">→</div>
              <div class="step-text"><strong>Marketing desorganizado</strong>Dar ordem, direção e coerência ao que já existe</div>
            </div>
            <div class="process-step">
              <div class="step-num">→</div>
              <div class="step-text"><strong>Concessionários a entrar no digital</strong>Estratégia específica para um setor competitivo e exigente</div>
            </div>
          </div>
          <div class="card-section-title" style="padding-top:16px;border-top:1px solid var(--navy-border);">O processo de trabalho</div>
          <div class="process-steps">
            <div class="process-step"><div class="step-num">1</div><div class="step-text"><strong>Descoberta</strong>Sessão de briefing profunda — negócio, valores e objetivos</div></div>
            <div class="process-step"><div class="step-num">2</div><div class="step-text"><strong>Pesquisa & Análise</strong>Mercado, concorrência, público-alvo e oportunidades</div></div>
            <div class="process-step"><div class="step-num">3</div><div class="step-text"><strong>Identidade Visual</strong>Criação e refinamento da marca até estar perfeita</div></div>
            <div class="process-step"><div class="step-num">4</div><div class="step-text"><strong>Estratégia</strong>Construção do plano digital completo e personalizado</div></div>
            <div class="process-step"><div class="step-num">5</div><div class="step-text"><strong>Entrega & Briefing</strong>Todos os entregáveis com formação para os usar</div></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FINAL CTA (Project Sync) -->
<div class="final-cta">
  <div class="cta-box">
    <h2>Não sabe por onde começar?<br><span class="grad-text">Nós ajudamos.</span></h2>
    <p>Marque uma conversa gratuita. Analisamos o seu negócio e recomendamos os serviços com maior impacto para si — sem compromisso.</p>
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
  // Selectors
  const sections = document.querySelectorAll('.service-section[data-section]');
  const pills = document.querySelectorAll('.service-pill[data-section]');

  // Intersection Observer for scroll synchronization
  const sectionObserver = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      // Only trigger if the entry is intersecting significantly
      if (e.isIntersecting && e.intersectionRatio > 0.3) {
        const id = e.target.dataset.section;
        updateActivePill(id);
      }
    });
  }, { threshold: [0.1, 0.3, 0.5] });

  sections.forEach(s => sectionObserver.observe(s));

  // Fade-up on scroll
  const fadeObserver = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.1 });
  document.querySelectorAll('.fade-up').forEach(el => fadeObserver.observe(el));

  // Function to update the active state and scroll into view
  function updateActivePill(id) {
    pills.forEach(p => {
      const isActive = p.dataset.section === id;
      p.classList.toggle('active', isActive);
      if (isActive) {
        p.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
      }
    });
  }

  // Immediate feedback on click
  pills.forEach(pill => {
    pill.addEventListener('click', (e) => {
      const id = pill.dataset.section;
      if (id) updateActivePill(id);
    });
  });

  // Nav scroll sync
  window.addEventListener('scroll', () => {
    const nav = document.querySelector('nav');
    if (nav) {
      nav.style.background =
        window.scrollY > 50 ? 'rgba(10, 15, 46, 0.96)' : 'rgba(10, 15, 46, 0.85)';
    }
  });
</script>
</body>
</html>
