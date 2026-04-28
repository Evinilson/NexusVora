<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.site-head')
    <title>Termos de Serviço — NexusVora</title>

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
    <h1>Termos de <span>Serviço</span></h1>
    <p>As condições que regem a utilização dos nossos serviços e do nosso website.</p>
    <span class="last-updated">Última atualização: Janeiro 2026</span>
</div>

<!-- CONTENT -->
<div class="content-wrapper">

    <!-- INDEX -->
    <div class="index-card">
        <h3>Índice</h3>
        <ul class="index-list">
            <li><a href="#t1">Aceitação dos termos</a></li>
            <li><a href="#t2">Serviços prestados</a></li>
            <li><a href="#t3">Contratos e propostas</a></li>
            <li><a href="#t4">Pagamentos</a></li>
            <li><a href="#t5">Obrigações do cliente</a></li>
            <li><a href="#t6">Propriedade intelectual</a></li>
            <li><a href="#t7">Limitação de responsabilidade</a></li>
            <li><a href="#t8">Rescisão</a></li>
            <li><a href="#t9">Lei aplicável</a></li>
        </ul>
    </div>

    <!-- SECTION 1 -->
    <div class="section" id="t1">
        <div class="section-header">
            <div class="section-num">01</div>
            <h2>Aceitação dos Termos</h2>
        </div>
        <div class="section-body">
            <p>Ao utilizar o website da <strong>NexusVora</strong> ou ao contratar os nossos serviços, declara que leu, compreendeu e aceita os presentes Termos de Serviço na sua totalidade.</p>
            <p>Caso não concorde com alguma das condições aqui estabelecidas, deverá abster-se de utilizar o nosso website ou de contratar os nossos serviços.</p>
            <div class="highlight-box">
                <p>Estes termos podem ser atualizados periodicamente. A versão mais recente estará sempre disponível nesta página. Recomendamos que a consulte regularmente.</p>
            </div>
        </div>
    </div>

    <!-- SECTION 2 -->
    <div class="section" id="t2">
        <div class="section-header">
            <div class="section-num">02</div>
            <h2>Serviços Prestados</h2>
        </div>
        <div class="section-body">
            <p>A NexusVora presta serviços de marketing digital, incluindo mas não se limitando a:</p>
            <ul>
                <li><strong>Desenvolvimento Web</strong> — criação e otimização de websites e landing pages</li>
                <li><strong>Google Ads</strong> — gestão de campanhas de pesquisa e display</li>
                <li><strong>Meta Ads</strong> — gestão de campanhas no Facebook e Instagram</li>
                <li><strong>SEO</strong> — otimização para motores de pesquisa</li>
                <li><strong>Gestão de Redes Sociais</strong> — criação de conteúdo e gestão de comunidade</li>
                <li><strong>Estratégia Digital 360°</strong> — planeamento e execução integrada de marketing digital</li>
            </ul>
            <p>Os serviços específicos, âmbito e condições de cada projeto são definidos na proposta comercial aceite pelo cliente.</p>
        </div>
    </div>

    <!-- SECTION 3 -->
    <div class="section" id="t3">
        <div class="section-header">
            <div class="section-num">03</div>
            <h2>Contratos e Propostas</h2>
        </div>
        <div class="section-body">
            <p>A relação comercial entre a NexusVora e o cliente estabelece-se com a aceitação formal de uma proposta comercial, seja por email, assinatura de contrato ou outro meio acordado entre as partes.</p>
            <ul>
                <li>As propostas têm validade de <strong>15 dias</strong> a contar da data de emissão, salvo indicação em contrário</li>
                <li>Alterações ao âmbito dos serviços após aceitação da proposta poderão implicar revisão de preços e prazos</li>
                <li>A NexusVora reserva o direito de recusar a prestação de serviços a qualquer entidade, sem necessidade de justificação</li>
            </ul>
            <div class="highlight-box">
                <p>Os contratos de serviços recorrentes (mensais) são estabelecidos sem período mínimo de permanência, salvo acordo expresso em contrário.</p>
            </div>
        </div>
    </div>

    <!-- SECTION 4 -->
    <div class="section" id="t4">
        <div class="section-header">
            <div class="section-num">04</div>
            <h2>Pagamentos e Faturação</h2>
        </div>
        <div class="section-body">
            <p>As condições de pagamento são definidas em cada proposta comercial. As condições gerais são:</p>
            <ul>
                <li><strong>Serviços mensais</strong> — faturados no início de cada mês ou conforme acordado</li>
                <li><strong>Projetos pontuais</strong> — 50% no início, 50% na entrega, salvo acordo em contrário</li>
                <li><strong>Prazo de pagamento</strong> — 15 dias após emissão de fatura, salvo acordo em contrário</li>
                <li><strong>Moeda</strong> — todos os valores em euros (€), sujeitos a IVA à taxa legal em vigor</li>
            </ul>
            <div class="warning-box">
                <p>⚠️ O atraso no pagamento poderá resultar na suspensão dos serviços ativos e na aplicação de juros de mora legalmente previstos.</p>
            </div>
            <p>Os orçamentos de investimento em plataformas (Google Ads, Meta Ads, etc.) são cobrados separadamente e geridos diretamente pelo cliente nas respetivas plataformas, salvo acordo em contrário.</p>
        </div>
    </div>

    <!-- SECTION 5 -->
    <div class="section" id="t5">
        <div class="section-header">
            <div class="section-num">05</div>
            <h2>Obrigações do Cliente</h2>
        </div>
        <div class="section-body">
            <p>Para garantir a correta prestação dos serviços, o cliente compromete-se a:</p>
            <ul>
                <li>Fornecer atempadamente toda a informação, conteúdos e acessos necessários para a execução dos serviços</li>
                <li>Designar um interlocutor principal para comunicação com a NexusVora</li>
                <li>Responder a pedidos de aprovação e feedback no prazo acordado</li>
                <li>Garantir que todo o material fornecido (imagens, textos, logótipos) não viola direitos de terceiros</li>
                <li>Efetuar os pagamentos nos prazos estabelecidos</li>
                <li>Não utilizar os serviços para fins ilegais, fraudulentos ou que violem direitos de terceiros</li>
            </ul>
            <p>O incumprimento destas obrigações poderá resultar em atrasos nos prazos acordados, sem responsabilidade da NexusVora.</p>
        </div>
    </div>

    <!-- SECTION 6 -->
    <div class="section" id="t6">
        <div class="section-header">
            <div class="section-num">06</div>
            <h2>Propriedade Intelectual</h2>
        </div>
        <div class="section-body">
            <p>Após a liquidação integral dos serviços contratados:</p>
            <ul>
                <li>Os materiais criados especificamente para o cliente (websites, criativos, textos) passam a ser propriedade do cliente</li>
                <li>A NexusVora mantém o direito de referenciar o trabalho realizado no seu portfólio, salvo indicação em contrário</li>
                <li>Ferramentas, processos e metodologias proprietárias da NexusVora permanecem sua propriedade exclusiva</li>
            </ul>
            <p>Todo o conteúdo do website da NexusVora (textos, imagens, logótipo, design) é propriedade da NexusVora ou dos seus licenciantes e está protegido por direitos de autor. A sua reprodução sem autorização prévia é proibida.</p>
        </div>
    </div>

    <!-- SECTION 7 -->
    <div class="section" id="t7">
        <div class="section-header">
            <div class="section-num">07</div>
            <h2>Limitação de Responsabilidade</h2>
        </div>
        <div class="section-body">
            <p>A NexusVora compromete-se a prestar os seus serviços com profissionalismo e dedicação. No entanto:</p>
            <ul>
                <li>Não garantimos resultados específicos em campanhas de marketing, pois dependem de múltiplos fatores externos</li>
                <li>Não somos responsáveis por alterações nos algoritmos ou políticas das plataformas (Google, Meta, etc.) que possam afetar os resultados</li>
                <li>A nossa responsabilidade máxima perante o cliente fica limitada ao valor pago pelos serviços no mês em que ocorreu o dano</li>
                <li>Não somos responsáveis por perdas indiretas, lucros cessantes ou danos consequentes</li>
            </ul>
            <div class="highlight-box">
                <p>Trabalhamos sempre com o objetivo de maximizar os resultados dos nossos clientes, com transparência e relatórios mensais detalhados.</p>
            </div>
        </div>
    </div>

    <!-- SECTION 8 -->
    <div class="section" id="t8">
        <div class="section-header">
            <div class="section-num">08</div>
            <h2>Rescisão e Cancelamento</h2>
        </div>
        <div class="section-body">
            <p>Qualquer das partes pode rescindir os serviços mensais com aviso prévio de <strong>30 dias</strong>, por escrito (email aceite).</p>
            <ul>
                <li>Os serviços são prestados até ao final do período pago</li>
                <li>Projetos em curso no momento da rescisão serão faturados proporcionalmente ao trabalho realizado</li>
                <li>A NexusVora pode rescindir imediatamente em caso de incumprimento dos presentes termos pelo cliente</li>
                <li>Após rescisão, todos os acessos a contas e ferramentas geridas pela NexusVora serão transferidos para o cliente</li>
            </ul>
        </div>
    </div>

    <!-- SECTION 9 -->
    <div class="section" id="t9">
        <div class="section-header">
            <div class="section-num">09</div>
            <h2>Lei Aplicável e Jurisdição</h2>
        </div>
        <div class="section-body">
            <p>Os presentes Termos de Serviço são regidos pela legislação portuguesa, nomeadamente pelo Código Civil, Código Comercial e demais legislação aplicável.</p>
            <p>Para resolução de litígios, as partes elegem o <strong>Tribunal da Comarca do Porto</strong> como competente, com expressa renúncia a qualquer outro, salvo acordo em contrário ou disposição legal imperativa.</p>
            <p>Em caso de conflito com um consumidor, poderá recorrer a entidades de Resolução Alternativa de Litígios (RAL) reconhecidas em Portugal, disponíveis em <a href="https://www.consumidor.gov.pt" class="inline-link" target="_blank">www.consumidor.gov.pt</a>.</p>
        </div>
    </div>

    <!-- CONTACT CARD -->
    <div class="contact-card">
        <h3>Dúvidas sobre os nossos termos?</h3>
        <p>A nossa equipa está disponível para esclarecer qualquer questão antes de avançar.</p>
        <a href="mailto:geral@nexusvora.com">geral@nexusvora.com →</a>
    </div>

</div>

@include('partials.site-footer')

</body>
</html>
