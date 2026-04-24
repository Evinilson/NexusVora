<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços — NexusVora</title>
    <link rel="icon" type="image/svg+xml" href='data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" fill="none"%3E%3Cdefs%3E%3ClinearGradient id="ng" x1="0" y1="0" x2="60" y2="60" gradientUnits="userSpaceOnUse"%3E%3Cstop offset="0%25" stop-color="%2300D4FF"/%3E%3Cstop offset="50%25" stop-color="%234A6CF7"/%3E%3Cstop offset="100%25" stop-color="%238B3FDB"/%3E%3C/linearGradient%3E%3C/defs%3E%3Ccircle cx="30" cy="30" r="7" stroke="url(%23ng)" stroke-width="2.5" fill="none"/%3E%3Ccircle cx="30" cy="30" r="3" fill="url(%23ng)"/%3E%3Cline x1="30" y1="23" x2="30" y2="10" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="30" cy="8" r="3" fill="url(%23ng)"/%3E%3Cline x1="30" y1="37" x2="30" y2="50" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="30" cy="52" r="3" fill="url(%23ng)"/%3E%3Cline x1="23" y1="30" x2="10" y2="30" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="8" cy="30" r="3" fill="url(%23ng)"/%3E%3Cline x1="37" y1="30" x2="50" y2="30" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="52" cy="30" r="3" fill="url(%23ng)"/%3E%3Cline x1="25" y1="25" x2="16" y2="16" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="13.5" cy="13.5" r="3" fill="url(%23ng)"/%3E%3Cline x1="35" y1="35" x2="44" y2="44" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="46.5" cy="46.5" r="3" fill="url(%23ng)"/%3E%3Cline x1="35" y1="25" x2="44" y2="16" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="46.5" cy="13.5" r="3" fill="url(%23ng)"/%3E%3Cline x1="25" y1="35" x2="16" y2="44" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="13.5" cy="46.5" r="3" fill="url(%23ng)"/%3E%3C/svg%3E'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

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

        a { color: inherit; }

        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 5vw; height: 72px;
            background: rgba(6,11,32,0.9);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--navy-border);
            transition: background .3s ease;
        }
        .nav-logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .nav-logo svg { width: 34px; height: 34px; }
        .nav-logo-text { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 1.25rem; letter-spacing: -0.02em; }
        .nav-logo-text span:first-child { color: #1A2464; }
        .nav-logo-text span:last-child { color: var(--cyan); }
        .nav-links { display: flex; gap: 32px; list-style: none; }
        .nav-links a { color: var(--text-muted); text-decoration: none; font-size: 0.9rem; font-weight: 500; transition: color .2s; }
        .nav-links a:hover, .nav-links a.active { color: #fff; }
        .nav-cta {
            background: var(--grad); color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 0.875rem;
            padding: 10px 22px; border-radius: 8px; text-decoration: none;
            transition: opacity .2s, transform .2s;
        }
        .nav-cta:hover { opacity: .88; transform: translateY(-1px); }

        .page-header {
            padding: 140px 5vw 80px;
            background: var(--navy2);
            position: relative; overflow: hidden; text-align: center;
        }
        .page-header::before {
            content: '';
            position: absolute; top: -120px; left: 50%; transform: translateX(-50%);
            width: 700px; height: 500px;
            background: radial-gradient(circle, rgba(74,108,247,0.14) 0%, transparent 70%);
        }
        .hero-grid {
            position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 30%, transparent 100%);
        }
        .page-header-inner { position: relative; z-index: 1; max-width: 700px; margin: 0 auto; }
        .section-tag {
            font-size: 0.75rem; font-weight: 700; letter-spacing: 0.12em;
            text-transform: uppercase; color: var(--cyan); margin-bottom: 14px;
        }
        .page-header h1 {
            font-size: clamp(1.7rem, 3.2vw, 2.8rem); font-weight: 800;
            color: #fff; letter-spacing: -0.03em; margin-bottom: 28px;
        }
        .grad-text {
            background: var(--grad);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .page-header p {
            font-size: 1.05rem; color: var(--text-muted); line-height: 1.7; text-wrap: pretty;
        }

        .service-nav {
            position: sticky; top: 72px; z-index: 90;
            background: rgba(6,11,32,0.95);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--navy-border);
            padding: 0 5vw;
        }
        .service-nav-inner {
            max-width: 1100px; margin: 0 auto;
            display: flex; gap: 0; overflow-x: auto;
            scroll-behavior: smooth;
            scrollbar-width: none;
        }
        .service-nav-inner::-webkit-scrollbar { display: none; }
        .service-pill {
            display: flex; align-items: center; gap: 8px;
            padding: 16px 20px;
            font-size: 0.85rem; font-weight: 600;
            color: var(--text-muted); text-decoration: none;
            border-bottom: 2px solid transparent;
            white-space: nowrap;
            transition: color .2s, border-color .2s;
        }
        .service-pill:hover { color: #fff; }
        .service-pill.active { color: var(--cyan); border-bottom-color: var(--cyan); }
        .pill-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }

        .service-section {
            padding: 100px 5vw;
            border-bottom: 1px solid var(--navy-border);
        }
        .service-section:nth-child(even) { background: var(--navy); }
        .service-section:nth-child(odd) { background: var(--navy2); }

        .service-inner {
            max-width: 1100px; margin: 0 auto;
            display: grid; grid-template-columns: 1fr 1.1fr; gap: 80px; align-items: start;
        }
        .service-inner.reverse { direction: rtl; }
        .service-inner.reverse > * { direction: ltr; }

        .service-number {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.72rem; font-weight: 700; letter-spacing: 0.12em;
            text-transform: uppercase; color: var(--text-muted); margin-bottom: 10px;
            display: flex; align-items: center; gap: 10px;
        }
        .service-number::before {
            content: '';
            display: inline-block; width: 24px; height: 1px; background: var(--text-muted);
        }
        .service-icon-wrap {
            width: 56px; height: 56px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 20px;
        }
        .service-content h2 {
            font-size: clamp(1.6rem, 2.8vw, 2.2rem); font-weight: 800;
            color: #fff; letter-spacing: -0.02em; margin-bottom: 16px; text-wrap: pretty;
        }
        .service-desc {
            font-size: 0.95rem; color: var(--text-muted); line-height: 1.8;
            margin-bottom: 32px; text-wrap: pretty;
        }
        .included-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.78rem; font-weight: 700; letter-spacing: 0.08em;
            text-transform: uppercase; color: var(--text-muted); margin-bottom: 14px;
        }
        .included-list { list-style: none; display: flex; flex-direction: column; gap: 10px; margin-bottom: 32px; }
        .included-list li {
            display: flex; gap: 10px; align-items: flex-start;
            font-size: 0.9rem; color: var(--text); line-height: 1.5;
        }
        .check-icon {
            width: 18px; height: 18px; flex-shrink: 0; margin-top: 2px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }

        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--grad); color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 0.95rem;
            padding: 14px 28px; border-radius: 10px; text-decoration: none;
            transition: opacity .2s, transform .2s, box-shadow .2s;
            box-shadow: 0 8px 28px rgba(74,108,247,0.3);
        }
        .btn-primary:hover { opacity: .9; transform: translateY(-2px); box-shadow: 0 12px 36px rgba(74,108,247,0.4); }
        .btn-ghost {
            display: inline-flex; align-items: center; gap: 8px;
            background: transparent; color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 600; font-size: 0.95rem;
            padding: 14px 24px; border-radius: 10px;
            border: 1px solid var(--navy-border); text-decoration: none;
            transition: border-color .2s, color .2s, background .2s;
        }
        .btn-ghost:hover { border-color: rgba(255,255,255,0.2); background: rgba(255,255,255,0.04); color: #fff; }

        .results-card {
            background: var(--navy-card);
            border: 1px solid var(--navy-border);
            border-radius: 20px; padding: 32px;
            position: relative; overflow: hidden;
        }
        .results-card::before {
            content: '';
            position: absolute; top: 0; right: 0; left: 0;
            height: 2px; background: var(--grad);
        }
        .results-card-title, .process-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.78rem; font-weight: 700; letter-spacing: 0.08em;
            text-transform: uppercase; color: var(--text-muted);
        }
        .results-card-title { margin-bottom: 20px; }
        .results-grid {
            display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; margin-bottom: 24px;
        }
        .result-item {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 12px; padding: 18px;
        }
        .result-val {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.7rem; font-weight: 800;
            background: var(--grad);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            line-height: 1; margin-bottom: 5px;
        }
        .result-label { font-size: 0.78rem; color: var(--text-muted); line-height: 1.4; }

        .process-title {
            margin-bottom: 14px; padding-top: 20px; border-top: 1px solid var(--navy-border);
        }
        .process-steps { display: flex; flex-direction: column; gap: 0; }
        .process-step {
            display: flex; gap: 14px; align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.04);
        }
        .process-step:last-child { border-bottom: none; }
        .step-num {
            width: 24px; height: 24px; flex-shrink: 0;
            border-radius: 6px;
            background: rgba(74,108,247,0.12);
            border: 1px solid rgba(74,108,247,0.2);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.7rem; font-weight: 800; color: var(--cyan);
        }
        .step-text { font-size: 0.85rem; color: var(--text); line-height: 1.5; }
        .step-text strong { color: #fff; font-weight: 600; display: block; margin-bottom: 1px; }

        .final-cta {
            background: var(--navy2);
            padding: 100px 5vw;
        }
        .cta-box {
            max-width: 1100px; margin: 0 auto;
            background: linear-gradient(135deg, rgba(74,108,247,0.15), rgba(139,63,219,0.1));
            border: 1px solid rgba(74,108,247,0.25);
            border-radius: 24px; padding: 72px 60px;
            text-align: center; position: relative; overflow: hidden;
        }
        .cta-box::before {
            content: '';
            position: absolute; top: -80px; left: 50%; transform: translateX(-50%);
            width: 500px; height: 300px;
            background: radial-gradient(circle, rgba(74,108,247,0.2), transparent 70%);
        }
        .cta-box h2 {
            font-size: clamp(1.7rem, 3vw, 2.6rem); font-weight: 800; color: #fff;
            letter-spacing: -0.02em; margin-bottom: 14px; position: relative; z-index: 1; text-wrap: pretty;
        }
        .cta-box p {
            font-size: 1rem; color: var(--text-muted); max-width: 480px;
            margin: 0 auto 36px; line-height: 1.7; position: relative; z-index: 1;
        }
        .cta-actions { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; position: relative; z-index: 1; }

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

        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.55s ease, transform 0.55s ease;
        }

        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Web service expanded */
        .service-subtitle {
            color: var(--cyan);
            font-size: 1rem;
            font-weight: 500;
            line-height: 1.55;
            opacity: 0.88;
            margin-bottom: 20px;
        }

        .web-extra-inner {
            max-width: 1100px;
            margin: 60px auto 0;
        }

        .web-areas-label {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 18px;
        }

        .web-areas-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            justify-content: center;
        }

        .area-card {
            flex: 0 0 calc(33.333% - 10px);
            min-width: 0;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--navy-border);
            border-radius: 14px;
            padding: 22px 24px;
            transition: border-color 0.25s ease, background 0.25s ease, transform 0.25s ease;
        }

        .area-card:hover {
            border-color: rgba(0, 212, 255, 0.28);
            background: rgba(0, 212, 255, 0.03);
            transform: translateY(-2px);
        }

        .area-card-icon {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
            background: rgba(0, 212, 255, 0.08);
            border: 1px solid rgba(0, 212, 255, 0.15);
        }

        .area-card h3 {
            color: #fff;
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .area-card p {
            color: var(--text-muted);
            font-size: 0.82rem;
            line-height: 1.65;
        }

        .web-bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 56px;
        }

        .approach-table {
            border: 1px solid var(--navy-border);
            border-radius: 12px;
            overflow: hidden;
        }

        .approach-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .approach-row:not(:last-child) {
            border-bottom: 1px solid var(--navy-border);
        }

        .approach-row span {
            padding: 13px 16px;
            font-size: 0.83rem;
            line-height: 1.5;
            color: var(--text);
        }

        .approach-row span:first-child {
            border-right: 1px solid var(--navy-border);
        }

        .approach-row span:last-child {
            color: var(--text-muted);
        }

        .approach-header span {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.7rem !important;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted) !important;
            background: rgba(255, 255, 255, 0.025);
        }

        @media (max-width: 900px) {
            .service-inner { grid-template-columns: 1fr; gap: 40px; }
            .service-inner.reverse { direction: ltr; }
            .nav-links { display: none; }
            .results-grid { grid-template-columns: 1fr 1fr; }
            .footer-top { grid-template-columns: 1fr 1fr; }
            .area-card { flex: 0 0 calc(50% - 7px); }
            .web-bottom-grid { grid-template-columns: 1fr; gap: 40px; }
        }

        @media (max-width: 640px) {
            nav { padding: 0 18px; }
            .nav-cta { display: none; }
            .page-header,
            .service-nav,
            .service-section,
            .final-cta,
            footer { padding-left: 18px; padding-right: 18px; }
            .page-header { padding-top: 116px; }
            .cta-box { padding: 48px 24px; }
            .cta-actions .btn-primary,
            .cta-actions .btn-ghost { width: 100%; justify-content: center; }
            .results-grid { grid-template-columns: 1fr; }
            .footer-top { grid-template-columns: 1fr; }
            .footer-bottom { align-items: flex-start; flex-direction: column; }
            .area-card { flex: 0 0 100%; }
            .approach-row { grid-template-columns: 1fr; }
            .approach-row span:first-child { border-right: none; border-bottom: 1px solid var(--navy-border); }
        }
    </style>
