<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.site-head')
    <title>Política de Privacidade — NexusVora</title>

    <style>
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

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--navy2);
            color: var(--text);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            line-height: 1.7;
        }
        h1,h2,h3,h4,h5 { font-family: 'Plus Jakarta Sans', sans-serif; line-height: 1.15; }

        a { color: inherit; }


        /* ── PAGE CONTENT STYLES ── */
        .page-hero {
            position: relative;
            z-index: 1;
            padding: 160px 2rem 3rem;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .page-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(139,63,219,0.1);
            border: 1px solid rgba(139,63,219,0.2);
            color: var(--purple);
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.35rem 0.85rem;
            border-radius: 100px;
            margin-bottom: 1.5rem;
        }

        .page-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--purple);
        }

        .page-hero h1 {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1rem;
            color: #fff;
        }

        .page-hero h1 span {
            background: var(--grad);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-hero p {
            color: var(--text-muted);
            font-size: 1.05rem;
            max-width: 520px;
            margin: 0 auto;
        }

        .last-updated {
            display: inline-block;
            margin-top: 1.25rem;
            font-size: 0.8rem;
            color: var(--text-muted);
            background: var(--navy-card);
            border: 1px solid var(--navy-border);
            padding: 0.3rem 0.85rem;
            border-radius: 100px;
        }

        .content-wrapper {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 2rem 6rem;
        }

        .index-card {
            background: var(--navy-card);
            border: 1px solid var(--navy-border);
            border-radius: 16px;
            padding: 1.75rem 2rem;
            margin-bottom: 2.5rem;
        }

        .index-card h3 {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 1rem;
        }

        .index-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.4rem 1.5rem;
            list-style: none;
        }

        .index-list a {
            color: var(--cyan);
            text-decoration: none;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            transition: color 0.2s;
        }

        .index-list a:hover { color: var(--blue); }
        .index-list a::before { content: '→'; font-size: 0.75rem; }

        .section {
            margin-bottom: 2.5rem;
            scroll-margin-top: 100px;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .section-num {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(139,63,219,0.15);
            border: 1px solid rgba(139,63,219,0.2);
            color: var(--purple);
            font-size: 0.75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .section h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #fff;
        }

        .section-body {
            background: var(--navy-card);
            border: 1px solid var(--navy-border);
            border-radius: 12px;
            padding: 1.5rem 1.75rem;
        }

        .section-body p {
            color: var(--text-muted);
            font-size: 0.9375rem;
            margin-bottom: 0.85rem;
        }

        .section-body p:last-child { margin-bottom: 0; }

        .section-body ul {
            list-style: none;
            margin: 0.75rem 0;
        }

        .section-body ul li {
            color: var(--text-muted);
            font-size: 0.9375rem;
            padding: 0.3rem 0 0.3rem 1.25rem;
            position: relative;
        }

        .section-body ul li::before {
            content: '·';
            position: absolute;
            left: 0;
            color: var(--purple);
            font-size: 1.2rem;
            line-height: 1.4;
        }

        .highlight-box {
            background: rgba(139,63,219,0.05);
            border: 1px solid rgba(139,63,219,0.15);
            border-radius: 8px;
            padding: 1rem 1.25rem;
            margin: 1rem 0;
        }

        .highlight-box p {
            color: rgba(232,234,246,0.85) !important;
            font-size: 0.875rem !important;
            margin: 0 !important;
        }

        .warning-box {
            background: rgba(255,165,0,0.05);
            border: 1px solid rgba(255,165,0,0.15);
            border-radius: 8px;
            padding: 1rem 1.25rem;
            margin: 1rem 0;
        }

        .warning-box p {
            color: rgba(255,200,100,0.9) !important;
            font-size: 0.875rem !important;
            margin: 0 !important;
        }

        strong {
            color: #fff;
            font-weight: 600;
        }

        a.inline-link {
            color: var(--cyan);
            text-decoration: none;
        }
        a.inline-link:hover { text-decoration: underline; }

        .contact-card {
            background: var(--grad);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            margin-top: 3rem;
        }

        .contact-card h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .contact-card p {
            color: rgba(255,255,255,0.8);
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
        }

        .contact-card a {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.3);
            color: #fff;
            text-decoration: none;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            transition: background 0.2s;
            display: inline-block;
        }
        .contact-card a:hover { background: rgba(255,255,255,0.25); }


        @media (max-width: 900px) {
            .nav-links { display: none; }
            .footer-top { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 640px) {
            .index-list { grid-template-columns: 1fr; }
            .page-hero { padding: 120px 1.5rem 2rem; }
            .content-wrapper { padding: 0 1.25rem 4rem; }
            .footer-top { grid-template-columns: 1fr; }
            .footer-bottom { align-items: flex-start; flex-direction: column; }
        }
    </style>
</head>
<body>

@include('partials.site-header')

<!-- HERO -->
<div class="page-hero">
    <div class="page-badge">Legal</div>
    <h1>Política de <span>Privacidade</span></h1>
    <p>Como recolhemos, usamos e protegemos as suas informações pessoais.</p>
    <span class="last-updated">Última atualização: Janeiro 2026</span>
</div>

<!-- CONTENT -->
<div class="content-wrapper">

    <!-- INDEX -->
    <div class="index-card">
        <h3>Índice</h3>
        <ul class="index-list">
            <li><a href="#sec1">Quem somos</a></li>
            <li><a href="#sec2">Dados que recolhemos</a></li>
            <li><a href="#sec3">Como usamos os dados</a></li>
            <li><a href="#sec4">Partilha de dados</a></li>
            <li><a href="#sec5">Cookies</a></li>
            <li><a href="#sec6">Os seus direitos</a></li>
            <li><a href="#sec7">Segurança</a></li>
            <li><a href="#sec8">Retenção de dados</a></li>
        </ul>
    </div>

    <!-- SECTION 1 -->
    <div class="section" id="sec1">
        <div class="section-header">
            <div class="section-num">01</div>
            <h2>Quem Somos</h2>
        </div>
        <div class="section-body">
            <p>A <strong>NexusVora</strong> é uma agência de marketing digital full-service focada no crescimento de PMEs e concessionários automóveis na região do Porto, Gaia e Maia.</p>
            <p>Para efeitos do Regulamento Geral sobre a Proteção de Dados (RGPD), a NexusVora é o <strong>Responsável pelo Tratamento</strong> dos seus dados pessoais.</p>
            <div class="highlight-box">
                <p><strong>NexusVora</strong> · Porto, Portugal · <a href="mailto:geral@nexusvora.com" class="inline-link">geral@nexusvora.com</a></p>
            </div>
        </div>
    </div>

    <!-- SECTION 2 -->
    <div class="section" id="sec2">
        <div class="section-header">
            <div class="section-num">02</div>
            <h2>Dados que Recolhemos</h2>
        </div>
        <div class="section-body">
            <p>Recolhemos apenas os dados estritamente necessários para prestar os nossos serviços e responder aos seus pedidos. Os dados podem ser recolhidos através de:</p>
            <ul>
                <li><strong>Formulários de contacto</strong> — nome, email, telefone, empresa e mensagem</li>
                <li><strong>Pedidos de diagnóstico/proposta</strong> — informações sobre o seu negócio</li>
                <li><strong>Navegação no site</strong> — dados de uso agregados e anónimos via cookies</li>
                <li><strong>Comunicações por email ou telefone</strong> — quando nos contacta diretamente</li>
                <li><strong>Redes sociais</strong> — se interagir com os nossos perfis</li>
            </ul>
            <p>Não recolhemos dados sensíveis como informação financeira, dados de saúde ou outros dados de categoria especial sem consentimento explícito.</p>
        </div>
    </div>

    <!-- SECTION 3 -->
    <div class="section" id="sec3">
        <div class="section-header">
            <div class="section-num">03</div>
            <h2>Como Usamos os Seus Dados</h2>
        </div>
        <div class="section-body">
            <p>Utilizamos os seus dados pessoais para as seguintes finalidades:</p>
            <ul>
                <li>Responder a pedidos de informação, diagnóstico ou proposta comercial</li>
                <li>Prestar e gerir os serviços contratados</li>
                <li>Enviar comunicações relevantes sobre os nossos serviços, com o seu consentimento</li>
                <li>Melhorar a experiência no nosso website</li>
                <li>Cumprir obrigações legais e regulatórias</li>
                <li>Gestão interna e faturação quando existe uma relação comercial</li>
            </ul>
            <p>Os seus dados nunca serão utilizados para fins que não os indicados acima sem o seu consentimento prévio.</p>
        </div>
    </div>

    <!-- SECTION 4 -->
    <div class="section" id="sec4">
        <div class="section-header">
            <div class="section-num">04</div>
            <h2>Partilha de Dados com Terceiros</h2>
        </div>
        <div class="section-body">
            <p>A NexusVora <strong>não vende, aluga nem comercializa</strong> os seus dados pessoais a terceiros. Podemos partilhar dados apenas nas seguintes situações:</p>
            <ul>
                <li><strong>Prestadores de serviços</strong> — ferramentas de email, CRM ou analytics que nos ajudam a operar, sempre com garantias de proteção de dados</li>
                <li><strong>Obrigação legal</strong> — quando exigido por lei ou por autoridades competentes</li>
                <li><strong>Com o seu consentimento</strong> — em qualquer outra situação, apenas com a sua autorização expressa</li>
            </ul>
            <div class="highlight-box">
                <p>Utilizamos ferramentas como Google Analytics e Meta Pixel para análise de desempenho. Estas ferramentas podem processar dados de forma anonimizada. Pode optar por não ser rastreado através das definições de cookies.</p>
            </div>
        </div>
    </div>

    <!-- SECTION 5 -->
    <div class="section" id="sec5">
        <div class="section-header">
            <div class="section-num">05</div>
            <h2>Cookies e Tecnologias de Rastreio</h2>
        </div>
        <div class="section-body">
            <p>O nosso website utiliza cookies para melhorar a sua experiência de navegação. Os cookies são pequenos ficheiros de texto armazenados no seu dispositivo.</p>
            <ul>
                <li><strong>Cookies essenciais</strong> — necessários para o funcionamento básico do site</li>
                <li><strong>Cookies de desempenho</strong> — medem como os visitantes usam o site, por exemplo Google Analytics</li>
                <li><strong>Cookies de marketing</strong> — utilizados para personalizar anúncios, por exemplo Meta Pixel</li>
            </ul>
            <p>Pode gerir as suas preferências de cookies através do banner apresentado na primeira visita ao site ou nas definições do seu browser. A recusa de cookies não essenciais não prejudica a utilização do site.</p>
        </div>
    </div>

    <!-- SECTION 6 -->
    <div class="section" id="sec6">
        <div class="section-header">
            <div class="section-num">06</div>
            <h2>Os Seus Direitos (RGPD)</h2>
        </div>
        <div class="section-body">
            <p>Ao abrigo do Regulamento Geral sobre a Proteção de Dados (RGPD), tem os seguintes direitos:</p>
            <ul>
                <li><strong>Direito de acesso</strong> — saber que dados temos sobre si</li>
                <li><strong>Direito de retificação</strong> — corrigir dados inexatos ou incompletos</li>
                <li><strong>Direito ao apagamento</strong> — solicitar a eliminação dos seus dados</li>
                <li><strong>Direito à portabilidade</strong> — receber os seus dados num formato legível por máquina</li>
                <li><strong>Direito de oposição</strong> — opor-se ao tratamento dos seus dados para marketing direto</li>
                <li><strong>Direito de limitação</strong> — restringir o tratamento dos seus dados em determinadas circunstâncias</li>
            </ul>
            <p>Para exercer qualquer um destes direitos, contacte-nos através de <a href="mailto:geral@nexusvora.com" class="inline-link">geral@nexusvora.com</a>. Responderemos no prazo máximo de 30 dias.</p>
            <p>Tem também o direito de apresentar uma reclamação à <strong>CNPD</strong> (Comissão Nacional de Proteção de Dados) em <a href="https://www.cnpd.pt" class="inline-link" target="_blank" rel="noreferrer">www.cnpd.pt</a>.</p>
        </div>
    </div>

    <!-- SECTION 7 -->
    <div class="section" id="sec7">
        <div class="section-header">
            <div class="section-num">07</div>
            <h2>Segurança dos Dados</h2>
        </div>
        <div class="section-body">
            <p>Implementamos medidas técnicas e organizacionais adequadas para proteger os seus dados pessoais contra acesso não autorizado, alteração, divulgação ou destruição.</p>
            <ul>
                <li>Comunicações encriptadas via HTTPS/SSL</li>
                <li>Acesso restrito aos dados apenas a colaboradores autorizados</li>
                <li>Backups regulares e sistemas de recuperação</li>
                <li>Revisão periódica das nossas práticas de segurança</li>
            </ul>
            <p>Em caso de violação de dados que represente risco para os seus direitos e liberdades, notificaremos a CNPD e os titulares afetados nos prazos legais previstos.</p>
        </div>
    </div>

    <!-- SECTION 8 -->
    <div class="section" id="sec8">
        <div class="section-header">
            <div class="section-num">08</div>
            <h2>Retenção de Dados</h2>
        </div>
        <div class="section-body">
            <p>Conservamos os seus dados apenas pelo período necessário para as finalidades para as quais foram recolhidos:</p>
            <ul>
                <li><strong>Dados de contacto/pedidos</strong> — até 1 ano após o último contacto, sem relação comercial</li>
                <li><strong>Dados de clientes</strong> — durante a vigência do contrato e até 5 anos após o seu término, por obrigações fiscais e legais</li>
                <li><strong>Dados de navegação/cookies</strong> — conforme configuração das ferramentas utilizadas, geralmente 13 meses</li>
            </ul>
            <p>Após o prazo aplicável, os dados são eliminados de forma segura ou anonimizados.</p>
        </div>
    </div>

    <!-- CONTACT CARD -->
    <div class="contact-card">
        <h3>Tem alguma questão sobre privacidade?</h3>
        <p>Estamos disponíveis para esclarecer qualquer dúvida sobre como tratamos os seus dados.</p>
        <a href="mailto:geral@nexusvora.com">geral@nexusvora.com →</a>
    </div>

</div>

@include('partials.site-footer')

</body>
</html>
