<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('partials.site-head')
  <title>Contacto - NexusVora</title>

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
      min-height: 100vh;
    }

    h1,h2,h3,h4,h5 { font-family: 'Plus Jakarta Sans', sans-serif; line-height: 1.15; }
    a { color: inherit; }

    .page-header {
      padding: 140px 5vw 80px;
      background: var(--navy2);
      position: relative;
      overflow: hidden;
    }

    .page-header::before {
      content: '';
      position: absolute;
      top: -100px;
      right: -50px;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, rgba(74,108,247,0.13) 0%, transparent 70%);
    }

    .page-header-inner {
      max-width: 1100px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }

    .section-tag {
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--cyan);
      margin-bottom: 14px;
    }

    .page-header h1 {
      font-size: clamp(2rem, 4vw, 3.2rem);
      font-weight: 800;
      color: #fff;
      letter-spacing: -0.03em;
      margin-bottom: 16px;
    }

    .grad-text {
      background: var(--grad);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .page-header p {
      font-size: 1.05rem;
      color: var(--text-muted);
      line-height: 1.7;
      max-width: 560px;
      text-wrap: pretty;
    }

    .contact-main {
      padding: 0 5vw 100px;
      background: var(--navy2);
    }

    .contact-inner {
      max-width: 1100px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1.4fr;
      gap: 48px;
      align-items: start;
    }

    .contact-info { display: flex; flex-direction: column; gap: 20px; }

    .info-card,
    .form-card,
    .map-card {
      background: var(--navy-card);
      border: 1px solid var(--navy-border);
      border-radius: 16px;
    }

    .info-card { padding: 28px; }
    .form-card { border-radius: 20px; padding: 40px; }
    .map-card { overflow: hidden; }

    .info-card-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.78rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--text-muted);
      margin-bottom: 20px;
    }

    .info-item {
      display: flex;
      gap: 14px;
      align-items: flex-start;
      margin-bottom: 18px;
    }

    .info-item:last-child { margin-bottom: 0; }

    .info-icon {
      width: 40px;
      height: 40px;
      flex-shrink: 0;
      border-radius: 10px;
      background: rgba(74,108,247,0.1);
      border: 1px solid rgba(74,108,247,0.2);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .info-label { font-size: 0.72rem; color: var(--text-muted); margin-bottom: 3px; }
    .info-value { font-size: 0.92rem; color: #fff; font-weight: 500; line-height: 1.5; }
    .info-value a { color: var(--cyan); text-decoration: none; }
    .info-value a:hover { text-decoration: underline; }

    .hours-grid { display: flex; flex-direction: column; gap: 8px; }
    .hours-row { display: flex; justify-content: space-between; align-items: center; font-size: 0.85rem; gap: 16px; }
    .hours-day { color: var(--text-muted); }
    .hours-time { color: #fff; font-weight: 500; }
    .hours-closed { color: #B8C0D9; font-weight: 600; }

    .map-placeholder {
      height: 200px;
      background: #0C1228;
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .map-placeholder > svg {
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
    }

    .map-pin {
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 4px;
    }

    .map-pin-icon {
      width: 40px;
      height: 40px;
      border-radius: 50% 50% 50% 0;
      transform: rotate(-45deg);
      background: var(--grad);
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 24px rgba(74,108,247,0.4);
    }

    .map-pin-icon svg { transform: rotate(45deg); }

    .map-pin-label {
      background: rgba(17,25,54,0.95);
      border: 1px solid var(--navy-border);
      border-radius: 8px;
      padding: 6px 12px;
      font-size: 0.75rem;
      color: #fff;
      font-weight: 600;
      white-space: nowrap;
    }

    .map-footer {
      padding: 14px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 16px;
    }

    .map-footer span { font-size: 0.8rem; color: var(--text-muted); }
    .map-footer a {
      font-size: 0.8rem;
      color: var(--cyan);
      font-weight: 600;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 4px;
      transition: gap .2s;
      white-space: nowrap;
    }

    .map-footer a:hover { gap: 8px; }

    .social-links { display: flex; gap: 10px; flex-wrap: wrap; }
    .social-link {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 14px;
      background: rgba(255,255,255,0.04);
      border: 1px solid var(--navy-border);
      border-radius: 8px;
      text-decoration: none;
      font-size: 0.82rem;
      color: var(--text-muted);
      font-weight: 500;
      transition: border-color .2s, color .2s, background .2s;
    }

    .social-link:hover {
      border-color: rgba(74,108,247,0.35);
      color: #fff;
      background: rgba(74,108,247,0.08);
    }

    .form-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 1.4rem;
      font-weight: 800;
      color: #fff;
      margin-bottom: 6px;
    }

    .form-subtitle { font-size: 0.88rem; color: var(--text-muted); margin-bottom: 32px; }
    .selected-plan-note {
      display: none;
      align-items: flex-start;
      gap: 10px;
      background: rgba(0,212,255,0.06);
      border: 1px solid rgba(0,212,255,0.18);
      border-radius: 12px;
      padding: 14px 16px;
      margin-bottom: 24px;
      color: var(--text-muted);
      font-size: 0.86rem;
      line-height: 1.55;
    }
    .selected-plan-note.show { display: flex; }
    .selected-plan-note-text { flex: 1; min-width: 0; }
    .selected-plan-note strong { color: #fff; }
    .selected-plan-note svg { flex-shrink: 0; margin-top: 2px; }
    .selected-plan-remove {
      flex-shrink: 0;
      background: transparent;
      border: 1px solid rgba(255,255,255,0.14);
      border-radius: 8px;
      color: var(--text-muted);
      cursor: pointer;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.74rem;
      font-weight: 700;
      padding: 6px 10px;
      transition: border-color .2s, color .2s, background .2s;
    }
    .selected-plan-remove:hover {
      background: rgba(255,255,255,0.05);
      border-color: rgba(255,255,255,0.28);
      color: #fff;
    }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .form-group { margin-bottom: 18px; }

    .form-group label {
      display: block;
      font-size: 0.8rem;
      font-weight: 600;
      color: var(--text-muted);
      margin-bottom: 8px;
      letter-spacing: 0.03em;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      background: rgba(255,255,255,0.04);
      border: 1px solid var(--navy-border);
      border-radius: 10px;
      padding: 12px 16px;
      font-family: 'Inter', sans-serif;
      font-size: 0.9rem;
      color: #fff;
      outline: none;
      transition: border-color .2s, background .2s, box-shadow .2s;
      appearance: none;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder { color: rgba(136,146,176,0.5); }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      border-color: rgba(74,108,247,0.5);
      background: rgba(74,108,247,0.05);
      box-shadow: 0 0 0 3px rgba(74,108,247,0.12);
    }

    .form-group input.error,
    .form-group textarea.error { border-color: rgba(239,68,68,0.5); }
    .form-group textarea { resize: vertical; min-height: 120px; }
    .form-group select { cursor: pointer; color: var(--text-muted); }
    .form-group select option { background: #111936; color: #fff; }

    .form-services {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
      gap: 10px;
      margin-bottom: 24px;
    }

    .service-check {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 10px 12px;
      background: rgba(255,255,255,0.03);
      border: 1px solid var(--navy-border);
      border-radius: 8px;
      cursor: pointer;
      transition: border-color .2s, background .2s;
      font-size: 0.8rem;
      color: var(--text-muted);
      font-weight: 500;
      user-select: none;
    }

    .service-check input { display: none; }
    .service-check.selected {
      border-color: rgba(74,108,247,0.45);
      background: rgba(74,108,247,0.08);
      color: #fff;
    }

    .service-check-box {
      width: 16px;
      height: 16px;
      flex-shrink: 0;
      border: 1.5px solid var(--navy-border);
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background .2s, border-color .2s;
    }

    .service-check.selected .service-check-box {
      background: var(--blue);
      border-color: var(--blue);
    }

    .form-privacy {
      display: flex;
      gap: 10px;
      align-items: flex-start;
      margin-bottom: 24px;
      cursor: pointer;
    }

    .privacy-checkbox {
      width: 18px;
      height: 18px;
      flex-shrink: 0;
      margin-top: 2px;
      border: 1.5px solid var(--navy-border);
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background .2s, border-color .2s;
      cursor: pointer;
    }

    .privacy-checkbox.checked {
      background: var(--blue);
      border-color: var(--blue);
    }

    .form-privacy span {
      font-size: 0.8rem;
      color: var(--text-muted);
      line-height: 1.5;
    }

    .form-privacy a {
      color: #8EDBFF;
      font-weight: 700;
      text-decoration: underline;
      text-decoration-thickness: 1px;
      text-underline-offset: 3px;
    }
    .form-privacy a:hover { color: #fff; }

    .btn-submit {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      background: var(--grad);
      color: #fff;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 1rem;
      padding: 16px 32px;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      transition: opacity .2s, transform .2s, box-shadow .2s;
      box-shadow: 0 8px 32px rgba(74,108,247,0.35);
    }

    .btn-submit:hover {
      opacity: .9;
      transform: translateY(-2px);
      box-shadow: 0 12px 40px rgba(74,108,247,0.45);
    }

    .btn-submit:disabled { opacity: .5; cursor: not-allowed; transform: none; }

    .form-success {
      display: none;
      text-align: center;
      padding: 48px 24px;
    }

    .form-success.show { display: block; }

    .success-icon {
      width: 64px;
      height: 64px;
      margin: 0 auto 20px;
      background: rgba(74,208,128,0.15);
      border: 1px solid rgba(74,208,128,0.3);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .form-success h3 {
      font-size: 1.3rem;
      font-weight: 800;
      color: #fff;
      margin-bottom: 10px;
    }

    .form-success p { font-size: 0.9rem; color: var(--text-muted); line-height: 1.6; }
    .field-error { font-size: 0.72rem; color: #F87171; margin-top: 5px; display: none; }
    .field-error.show { display: block; }

    @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

    @media (max-width: 900px) {
      .contact-inner { grid-template-columns: 1fr; }
      .form-row { grid-template-columns: 1fr; }
      .form-services { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 560px) {
      .page-header { padding-top: 120px; }
      .form-card, .info-card { padding: 24px; }
      .form-services { grid-template-columns: 1fr; }
      .map-footer { align-items: flex-start; flex-direction: column; }
    }
  </style>
</head>
<body>
@include('partials.site-header')

<main>
  <section class="page-header">
    <div class="page-header-inner">
      <div class="section-tag">Contacto</div>
      <h1>Vamos <span class="grad-text">falar sobre</span><br>o seu negócio</h1>
      <p>Preencha o formulário e entraremos em contacto em menos de 24 horas úteis. Sem compromisso, sem pressão.</p>
    </div>
  </section>

  <section class="contact-main">
    <div class="contact-inner">
      <aside class="contact-info" aria-label="Informações de contacto">
        <div class="info-card">
          <div class="info-card-title">Informações de Contacto</div>

          <div class="info-item">
            <div class="info-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
              </svg>
            </div>
            <div>
              <div class="info-label">Morada</div>
              <div class="info-value">Área Metropolitana do Porto<br>Porto · Gaia · Maia</div>
            </div>
          </div>

          <div class="info-item">
            <div class="info-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.96a16 16 0 0 0 6.13 6.13l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
              </svg>
            </div>
            <div>
              <div class="info-label">Telefone</div>
              <div class="info-value"><a href="tel:+351932949284">+351 932 949 284</a></div>
            </div>
          </div>

          <div class="info-item">
            <div class="info-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4A6CF7" stroke-width="1.8" stroke-linecap="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
              </svg>
            </div>
            <div>
              <div class="info-label">Email</div>
              <div class="info-value"><a href="mailto:geral@nexusvora.com">geral@nexusvora.com</a></div>
            </div>
          </div>
        </div>

        <div class="info-card">
          <div class="info-card-title">Horário de Atendimento</div>
          <div class="hours-grid">
            <div class="hours-row"><span class="hours-day">Segunda - Sexta</span><span class="hours-time">09h00 - 18h30</span></div>
            <div class="hours-row"><span class="hours-day">Sábado</span><span class="hours-time">09h30 - 13h00</span></div>
            <div class="hours-row"><span class="hours-day">Domingo</span><span class="hours-closed">Encerrado</span></div>
          </div>
        </div>

        <div class="map-card">
          <div class="map-placeholder">
            <svg viewBox="0 0 500 200" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
              <rect width="500" height="200" fill="#0C1228"/>
              <line x1="0" y1="60" x2="500" y2="60" stroke="rgba(74,108,247,0.12)" stroke-width="6"/>
              <line x1="0" y1="120" x2="500" y2="120" stroke="rgba(74,108,247,0.12)" stroke-width="4"/>
              <line x1="0" y1="155" x2="500" y2="155" stroke="rgba(74,108,247,0.08)" stroke-width="3"/>
              <line x1="80" y1="0" x2="80" y2="200" stroke="rgba(74,108,247,0.1)" stroke-width="4"/>
              <line x1="180" y1="0" x2="180" y2="200" stroke="rgba(74,108,247,0.1)" stroke-width="6"/>
              <line x1="280" y1="0" x2="280" y2="200" stroke="rgba(74,108,247,0.08)" stroke-width="3"/>
              <line x1="380" y1="0" x2="380" y2="200" stroke="rgba(74,108,247,0.08)" stroke-width="3"/>
              <path d="M0,140 C80,135 120,145 200,138 C280,131 350,148 500,140" fill="none" stroke="rgba(0,212,255,0.2)" stroke-width="10"/>
              <path d="M0,148 C80,143 120,153 200,146 C280,139 350,156 500,148" fill="rgba(0,212,255,0.06)" stroke="none"/>
              <text x="240" y="152" fill="rgba(0,212,255,0.35)" font-size="9" font-family="monospace" text-anchor="middle">Rio Douro</text>
              <rect x="90" y="70" width="70" height="40" rx="3" fill="rgba(74,108,247,0.07)" stroke="rgba(74,108,247,0.12)" stroke-width="1"/>
              <rect x="190" y="70" width="70" height="40" rx="3" fill="rgba(74,108,247,0.07)" stroke="rgba(74,108,247,0.12)" stroke-width="1"/>
              <rect x="290" y="70" width="70" height="40" rx="3" fill="rgba(74,108,247,0.07)" stroke="rgba(74,108,247,0.12)" stroke-width="1"/>
            </svg>

            <div class="map-pin">
              <div class="map-pin-icon">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="white" stroke="none" aria-hidden="true">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                </svg>
              </div>
              <div class="map-pin-label">NexusVora · Porto</div>
            </div>
          </div>
          <div class="map-footer">
            <span>Área Metropolitana do Porto</span>
            <a href="https://maps.google.com/?q=Porto,Portugal" target="_blank" rel="noopener">
              Ver no mapa
              <svg width="12" height="12" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="#00D4FF" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
          </div>
        </div>

        <div class="info-card">
          <div class="info-card-title">Redes Sociais</div>
          <div class="social-links">
            <a href="https://www.linkedin.com" target="_blank" rel="noreferrer" class="social-link">LinkedIn</a>
            <a href="https://www.instagram.com" target="_blank" rel="noreferrer" class="social-link">Instagram</a>
            <a href="https://www.facebook.com" target="_blank" rel="noreferrer" class="social-link">Facebook</a>
          </div>
        </div>
      </aside>

      <section class="form-card" aria-labelledby="contact-form-title">
        <div id="form-view">
          <h2 class="form-title" id="contact-form-title">Pedir Diagnóstico Grátis</h2>
          <p class="form-subtitle">Conte-nos o seu projeto. Respondemos em menos de 24h úteis.</p>

          <div class="selected-plan-note" id="selected-plan-note">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
            <span class="selected-plan-note-text">Plano selecionado: <strong id="selected-plan-label"></strong></span>
            <button type="button" class="selected-plan-remove" id="selected-plan-remove">Remover</button>
          </div>

          <form id="contact-form" novalidate>
            <input type="hidden" id="f-plan" />
            <input type="hidden" id="f-category" />
            <div class="form-row">
              <div class="form-group">
                <label for="f-name">Nome *</label>
                <input type="text" id="f-name" placeholder="O seu nome" />
                <div class="field-error" id="err-name">Campo obrigatório</div>
              </div>
              <div class="form-group">
                <label for="f-company">Empresa</label>
                <input type="text" id="f-company" placeholder="Nome da empresa" />
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="f-email">Email *</label>
                <input type="email" id="f-email" placeholder="email@empresa.pt" />
                <div class="field-error" id="err-email">Email inválido</div>
              </div>
              <div class="form-group">
                <label for="f-phone">Telefone</label>
                <input type="tel" id="f-phone" placeholder="+351 9XX XXX XXX" />
              </div>
            </div>

            <div class="form-group">
              <label for="f-sector">Sector de actividade</label>
              <select id="f-sector">
                <option value="" disabled selected>Selecione o seu sector</option>
                <option>Concessionário Automóvel</option>
                <option>Clínica / Saúde & Bem-estar</option>
                <option>Construção Civil / Imobiliário</option>
                <option>Restauração & Hotelaria</option>
                <option>Comércio / Retalho</option>
                <option>Serviços B2B</option>
                <option>Outro</option>
              </select>
            </div>

            <div class="form-group">
              <label>Serviços de interesse</label>
              <div class="form-services" id="services-checks">
                <label class="service-check"><input type="checkbox" value="Web"><span class="service-check-box"></span>Website</label>
                <label class="service-check"><input type="checkbox" value="Social"><span class="service-check-box"></span>Redes Sociais</label>
                <label class="service-check"><input type="checkbox" value="Google"><span class="service-check-box"></span>Google Ads</label>
                <label class="service-check"><input type="checkbox" value="Meta"><span class="service-check-box"></span>Meta Ads</label>
                <label class="service-check"><input type="checkbox" value="SEO"><span class="service-check-box"></span>SEO</label>
                <label class="service-check"><input type="checkbox" value="AI"><span class="service-check-box"></span>NexusAI</label>
                <label class="service-check"><input type="checkbox" value="Marca"><span class="service-check-box"></span>Marca &amp; Estratégia</label>
                <label class="service-check"><input type="checkbox" value="Horas"><span class="service-check-box"></span>Pacotes de Horas</label>
                <label class="service-check"><input type="checkbox" value="360"><span class="service-check-box"></span>Estratégia 360°</label>
              </div>
            </div>

            <div class="form-group">
              <label for="f-message">Mensagem *</label>
              <textarea id="f-message" placeholder="Descreva brevemente o seu projeto, objetivos e orçamento aproximado..."></textarea>
              <div class="field-error" id="err-message">Campo obrigatório</div>
            </div>

            <div class="form-privacy" id="privacy-toggle">
              <div class="privacy-checkbox" id="privacy-box"></div>
              <span>Autorizo o tratamento dos meus dados pessoais de acordo com a <a href="{{ route('privacidade') }}">Política de Privacidade</a> da NexusVora.</span>
            </div>
            <div class="field-error" id="err-privacy" style="margin-bottom:16px;">Deve aceitar a política de privacidade</div>

            <button type="submit" class="btn-submit" id="submit-btn">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
              Enviar Mensagem
            </button>
          </form>
        </div>

        <div class="form-success" id="form-success">
          <div class="success-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#4AD080" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <h3>Mensagem enviada!</h3>
          <p>Obrigado pelo contacto. A nossa equipa irá responder em menos de 24 horas úteis.</p>
        </div>
      </section>
    </div>
  </section>
</main>

@include('partials.site-footer')

<script>
  const selectedPlanConfig = {
    'web:essencial': {
      label: 'Essencial - Desenvolvimento Web',
      services: ['Web', 'SEO', 'Marca', '360'],
      message: 'Tenho interesse no plano Essencial de Desenvolvimento Web.'
    },
    'web:profissional': {
      label: 'Profissional - Desenvolvimento Web',
      services: ['Web', 'SEO', 'Marca', '360'],
      message: 'Tenho interesse no plano Profissional de Desenvolvimento Web.'
    },
    'web:ecommerce': {
      label: 'E-commerce - Desenvolvimento Web',
      services: ['Web', 'SEO', 'Marca', '360'],
      message: 'Tenho interesse no plano E-commerce de Desenvolvimento Web.'
    },
    'marketing:starter': {
      label: 'Starter - Marketing Digital',
      services: ['Web', 'SEO', 'Marca', '360', 'Social', 'Google', 'Meta'],
      message: 'Tenho interesse no plano Starter de Marketing Digital.'
    },
    'marketing:growth': {
      label: 'Growth - Marketing Digital',
      services: ['Web', 'SEO', 'Marca', '360', 'Social', 'Google', 'Meta'],
      message: 'Tenho interesse no plano Growth de Marketing Digital.'
    },
    'marketing:full-service': {
      label: 'Full-Service - Marketing Digital',
      services: ['Web', 'SEO', 'Marca', '360', 'Social', 'Google', 'Meta', 'AI'],
      message: 'Tenho interesse no plano Full-Service de Marketing Digital.'
    },
    'horas:5h': {
      label: 'Pacote Básico 5h - Pacotes de Horas',
      services: ['Horas'],
      message: 'Tenho interesse no Pacote Básico de 5 horas.'
    },
    'horas:10h': {
      label: 'Pacote Médio 10h - Pacotes de Horas',
      services: ['Horas'],
      message: 'Tenho interesse no Pacote Médio de 10 horas.'
    },
    'horas:20h': {
      label: 'Pacote Avançado 20h+ - Pacotes de Horas',
      services: ['Horas'],
      message: 'Tenho interesse no Pacote Avançado de 20 horas ou mais.'
    }
  };

  function setServiceChecked(value, checked) {
    const input = document.querySelector(`.service-check input[value="${value}"]`);
    if (!input) return;

    input.checked = checked;
    const label = input.closest('.service-check');
    label.classList.toggle('selected', checked);
    const box = label.querySelector('.service-check-box');
    box.innerHTML = checked
      ? '<svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="white" stroke-width="1.8" stroke-linecap="round"/></svg>'
      : '';
  }

  let autoPlanMessage = '';
  let autoPlanServices = [];

  document.querySelectorAll('.service-check').forEach((label) => {
    label.addEventListener('click', (event) => {
      event.preventDefault();
      const cb = label.querySelector('input');
      setServiceChecked(cb.value, !cb.checked);
    });
  });

  const params = new URLSearchParams(window.location.search);
  const selectedCategory = params.get('categoria');
  const selectedPlan = params.get('plano');
  const selectedConfig = selectedPlanConfig[`${selectedCategory}:${selectedPlan}`];

  if (selectedConfig) {
    autoPlanServices = selectedConfig.services;
    autoPlanMessage = `Plano escolhido: ${selectedConfig.label}\n\n${selectedConfig.message}\n\nGostaria de receber mais informações sobre prazos, processo e próximos passos.`;
    document.getElementById('f-plan').value = selectedPlan;
    document.getElementById('f-category').value = selectedCategory;
    document.getElementById('selected-plan-label').textContent = selectedConfig.label;
    document.getElementById('selected-plan-note').classList.add('show');
    document.getElementById('f-message').value = autoPlanMessage;
    selectedConfig.services.forEach((service) => setServiceChecked(service, true));
  }

  document.getElementById('selected-plan-remove').addEventListener('click', () => {
    document.getElementById('f-plan').value = '';
    document.getElementById('f-category').value = '';
    document.getElementById('selected-plan-label').textContent = '';
    document.getElementById('selected-plan-note').classList.remove('show');

    autoPlanServices.forEach((service) => setServiceChecked(service, false));

    const message = document.getElementById('f-message');
    if (message.value === autoPlanMessage) {
      message.value = '';
    }

    autoPlanMessage = '';
    autoPlanServices = [];

    const cleanUrl = `${window.location.pathname}${window.location.hash || ''}`;
    window.history.replaceState({}, '', cleanUrl);
  });

  let privacyChecked = false;
  document.getElementById('privacy-toggle').addEventListener('click', () => {
    privacyChecked = !privacyChecked;
    const box = document.getElementById('privacy-box');
    box.classList.toggle('checked', privacyChecked);
    box.innerHTML = privacyChecked
      ? '<svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="white" stroke-width="1.8" stroke-linecap="round"/></svg>'
      : '';
    document.getElementById('err-privacy').classList.remove('show');
  });

  document.getElementById('contact-form').addEventListener('submit', (e) => {
    e.preventDefault();
    let valid = true;

    const name = document.getElementById('f-name');
    const email = document.getElementById('f-email');
    const message = document.getElementById('f-message');

    ['err-name', 'err-email', 'err-message', 'err-privacy'].forEach((id) => {
      document.getElementById(id).classList.remove('show');
    });
    [name, email, message].forEach((el) => el.classList.remove('error'));

    if (!name.value.trim()) {
      document.getElementById('err-name').classList.add('show');
      name.classList.add('error');
      valid = false;
    }

    const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRe.test(email.value.trim())) {
      document.getElementById('err-email').classList.add('show');
      email.classList.add('error');
      valid = false;
    }

    if (!message.value.trim()) {
      document.getElementById('err-message').classList.add('show');
      message.classList.add('error');
      valid = false;
    }

    if (!privacyChecked) {
      document.getElementById('err-privacy').classList.add('show');
      valid = false;
    }

    if (!valid) return;

    const btn = document.getElementById('submit-btn');
    btn.disabled = true;
    btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0"/></svg> A enviar...';

    const company = document.getElementById('f-company').value.trim();
    const phone = document.getElementById('f-phone').value.trim();
    const sector = document.getElementById('f-sector').value;
    const plan = document.getElementById('f-plan').value;
    const category = document.getElementById('f-category').value;
    
    const selectedServices = Array.from(document.querySelectorAll('.service-check input:checked')).map(el => el.value).join(', ');

    fetch('{{ route("contacto.submit") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            name: name.value.trim(),
            email: email.value.trim(),
            phone: phone,
            company: company,
            sector: sector,
            services: selectedServices,
            plan: plan,
            category: category,
            message: message.value.trim(),
            privacy: privacyChecked
        })
    })
    .then(response => {
        if (!response.ok) throw new Error('Network error');
        return response.json();
    })
    .then(data => {
        document.getElementById('form-view').style.display = 'none';
        document.getElementById('form-success').classList.add('show');
    })
    .catch(error => {
        console.error('Error:', error);
        btn.disabled = false;
        btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg> Tentar Novamente';
        alert('Ocorreu um erro ao enviar a mensagem. Por favor, verifique a sua ligação ou tente mais tarde.');
    });
  });
</script>
</body>
</html>
