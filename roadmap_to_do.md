# Roadmap To Do - Antes de Publicar

## Configuração do servidor

- [ ] Confirmar que o `.env` usado no servidor tem:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://nexusvora.com
```

- [ ] Confirmar cookies seguros em HTTPS:

```env
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax
SESSION_ENCRYPT=true
```

## Segurança

- [x] Adicionar rate limit ao envio do formulário de contacto:

```php
Route::post('/contacto', [ContactController::class, 'submit'])
    ->middleware('throttle:5,1')
    ->name('contacto.submit');
```

- [x] Adicionar rate limit ao login admin:

```php
Route::post('/login', [AdminAuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.store');
```

- [x] Registar falhas de envio de email no `ContactController`:

```php
report($e);
```

## Deploy

- [x] Antes de publicar, limpar caches locais:

```bash
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan cache:clear
```

- [ ] No servidor, depois do upload:

```bash
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Verificação final

- [ ] Testar formulário de contacto em produção.
- [ ] Confirmar receção do email em `geral@nexusvora.com`.
- [ ] Confirmar que `/precos`, `/contacto`, `/servicos`, `/termos-servico` e `/politica-privacidade` abrem corretamente.
- [ ] Confirmar que `https://nexusvora.com/sitemap.xml` está acessível.
- [ ] Confirmar que `https://nexusvora.com/robots.txt` aponta para o sitemap correto.

## Plano RGPD / Cookies / Analytics

### Objetivo

Garantir que a Política de Privacidade corresponde ao comportamento técnico real do site: nenhum script não essencial deve carregar antes de consentimento explícito, e o utilizador deve conseguir aceitar, recusar ou revogar preferências de cookies a qualquer momento.

Nota: os itens marcados foram implementados no código e validados localmente com `php -l`, `php artisan route:list -v`, `php artisan view:cache` e `php artisan test`. Itens que dependem de produção, IDs reais, browser/Network ou criação de email ficam por marcar.

### Fase 1 - Auditoria técnica antes de alterar

- [x] Confirmar se existem scripts reais de Google Analytics, Google Tag Manager, Meta Pixel ou outros trackers no código versionado. Resultado: não existem trackers diretos; só existem no loader condicional pós-consentimento.
- [ ] Confirmar se existem scripts reais de Google Analytics, Google Tag Manager, Meta Pixel ou outros trackers fora do código versionado, por exemplo no painel de alojamento, CDN, Google Tag Manager ou snippets injetados no servidor.
- [ ] Confirmar quais IDs serão usados em produção:
  - [ ] Google Analytics 4: `G-XXXXXXXXXX`
  - [ ] Meta Pixel: `XXXXXXXXXXXXXXX`
- [ ] Decidir se o site vai mesmo usar Meta Pixel no lançamento. Se não for usado, remover a menção da política até ser ativado.
- [x] Manter `geral@nexusvora.com` como contacto para direitos RGPD, porque não existe email dedicado de privacidade.

### Fase 2 - Implementar CMP

- [x] Escolher a CMP:
  - [x] Preferencial: Klaro open-source, por ser simples e suficiente para Laravel/Blade.
  - [ ] Alternativa: Cookiebot, se for preferível uma solução gerida.
- [x] Criar ficheiro de configuração da CMP em `public_html/js/klaro-config.js`.
- [x] Declarar categorias separadas:
  - [x] Essenciais: sempre ativos.
  - [x] Analytics: Google Analytics, `required: false`.
  - [x] Marketing: Meta Pixel, `required: false`.
- [x] Incluir CSS/JS da CMP no layout comum em `resources/views/partials/site-head.blade.php`.
- [x] Garantir por código e teste automatizado que a CMP é incluída nas páginas públicas.
- [ ] Confirmar em browser real que a CMP aparece na primeira visita e permite aceitar, recusar e guardar preferências granulares.

### Fase 3 - Bloquear scripts até consentimento

- [x] Criar um partial Blade para scripts condicionais, por exemplo `resources/views/partials/cookie-consent.blade.php`.
- [x] Carregar Google Analytics apenas depois de consentimento para a categoria `analytics`.
- [x] Carregar Meta Pixel apenas depois de consentimento para a categoria `marketing`.
- [x] Não deixar nenhum `gtag`, `googletagmanager`, `fbq` ou `connect.facebook.net` carregar diretamente no HTML inicial.
- [ ] Configurar GA4 com privacidade reforçada:
  - [x] Confirmar anonimização de IP no código (`anonymize_ip: true`).
  - [x] Desativar sinais/ads personalization no código quando não necessários.
  - [ ] Ajustar retenção de dados no painel GA4 para o mínimo necessário.
- [ ] Se Google Tag Manager for usado, garantir que as tags internas também respeitam consentimento.

### Fase 4 - Botão persistente para gerir cookies

- [x] Adicionar botão fixo "Gerir cookies" visível em todas as páginas públicas.
- [x] O botão deve chamar a CMP, por exemplo `klaro.show()`.
- [ ] Garantir que o botão não cobre CTAs, formulários ou elementos importantes em mobile.
- [ ] Testar que a revogação remove consentimentos e impede novos carregamentos de scripts não essenciais.

### Fase 5 - Corrigir formulário de contacto

- [x] Substituir ou complementar a checkbox visual por um `<input type="checkbox" name="privacy" required>` real.
- [x] Garantir que a checkbox vem desmarcada por defeito.
- [x] Manter validação frontend e backend:
  - [x] Frontend: impede envio sem aceitação.
  - [x] Backend: regra atual `'privacy' => 'accepted'` continua obrigatória.
- [x] Garantir acessibilidade:
  - [x] Label associado ao input.
  - [x] Navegação por teclado.
  - [x] Estado checked percetível sem depender apenas de JS.
- [x] Confirmar que o payload enviado pelo `fetch` envia `privacy: true` apenas quando o input estiver marcado.

### Fase 6 - Atualizar Política de Privacidade

- [x] Atualizar `resources/views/privacidade.blade.php`.
- [x] Mapear finalidade, dados tratados, base legal e retenção numa tabela clara:
  - [x] Responder a contactos: nome, email, telefone, empresa, mensagem; interesse legítimo ou diligências pré-contratuais.
  - [x] Prestação de serviços: dados de cliente/projeto; execução de contrato.
  - [x] Faturação: NIF, morada, dados fiscais; obrigação legal.
  - [x] Analytics: dados de navegação; consentimento.
  - [x] Marketing/Meta Pixel: dados de navegação e eventos; consentimento.
  - [x] Comunicações comerciais: email e preferências; consentimento ou interesse legítimo, conforme o caso.
- [x] Explicar transferências internacionais:
  - [x] Identificar Google e Meta como possíveis prestadores fora do EEE.
  - [x] Referir Standard Contractual Clauses, Data Privacy Framework ou outro mecanismo aplicável quando usado.
  - [x] Evitar afirmar anonimização se não estiver tecnicamente garantida antes da transferência.
- [x] Atualizar secção de cookies para refletir a CMP real.
- [x] Adicionar instrução clara para revogar consentimento pelo botão "Gerir cookies".
- [x] Manter contacto de direitos RGPD como `geral@nexusvora.com` na política.

### Fase 7 - Testes de conformidade

- [ ] Testar em janela anónima sem consentimento:
  - [ ] Não existem pedidos para `googletagmanager.com`.
  - [ ] Não existem pedidos para `google-analytics.com`.
  - [ ] Não existem pedidos para `connect.facebook.net`.
  - [ ] Não existem cookies não essenciais.
- [ ] Aceitar apenas analytics:
  - [ ] Google Analytics carrega.
  - [ ] Meta Pixel não carrega.
- [ ] Aceitar apenas marketing:
  - [ ] Meta Pixel carrega.
  - [ ] Google Analytics não carrega, salvo se também consentido.
- [ ] Recusar tudo:
  - [ ] Apenas cookies essenciais permanecem.
- [ ] Revogar consentimento pelo botão persistente:
  - [ ] Preferências são atualizadas.
  - [ ] Scripts não essenciais deixam de carregar em visitas seguintes.
- [ ] Enviar formulário com checkbox desmarcada:
  - [ ] Frontend bloqueia em browser real.
  - [x] Backend rejeita se o pedido for manipulado manualmente.
- [x] Enviar formulário com checkbox marcada:
  - [x] Pedido é aceite em teste automatizado.
  - [x] Email é enviado em teste automatizado com `Mail::fake()`.

### Fase 8 - Deploy

- [x] Preparar IDs de analytics/pixel por variáveis de ambiente, sem hardcode sensível:

```env
GA4_MEASUREMENT_ID=G-XXXXXXXXXX
META_PIXEL_ID=XXXXXXXXXXXXXXX
```

- [ ] Publicar alterações.
- [ ] Limpar e reconstruir caches:

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

- [ ] Repetir os testes da Fase 7 em produção.
- [ ] Guardar evidências simples da conformidade:
  - [ ] Screenshot do banner.
  - [ ] Screenshot das preferências granulares.
  - [ ] Screenshot da aba Network antes e depois do consentimento.
  - [ ] Data da validação.

### Prioridade recomendada

1. CMP e bloqueio real de scripts antes do consentimento.
2. Botão persistente para gerir/revogar cookies.
3. Correção da checkbox do formulário para input real obrigatório.
4. Atualização da Política de Privacidade com bases legais e transferências internacionais.
5. Testes finais em produção e registo de evidências.
