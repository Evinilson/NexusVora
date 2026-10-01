# Plano de GitHub Actions para deploy na Hostinger

> Estado: planeamento. Este documento descreve o workflow proposto; ainda não foi criado nem executado.

## Objetivo

Publicar a aplicação Laravel a partir do GitHub de forma repetível, sem voltar a deixar ficheiros necessários fora do upload, sem substituir o `.env` de produção e sem expor o código privado pela pasta pública.

## Contexto confirmado

- O projeto usa Laravel 12 e requer PHP `^8.2`; a Hostinger indica PHP 8.3 para o site.
- A raiz pública do domínio é `public_html`.
- O `public_html/index.php` publicado carrega `../vendor/autoload.php` e `../bootstrap/app.php`. Isto indica que a aplicação Laravel fica na pasta imediatamente acima de `public_html`, mantendo o código e as dependências fora da raiz pública.
- O Vite está configurado para publicar os assets em `public_html`, e o comando de build existente é `npm run build`.
- A branch local `main` acompanha `origin/main`.
- O erro observado em produção foi `Route [service.social] not defined`. A rota está registada no código local. O utilizador informou que já encontrou e resolveu o envio de um ficheiro em falta; o workflow deverá garantir que os ficheiros de rotas e views versionados são sincronizados antes de reconstruir as caches.
- O repositório não tem atualmente um lockfile do npm (`package-lock.json`, `pnpm-lock.yaml` ou `yarn.lock`). `npm ci` só deve entrar no workflow depois de escolher npm e adicionar o respetivo `package-lock.json` ao repositório.
- O `README.md` ainda descreve um deploy por Laravel Forge num servidor Hetzner. Esse registo deverá ser confirmado e alinhado com o alojamento Hostinger antes de implementar o workflow.

## Fluxo proposto

1. **Disparo:** executar em `push` para `main` e permitir execução manual (`workflow_dispatch`). Proteger a branch `main` e usar um ambiente GitHub chamado `production`.
2. **Build dos assets:** no runner do GitHub, instalar a versão LTS de Node escolhida pelo projeto, instalar dependências a partir do lockfile e executar `npm run build`. Publicar apenas o resultado de `public_html/build`.
3. **Acesso SSH:** usar uma chave dedicada ao deploy, guardada como GitHub Secret. Configurar host, porta e utilizador como secrets/variáveis do ambiente `production`. Nunca escrever chaves, `.env` ou credenciais no repositório ou nos logs do workflow.
4. **Sincronização da aplicação:** sincronizar os ficheiros versionados para a pasta privada da aplicação na pasta do domínio, usando destinos remotos fixos e previamente confirmados. Excluir `.env`, `.git`, `node_modules`, `vendor` e `storage`; preservar `vendor` até à instalação no servidor e preservar `storage`, que pode conter logs, sessões, cache e ficheiros enviados por utilizadores.
5. **Sincronização pública:** atualizar apenas assets e ficheiros públicos que o projeto controla. Preservar o `index.php`, o `.htaccess` e conteúdos existentes em `public_html` até confirmar explicitamente quais são geridos pelo repositório. Não usar `rsync --delete` amplo em `public_html`, porque pode apagar conteúdos irmãos ou ficheiros de marketing.
6. **Composer no servidor:** na raiz privada da aplicação, executar `composer install --no-dev --prefer-dist --optimize-autoloader`, usando o PHP CLI compatível com PHP 8.3. Confirmar o caminho real do PHP CLI e do Composer por SSH antes de fixar estes comandos; o PHP CLI pode diferir da versão PHP selecionada para pedidos web.
7. **Caches Laravel:** depois da sincronização e do Composer, limpar apenas as caches de configuração, rotas e views com `php artisan config:clear`, `php artisan route:clear` e `php artisan view:clear`. Confirmar que `service.social` aparece em `php artisan route:list --name=service.social`; só depois gerar caches de produção com `php artisan config:cache`, `php artisan route:cache` e `php artisan view:cache`. Evitar `optimize:clear` automático até confirmar o cache store, porque esse comando também pode limpar chaves do cache da aplicação.
8. **Migrações:** manter migrações fora do deploy automático inicial. Só acrescentar `php artisan migrate --force` depois de rever as migrações e aprovar explicitamente esse passo para produção.
9. **Verificação pós-deploy:** confirmar respostas HTTP 200 na página inicial, no índice de serviços, na página de Redes Sociais e no sitemap. Se houver falha, consultar `storage/logs/laravel.log` da aplicação afetada. Manter `APP_DEBUG=false` no `.env` de produção.

## Proteção e recuperação

- Manter o `.env` existente no servidor e nunca sincronizar um `.env` do repositório para produção.
- Preservar `storage` e não executar comandos de limpeza que apaguem dados de cache partilhada sem avaliar o impacto.
- Não colocar o código Laravel, `.env`, `vendor` ou `storage` em `public_html`.
- Não permitir que valores de um commit determinem livremente o destino remoto do deploy.
- Antes da primeira execução, criar uma cópia de recuperação do código atualmente publicado e documentar como restaurá-la, sem substituir o `.env` nem os dados de `storage`.
- A chave SSH de uma conta de alojamento partilhado tem permissões dessa conta; uma chave separada facilita a rotação, mas não limita o acesso a uma pasta específica.

## Informação necessária antes de criar o workflow

- Confirmar se `main` é a branch de produção e ativar a proteção adequada no GitHub.
- Escolher npm e adicionar `package-lock.json`, ou escolher outro gestor e usar o respetivo lockfile e comandos.
- Confirmar por SSH o host, a porta, o utilizador, a pasta privada da aplicação e os caminhos dos executáveis PHP e Composer.
- Confirmar que o `public_html/index.php` e o `.htaccess` são wrappers mantidos pelo projeto e decidir quais ficheiros públicos devem ser sincronizados.
- Rever o método de recuperação da versão anterior e decidir, após revisão, se alguma migração pode ser automatizada.
- Confirmar ou corrigir a descrição de deploy no `README.md`, atualmente divergente do alojamento Hostinger observado.

## Referências do projeto

- [Roadmap e tarefas de publicação](../roadmap_to_do.md)
- [Configuração do Vite](../vite.config.js)
- [Rotas web](../routes/web.php)
- [Documentação oficial do Laravel 12 sobre cache de rotas](https://laravel.com/docs/12.x/routing#route-caching)
