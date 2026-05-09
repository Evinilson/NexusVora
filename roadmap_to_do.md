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

- [ ] Adicionar rate limit ao envio do formulário de contacto:

```php
Route::post('/contacto', [ContactController::class, 'submit'])
    ->middleware('throttle:5,1')
    ->name('contacto.submit');
```

- [ ] Adicionar rate limit ao login admin:

```php
Route::post('/login', [AdminAuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.store');
```

- [ ] Registar falhas de envio de email no `ContactController`:

```php
report($e);
```

## Deploy

- [ ] Antes de publicar, limpar caches locais:

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
