<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NexusVora</title>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #060b20;
            --surface: #0f1733;
            --surface-2: #111936;
            --border: rgba(255, 255, 255, 0.09);
            --text: #f8fafc;
            --muted: #94a3b8;
            --cyan: #00d4ff;
            --blue: #4a6cf7;
            --purple: #8b3fdb;
            --danger: #fb7185;
            --grad: linear-gradient(135deg, var(--cyan), var(--blue), var(--purple));
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 28px;
            background:
                radial-gradient(circle at 15% 12%, rgba(0, 212, 255, 0.2), transparent 28%),
                radial-gradient(circle at 86% 18%, rgba(74, 108, 247, 0.22), transparent 30%),
                radial-gradient(circle at 68% 88%, rgba(139, 63, 219, 0.16), transparent 26%),
                var(--bg);
            color: var(--text);
            font-family: Inter, system-ui, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .login-shell {
            width: min(980px, 100%);
            min-height: 620px;
            display: grid;
            grid-template-columns: minmax(0, 0.92fr) minmax(360px, 1.08fr);
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: rgba(10, 15, 46, 0.88);
            box-shadow: 0 30px 90px rgba(0, 0, 0, 0.42);
        }

        .brand-panel {
            position: relative;
            padding: 34px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-right: 1px solid var(--border);
            background:
                radial-gradient(circle at 50% 24%, rgba(0, 212, 255, 0.17), transparent 34%),
                linear-gradient(180deg, rgba(17, 25, 54, 0.96), rgba(8, 13, 36, 0.98));
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            width: fit-content;
        }

        .brand-logo svg {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
        }

        .brand-logo-text {
            font-family: "Plus Jakarta Sans", Inter, sans-serif;
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .brand-logo-text span:first-child { color: #dcebff; }
        .brand-logo-text span:last-child { color: var(--cyan); }

        .network-visual {
            min-height: 270px;
            display: grid;
            place-items: center;
        }

        .rotating-logo {
            position: relative;
            width: min(230px, 78%);
            aspect-ratio: 1;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background:
                radial-gradient(circle at center, rgba(6, 11, 32, 0.96) 0 45%, transparent 46%),
                conic-gradient(from 210deg, rgba(0,212,255,0.2), rgba(74,108,247,0.3), rgba(139,63,219,0.22), rgba(0,212,255,0.2));
            box-shadow: 0 24px 70px rgba(0, 0, 0, 0.34);
        }

        .rotating-logo::before {
            content: "";
            position: absolute;
            inset: 18%;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(6, 11, 32, 0.74);
        }

        .rotating-logo svg {
            position: relative;
            z-index: 1;
            width: 136px;
            height: 136px;
            animation: logoSpin 16s linear infinite;
            filter: drop-shadow(0 12px 26px rgba(0, 212, 255, 0.16));
        }

        @keyframes logoSpin {
            to { transform: rotate(360deg); }
        }

        @media (prefers-reduced-motion: reduce) {
            .rotating-logo svg {
                animation: none;
            }
        }

        .brand-note {
            margin: 0;
            color: var(--muted);
            line-height: 1.65;
        }

        .login-panel {
            padding: 46px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background:
                linear-gradient(180deg, rgba(17, 25, 54, 0.78), rgba(10, 15, 46, 0.92));
        }

        .eyebrow {
            margin: 0 0 10px;
            color: var(--cyan);
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            font-family: "Plus Jakarta Sans", Inter, sans-serif;
            font-size: clamp(2rem, 4vw, 3rem);
            line-height: 1.06;
            letter-spacing: 0;
        }

        .intro {
            max-width: 520px;
            margin: 14px 0 30px;
            color: var(--muted);
            line-height: 1.7;
        }

        .login-form {
            display: grid;
            gap: 17px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        label {
            color: #dbeafe;
            font-size: 0.9rem;
            font-weight: 800;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            min-height: 48px;
            padding: 13px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: rgba(6, 11, 32, 0.72);
            color: var(--text);
            font: inherit;
            outline: 0;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: rgba(0, 212, 255, 0.56);
            box-shadow: 0 0 0 4px rgba(0, 212, 255, 0.11);
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        .remember {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .remember input {
            width: 16px;
            height: 16px;
            accent-color: var(--cyan);
        }

        .error {
            margin: 0;
            padding: 12px 14px;
            border: 1px solid rgba(251, 113, 133, 0.38);
            border-radius: 8px;
            background: rgba(251, 113, 133, 0.09);
            color: #fecdd3;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .submit {
            width: 100%;
            min-height: 50px;
            border: 0;
            border-radius: 8px;
            background: var(--grad);
            color: white;
            cursor: pointer;
            font: inherit;
            font-weight: 800;
            box-shadow: 0 14px 34px rgba(74, 108, 247, 0.28);
        }

        .submit:hover {
            filter: brightness(1.04);
        }

        .back {
            display: inline-flex;
            width: fit-content;
            margin-top: 22px;
            color: var(--muted);
            font-size: 0.92rem;
        }

        .back:hover {
            color: var(--text);
        }

        @media (max-width: 840px) {
            body { padding: 16px; }

            .login-shell {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .brand-panel {
                min-height: auto;
                border-right: 0;
                border-bottom: 1px solid var(--border);
                gap: 28px;
            }

            .network-visual {
                min-height: 150px;
            }

            .rotating-logo {
                width: 145px;
            }

            .rotating-logo svg {
                width: 88px;
                height: 88px;
            }

            .login-panel {
                padding: 30px 24px;
            }
        }
    </style>
</head>
<body>
    <main class="login-shell">
        <aside class="brand-panel">
            <a href="{{ route('home') }}" class="brand-logo" aria-label="NexusVora">
                <svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="ng-login" x1="0" y1="0" x2="60" y2="60" gradientUnits="userSpaceOnUse">
                            <stop offset="0%" stop-color="#00D4FF"/>
                            <stop offset="50%" stop-color="#4A6CF7"/>
                            <stop offset="100%" stop-color="#8B3FDB"/>
                        </linearGradient>
                    </defs>
                    <circle cx="30" cy="30" r="7" stroke="url(#ng-login)" stroke-width="2.5" fill="none"/>
                    <circle cx="30" cy="30" r="3" fill="url(#ng-login)"/>
                    <line x1="30" y1="23" x2="30" y2="10" stroke="url(#ng-login)" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="30" cy="8" r="3" fill="url(#ng-login)"/>
                    <line x1="30" y1="37" x2="30" y2="50" stroke="url(#ng-login)" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="30" cy="52" r="3" fill="url(#ng-login)"/>
                    <line x1="23" y1="30" x2="10" y2="30" stroke="url(#ng-login)" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="8" cy="30" r="3" fill="url(#ng-login)"/>
                    <line x1="37" y1="30" x2="50" y2="30" stroke="url(#ng-login)" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="52" cy="30" r="3" fill="url(#ng-login)"/>
                    <line x1="25" y1="25" x2="16" y2="16" stroke="url(#ng-login)" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="13.5" cy="13.5" r="3" fill="url(#ng-login)"/>
                    <line x1="35" y1="35" x2="44" y2="44" stroke="url(#ng-login)" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="46.5" cy="46.5" r="3" fill="url(#ng-login)"/>
                    <line x1="35" y1="25" x2="44" y2="16" stroke="url(#ng-login)" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="46.5" cy="13.5" r="3" fill="url(#ng-login)"/>
                    <line x1="25" y1="35" x2="16" y2="44" stroke="url(#ng-login)" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="13.5" cy="46.5" r="3" fill="url(#ng-login)"/>
                </svg>
                <span class="brand-logo-text"><span>Nexus</span><span>Vora</span></span>
            </a>

            <div class="network-visual" aria-hidden="true">
                <div class="rotating-logo">
                    <svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="30" cy="30" r="7" stroke="url(#ng-login)" stroke-width="2.5" fill="none"/>
                        <circle cx="30" cy="30" r="3" fill="url(#ng-login)"/>
                        <line x1="30" y1="23" x2="30" y2="10" stroke="url(#ng-login)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="30" cy="8" r="3" fill="url(#ng-login)"/>
                        <line x1="30" y1="37" x2="30" y2="50" stroke="url(#ng-login)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="30" cy="52" r="3" fill="url(#ng-login)"/>
                        <line x1="23" y1="30" x2="10" y2="30" stroke="url(#ng-login)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="8" cy="30" r="3" fill="url(#ng-login)"/>
                        <line x1="37" y1="30" x2="50" y2="30" stroke="url(#ng-login)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="52" cy="30" r="3" fill="url(#ng-login)"/>
                        <line x1="25" y1="25" x2="16" y2="16" stroke="url(#ng-login)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="13.5" cy="13.5" r="3" fill="url(#ng-login)"/>
                        <line x1="35" y1="35" x2="44" y2="44" stroke="url(#ng-login)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="46.5" cy="46.5" r="3" fill="url(#ng-login)"/>
                        <line x1="35" y1="25" x2="44" y2="16" stroke="url(#ng-login)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="46.5" cy="13.5" r="3" fill="url(#ng-login)"/>
                        <line x1="25" y1="35" x2="16" y2="44" stroke="url(#ng-login)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="13.5" cy="46.5" r="3" fill="url(#ng-login)"/>
                    </svg>
                </div>
            </div>

            <p class="brand-note">
                Painel interno NexusVora para gerir clientes, projetos, pacotes de horas e partilhas seguras.
            </p>
        </aside>

        <section class="login-panel">
            <p class="eyebrow">nv-console</p>
            <h1>Acesso interno</h1>
            <p class="intro">
                Entra na consola privada para acompanhar operacao, documentos e informacao sensivel do sistema.
            </p>

            <form class="login-form" method="POST" action="{{ route('admin.login.store') }}">
                @csrf

                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required>
                </div>

                @if ($errors->any())
                    <p class="error">{{ $errors->first() }}</p>
                @endif

                <div class="remember-row">
                    <label class="remember">
                        <input name="remember" type="checkbox" value="1">
                        <span>Manter sessao iniciada</span>
                    </label>
                </div>

                <button class="submit" type="submit">Entrar na consola</button>
            </form>

            <a class="back" href="{{ route('home') }}">Voltar ao site</a>
        </section>
    </main>
</body>
</html>