</head>
<body>
@include('partials.site-header')

<div class="page-header">
    <div class="hero-grid"></div>
    <div class="page-header-inner">
        <div class="section-tag">Serviços</div>
        <h1>Tudo o que o seu negócio<br>precisa para <span class="grad-text">crescer online</span></h1>
        <p>Cinco serviços complementares, uma estratégia integrada. Cada canal potencia o outro, para resultados que duram.</p>
    </div>
</div>

<div class="service-nav">
    <div class="service-nav-inner">
        <a href="#web" class="service-pill active" data-section="web"><span class="pill-dot" style="background:#00D4FF"></span>Desenvolvimento Web</a>
        <a href="#social" class="service-pill" data-section="social"><span class="pill-dot" style="background:#4A6CF7"></span>Redes Sociais</a>
        <a href="#google" class="service-pill" data-section="google"><span class="pill-dot" style="background:#8B3FDB"></span>Google Ads</a>
        <a href="#meta" class="service-pill" data-section="meta"><span class="pill-dot" style="background:#00D4FF"></span>Meta Ads</a>
        <a href="#seo" class="service-pill" data-section="seo"><span class="pill-dot" style="background:#4A6CF7"></span>SEO</a>
    </div>
</div>

<section class="service-section" id="web" data-section="web">
    <div class="service-inner">
        <div class="service-content reveal">
            <div class="service-number">01</div>
            <div class="service-icon-wrap" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.2);">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round"><rect x="3" y="4" width="18" height="13" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
            </div>
            <h2>Desenvolvimento<br>Web Profissional</h2>
            <p class="service-subtitle">Criação de sites, lojas online e plataformas digitais para empresas que querem crescer</p>
            <p class="service-desc">O vosso site é o vosso melhor vendedor — capta leads, apresenta a marca e fecha negócios enquanto dormem. Na NexusVora criamos sites profissionais para PMEs e concessionários da região do Porto, Gaia e Maia: desde sites institucionais e lojas online até plataformas SaaS, sempre com SEO técnico integrado desde o primeiro dia e um único foco — aparecer no Google e converter visitantes em clientes.</p>
            <a href="{{ route('home') }}#cta-final" class="btn-primary">Quero o meu site <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        </div>

        <div class="service-visual reveal">
            <div class="results-card">
                <div class="results-card-title">Resultados Típicos</div>
                <div class="results-grid">
                    <div class="result-item"><div class="result-val">+180%</div><div class="result-label">Taxa de conversão vs. site anterior</div></div>
                    <div class="result-item"><div class="result-val">&lt;2s</div><div class="result-label">Tempo de carregamento médio</div></div>
                    <div class="result-item"><div class="result-val">98/100</div><div class="result-label">Score PageSpeed Insights</div></div>
                    <div class="result-item"><div class="result-val">30 dias</div><div class="result-label">Prazo médio de entrega</div></div>
                </div>
                <div class="process-title">Processo de trabalho</div>
                <div class="process-steps">
                    <div class="process-step"><div class="step-num">1</div><div class="step-text"><strong>Briefing & estratégia</strong>Análise do negócio, concorrência e objetivos de conversão</div></div>
                    <div class="process-step"><div class="step-num">2</div><div class="step-text"><strong>Design & prototipagem</strong>Wireframes e mockups para aprovação antes do desenvolvimento</div></div>
                    <div class="process-step"><div class="step-num">3</div><div class="step-text"><strong>Desenvolvimento</strong>Construção rápida, otimizada e com código limpo</div></div>
                    <div class="process-step"><div class="step-num">4</div><div class="step-text"><strong>Testes & lançamento</strong>QA completo, testes de velocidade e publicação</div></div>
                    <div class="process-step"><div class="step-num">5</div><div class="step-text"><strong>Suporte contínuo</strong>Atualizações, backups e manutenção mensal</div></div>
                </div>
            </div>
        </div>
    </div>

    <div class="web-extra-inner">
        <p class="web-areas-label reveal">Áreas de Atuação</p>
        <div class="web-areas-grid">
            <div class="area-card reveal">
                <div class="area-card-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round"><rect x="3" y="9" width="18" height="11" rx="2"/><path d="M3 9l9-6 9 6"/><path d="M12 9v11"/></svg>
                </div>
                <h3>Sites Institucionais</h3>
                <p>Design exclusivo, arquitetura SEO-optimizada e estrutura pensada para converter visitantes em contactos — sem templates genéricos.</p>
            </div>
            <div class="area-card reveal">
                <div class="area-card-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                </div>
                <h3>Landing Pages</h3>
                <p>Páginas de alta conversão para campanhas de Google Ads e Meta Ads, lançamentos de produto ou captação de leads qualificados.</p>
            </div>
            <div class="area-card reveal">
                <div class="area-card-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                </div>
                <h3>Lojas Online / E-commerce</h3>
                <p>Lojas online prontas para vender, com gestão de stock, pagamentos integrados e experiência de compra otimizada para maximizar vendas.</p>
            </div>
            <div class="area-card reveal">
                <div class="area-card-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4l3 5v3h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                </div>
                <h3>Sites para Concessionários</h3>
                <p>Especialistas em sites para concessionários automóveis — fichas de viaturas, formulários de test drive, pesquisa de stock e integração com sistemas de gestão.</p>
            </div>
            <div class="area-card reveal">
                <div class="area-card-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                </div>
                <h3>Portfólios e Blogs</h3>
                <p>Sites para consultores, arquitetos e profissionais liberais — conteúdo que constrói autoridade no Google e atrai clientes de forma orgânica.</p>
            </div>
            <div class="area-card reveal">
                <div class="area-card-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/><path d="M7 7h.01M11 7h6"/></svg>
                </div>
                <h3>Plataformas e SaaS à Medida</h3>
                <p>Desenvolvimento de aplicações web personalizadas — integrações, automatizações e sistemas internos para necessidades específicas de negócio.</p>
            </div>
            <div class="area-card reveal">
                <div class="area-card-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round"><path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.3M22 12.5a10 10 0 0 1-18.8 4.2"/></svg>
                </div>
                <h3>Redesign e Migração</h3>
                <p>Site lento, desatualizado ou com má experiência mobile? Redesign com preservação total do histórico SEO e melhoria de Core Web Vitals — sem perder o posicionamento no Google.</p>
            </div>
        </div>
    </div>

    <div class="web-extra-inner web-bottom-grid">
        <div class="web-included reveal">
            <div class="included-title">O que está sempre incluído</div>
            <ul class="included-list">
                <li><span class="check-icon" style="background:rgba(0,212,255,0.12);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Design 100% personalizado — sem templates genéricos</li>
                <li><span class="check-icon" style="background:rgba(0,212,255,0.12);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Site responsivo — mobile, tablet e desktop</li>
                <li><span class="check-icon" style="background:rgba(0,212,255,0.12);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>SEO técnico integrado desde o primeiro dia</li>
                <li><span class="check-icon" style="background:rgba(0,212,255,0.12);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Formulários de contacto e integração com CRM</li>
                <li><span class="check-icon" style="background:rgba(0,212,255,0.12);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>HTTPS (SSL), hosting de alta velocidade e domínio configurado</li>
                <li><span class="check-icon" style="background:rgba(0,212,255,0.12);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Manutenção mensal — atualizações, backups e segurança</li>
                <li><span class="check-icon" style="background:rgba(0,212,255,0.12);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Formação ao cliente para gestão autónoma do conteúdo</li>
                <li><span class="check-icon" style="background:rgba(0,212,255,0.12);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Relatório de performance mensal (Google Analytics + Search Console)</li>
            </ul>
        </div>
        <div class="web-approach reveal">
            <div class="included-title">A nossa abordagem</div>
            <div class="approach-table">
                <div class="approach-row approach-header">
                    <span>O seu perfil</span>
                    <span>A nossa abordagem</span>
                </div>
                <div class="approach-row">
                    <span>Quer autonomia na gestão</span>
                    <span>CMS intuitivo, formação e suporte incluídos</span>
                </div>
                <div class="approach-row">
                    <span>Precisa de funcionalidades específicas</span>
                    <span>Desenvolvimento à medida</span>
                </div>
                <div class="approach-row">
                    <span>Tem loja online</span>
                    <span>Solução e-commerce otimizada para vender</span>
                </div>
                <div class="approach-row">
                    <span>Já tem site mas precisa de melhorar</span>
                    <span>Redesign com foco em conversão e SEO</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="service-section" id="social" data-section="social">
    <div class="service-inner reverse">
        <div class="service-content reveal">
            <div class="service-number">02</div>
            <div class="service-icon-wrap" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.2);">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round"><rect x="2" y="2" width="9" height="9" rx="1.5"/><rect x="13" y="2" width="9" height="9" rx="1.5"/><rect x="2" y="13" width="9" height="9" rx="1.5"/><rect x="13" y="13" width="9" height="9" rx="1.5"/></svg>
            </div>
            <h2>Gestão de<br>Redes Sociais</h2>
            <p class="service-desc">A sua presença nas redes sociais é frequentemente o primeiro contacto que um potencial cliente tem com a sua marca. Criamos e gerimos conteúdo estratégico que constrói comunidade, gera confiança e transforma seguidores em clientes, com consistência visual e editorial em todos os canais.</p>
            <div class="included-title">O que está incluído</div>
            <ul class="included-list">
                <li><span class="check-icon" style="background:rgba(74,108,247,0.12);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Estratégia de conteúdo mensal personalizada</li>
                <li><span class="check-icon" style="background:rgba(74,108,247,0.12);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Criação de posts, stories, reels e vídeos curtos</li>
                <li><span class="check-icon" style="background:rgba(74,108,247,0.12);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Design gráfico alinhado com a identidade da marca</li>
                <li><span class="check-icon" style="background:rgba(74,108,247,0.12);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Calendarização e publicação nas plataformas (Instagram, Facebook, LinkedIn)</li>
                <li><span class="check-icon" style="background:rgba(74,108,247,0.12);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Gestão de comentários e mensagens directas</li>
                <li><span class="check-icon" style="background:rgba(74,108,247,0.12);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Relatório mensal de métricas e crescimento</li>
            </ul>
            <a href="{{ route('home') }}#cta-final" class="btn-primary">Pedir proposta<svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        </div>

        <div class="service-visual reveal">
            <div class="results-card">
                <div class="results-card-title">Resultados Típicos</div>
                <div class="results-grid">
                    <div class="result-item"><div class="result-val">+320%</div><div class="result-label">Crescimento de seguidores em 6 meses</div></div>
                    <div class="result-item"><div class="result-val">4.8%</div><div class="result-label">Taxa de engagement média</div></div>
                    <div class="result-item"><div class="result-val">16×</div><div class="result-label">Publicações por mês (mínimo)</div></div>
                    <div class="result-item"><div class="result-val">48h</div><div class="result-label">Aprovação de conteúdos antes de publicar</div></div>
                </div>
                <div class="process-title">O nosso fluxo mensal</div>
                <div class="process-steps">
                    <div class="process-step"><div class="step-num">1</div><div class="step-text"><strong>Planeamento editorial</strong>Definição de temas, datas e formatos para o mês</div></div>
                    <div class="process-step"><div class="step-num">2</div><div class="step-text"><strong>Produção de conteúdo</strong>Textos, design e edição de vídeo</div></div>
                    <div class="process-step"><div class="step-num">3</div><div class="step-text"><strong>Aprovação pelo cliente</strong>Revisão prévia de todos os conteúdos</div></div>
                    <div class="process-step"><div class="step-num">4</div><div class="step-text"><strong>Publicação & gestão</strong>Agendamento e monitorização diária</div></div>
                    <div class="process-step"><div class="step-num">5</div><div class="step-text"><strong>Relatório mensal</strong>Análise de resultados e ajuste de estratégia</div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="service-section" id="google" data-section="google">
    <div class="service-inner">
        <div class="service-content reveal">
            <div class="service-number">03</div>
            <div class="service-icon-wrap" style="background:rgba(139,63,219,0.1);border:1px solid rgba(139,63,219,0.2);">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#8B3FDB" stroke-width="1.8" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            </div>
            <h2>Google Ads<br>com Resultados Reais</h2>
            <p class="service-desc">Quando um potencial cliente pesquisa no Google pelo que vende, o seu anúncio precisa de aparecer em primeiro. Gerimos campanhas de Search, Display e Performance Max com segmentação precisa, focadas em conversões reais, não apenas em cliques. Cada euro investido é rastreado e justificado.</p>
            <div class="included-title">O que está incluído</div>
            <ul class="included-list">
                <li><span class="check-icon" style="background:rgba(139,63,219,0.12);border:1px solid rgba(139,63,219,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#8B3FDB" stroke-width="2" stroke-linecap="round"/></svg></span>Auditoria e configuração da conta Google Ads</li>
                <li><span class="check-icon" style="background:rgba(139,63,219,0.12);border:1px solid rgba(139,63,219,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#8B3FDB" stroke-width="2" stroke-linecap="round"/></svg></span>Pesquisa avançada de keywords e análise de concorrência</li>
                <li><span class="check-icon" style="background:rgba(139,63,219,0.12);border:1px solid rgba(139,63,219,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#8B3FDB" stroke-width="2" stroke-linecap="round"/></svg></span>Criação e testes A/B de anúncios (texto, extensões, RSA)</li>
                <li><span class="check-icon" style="background:rgba(139,63,219,0.12);border:1px solid rgba(139,63,219,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#8B3FDB" stroke-width="2" stroke-linecap="round"/></svg></span>Configuração de conversões e rastreio via Google Tag Manager</li>
                <li><span class="check-icon" style="background:rgba(139,63,219,0.12);border:1px solid rgba(139,63,219,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#8B3FDB" stroke-width="2" stroke-linecap="round"/></svg></span>Otimização contínua de lances e Quality Score</li>
                <li><span class="check-icon" style="background:rgba(139,63,219,0.12);border:1px solid rgba(139,63,219,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#8B3FDB" stroke-width="2" stroke-linecap="round"/></svg></span>Relatório mensal com ROAS, CPL e recomendações de escala</li>
            </ul>
            <a href="{{ route('home') }}#cta-final" class="btn-primary">Pedir proposta<svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        </div>

        <div class="service-visual reveal">
            <div class="results-card">
                <div class="results-card-title">Resultados Típicos</div>
                <div class="results-grid">
                    <div class="result-item"><div class="result-val">3.2×</div><div class="result-label">ROAS médio nos primeiros 90 dias</div></div>
                    <div class="result-item"><div class="result-val">-41%</div><div class="result-label">Redução do custo por clique vs. média sector</div></div>
                    <div class="result-item"><div class="result-val">+89%</div><div class="result-label">Aumento de leads qualificados</div></div>
                    <div class="result-item"><div class="result-val">7,2%</div><div class="result-label">CTR médio (vs. 2,1% do mercado)</div></div>
                </div>
                <div class="process-title">Gestão contínua</div>
                <div class="process-steps">
                    <div class="process-step"><div class="step-num">1</div><div class="step-text"><strong>Setup & tracking</strong>Configuração de conta, conversões e pixels</div></div>
                    <div class="process-step"><div class="step-num">2</div><div class="step-text"><strong>Lançamento de campanhas</strong>Search, Display ou Performance Max conforme o objetivo</div></div>
                    <div class="process-step"><div class="step-num">3</div><div class="step-text"><strong>Otimização semanal</strong>Ajustes de lances, keywords negativas e anúncios</div></div>
                    <div class="process-step"><div class="step-num">4</div><div class="step-text"><strong>Escala progressiva</strong>Aumento de budget nas campanhas com melhor ROAS</div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="service-section" id="meta" data-section="meta">
    <div class="service-inner reverse">
        <div class="service-content reveal">
            <div class="service-number">04</div>
            <div class="service-icon-wrap" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.2);">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </div>
            <h2>Meta Ads —<br>Facebook & Instagram</h2>
            <p class="service-desc">O Meta é uma das plataformas de publicidade mais poderosas do mundo, quando bem utilizada. Criamos campanhas que encontram o seu cliente ideal, com segmentação demográfica, por interesses e lookalike audiences. Do awareness à conversão, gerimos cada fase do funil com criativos de alto impacto.</p>
            <div class="included-title">O que está incluído</div>
            <ul class="included-list">
                <li><span class="check-icon" style="background:rgba(0,212,255,0.12);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Configuração do Meta Business Suite e Pixel</li>
                <li><span class="check-icon" style="background:rgba(0,212,255,0.12);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Criação de audiências personalizadas e lookalike</li>
                <li><span class="check-icon" style="background:rgba(0,212,255,0.12);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Design de criativos (imagem e vídeo) para feed e stories</li>
                <li><span class="check-icon" style="background:rgba(0,212,255,0.12);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Testes A/B de audiências, criativos e copy</li>
                <li><span class="check-icon" style="background:rgba(0,212,255,0.12);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Campanhas de retargeting para quem visitou o site</li>
                <li><span class="check-icon" style="background:rgba(0,212,255,0.12);border:1px solid rgba(0,212,255,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00D4FF" stroke-width="2" stroke-linecap="round"/></svg></span>Dashboard em tempo real e relatório mensal detalhado</li>
            </ul>
            <a href="{{ route('home') }}#cta-final" class="btn-primary">Pedir proposta<svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        </div>

        <div class="service-visual reveal">
            <div class="results-card">
                <div class="results-card-title">Resultados Típicos</div>
                <div class="results-grid">
                    <div class="result-item"><div class="result-val">4.2×</div><div class="result-label">ROAS médio Meta Ads</div></div>
                    <div class="result-item"><div class="result-val">-38%</div><div class="result-label">Redução do custo por lead</div></div>
                    <div class="result-item"><div class="result-val">+210%</div><div class="result-label">Alcance vs. publicações orgânicas</div></div>
                    <div class="result-item"><div class="result-val">2,4%</div><div class="result-label">Taxa de conversão de anúncios (média sector: 0,9%)</div></div>
                </div>
                <div class="process-title">Estrutura de campanhas</div>
                <div class="process-steps">
                    <div class="process-step"><div class="step-num">1</div><div class="step-text"><strong>Topo de funil (awareness)</strong>Apresentar a marca a audiências novas e qualificadas</div></div>
                    <div class="process-step"><div class="step-num">2</div><div class="step-text"><strong>Meio de funil (consideração)</strong>Leads, tráfego e envolvimento com conteúdo</div></div>
                    <div class="process-step"><div class="step-num">3</div><div class="step-text"><strong>Fundo de funil (conversão)</strong>Campanhas de conversão para quem já conhece a marca</div></div>
                    <div class="process-step"><div class="step-num">4</div><div class="step-text"><strong>Retargeting</strong>Recuperar visitantes que ainda não converteram</div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="service-section" id="seo" data-section="seo">
    <div class="service-inner">
        <div class="service-content reveal">
            <div class="service-number">05</div>
            <div class="service-icon-wrap" style="background:rgba(74,108,247,0.1);border:1px solid rgba(74,108,247,0.2);">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            </div>
            <h2>SEO — Visibilidade<br>Orgânica Duradoura</h2>
            <p class="service-desc">Aparecer no topo do Google para as pesquisas certas é o canal de marketing com melhor retorno a longo prazo. A nossa abordagem de SEO combina otimização técnica, criação de conteúdo e construção de autoridade, para que o seu site atraia tráfego qualificado todos os meses, sem depender exclusivamente de publicidade paga.</p>
            <div class="included-title">O que está incluído</div>
            <ul class="included-list">
                <li><span class="check-icon" style="background:rgba(74,108,247,0.12);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Auditoria técnica SEO completa (velocidade, crawlability, Core Web Vitals)</li>
                <li><span class="check-icon" style="background:rgba(74,108,247,0.12);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Pesquisa de keywords com análise de intenção de pesquisa</li>
                <li><span class="check-icon" style="background:rgba(74,108,247,0.12);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Otimização on-page (meta titles, descriptions, headings, schema)</li>
                <li><span class="check-icon" style="background:rgba(74,108,247,0.12);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Criação de conteúdo SEO-optimizado (artigos, páginas de serviço)</li>
                <li><span class="check-icon" style="background:rgba(74,108,247,0.12);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>SEO local — Google Business Profile e diretorias regionais</li>
                <li><span class="check-icon" style="background:rgba(74,108,247,0.12);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Link building e construção de autoridade de domínio</li>
                <li><span class="check-icon" style="background:rgba(74,108,247,0.12);border:1px solid rgba(74,108,247,0.25);"><svg width="9" height="9" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round"/></svg></span>Relatório mensal com rankings, tráfego e recomendações</li>
            </ul>
            <a href="{{ route('home') }}#cta-final" class="btn-primary">Pedir proposta<svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        </div>

        <div class="service-visual reveal">
            <div class="results-card">
                <div class="results-card-title">Resultados Típicos</div>
                <div class="results-grid">
                    <div class="result-item"><div class="result-val">+240%</div><div class="result-label">Tráfego orgânico em 6 meses</div></div>
                    <div class="result-item"><div class="result-val">Top 3</div><div class="result-label">Posição Google para keywords principais</div></div>
                    <div class="result-item"><div class="result-val">3–6m</div><div class="result-label">Prazo para resultados visíveis</div></div>
                    <div class="result-item"><div class="result-val">∞</div><div class="result-label">Tráfego sem custo por clique adicional</div></div>
                </div>
                <div class="process-title">Abordagem SEO</div>
                <div class="process-steps">
                    <div class="process-step"><div class="step-num">1</div><div class="step-text"><strong>Auditoria técnica</strong>Identificar e corrigir problemas que bloqueiam o Google</div></div>
                    <div class="process-step"><div class="step-num">2</div><div class="step-text"><strong>Estratégia de keywords</strong>Encontrar as pesquisas com maior potencial de conversão</div></div>
                    <div class="process-step"><div class="step-num">3</div><div class="step-text"><strong>Otimização on-page</strong>Melhorar cada página para as keywords certas</div></div>
                    <div class="process-step"><div class="step-num">4</div><div class="step-text"><strong>Conteúdo & autoridade</strong>Publicar conteúdo que atrai links e confiança</div></div>
                    <div class="process-step"><div class="step-num">5</div><div class="step-text"><strong>Monitorização contínua</strong>Acompanhar rankings e adaptar a cada atualização do Google</div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="final-cta">
    <div class="cta-box">
        <h2>Não sabe por onde começar?<br><span class="grad-text">Nós ajudamos.</span></h2>
        <p>Marque uma conversa gratuita. Analisamos o seu negócio e recomendamos os serviços com maior impacto para si.</p>
        <div class="cta-actions">
            <a href="{{ route('home') }}#cta-final" class="btn-primary">Pedir Diagnóstico Grátis<svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
            <a href="tel:+351220000000" class="btn-ghost">Ligar agora</a>
        </div>
    </div>
