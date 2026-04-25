# NexusVora — Roadmap de Decisões

> Documento vivo. Atualizado a cada decisão tomada nas sessões de trabalho.
> Estado: [ ] A fazer · [x] Concluído · [~] Em progresso

---

## Fase 1 — SEO Técnico (Prioridade Crítica)

### 1.1 Meta description
- [ ] Adicionar `<meta name="description">` no `<head>` de `welcome.blade.php`
- Texto acordado: _"NexusVora — Agência de marketing digital full-service em Porto, Gaia e Maia. Especialistas em SEO, Google Ads, Meta Ads e websites para PMEs e concessionários. Diagnóstico grátis."_

### 1.2 Schema.org / JSON-LD (SEO local)
- [ ] Adicionar bloco `LocalBusiness` antes de `</head>`
- Campos: name, description, address (Porto), telephone, email, areaServed, serviceType

### 1.3 H1 com palavras-chave
- [ ] Reescrever o H1 atual (`"O seu negócio merece crescer de verdade."`) para incluir localização e serviço
- Direção acordada: algo como _"Marketing Digital para PMEs no Porto — Resultados que crescem de verdade."_

---

## Fase 2 — SEO Complementar (Esta semana)

### 2.1 Open Graph tags
- [ ] Adicionar `og:title`, `og:description`, `og:type`, `og:locale` no `<head>`

### 2.2 Alt text nos SVGs de serviços
- [ ] Adicionar `aria-label` ou `<title>` dentro dos SVGs dos cards de serviço

### 2.3 Canonical URL
- [ ] Adicionar `<link rel="canonical">` para evitar conteúdo duplicado (http/https/www)

### 2.4 Sitemap.xml
- [ ] Criar sitemap para facilitar indexação das páginas pelo Google
- Rotas a incluir: `/`, `/servicos`, e futuras páginas de serviço

### 2.5 robots.txt
- [ ] Verificar e configurar permissões de indexação

---

## Fase 3 — Páginas de Serviço Dedicadas (Alto impacto SEO)

**Decisão:** Em vez de depender apenas do hero rotativo, criar páginas individuais por serviço. Cada página é indexada separadamente pelo Google e pode ranquear para as suas próprias keywords.

### Rotas a criar em `routes/web.php`
- [ ] `/servicos/desenvolvimento-web`
- [ ] `/servicos/marketing-digital`
- [ ] `/servicos/automacao-de-processos`
- [ ] `/servicos/integracao-de-ia`
- [ ] `/servicos/servicos-personalizados`

### Views a criar em `resources/views/services/`
- [ ] `desenvolvimento-web.blade.php`
- [ ] `marketing-digital.blade.php`
- [ ] `automacao-de-processos.blade.php`
- [ ] `integracao-de-ia.blade.php`
- [ ] `servicos-personalizados.blade.php`

### Cada página deve ter
- H1 com keywords específicas do serviço
- Meta description única
- Schema.org `Service`
- Conteúdo rico (400+ palavras) com keywords naturais
- CTA para contacto

---

## Fase 4 — Hero Rotativo (Visual + SEO-friendly)

**Decisão:** Criar um card no hero que roda visualmente pelos 5 serviços, mas com todo o conteúdo presente no HTML desde o início (apenas escondido via CSS). Assim o Google lê tudo e o utilizador vê a animação.

**Formato acordado:** Card com imagem de fundo ou vídeo curto em loop, rotação entre:
1. Desenvolvimento Web — keywords: criação de sites, websites profissionais Porto
2. Marketing Digital — keywords: agência marketing Porto, Google Ads, Meta Ads
3. Automação de Processos — keywords: automação empresarial, processos digitais
4. Integração de IA — keywords: inteligência artificial para empresas, AI integration
5. Serviços Personalizados — keywords: soluções digitais à medida

**Regra técnica:** Todo o conteúdo dos 5 slides no HTML, visibilidade controlada só por CSS/JS.

---

## Decisões de Arquitetura Registadas

| Data | Decisão | Motivo |
|---|---|---|
| 2026-04-22 | Páginas dedicadas por serviço em vez de só hero rotativo | Google não indexa bem conteúdo rotativo escondido via JS |
| 2026-04-22 | Hero rotativo com conteúdo no HTML desde o início | Combinar impacto visual com SEO-friendly |
| 2026-04-22 | Foco em SEO local (Porto, Gaia, Maia) | Mercado-alvo definido: PMEs e concessionários da região |

---

## Backlog (Sem data definida)

- [ ] Blog/artigos para SEO de conteúdo (ex: "Como fazer marketing digital para concessionários")
- [ ] Google Search Console — configurar e monitorizar keywords
- [ ] Google Analytics 4 — integrar para medir tráfego e conversões
- [ ] Página de contacto dedicada (`/contacto`) com formulário
- [ ] Reforçar keywords locais no corpo de texto dos cards de serviço existentes
