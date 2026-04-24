<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexusVora — Agência Full-Service | Web, Marketing Digital e IA</title>
    <link rel="icon" type="image/svg+xml" href='data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" fill="none"%3E%3Cdefs%3E%3ClinearGradient id="ng" x1="0" y1="0" x2="60" y2="60" gradientUnits="userSpaceOnUse"%3E%3Cstop offset="0%25" stop-color="%2300D4FF"/%3E%3Cstop offset="50%25" stop-color="%234A6CF7"/%3E%3Cstop offset="100%25" stop-color="%238B3FDB"/%3E%3C/linearGradient%3E%3C/defs%3E%3Ccircle cx="30" cy="30" r="7" stroke="url(%23ng)" stroke-width="2.5" fill="none"/%3E%3Ccircle cx="30" cy="30" r="3" fill="url(%23ng)"/%3E%3Cline x1="30" y1="23" x2="30" y2="10" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="30" cy="8" r="3" fill="url(%23ng)"/%3E%3Cline x1="30" y1="37" x2="30" y2="50" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="30" cy="52" r="3" fill="url(%23ng)"/%3E%3Cline x1="23" y1="30" x2="10" y2="30" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="8" cy="30" r="3" fill="url(%23ng)"/%3E%3Cline x1="37" y1="30" x2="50" y2="30" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="52" cy="30" r="3" fill="url(%23ng)"/%3E%3Cline x1="25" y1="25" x2="16" y2="16" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="13.5" cy="13.5" r="3" fill="url(%23ng)"/%3E%3Cline x1="35" y1="35" x2="44" y2="44" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="46.5" cy="46.5" r="3" fill="url(%23ng)"/%3E%3Cline x1="35" y1="25" x2="44" y2="16" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="46.5" cy="13.5" r="3" fill="url(%23ng)"/%3E%3Cline x1="25" y1="35" x2="16" y2="44" stroke="url(%23ng)" stroke-width="2" stroke-linecap="round"/%3E%3Ccircle cx="13.5" cy="46.5" r="3" fill="url(%23ng)"/%3E%3C/svg%3E'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --cyan: #00d4ff;
            --blue: #4a6cf7;
            --purple: #8b3fdb;
            --navy: #0a0f2e;
            --navy-2: #060b20;
            --navy-card: #111936;
            --navy-border: rgba(255, 255, 255, 0.07);
            --text: #e8eaf6;
            --text-muted: #8892b0;
            --grad: linear-gradient(135deg, #00d4ff, #4a6cf7, #8b3fdb);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: "Inter", sans-serif;
            background: var(--navy);
            color: var(--text);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5 {
            font-family: "Plus Jakarta Sans", sans-serif;
            line-height: 1.15;
        }

        a {
            color: inherit;
        }


        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 120px 5vw 80px;
            overflow: hidden;
        }

        .hero-inner {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            align-items: center;
        }

        .hero-canvas {
            position: absolute;
            inset: 0;
            z-index: 0;
            display: block;
            width: 100%;
            height: 100%;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 28px;
            padding: 6px 16px;
            border: 1px solid rgba(74, 108, 247, 0.3);
            border-radius: 999px;
            background: rgba(74, 108, 247, 0.15);
            color: var(--cyan);
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .hero-badge-dot,
        .dash-badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--cyan);
            animation: pulse 2s infinite;
        }

        .hero h1 {
            position: relative;
            z-index: 1;
            margin-bottom: 28px;
            color: #fff;
            font-size: clamp(1.8rem, 3vw, 2.8rem);
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.15;
            text-wrap: pretty;
        }

        .grad-text {
            background: var(--grad);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            max-width: 560px;
            margin-bottom: 40px;
            color: var(--text-muted);
            font-size: 1.15rem;
            line-height: 1.7;
            text-wrap: pretty;
        }

        .hero-actions,
        .cta-actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            align-items: center;
        }

        .btn-primary {
            padding: 16px 32px;
            border-radius: 10px;
            background: var(--grad);
            color: #fff;
            font-family: "Plus Jakarta Sans", sans-serif;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 8px 32px rgba(74, 108, 247, 0.35);
        }

        .btn-primary:hover {
            box-shadow: 0 12px 40px rgba(74, 108, 247, 0.45);
            transform: translateY(-2px);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 16px 28px;
            border: 1px solid var(--navy-border);
            border-radius: 10px;
            background: transparent;
            color: var(--text);
            font-family: "Plus Jakarta Sans", sans-serif;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            transition: border-color 0.2s ease, color 0.2s ease, background 0.2s ease;
        }

        .btn-ghost:hover {
            border-color: rgba(255, 255, 255, 0.25);
            background: rgba(255, 255, 255, 0.04);
            color: #fff;
        }

        .btn-ghost--project {
            position: relative;
            overflow: hidden;
            border-color: rgba(74, 108, 247, 0.28);
            background:
                linear-gradient(120deg, rgba(0, 212, 255, 0.12), rgba(74, 108, 247, 0.14), rgba(139, 63, 219, 0.12));
            box-shadow:
                inset 0 0 0 1px rgba(255, 255, 255, 0.02),
                0 12px 30px rgba(10, 15, 46, 0.35);
        }

        .btn-ghost--project::before {
            content: "";
            position: absolute;
            inset: -1px;
            background: linear-gradient(135deg, var(--cyan), var(--blue), var(--purple), var(--cyan));
            background-size: 220% 220%;
            opacity: 0.18;
            filter: blur(10px);
            animation: projectButtonFlow 6s linear infinite;
        }

        .btn-ghost--project::after {
            content: "";
            position: absolute;
            top: 0;
            left: -35%;
            width: 30%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transform: skewX(-20deg);
            animation: projectButtonShine 3.8s ease-in-out infinite;
        }

        .btn-ghost--project span {
            position: relative;
            z-index: 1;
        }

        .btn-ghost--project:hover {
            border-color: rgba(0, 212, 255, 0.42);
            background:
                linear-gradient(120deg, rgba(0, 212, 255, 0.18), rgba(74, 108, 247, 0.22), rgba(139, 63, 219, 0.18));
            box-shadow:
                inset 0 0 0 1px rgba(255, 255, 255, 0.04),
                0 18px 44px rgba(74, 108, 247, 0.22);
            transform: translateY(-2px);
        }

        .hero-visual {
            position: relative;
            z-index: 1;
        }

        .dash-card {
            position: relative;
            overflow: hidden;
            padding: 24px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 18px;
            background: #111936;
            box-shadow: 0 32px 80px rgba(0, 0, 0, 0.5);
        }

        .dash-card::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(74, 108, 247, 0.15), transparent 70%);
        }

        .dash-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .dash-title {
            color: #fff;
            font-family: "Plus Jakarta Sans", sans-serif;
            font-size: 0.82rem;
            font-weight: 700;
        }

        .dash-badge {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border: 1px solid rgba(0, 212, 255, 0.2);
            border-radius: 999px;
            background: rgba(0, 212, 255, 0.1);
            color: var(--cyan);
            font-size: 0.72rem;
            font-weight: 600;
        }

        .dash-kpis {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .dash-kpi,
        .why-metric {
            padding: 12px 14px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.03);
        }

        .dash-kpi-val,
        .stat-num,
        .portfolio-result-val,
        .why-metric-val {
            background: var(--grad);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-family: "Plus Jakarta Sans", sans-serif;
            font-weight: 800;
            line-height: 1;
        }

        .dash-kpi-val {
            font-size: 1.3rem;
        }

        .dash-kpi-label,
        .dash-chart-label,
        .dash-channel-name,
        .dash-channel-val,
        .dash-kpi-change,
        .hero-floating-badge-text span,
        .portfolio-result-label,
        .stat-label,
        .why-metric-label,
        .author-role,
        .footer-bottom p,
        .footer-brand p,
        .footer-col ul a {
            color: var(--text-muted);
        }

        .dash-kpi-label {
            margin-top: 4px;
            font-size: 0.68rem;
        }

        .dash-kpi-change {
            margin-top: 2px;
            color: #4ade80;
            font-size: 0.68rem;
            font-weight: 600;
        }

        .dash-chart-area {
            margin-bottom: 18px;
        }

        .dash-chart-label {
            margin-bottom: 10px;
            font-size: 0.72rem;
        }

        .dash-chart {
            position: relative;
            height: 100px;
        }

        .dash-chart svg {
            width: 100%;
            height: 100%;
        }

        .dash-channels {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .dash-channel {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dash-channel-name {
            width: 80px;
            flex-shrink: 0;
            font-size: 0.75rem;
        }

        .dash-channel-bar-wrap {
            flex: 1;
            height: 6px;
            overflow: hidden;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.06);
        }

        .dash-channel-bar {
            height: 100%;
            border-radius: 999px;
        }

        .dash-channel-val {
            width: 36px;
            flex-shrink: 0;
            color: var(--text);
            font-size: 0.72rem;
            font-weight: 600;
            text-align: right;
        }

        .hero-floating-badge {
            position: absolute;
            bottom: -20px;
            left: -20px;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border: 1px solid rgba(74, 108, 247, 0.3);
            border-radius: 12px;
            background: #111936;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .hero-floating-badge-icon {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.2), rgba(74, 108, 247, 0.2));
        }

        .hero-floating-badge-text {
            font-size: 0.75rem;
        }

        .hero-floating-badge-text strong {
            display: block;
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .stats-inner,
        .services-grid,
        .testimonials-grid,
        .portfolio-grid {
            display: grid;
            gap: 20px;
        }

        section {
            padding: 100px 5vw;
        }

        .section-inner {
            max-width: 1100px;
            margin: 0 auto;
        }

        .section-tag {
            margin-bottom: 14px;
            color: var(--cyan);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .section-title {
            margin-bottom: 16px;
            color: #fff;
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            font-weight: 800;
            letter-spacing: -0.02em;
            text-wrap: pretty;
        }

        .section-sub {
            max-width: 560px;
            color: var(--text-muted);
            font-size: 1.05rem;
            line-height: 1.7;
            text-wrap: pretty;
        }

        #servicos,
        #depoimentos,
        footer {
            background: var(--navy-2);
        }

        #servicos {
            position: relative;
            overflow: hidden;
        }

        #servicos .section-inner {
            position: relative;
            z-index: 1;
        }

        .section-bg {
            position: absolute;
            inset: 0;
            z-index: 0;
            background: var(--navy-2);
        }

        .section-bg::before {
            content: "";
            position: absolute;
            top: -200px;
            right: -100px;
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(74, 108, 247, 0.18) 0%, transparent 70%);
            border-radius: 50%;
        }

        .section-bg::after {
            content: "";
            position: absolute;
            bottom: -150px;
            left: 10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(0, 212, 255, 0.12) 0%, transparent 70%);
            border-radius: 50%;
        }

        .section-grid {
            position: absolute;
            inset: 0;
            z-index: 0;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.06) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 30%, transparent 100%);
        }

        .services-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 24px;
            margin-bottom: 56px;
        }

        .services-grid,
        .testimonials-grid,
        .portfolio-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .service-card,
        .testimonial-card,
        .portfolio-card,
        .why-visual-box {
            border: 1px solid var(--navy-border);
            background: var(--navy-card);
        }

        .service-card {
            position: relative;
            overflow: hidden;
            padding: 32px;
            border-radius: 16px;
            transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
        }

        .service-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--grad);
            opacity: 0;
            transition: opacity 0.25s ease;
        }

        .service-card:hover,
        .testimonial-card:hover,
        .portfolio-card:hover {
            transform: translateY(-4px);
            border-color: rgba(74, 108, 247, 0.3);
        }

        .service-card:hover {
            box-shadow: 0 16px 48px rgba(10, 15, 46, 0.5);
        }

        .service-card:hover::before {
            opacity: 1;
        }

        .service-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            border-radius: 12px;
            font-size: 1.4rem;
        }

        .service-card h3,
        .portfolio-body h3 {
            margin-bottom: 10px;
            color: #fff;
            font-size: 1.15rem;
            font-weight: 700;
        }

        .service-card p,
        .portfolio-body p,
        .why-feature-body p,
        .cta-box p {
            color: var(--text-muted);
            line-height: 1.65;
        }

        .service-card p,
        .portfolio-body p {
            font-size: 0.9rem;
        }

        .service-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 20px;
            color: var(--cyan);
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: gap 0.2s ease;
        }

        .service-link:hover {
            gap: 10px;
        }

        .why-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            align-items: center;
            margin-top: 64px;
        }

        .why-visual-box {
            position: relative;
            overflow: hidden;
            padding: 40px;
            border-radius: 20px;
        }

        .why-visual-box::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 80% 20%, rgba(74, 108, 247, 0.1) 0%, transparent 60%);
        }

        .why-metrics {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .why-metric {
            padding: 20px;
            border-radius: 12px;
        }

        .why-metric-val {
            font-size: 1.8rem;
        }

        .why-metric-label {
            margin-top: 4px;
            font-size: 0.8rem;
        }

        .why-features {
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .why-feature {
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }

        .why-feature-icon {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(74, 108, 247, 0.2);
            border-radius: 10px;
            background: rgba(74, 108, 247, 0.12);
        }

        .why-feature-body h4 {
            margin-bottom: 4px;
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
        }

        .testimonial-card,
        .portfolio-card {
            border-radius: 16px;
            transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
        }

        .testimonial-card {
            display: flex;
            flex-direction: column;
            padding: 32px;
        }

        .portfolio-card {
            overflow: hidden;
            border-radius: 18px;
        }

        .portfolio-card:hover {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        }

        .stars {
            display: flex;
            gap: 3px;
            margin-bottom: 20px;
        }

        .star {
            width: 14px;
            height: 14px;
            background: linear-gradient(135deg, #ffd700, #ffa500);
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
        }

        .testimonial-text {
            flex: 1;
            margin-bottom: 24px;
            color: var(--text);
            font-size: 0.93rem;
            font-style: italic;
            line-height: 1.7;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .author-avatar {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--grad);
            color: #fff;
            font-family: "Plus Jakarta Sans", sans-serif;
            font-size: 0.9rem;
            font-weight: 800;
        }

        .author-name,
        .footer-col h5,
        .cta-box h2 {
            color: #fff;
            font-family: "Plus Jakarta Sans", sans-serif;
            font-weight: 700;
        }

        .author-name {
            font-size: 0.9rem;
        }

        .author-role {
            margin-top: 2px;
            font-size: 0.78rem;
        }

        .portfolio-thumb {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 180px;
            overflow: hidden;
        }

        .portfolio-thumb-label {
            position: absolute;
            bottom: 12px;
            left: 12px;
            color: rgba(255, 255, 255, 0.25);
            font-family: monospace;
            font-size: 0.72rem;
            letter-spacing: 0.06em;
        }

        .portfolio-body {
            padding: 24px;
        }

        .portfolio-tag {
            display: inline-block;
            margin-bottom: 12px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .portfolio-results {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            padding-top: 16px;
            border-top: 1px solid var(--navy-border);
        }

        .portfolio-result-item {
            text-align: center;
        }

        .portfolio-result-val {
            font-size: 1.1rem;
        }

        .portfolio-result-label {
            margin-top: 2px;
            font-size: 0.65rem;
        }

        #cta-final {
            padding: 120px 5vw;
        }

        .cta-box {
            position: relative;
            overflow: hidden;
            max-width: 1100px;
            margin: 0 auto;
            padding: 80px 60px;
            border: 1px solid rgba(74, 108, 247, 0.25);
            border-radius: 24px;
            background: linear-gradient(135deg, rgba(74, 108, 247, 0.15), rgba(139, 63, 219, 0.1));
            text-align: center;
        }

        .cta-box::before {
            content: "";
            position: absolute;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 300px;
            background: radial-gradient(circle, rgba(74, 108, 247, 0.2), transparent 70%);
        }

        .cta-box h2 {
            position: relative;
            z-index: 1;
            margin-bottom: 16px;
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            font-weight: 800;
            letter-spacing: -0.02em;
            text-wrap: pretty;
        }

        .cta-box p {
            position: relative;
            z-index: 1;
            max-width: 500px;
            margin: 0 auto 40px;
            font-size: 1.05rem;
            line-height: 1.7;
        }

        .cta-actions {
            position: relative;
            z-index: 1;
            justify-content: center;
        }


        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(1.4);
            }
        }

        @keyframes projectButtonFlow {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }

        @keyframes projectButtonShine {
            0%, 100% {
                left: -35%;
                opacity: 0;
            }

            15% {
                opacity: 0;
            }

            45% {
                left: 115%;
                opacity: 1;
            }

            60% {
                opacity: 0;
            }
        }

        @media (max-width: 900px) {
            .hero-inner,
            .why-grid {
                grid-template-columns: 1fr;
            }

            .hero-visual {
                display: none;
            }

            .services-grid {
                grid-template-columns: 1fr 1fr;
            }

            .testimonials-grid,
            .portfolio-grid {
                grid-template-columns: 1fr;
            }

            .stats-inner {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-top {
                grid-template-columns: 1fr 1fr;
            }

            .nav-links {
                display: none;
            }
        }

        @media (max-width: 640px) {
            nav {
                padding: 0 18px;
            }

            .nav-cta {
                display: none;
            }

            .hero,
            section,
            #cta-final,
            footer {
                padding-left: 18px;
                padding-right: 18px;
            }

            .hero {
                padding-top: 110px;
                padding-bottom: 64px;
            }

            .hero p,
            .section-sub,
            .cta-box p {
                font-size: 1rem;
            }

            .btn-primary,
            .btn-ghost {
                width: 100%;
                justify-content: center;
            }

            .services-grid,
            .stats-inner,
            .footer-top,
            .why-metrics,
            .dash-kpis,
            .portfolio-results {
                grid-template-columns: 1fr;
            }

            .cta-box {
                padding: 48px 24px;
            }

            .footer-bottom {
                align-items: flex-start;
                flex-direction: column;
            }

            .footer-bottom a {
                margin-top: 5px;
            }
        }
    </style>
</head>
<body>
    @include('partials.site-header')

    <section class="hero">
        <canvas id="hero-canvas" class="hero-canvas" aria-hidden="true"></canvas>

        <div class="hero-inner">
            <div class="hero-content">
                <div class="hero-badge">
                    <div class="hero-badge-dot"></div>
                    Agência Full-Service · Web · Ads · SEO · IA
                </div>

                <h1>
                    Transformamos o seu negócio numa<br>
                    <span class="grad-text">máquina de crescimento digital.</span>
                </h1>

                <p>
                    Da identidade visual à automação com IA — desenvolvemos sites, gerimos campanhas e implementamos
                    estratégias que geram resultados mensuráveis para PMEs e concessionários.
                </p>

                <div class="hero-actions">
                    <a href="#cta-final" class="btn-primary">
                        Pedir Diagnóstico Grátis
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="dash-card">
                    <div class="dash-header">
                        <span class="dash-title">Performance — Últimos 30 dias</span>
                        <span class="dash-badge"><span class="dash-badge-dot"></span>Live</span>
                    </div>

                    <div class="dash-kpis">
                        <div class="dash-kpi">
                            <div class="dash-kpi-val">3.8×</div>
                            <div class="dash-kpi-label">ROAS</div>
                            <div class="dash-kpi-change">↑ +0.4 vs mês ant.</div>
                        </div>
                        <div class="dash-kpi">
                            <div class="dash-kpi-val">€2.1k</div>
                            <div class="dash-kpi-label">Custo/Conv.</div>
                            <div class="dash-kpi-change">↓ -12%</div>
                        </div>
                        <div class="dash-kpi">
                            <div class="dash-kpi-val">247</div>
                            <div class="dash-kpi-label">Leads</div>
                            <div class="dash-kpi-change">↑ +38%</div>
                        </div>
                    </div>

                    <div class="dash-chart-area">
                        <div class="dash-chart-label">Tráfego orgânico · visitas/semana</div>
                        <div class="dash-chart">
                            <svg viewBox="0 0 400 100" preserveAspectRatio="none">
                                <defs>
                                    <linearGradient id="chartGrad" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#4A6CF7" stop-opacity="0.3"/>
                                        <stop offset="100%" stop-color="#4A6CF7" stop-opacity="0"/>
                                    </linearGradient>
                                    <linearGradient id="lineGrad" x1="0" y1="0" x2="1" y2="0">
                                        <stop offset="0%" stop-color="#00D4FF"/>
                                        <stop offset="50%" stop-color="#4A6CF7"/>
                                        <stop offset="100%" stop-color="#8B3FDB"/>
                                    </linearGradient>
                                </defs>
                                <line x1="0" y1="25" x2="400" y2="25" stroke="rgba(255,255,255,0.04)" stroke-width="1"/>
                                <line x1="0" y1="50" x2="400" y2="50" stroke="rgba(255,255,255,0.04)" stroke-width="1"/>
                                <line x1="0" y1="75" x2="400" y2="75" stroke="rgba(255,255,255,0.04)" stroke-width="1"/>
                                <path d="M0,80 C40,75 60,65 100,58 C140,51 160,55 200,44 C240,33 260,38 300,25 C330,15 360,18 400,8 L400,100 L0,100 Z" fill="url(#chartGrad)"/>
                                <path d="M0,80 C40,75 60,65 100,58 C140,51 160,55 200,44 C240,33 260,38 300,25 C330,15 360,18 400,8" fill="none" stroke="url(#lineGrad)" stroke-width="2.5" stroke-linecap="round"/>
                                <circle cx="400" cy="8" r="4" fill="#8B3FDB"/>
                                <circle cx="400" cy="8" r="7" fill="rgba(139,63,219,0.25)"/>
                            </svg>
                        </div>
                    </div>

                    <div class="dash-chart-label">Canais de aquisição</div>
                    <div class="dash-channels">
                        <div class="dash-channel">
                            <span class="dash-channel-name">Google Ads</span>
                            <div class="dash-channel-bar-wrap"><div class="dash-channel-bar" style="width: 78%; background: linear-gradient(90deg, #00D4FF, #4A6CF7);"></div></div>
                            <span class="dash-channel-val">78%</span>
                        </div>
                        <div class="dash-channel">
                            <span class="dash-channel-name">Meta Ads</span>
                            <div class="dash-channel-bar-wrap"><div class="dash-channel-bar" style="width: 61%; background: linear-gradient(90deg, #4A6CF7, #8B3FDB);"></div></div>
                            <span class="dash-channel-val">61%</span>
                        </div>
                        <div class="dash-channel">
                            <span class="dash-channel-name">SEO</span>
                            <div class="dash-channel-bar-wrap"><div class="dash-channel-bar" style="width: 45%; background: linear-gradient(90deg, #8B3FDB, #00D4FF);"></div></div>
                            <span class="dash-channel-val">45%</span>
                        </div>
                    </div>
                </div>

                <div class="hero-floating-badge">
                    <div class="hero-floating-badge-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="2" stroke-linecap="round">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                        </svg>
                    </div>
                    <div class="hero-floating-badge-text">
                        <strong>+247% tráfego orgânico</strong>
                        <span>AutoPremium Gaia · últimos 6 meses</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="servicos">
        <div class="section-bg"></div>
        <div class="section-grid"></div>
        <div class="section-inner">
            <div class="services-header">
                <div>
                    <div class="section-tag">O que fazemos</div>
                    <h2 class="section-title">Serviços que geram<br>resultados reais</h2>
                    <p class="section-sub">Uma suite completa de serviços digitais, desenhada para o crescimento de PMEs e concessionários automóveis.</p>
                </div>
                <a href="{{ route('services') }}" class="btn-ghost btn-ghost--project" style="white-space: nowrap;"><span>Ver todos os serviços</span></a>
            </div>

            <div class="services-grid">
                <!-- 01 Web -->
                <article class="service-card reveal">
                    <div class="service-icon" style="background: rgba(0, 212, 255, 0.1); border: 1px solid rgba(0, 212, 255, 0.2);">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round">
                            <rect x="3" y="4" width="18" height="13" rx="2"/>
                            <path d="M8 21h8M12 17v4"/>
                        </svg>
                    </div>
                    <h3>Desenvolvimento Web</h3>
                    <p>Sites, lojas online e plataformas profissionais — rápidos, seguros e otimizados para converter visitantes em clientes.</p>
                    <a href="{{ route('services') }}#web" class="service-link">Ver serviço
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                            <path d="M3 8h10M9 4l4 4-4 4" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </article>

                <!-- 02 Redes Sociais -->
                <article class="service-card reveal">
                    <div class="service-icon" style="background: rgba(74, 108, 247, 0.1); border: 1px solid rgba(74, 108, 247, 0.2);">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round">
                            <rect x="2" y="2" width="9" height="9" rx="1.5"/>
                            <rect x="13" y="2" width="9" height="9" rx="1.5"/>
                            <rect x="2" y="13" width="9" height="9" rx="1.5"/>
                            <rect x="13" y="13" width="9" height="9" rx="1.5"/>
                        </svg>
                    </div>
                    <h3>Gestão de Redes Sociais</h3>
                    <p>Estratégia editorial, criativos de alto nível e gestão diária para marcas que querem crescer no digital.</p>
                    <a href="{{ route('services') }}#social" class="service-link">Ver serviço
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                            <path d="M3 8h10M9 4l4 4-4 4" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </article>

                <!-- 03 Tráfego -->
                <article class="service-card reveal">
                    <div class="service-icon" style="background: rgba(139, 63, 219, 0.1); border: 1px solid rgba(139, 63, 219, 0.2);">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#8B3FDB" stroke-width="1.8" stroke-linecap="round">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                        </svg>
                    </div>
                    <h3>Tráfego, Leads & Conversões</h3>
                    <p>Google Ads, Meta Ads e SEO — os três pilares do tráfego pago e orgânico, integrados numa estratégia única.</p>
                    <a href="{{ route('services') }}#trafego" class="service-link">Ver serviço
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                            <path d="M3 8h10M9 4l4 4-4 4" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </article>

                <!-- 04 NexusAI -->
                <article class="service-card reveal" style="background: linear-gradient(135deg, rgba(0, 212, 255, 0.05), rgba(74, 108, 247, 0.05)); border-color: rgba(0, 212, 255, 0.2);">
                    <div class="service-icon" style="background: rgba(0, 212, 255, 0.1); border: 1px solid rgba(0, 212, 255, 0.2);">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round">
                            <path d="M12 2a10 10 0 1 0 10 10"/><path d="M12 6v6l4 2"/><circle cx="19" cy="5" r="3" fill="#00D4FF" opacity=".3"/><circle cx="19" cy="5" r="1.5" fill="#00D4FF"/>
                        </svg>
                    </div>
                    <div style="display:inline-flex;align-items:center;gap:6px;background:rgba(0,212,255,0.08);border:1px solid rgba(0,212,255,0.2);border-radius:100px;padding:3px 10px;font-size:0.7rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--cyan);margin-bottom:12px;">
                        <span style="width:5px;height:5px;border-radius:50%;background:var(--cyan);animation:pulse 2s infinite;"></span>Produto Premium
                    </div>
                    <h3>NexusAI — Automação Inteligente</h3>
                    <p>Chatbots com IA, automação de processos e integrações — o seu negócio a trabalhar enquanto dorme.</p>
                    <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 16px;">
                        <span style="background: rgba(255,255,255,0.05); padding: 4px 10px; border-radius: 6px; font-size: 0.7rem; color: var(--text-muted);">Chatbots IA</span>
                        <span style="background: rgba(255,255,255,0.05); padding: 4px 10px; border-radius: 6px; font-size: 0.7rem; color: var(--text-muted);">Automação</span>
                        <span style="background: rgba(255,255,255,0.05); padding: 4px 10px; border-radius: 6px; font-size: 0.7rem; color: var(--text-muted);">Integrações</span>
                    </div>
                    <a href="{{ route('services') }}#nexusai" class="service-link" style="margin-top: 16px;">Descobrir NexusAI
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                            <path d="M3 8h10M9 4l4 4-4 4" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </article>

                <!-- 05 Marca & Estratégia -->
                <article class="service-card reveal">
                    <div class="service-icon" style="background: rgba(74, 108, 247, 0.1); border: 1px solid rgba(74, 108, 247, 0.2);">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <h3>Marca & Estratégia Digital</h3>
                    <p>Identidade visual, posicionamento e estratégia integrada — cada canal a potenciar o outro para resultados consistentes.</p>
                    <a href="{{ route('services') }}#marca" class="service-link">Ver serviço
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                            <path d="M3 8h10M9 4l4 4-4 4" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </article>

                <!-- 06 Estratégia Digital 360 -->
                <article class="service-card reveal" style="background: linear-gradient(135deg, rgba(74, 108, 247, 0.12), rgba(139, 63, 219, 0.08)); border-color: rgba(74, 108, 247, 0.25);">
                    <div class="service-icon" style="background: rgba(74, 108, 247, 0.15); border: 1px solid rgba(74, 108, 247, 0.3);">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 2v20M2 12h20M12 12l7.07-7.07M12 12l-7.07 7.07M12 12l7.07 7.07M12 12L4.93 4.93"/>
                        </svg>
                    </div>
                    <h3>Estratégia Digital 360°</h3>
                    <p>Uma abordagem integrada combinando todos os canais para maximizar o retorno e a autoridade da sua marca.</p>
                    <a href="#cta-final" class="service-link">Falar com especialista
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                            <path d="M3 8h10M9 4l4 4-4 4" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </article>
            </div>
        </div>
    </section>

    <section id="porquenos">
        <div class="section-inner">
            <div style="text-align: center;">
                <div class="section-tag">Porquê a NexusVora</div>
                <h2 class="section-title" style="max-width: 600px; margin: 0 auto 12px;">Não somos mais uma agência.<br>Somos o vosso parceiro de crescimento.</h2>
                <p class="section-sub" style="margin: 0 auto;">Focamo-nos exclusivamente na região do Porto, conhecemos o mercado local, os consumidores e os comportamentos que fazem a diferença.</p>
            </div>

            <div class="why-grid">
                <div class="why-visual">
                    <div class="why-visual-box">
                        <div class="why-metrics">
                            <div class="why-metric">
                                <div class="why-metric-val">+240%</div>
                                <div class="why-metric-label">Tráfego orgânico médio</div>
                            </div>
                            <div class="why-metric">
                                <div class="why-metric-val">-38%</div>
                                <div class="why-metric-label">Custo por lead em Ads</div>
                            </div>
                            <div class="why-metric">
                                <div class="why-metric-val">4.2×</div>
                                <div class="why-metric-label">ROAS médio Meta Ads</div>
                            </div>
                            <div class="why-metric">
                                <div class="why-metric-val">72h</div>
                                <div class="why-metric-label">Tempo de resposta máx.</div>
                            </div>
                        </div>
                        <div style="position: relative; z-index: 1; margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--navy-border); color: var(--text-muted); font-size: 0.78rem;">
                            Médias dos nossos clientes · últimos 12 meses
                        </div>
                    </div>
                </div>

                <div class="why-features">
                    <div class="why-feature reveal">
                        <div class="why-feature-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        <div class="why-feature-body">
                            <h4>Especialistas em PMEs e Automóvel</h4>
                            <p>Experiência comprovada em concessionários e pequenas e médias empresas da região do Porto, com foco em necessidades específicas de cada negócio.</p>
                        </div>
                    </div>

                    <div class="why-feature reveal">
                        <div class="why-feature-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                            </svg>
                        </div>
                        <div class="why-feature-body">
                            <h4>Estratégia baseada em dados</h4>
                            <p>Cada decisão é suportada por métricas reais. Os relatórios mensais são transparentes para que saiba sempre o retorno do investimento.</p>
                        </div>
                    </div>

                    <div class="why-feature reveal">
                        <div class="why-feature-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                        </div>
                        <div class="why-feature-body">
                            <h4>Resposta rápida, equipa dedicada</h4>
                            <p>Não é um ticket de suporte. É uma equipa que conhece o seu negócio e responde em menos de 72 horas, sempre.</p>
                        </div>
                    </div>

                    <div class="why-feature reveal">
                        <div class="why-feature-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </div>
                        <div class="why-feature-body">
                            <h4>Contratos flexíveis, sem amarras</h4>
                            <p>Acreditamos em relações baseadas em resultados. Sem contratos longos forçados, ficam porque funcionamos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="depoimentos">
        <div class="section-inner">
            <div style="text-align: center;">
                <div class="section-tag">O que dizem os nossos clientes</div>
                <h2 class="section-title" style="max-width: 500px; margin: 0 auto 12px;">Resultados que falam por si</h2>
                <p class="section-sub" style="margin: 0 auto;">PMEs e concessionários que confiaram na NexusVora para crescer no digital.</p>
            </div>

            <div class="testimonials-grid">
                <article class="testimonial-card reveal">
                    <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div></div>
                    <p class="testimonial-text">"Em 6 meses, o tráfego do nosso site triplicou e as consultas no showroom aumentaram 40%. A equipa da NexusVora percebeu exatamente o que precisávamos."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">RC</div>
                        <div>
                            <div class="author-name">Ricardo Costa</div>
                            <div class="author-role">Diretor Geral · AutoPremium Gaia</div>
                        </div>
                    </div>
                </article>

                <article class="testimonial-card reveal">
                    <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div></div>
                    <p class="testimonial-text">"O ROI das campanhas Meta superou as nossas expetativas. Pela primeira vez tenho dados concretos do que o marketing nos traz. Recomendo sem reservas."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">SP</div>
                        <div>
                            <div class="author-name">Sandra Pinto</div>
                            <div class="author-role">CEO · Clínica Estética Maia</div>
                        </div>
                    </div>
                </article>

                <article class="testimonial-card reveal">
                    <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div></div>
                    <p class="testimonial-text">"O novo site que desenvolveram converteu muito melhor que o anterior. Estamos no top 3 do Google para as nossas keywords principais. Excelente trabalho."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">MT</div>
                        <div>
                            <div class="author-name">Miguel Teixeira</div>
                            <div class="author-role">Sócio · Construtora T&amp;M Porto</div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section id="portfolio">
        <div class="section-inner">
            <div style="text-align: center;">
                <div class="section-tag">Casos de Sucesso</div>
                <h2 class="section-title" style="max-width: 560px; margin: 0 auto 12px;">Resultados reais,<br>clientes reais</h2>
                <p class="section-sub" style="margin: 0 auto;">PMEs e concessionários da região do Porto que confiaram na NexusVora para crescer no digital.</p>
            </div>

            <div class="portfolio-grid" style="margin-top: 56px;">
                <article class="portfolio-card reveal">
                    <div class="portfolio-thumb" style="background: linear-gradient(135deg, #0A0F2E, #0D1535);">
                        <svg width="100%" height="100%" viewBox="0 0 400 180" preserveAspectRatio="xMidYMid slice">
                            <defs>
                                <pattern id="stripe1" patternUnits="userSpaceOnUse" width="20" height="20" patternTransform="rotate(45)">
                                    <rect width="20" height="20" fill="#0A0F2E"/>
                                    <rect width="10" height="20" fill="rgba(74,108,247,0.07)"/>
                                </pattern>
                            </defs>
                            <rect width="400" height="180" fill="url(#stripe1)"/>
                            <g transform="translate(140,55)">
                                <rect x="15" y="30" width="90" height="35" rx="6" fill="none" stroke="rgba(74,108,247,0.4)" stroke-width="1.5"/>
                                <path d="M25,30 L35,10 L85,10 L95,30" fill="none" stroke="rgba(74,108,247,0.4)" stroke-width="1.5"/>
                                <circle cx="35" cy="67" r="9" fill="none" stroke="rgba(74,108,247,0.4)" stroke-width="1.5"/>
                                <circle cx="85" cy="67" r="9" fill="none" stroke="rgba(74,108,247,0.4)" stroke-width="1.5"/>
                                <line x1="0" y1="65" x2="120" y2="65" stroke="rgba(74,108,247,0.2)" stroke-width="1"/>
                            </g>
                            <text x="200" y="148" text-anchor="middle" fill="rgba(255,255,255,0.18)" font-family="monospace" font-size="10">website · seo · google ads</text>
                        </svg>
                        <div class="portfolio-thumb-label">AutoPremium Gaia</div>
                    </div>
                    <div class="portfolio-body">
                        <span class="portfolio-tag" style="background: rgba(0, 212, 255, 0.1); color: #00D4FF; border: 1px solid rgba(0, 212, 255, 0.2);">Concessionário</span>
                        <h3>AutoPremium Gaia</h3>
                        <p>Redesign completo do site, estratégia SEO e campanhas Google Ads focadas em test drives e vendas de usados premium.</p>
                        <div class="portfolio-results">
                            <div class="portfolio-result-item">
                                <div class="portfolio-result-val">+247%</div>
                                <div class="portfolio-result-label">Tráfego orgânico</div>
                            </div>
                            <div class="portfolio-result-item">
                                <div class="portfolio-result-val">+40%</div>
                                <div class="portfolio-result-label">Consultas showroom</div>
                            </div>
                            <div class="portfolio-result-item">
                                <div class="portfolio-result-val">3.2×</div>
                                <div class="portfolio-result-label">ROAS Google</div>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="portfolio-card reveal">
                    <div class="portfolio-thumb" style="background: linear-gradient(135deg, #0A0F2E, #130D2E);">
                        <svg width="100%" height="100%" viewBox="0 0 400 180" preserveAspectRatio="xMidYMid slice">
                            <defs>
                                <pattern id="stripe2" patternUnits="userSpaceOnUse" width="20" height="20" patternTransform="rotate(45)">
                                    <rect width="20" height="20" fill="#0A0F2E"/>
                                    <rect width="10" height="20" fill="rgba(139,63,219,0.07)"/>
                                </pattern>
                            </defs>
                            <rect width="400" height="180" fill="url(#stripe2)"/>
                            <g transform="translate(165,40)">
                                <rect x="25" y="0" width="20" height="70" rx="4" fill="none" stroke="rgba(139,63,219,0.45)" stroke-width="1.5"/>
                                <rect x="0" y="25" width="70" height="20" rx="4" fill="none" stroke="rgba(139,63,219,0.45)" stroke-width="1.5"/>
                                <circle cx="35" cy="35" r="30" fill="none" stroke="rgba(139,63,219,0.18)" stroke-width="1" stroke-dasharray="4 3"/>
                            </g>
                            <text x="200" y="148" text-anchor="middle" fill="rgba(255,255,255,0.18)" font-family="monospace" font-size="10">meta ads · instagram · landing page</text>
                        </svg>
                        <div class="portfolio-thumb-label">Clínica Estética Maia</div>
                    </div>
                    <div class="portfolio-body">
                        <span class="portfolio-tag" style="background: rgba(139, 63, 219, 0.1); color: #A970FF; border: 1px solid rgba(139, 63, 219, 0.2);">Saúde &amp; Estética</span>
                        <h3>Clínica Estética Maia</h3>
                        <p>Estratégia Meta Ads com criativos de alto impacto, gestão de Instagram e landing page optimizada para marcações online.</p>
                        <div class="portfolio-results">
                            <div class="portfolio-result-item">
                                <div class="portfolio-result-val">4.2×</div>
                                <div class="portfolio-result-label">ROAS Meta Ads</div>
                            </div>
                            <div class="portfolio-result-item">
                                <div class="portfolio-result-val">-38%</div>
                                <div class="portfolio-result-label">Custo por lead</div>
                            </div>
                            <div class="portfolio-result-item">
                                <div class="portfolio-result-val">+180%</div>
                                <div class="portfolio-result-label">Marcações online</div>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="portfolio-card reveal">
                    <div class="portfolio-thumb" style="background: linear-gradient(135deg, #0A0F2E, #0D1A20);">
                        <svg width="100%" height="100%" viewBox="0 0 400 180" preserveAspectRatio="xMidYMid slice">
                            <defs>
                                <pattern id="stripe3" patternUnits="userSpaceOnUse" width="20" height="20" patternTransform="rotate(45)">
                                    <rect width="20" height="20" fill="#0A0F2E"/>
                                    <rect width="10" height="20" fill="rgba(0,212,255,0.07)"/>
                                </pattern>
                            </defs>
                            <rect width="400" height="180" fill="url(#stripe3)"/>
                            <g transform="translate(145,30)">
                                <rect x="30" y="20" width="50" height="65" fill="none" stroke="rgba(0,212,255,0.4)" stroke-width="1.5"/>
                                <rect x="0" y="40" width="30" height="45" fill="none" stroke="rgba(0,212,255,0.3)" stroke-width="1.5"/>
                                <rect x="80" y="35" width="30" height="50" fill="none" stroke="rgba(0,212,255,0.3)" stroke-width="1.5"/>
                                <line x1="0" y1="85" x2="110" y2="85" stroke="rgba(0,212,255,0.2)" stroke-width="1.5"/>
                                <rect x="42" y="50" width="10" height="10" fill="rgba(0,212,255,0.2)" rx="1"/>
                                <rect x="58" y="50" width="10" height="10" fill="rgba(0,212,255,0.2)" rx="1"/>
                                <rect x="42" y="65" width="10" height="10" fill="rgba(0,212,255,0.2)" rx="1"/>
                                <rect x="58" y="65" width="10" height="10" fill="rgba(0,212,255,0.2)" rx="1"/>
                            </g>
                            <text x="200" y="148" text-anchor="middle" fill="rgba(255,255,255,0.18)" font-family="monospace" font-size="10">seo · google ads · web</text>
                        </svg>
                        <div class="portfolio-thumb-label">Construtora T&amp;M Porto</div>
                    </div>
                    <div class="portfolio-body">
                        <span class="portfolio-tag" style="background: rgba(0, 212, 255, 0.1); color: #00D4FF; border: 1px solid rgba(0, 212, 255, 0.2);">Construção Civil</span>
                        <h3>Construtora T&amp;M Porto</h3>
                        <p>Novo site orientado a conversão, SEO local para keywords de construção no Porto e campanhas Google Ads para geração de orçamentos.</p>
                        <div class="portfolio-results">
                            <div class="portfolio-result-item">
                                <div class="portfolio-result-val">Top 3</div>
                                <div class="portfolio-result-label">Google keywords</div>
                            </div>
                            <div class="portfolio-result-item">
                                <div class="portfolio-result-val">+310%</div>
                                <div class="portfolio-result-label">Pedidos orçamento</div>
                            </div>
                            <div class="portfolio-result-item">
                                <div class="portfolio-result-val">2.9×</div>
                                <div class="portfolio-result-label">ROI campanha</div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <div style="margin-top: 40px; text-align: center;">
                <a href="#cta-final" class="btn-ghost btn-ghost--project"><span>Ver todos os casos de sucesso</span></a>
            </div>
        </div>
    </section>

    <section id="cta-final">
        <div class="section-inner">
            <div class="cta-box">
                <h2>Pronto para crescer no digital?</h2>
                <p>Fale connosco hoje. Uma conversa sem compromisso pode ser o início de uma grande transformação para o seu negócio.</p>
                <div class="cta-actions">
                    <a href="mailto:geral@nexusvora.pt" class="btn-primary">
                        Pedir proposta gratuita
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="tel:+351220000000" class="btn-ghost">Ligar agora</a>
                </div>
            </div>
        </div>
    </section>

    @include('partials.site-footer')

    <script>
        const navElement = document.querySelector("nav");
        const revealElements = document.querySelectorAll(".reveal");
        const heroCanvas = document.getElementById("hero-canvas");

        if (heroCanvas) {
            const ctx = heroCanvas.getContext("2d");
            let particles = [];
            const COUNT = 110;
            const CONNECT_DIST = 140;
            const SPEED = 0.28;

            const heroWidth = () => heroCanvas.offsetWidth;
            const heroHeight = () => heroCanvas.offsetHeight;

            function resizeHeroCanvas() {
                const ratio = window.devicePixelRatio || 1;
                const width = heroWidth();
                const height = heroHeight();

                heroCanvas.width = Math.round(width * ratio);
                heroCanvas.height = Math.round(height * ratio);
                ctx.setTransform(ratio, 0, 0, ratio, 0, 0);
            }

            function initHeroParticles() {
                particles = [];

                for (let i = 0; i < COUNT; i++) {
                    particles.push({
                        x: Math.random() * heroWidth(),
                        y: Math.random() * heroHeight(),
                        vx: (Math.random() - 0.5) * SPEED,
                        vy: (Math.random() - 0.5) * SPEED,
                        r: Math.random() * 2.4 + 1,
                        alpha: Math.random() * 0.5 + 0.5,
                        pulse: Math.random() * Math.PI * 2,
                        pulseSpeed: Math.random() * 0.03 + 0.008,
                        hue: Math.random() < 0.5 ? 190 + Math.random() * 20 : 250 + Math.random() * 30,
                    });
                }
            }

            function drawHeroCanvas() {
                const width = heroWidth();
                const height = heroHeight();

                ctx.clearRect(0, 0, width, height);

                const bg = ctx.createRadialGradient(width * 0.35, height * 0.55, 0, width * 0.5, height * 0.5, width * 0.9);
                bg.addColorStop(0, "#071530");
                bg.addColorStop(0.5, "#040d1e");
                bg.addColorStop(1, "#020810");
                ctx.fillStyle = bg;
                ctx.fillRect(0, 0, width, height);

                const glow = ctx.createRadialGradient(width * 0.15, height * 0.75, 0, width * 0.15, height * 0.75, width * 0.4);
                glow.addColorStop(0, "rgba(0, 100, 140, 0.18)");
                glow.addColorStop(1, "rgba(0, 0, 0, 0)");
                ctx.fillStyle = glow;
                ctx.fillRect(0, 0, width, height);

                for (let i = 0; i < particles.length; i++) {
                    const p = particles[i];

                    for (let j = i + 1; j < particles.length; j++) {
                        const q = particles[j];
                        const dx = p.x - q.x;
                        const dy = p.y - q.y;
                        const dist = Math.sqrt(dx * dx + dy * dy);

                        if (dist < CONNECT_DIST) {
                            const fade = 1 - dist / CONNECT_DIST;
                            ctx.beginPath();
                            ctx.moveTo(p.x, p.y);
                            ctx.lineTo(q.x, q.y);
                            ctx.strokeStyle = `rgba(160, 180, 255, ${fade * 0.22})`;
                            ctx.lineWidth = fade * 0.9;
                            ctx.stroke();
                        }
                    }
                }

                for (let i = 0; i < particles.length; i++) {
                    const p = particles[i];
                    p.pulse += p.pulseSpeed;
                    const radius = p.r * (1 + 0.25 * Math.sin(p.pulse));
                    const alpha = p.alpha * (0.75 + 0.25 * Math.sin(p.pulse));

                    p.x += p.vx;
                    p.y += p.vy;

                    if (p.x < 0) p.x = width;
                    if (p.x > width) p.x = 0;
                    if (p.y < 0) p.y = height;
                    if (p.y > height) p.y = 0;

                    const particleGlow = ctx.createRadialGradient(p.x, p.y, 0, p.x, p.y, radius * 5);
                    particleGlow.addColorStop(0, `hsla(${p.hue}, 90%, 75%, ${alpha * 0.6})`);
                    particleGlow.addColorStop(0.4, `hsla(${p.hue}, 80%, 60%, ${alpha * 0.2})`);
                    particleGlow.addColorStop(1, `hsla(${p.hue}, 80%, 50%, 0)`);
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, radius * 5, 0, Math.PI * 2);
                    ctx.fillStyle = particleGlow;
                    ctx.fill();

                    ctx.beginPath();
                    ctx.arc(p.x, p.y, radius * 0.8, 0, Math.PI * 2);
                    ctx.fillStyle = `hsla(${p.hue + 20}, 100%, 88%, ${alpha})`;
                    ctx.fill();
                }

                window.requestAnimationFrame(drawHeroCanvas);
            }

            resizeHeroCanvas();
            initHeroParticles();
            drawHeroCanvas();

            window.addEventListener("resize", () => {
                resizeHeroCanvas();
                initHeroParticles();
            });
        }

        window.addEventListener("scroll", () => {
            navElement.style.background = window.scrollY > 50
                ? "rgba(10, 15, 46, 0.96)"
                : "rgba(10, 15, 46, 0.85)";
        });

        if ("IntersectionObserver" in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("is-visible");
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12 });

            revealElements.forEach((element) => observer.observe(element));
        } else {
            revealElements.forEach((element) => element.classList.add("is-visible"));
        }

    </script>
</body>
</html>
