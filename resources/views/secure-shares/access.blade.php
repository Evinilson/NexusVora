<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partilha segura - NexusVora</title>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #060b20;
            --surface: #0d1530;
            --surface-2: #111936;
            --surface-3: #17203f;
            --border: rgba(255,255,255,0.1);
            --text: #f8fafc;
            --muted: #94a3b8;
            --cyan: #00d4ff;
            --blue: #4a6cf7;
            --purple: #8b3fdb;
            --success: #10b981;
            --danger: #fb7185;
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 28px;
            background:
                radial-gradient(circle at 16% 18%, rgba(0,212,255,0.22), transparent 28%),
                radial-gradient(circle at 86% 10%, rgba(74,108,247,0.22), transparent 28%),
                linear-gradient(135deg, #060b20 0%, #080f2a 48%, #0d1028 100%);
            color: var(--text);
            font-family: Inter, system-ui, sans-serif;
        }

        a { color: inherit; }

        .shell {
            width: min(1040px, 100%);
            display: grid;
            grid-template-columns: minmax(260px, 0.72fr) minmax(0, 1.28fr);
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: rgba(10,15,46,0.9);
            box-shadow: 0 28px 90px rgba(0,0,0,0.42);
        }

        .aside {
            position: relative;
            min-height: 560px;
            padding: 30px;
            background:
                radial-gradient(circle at 50% 18%, rgba(0,212,255,0.18), transparent 32%),
                linear-gradient(180deg, rgba(17,25,54,0.96), rgba(8,13,36,0.98));
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 30px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            font-size: 1.2rem;
            font-weight: 800;
        }

        .brand img {
            width: 36px;
            height: 36px;
        }

        .trust-visual {
            display: grid;
            place-items: center;
            min-height: 230px;
        }

        .shield {
            width: min(190px, 80%);
            aspect-ratio: 1;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background:
                radial-gradient(circle at center, rgba(0,212,255,0.16) 0 38%, transparent 39%),
                conic-gradient(from 220deg, var(--cyan), var(--blue), var(--purple), var(--cyan));
            box-shadow: 0 24px 70px rgba(0,0,0,0.32);
        }

        .shield-inner {
            width: 70%;
            aspect-ratio: 1;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: var(--surface);
            border: 1px solid rgba(255,255,255,0.14);
            text-align: center;
        }

        .shield-lock {
            width: 54px;
            height: 54px;
            border: 4px solid var(--cyan);
            border-top-width: 0;
            border-radius: 10px;
            position: relative;
            margin-top: 18px;
        }

        .shield-lock::before {
            content: "";
            position: absolute;
            left: 9px;
            top: -28px;
            width: 28px;
            height: 30px;
            border: 4px solid var(--cyan);
            border-bottom: 0;
            border-radius: 18px 18px 0 0;
        }

        .aside-note {
            color: var(--muted);
            line-height: 1.65;
            margin: 0;
            font-size: 0.92rem;
        }

        .main {
            padding: 34px;
            background:
                linear-gradient(180deg, rgba(17,25,54,0.9), rgba(10,15,46,0.94));
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.05);
            color: #dbeafe;
            font-size: 0.82rem;
            font-weight: 800;
        }

        .status-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--success);
        }

        .status-dot.expired { background: var(--danger); }

        .eyebrow {
            margin: 24px 0 8px;
            color: var(--cyan);
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            font-size: clamp(1.85rem, 5vw, 3.15rem);
            line-height: 1.05;
            letter-spacing: 0;
        }

        .copy {
            margin: 14px 0 0;
            max-width: 660px;
            color: var(--muted);
            line-height: 1.7;
            font-size: 1rem;
        }

        .notice {
            margin: 24px 0;
            padding: 16px;
            display: flex;
            gap: 12px;
            border: 1px solid rgba(0,212,255,0.18);
            border-radius: 8px;
            background: rgba(0,212,255,0.07);
            color: #c4eefd;
            line-height: 1.55;
        }

        .notice.expired {
            border-color: rgba(251,113,133,0.32);
            background: rgba(251,113,133,0.08);
            color: #fecdd3;
        }

        .notice-mark {
            width: 28px;
            height: 28px;
            flex: 0 0 28px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            background: rgba(255,255,255,0.08);
            color: var(--cyan);
            font-weight: 800;
        }

        .notice.expired .notice-mark {
            color: var(--danger);
        }

        .access-card,
        .secret-card {
            margin-top: 22px;
            padding: 22px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: rgba(6,11,32,0.46);
        }

        .form-row {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 12px;
            align-items: end;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--muted);
            font-size: 0.82rem;
            font-weight: 800;
        }

        input,
        textarea {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--surface);
            color: var(--text);
            padding: 13px 14px;
            font: inherit;
            outline: none;
        }

        input:focus,
        textarea:focus {
            border-color: rgba(0,212,255,0.55);
            box-shadow: 0 0 0 3px rgba(0,212,255,0.11);
        }

        button,
        .link-button {
            min-height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 8px;
            background: var(--cyan);
            color: #00111a;
            padding: 12px 18px;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
        }

        .error {
            margin: 10px 0 0;
            color: #fecdd3;
            font-size: 0.86rem;
        }

        .secret-grid {
            display: grid;
            gap: 16px;
        }

        .secret-block {
            padding: 16px;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            background: rgba(255,255,255,0.035);
        }

        .secret-heading {
            margin: 0 0 10px;
            color: #dbeafe;
            font-size: 0.92rem;
            font-weight: 800;
        }

        .payload {
            min-height: 190px;
            resize: vertical;
            white-space: pre-wrap;
            line-height: 1.65;
        }

        .small-note {
            margin: 10px 0 0;
            color: var(--muted);
            font-size: 0.82rem;
            line-height: 1.5;
        }

        @media (max-width: 820px) {
            body { padding: 16px; }

            .shell {
                grid-template-columns: 1fr;
            }

            .aside {
                min-height: auto;
                border-right: 0;
                border-bottom: 1px solid var(--border);
            }

            .trust-visual {
                min-height: 150px;
            }

            .shield {
                width: 130px;
            }

            .main {
                padding: 24px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            button,
            .link-button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <main class="shell">
        <aside class="aside">
            <div class="brand">
                <img src="/favicon.svg" alt="">
                <span>NexusVora</span>
            </div>

            <div class="trust-visual" aria-hidden="true">
                <div class="shield">
                    <div class="shield-inner">
                        <div class="shield-lock"></div>
                    </div>
                </div>
            </div>

            <p class="aside-note">
                Este link foi criado para uma unica partilha sensivel. Usa o codigo recebido em separado e fecha a pagina quando terminares.
            </p>
        </aside>

        <section class="main">
            <span class="status-pill">
                <span class="status-dot {{ $share->isExpired() ? 'expired' : '' }}"></span>
                {{ $share->isExpired() ? 'Partilha expirada' : ($unlocked ? 'Acesso desbloqueado' : 'Acesso protegido') }}
            </span>

            <p class="eyebrow">Partilha segura</p>
            <h1>{{ $share->title }}</h1>
            <p class="copy">
                A informacao desta pagina esta protegida por codigo de acesso e fica disponivel apenas ate ao prazo definido.
            </p>

            <div class="notice {{ $share->isExpired() ? 'expired' : '' }}">
                <span class="notice-mark">{{ $share->isExpired() ? '!' : 'i' }}</span>
                <div>
                    @if($share->isExpired())
                        Esta partilha expirou em {{ $share->expires_at->format('d/m/Y H:i') }}. Pede uma nova partilha a quem te enviou este link.
                    @else
                        {{ $share->timeLeftLabel() }}. O codigo de acesso deve ter sido enviado por outro canal.
                    @endif
                </div>
            </div>

            @if(! $share->isExpired() && ! $unlocked)
                <form class="access-card" method="POST" action="{{ route('secure-shares.public.unlock', $share->token) }}">
                    @csrf
                    <div class="form-row">
                        <div>
                            <label for="access_code">Codigo de acesso</label>
                            <input id="access_code" name="access_code" required autofocus autocomplete="one-time-code" placeholder="Introduz o codigo">
                            @error('access_code') <p class="error">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit">Ver dados</button>
                    </div>
                    <p class="small-note">Por seguranca, nao partilhes este codigo no mesmo local onde recebeste o link.</p>
                </form>
            @elseif($unlocked && ! $share->isExpired())
                <section class="secret-card">
                    <div class="secret-grid">
                        @if($share->secure_url)
                            <div class="secret-block">
                                <p class="secret-heading">Link seguro</p>
                                <a href="{{ $share->secure_url }}" class="link-button" target="_blank" rel="noopener noreferrer">Abrir link</a>
                                <p class="small-note">O link abre numa nova janela.</p>
                            </div>
                        @endif

                        @if($share->secret_payload)
                            <div class="secret-block">
                                <p class="secret-heading">Dados partilhados</p>
                                <textarea class="payload" readonly onclick="this.select()">{{ $share->secret_payload }}</textarea>
                                <p class="small-note">Clica dentro da caixa para selecionar o conteudo.</p>
                            </div>
                        @endif
                    </div>
                </section>
            @endif
        </section>
    </main>
</body>
</html>
