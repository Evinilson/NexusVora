<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.site-head')
    <title>{{ $service['seo']['title'] }}</title>
    <style>
        *, *::before, *::after { box-sizing:border-box; }
        :root { --cyan:#00D4FF; --blue:#4A6CF7; --purple:#8B3FDB; --gold:#F5A623; --green:#2DE2A6; --navy:#0A0F2E; --navy2:#060B20; --card:#111936; --navy-card:#111936; --border:rgba(255,255,255,.08); --navy-border:rgba(255,255,255,.07); --text:#E8EAF6; --text-muted:#8892B0; --muted:#98A3C2; --grad:linear-gradient(135deg,#00D4FF,#4A6CF7,#8B3FDB); }
        body { margin:0; background:var(--navy2); color:var(--text); font-family:'Inter',sans-serif; overflow-x:hidden; }
        h1,h2,h3 { font-family:'Plus Jakarta Sans',sans-serif; }
        .service-page { --accent:var(--cyan); --accent-rgb:0,212,255; --accent-2:var(--blue); }
        .service-page[data-accent="blue"] { --accent:#7C9CFF; --accent-rgb:74,108,247; --accent-2:var(--purple); }
        .service-page[data-accent="purple"] { --accent:#B08CFF; --accent-rgb:139,63,219; --accent-2:var(--cyan); }
        .service-page[data-accent="gold"] { --accent:var(--gold); --accent-rgb:245,166,35; --accent-2:#FF6B35; }
        .service-page[data-accent="green"] { --accent:var(--green); --accent-rgb:45,226,166; --accent-2:var(--cyan); }
        .hero { position:relative; overflow:hidden; padding:154px 5vw 90px; isolation:isolate; }
        .hero::before { content:''; position:absolute; z-index:-2; inset:0; background:radial-gradient(circle at 78% 10%, rgba(var(--accent-rgb),.17), transparent 30%), radial-gradient(circle at 20% 25%, rgba(74,108,247,.12), transparent 34%); }
        .hero::after { content:''; position:absolute; z-index:-1; inset:0; opacity:.55; background-image:radial-gradient(rgba(255,255,255,.11) 1px,transparent 1px); background-size:35px 35px; mask-image:radial-gradient(ellipse 75% 70% at 50% 30%,#000,transparent); }
        .hero-inner,.content-inner,.cta-inner { max-width:1100px; margin:0 auto; }
        .breadcrumbs { display:flex; gap:9px; align-items:center; color:var(--muted); font-size:.78rem; margin-bottom:28px; }
        .breadcrumbs a { color:var(--muted); text-decoration:none; }
        .breadcrumbs a:hover { color:#fff; }
        .eyebrow { display:inline-flex; align-items:center; gap:8px; margin-bottom:16px; color:var(--accent); font-size:.72rem; font-weight:800; letter-spacing:.12em; text-transform:uppercase; }
        .eyebrow::before { content:''; width:22px; height:1px; background:currentColor; }
        .hero-grid { display:grid; grid-template-columns:minmax(0,1.2fr) minmax(280px,.8fr); gap:70px; align-items:end; }
        h1 { max-width:730px; margin:0 0 22px; font-size:clamp(2.2rem,4.2vw,4.2rem); line-height:1.06; letter-spacing:-.045em; color:#fff; }
        .hero-lead { max-width:700px; color:#C0C8E0; font-size:clamp(1.02rem,1.5vw,1.16rem); line-height:1.75; }
        .hero-card { padding:28px; border:1px solid rgba(var(--accent-rgb),.25); border-radius:20px; background:linear-gradient(145deg,rgba(17,25,54,.94),rgba(10,15,46,.72)); box-shadow:0 24px 65px rgba(0,0,0,.24), inset 0 1px 0 rgba(255,255,255,.06); }
        .hero-card-label { display:block; margin-bottom:14px; color:var(--accent); font-size:.7rem; font-weight:800; letter-spacing:.1em; text-transform:uppercase; }
        .hero-card p { margin:0; color:var(--muted); font-size:.9rem; line-height:1.7; }
        .hero-card strong { color:#fff; }
        .hero-actions { display:flex; gap:12px; flex-wrap:wrap; margin-top:33px; }
        .service-page .btn { display:inline-flex; align-items:center; gap:9px; border-radius:10px; padding:14px 21px; font-family:'Plus Jakarta Sans',sans-serif; font-size:.9rem; font-weight:800; text-decoration:none; transition:transform .22s ease,box-shadow .22s ease,border-color .22s ease; }
        .service-page .btn-primary { color:#fff; background:linear-gradient(135deg,var(--accent),var(--accent-2)); box-shadow:0 12px 30px rgba(var(--accent-rgb),.22); }
        .service-page .btn-primary:hover { transform:translateY(-2px); box-shadow:0 18px 36px rgba(var(--accent-rgb),.35); }
        .service-page .btn-ghost { color:var(--text); border:1px solid var(--border); }
        .service-page .btn-ghost:hover { border-color:rgba(255,255,255,.28); background:rgba(255,255,255,.04); }
        .content { padding:82px 5vw; background:linear-gradient(180deg,var(--navy),var(--navy2)); }
        .content-grid { display:grid; grid-template-columns:minmax(0,1.1fr) minmax(270px,.75fr); gap:64px; }
        .section-label { color:var(--accent); font-size:.72rem; font-weight:800; letter-spacing:.12em; text-transform:uppercase; }
        h2 { margin:12px 0 18px; color:#fff; font-size:clamp(1.65rem,2.6vw,2.5rem); line-height:1.14; letter-spacing:-.03em; }
        .intro { margin:0 0 34px; color:var(--muted); font-size:1rem; line-height:1.8; }
        .feature-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:13px; }
        .feature { min-height:190px; padding:21px; border:1px solid var(--border); border-radius:15px; background:rgba(255,255,255,.025); transition:transform .25s ease,border-color .25s ease,background .25s ease; }
        .feature:hover { transform:translateY(-5px); border-color:rgba(var(--accent-rgb),.3); background:rgba(var(--accent-rgb),.055); }
        .feature-index { display:flex; align-items:center; justify-content:center; width:28px; height:28px; margin-bottom:27px; border:1px solid rgba(var(--accent-rgb),.28); border-radius:8px; background:rgba(var(--accent-rgb),.1); color:var(--accent); font-size:.72rem; font-weight:800; }
        .feature h3 { margin:0 0 8px; color:#fff; font-size:.93rem; }
        .feature p { margin:0; color:var(--muted); font-size:.8rem; line-height:1.63; }
        .side-card { position:sticky; top:105px; padding:30px; border:1px solid rgba(var(--accent-rgb),.22); border-radius:18px; background:var(--card); overflow:hidden; }
        .side-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:linear-gradient(90deg,var(--accent),var(--accent-2)); }
        .side-card h3 { margin:0 0 17px; color:#fff; font-size:1.04rem; }
        .fit-list { display:grid; gap:0; margin:0; padding:0; list-style:none; }
        .fit-list li { display:flex; gap:10px; padding:13px 0; border-bottom:1px solid rgba(255,255,255,.06); color:#C8D0E5; font-size:.86rem; line-height:1.5; }
        .fit-list li:last-child { border-bottom:0; }
        .fit-list li::before { content:'✓'; color:var(--accent); font-weight:900; }
        .depth-section { padding:90px 5vw; background:var(--navy); }
        .depth-section--alt { background:var(--navy2); }
        .depth-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; }
        .depth-card { padding:24px; border:1px solid var(--border); border-radius:16px; background:rgba(255,255,255,.025); }
        .depth-card h3 { margin:0 0 9px; color:#fff; font-size:.98rem; }
        .depth-card p { margin:0; color:var(--muted); font-size:.86rem; line-height:1.65; }
        .deliverable-layout { display:grid; grid-template-columns:minmax(0,1fr) minmax(260px,.7fr); gap:48px; align-items:start; }
        .deliverable-list { display:grid; gap:0; margin:0; padding:0; list-style:none; border-top:1px solid var(--border); }
        .deliverable-list li { display:flex; gap:12px; padding:15px 0; border-bottom:1px solid var(--border); color:#C8D0E5; font-size:.9rem; line-height:1.55; }
        .deliverable-list li::before { content:'✓'; display:grid; width:22px; height:22px; flex:0 0 22px; place-items:center; border:1px solid rgba(var(--accent-rgb),.3); border-radius:7px; background:rgba(var(--accent-rgb),.1); color:var(--accent); font-size:.75rem; font-weight:900; }
        .deliverable-note { padding:25px; border-left:2px solid var(--accent); border-radius:0 14px 14px 0; background:rgba(var(--accent-rgb),.07); color:var(--muted); font-size:.9rem; line-height:1.7; }
        .deliverable-note strong { display:block; margin-bottom:7px; color:#fff; font-family:'Plus Jakarta Sans',sans-serif; }
        .process { padding:90px 5vw; background:var(--navy); }
        .process-card { display:grid; grid-template-columns:repeat(4,1fr); overflow:hidden; border:1px solid var(--border); border-radius:19px; background:rgba(255,255,255,.025); }
        .process-step { min-height:185px; padding:27px 24px; border-right:1px solid var(--border); }
        .process-step:last-child { border-right:0; }
        .step-number { display:block; margin-bottom:32px; color:var(--accent); font-size:.75rem; font-weight:800; letter-spacing:.1em; }
        .process-step h3 { margin:0 0 8px; color:#fff; font-size:.95rem; }
        .process-step p { margin:0; color:var(--muted); font-size:.82rem; line-height:1.6; }
        .faq-list { display:grid; gap:11px; }
        .faq-item { border:1px solid var(--border); border-radius:13px; background:rgba(255,255,255,.025); }
        .faq-item summary { display:flex; cursor:pointer; align-items:center; justify-content:space-between; gap:18px; padding:19px 21px; color:#fff; font-family:'Plus Jakarta Sans',sans-serif; font-size:.92rem; font-weight:700; list-style:none; }
        .faq-item summary::-webkit-details-marker { display:none; }
        .faq-item summary::after { content:'+'; color:var(--accent); font-size:1.3rem; font-weight:400; }
        .faq-item[open] summary::after { content:'−'; }
        .faq-item p { max-width:830px; margin:0; padding:0 21px 20px; color:var(--muted); font-size:.9rem; line-height:1.7; }
        .cta { padding:90px 5vw 100px; background:var(--navy2); }
        .cta-inner { position:relative; padding:64px 48px; overflow:hidden; border:1px solid rgba(var(--accent-rgb),.25); border-radius:24px; text-align:center; background:linear-gradient(135deg,rgba(var(--accent-rgb),.12),rgba(139,63,219,.1)); }
        .cta-inner::before { content:''; position:absolute; top:-120px; left:50%; width:520px; height:260px; transform:translateX(-50%); background:radial-gradient(circle,rgba(var(--accent-rgb),.23),transparent 69%); }
        .cta h2,.cta p,.cta .hero-actions { position:relative; z-index:1; }
        .cta h2 { margin-bottom:12px; }
        .cta p { max-width:600px; margin:0 auto; color:var(--muted); line-height:1.7; }
        .cta .hero-actions { justify-content:center; }
        .reveal { opacity:0; transform:translateY(22px); transition:opacity .6s ease,transform .6s ease; }
        .reveal.visible { opacity:1; transform:translateY(0); }
        @media (max-width:900px) { .hero-grid,.content-grid,.deliverable-layout { grid-template-columns:1fr; gap:35px; } .hero { padding-top:125px; } .feature-grid,.depth-grid { grid-template-columns:1fr; } .side-card { position:relative; top:auto; } .process-card { grid-template-columns:1fr 1fr; } .process-step:nth-child(2) { border-right:0; } .process-step:nth-child(-n+2) { border-bottom:1px solid var(--border); } }
        @media (max-width:600px) { .hero { padding:112px 6vw 65px; } .content,.process,.depth-section { padding-left:6vw; padding-right:6vw; } .process-card { grid-template-columns:1fr; } .process-step,.process-step:nth-child(2) { border-right:0; border-bottom:1px solid var(--border); } .process-step:last-child { border-bottom:0; } .cta { padding:0 6vw 75px; } .cta-inner { padding:47px 24px; } .service-page .btn { width:100%; justify-content:center; } }
    </style>
</head>
<body>
@include('partials.site-header')

<main class="service-page" data-accent="{{ $service['accent'] }}">
    <section class="hero">
        <div class="hero-inner">
            <nav class="breadcrumbs" aria-label="Navegação estrutural"><a href="{{ route('home') }}">Início</a><span>/</span><a href="{{ route('services') }}">Serviços</a><span>/</span><span>{{ $service['eyebrow'] }}</span></nav>
            <div class="hero-grid">
                <div class="reveal">
                    <div class="eyebrow">{{ $service['eyebrow'] }}</div>
                    <h1>{{ $service['title'] }}</h1>
                    <p class="hero-lead">{{ $service['lead'] }}</p>
                    <div class="hero-actions"><a href="{{ route('contacto') }}" class="btn btn-primary">Pedir diagnóstico <span aria-hidden="true">→</span></a><a href="#como-ajudamos" class="btn btn-ghost">Ver como ajudamos</a></div>
                </div>
                <aside class="hero-card reveal"><span class="hero-card-label">O objetivo</span><p><strong>Uma solução útil para o negócio</strong><br>Não vendemos tecnologia isolada. Definimos o que vale a pena resolver e construímos um caminho claro para o fazer.</p></aside>
            </div>
        </div>
    </section>

    <section class="content" id="como-ajudamos">
        <div class="content-inner content-grid">
            <div class="reveal"><div class="section-label">Como ajudamos</div><h2>Uma solução pensada para funcionar no dia a dia.</h2><p class="intro">{{ $service['intro'] }}</p><div class="feature-grid">@foreach ($service['features'] as $index => $feature)<article class="feature"><span class="feature-index">0{{ $index + 1 }}</span><h3>{{ $feature['title'] }}</h3><p>{{ $feature['text'] }}</p></article>@endforeach</div></div>
            <aside class="side-card reveal"><h3>Este serviço é para si se…</h3><ul class="fit-list">@foreach ($service['for'] as $item)<li>{{ $item }}</li>@endforeach</ul></aside>
        </div>
    </section>

    @if(isset($service['problems']))
    <section class="depth-section"><div class="content-inner"><div class="section-label reveal">Problemas que resolvemos</div><h2 class="reveal">Onde a tecnologia pode fazer uma diferença real.</h2><div class="depth-grid reveal">@foreach ($service['problems'] as $problem)<article class="depth-card"><h3>{{ $problem['title'] }}</h3><p>{{ $problem['text'] }}</p></article>@endforeach</div></div></section>
    <section class="depth-section depth-section--alt"><div class="content-inner deliverable-layout"><div class="reveal"><div class="section-label">O que pode incluir</div><h2>O essencial para avançar com clareza.</h2><ul class="deliverable-list">@foreach ($service['deliverables'] as $deliverable)<li>{{ $deliverable }}</li>@endforeach</ul></div><aside class="deliverable-note reveal"><strong>Âmbito definido antes de começar</strong>Cada projeto é ajustado ao contexto da empresa. Antes de avançar, alinhamos o problema, as prioridades, os entregáveis e o investimento para evitar surpresas.</aside></div></section>
    @endif

    @php
        $processSteps = $service['process'] ?? [
            ['step' => '01. Diagnóstico', 'title' => 'Percebemos o contexto', 'text' => 'Analisamos o objetivo, o processo atual e o impacto que a solução deve criar.'],
            ['step' => '02. Plano', 'title' => 'Definimos prioridades', 'text' => 'Organizamos o trabalho por etapas, com foco no que gera mais valor primeiro.'],
            ['step' => '03. Execução', 'title' => 'Construímos com clareza', 'text' => 'Desenvolvemos, testamos e mantemos a comunicação simples em cada decisão importante.'],
            ['step' => '04. Evolução', 'title' => 'Acompanhamos o resultado', 'text' => 'Medimos, corrigimos e evoluímos a solução à medida que o negócio cresce.'],
        ];
    @endphp
    <section class="process"><div class="content-inner"><div class="section-label reveal">Forma de trabalhar</div><h2 class="reveal">Do problema à solução, sem improviso.</h2><div class="process-card reveal">@foreach ($processSteps as $step)<article class="process-step"><span class="step-number">{{ $step['step'] }}</span><h3>{{ $step['title'] }}</h3><p>{{ $step['text'] }}</p></article>@endforeach</div></div></section>

    @if(isset($service['faqs']))
    <section class="depth-section depth-section--alt"><div class="content-inner"><div class="section-label reveal">Perguntas frequentes</div><h2 class="reveal">Antes de avançar, é normal ter dúvidas.</h2><div class="faq-list reveal">@foreach ($service['faqs'] as $faq)<details class="faq-item"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>@endforeach</div></div></section>
    @endif

    <section class="cta"><div class="cta-inner reveal"><div class="section-label">Próximo passo</div><h2>Vamos perceber o que faz mais sentido para a sua empresa.</h2><p>Partilhe o desafio. Respondemos com clareza sobre o que vale a pena fazer, por onde começar e como avançar.</p><div class="hero-actions"><a href="{{ route('contacto') }}" class="btn btn-primary">Falar sobre o projeto <span aria-hidden="true">→</span></a><a href="{{ route('services') }}" class="btn btn-ghost">Ver todos os serviços</a></div></div></section>
</main>

@include('partials.site-footer')
<script>const observer=new IntersectionObserver(entries=>entries.forEach(entry=>{if(entry.isIntersecting)entry.target.classList.add('visible')}),{threshold:.12});document.querySelectorAll('.reveal').forEach(element=>observer.observe(element));</script>
</body>
</html>