</div>

@include('partials.site-footer')

<script>
    const navElement = document.querySelector("nav");
    const sections = document.querySelectorAll(".service-section[data-section]");
    const pills = document.querySelectorAll(".service-pill[data-section]");
    const serviceNavInner = document.querySelector(".service-nav-inner");
    const revealElements = document.querySelectorAll(".reveal");

    function setActivePill(id) {
        pills.forEach((pill) => {
            const isActive = pill.dataset.section === id;
            pill.classList.toggle("active", isActive);

            if (isActive && serviceNavInner) {
                const targetLeft = pill.offsetLeft - ((serviceNavInner.clientWidth - pill.clientWidth) / 2);
                const maxScroll = serviceNavInner.scrollWidth - serviceNavInner.clientWidth;
                const nextScrollLeft = Math.max(0, Math.min(targetLeft, maxScroll));

                serviceNavInner.scrollTo({
                    left: nextScrollLeft,
                    behavior: "smooth",
                });
            }
        });
    }

    window.addEventListener("scroll", () => {
        navElement.style.background = window.scrollY > 50
            ? "rgba(4, 8, 16, 0.97)"
            : "rgba(6, 11, 32, 0.9)";
    });

    if ("IntersectionObserver" in window) {
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    setActivePill(entry.target.dataset.section);
                }
            });
        }, { threshold: 0.4 });

        sections.forEach((section) => sectionObserver.observe(section));

        const fadeObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    fadeObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        revealElements.forEach((element) => fadeObserver.observe(element));
    } else {
        revealElements.forEach((element) => element.classList.add("is-visible"));
    }

    const initialActivePill = document.querySelector(".service-pill.active");
    if (initialActivePill) {
        setActivePill(initialActivePill.dataset.section);
    }
</script>
</body>
</html>
