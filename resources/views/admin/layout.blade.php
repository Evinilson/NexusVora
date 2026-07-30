<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - NexusVora</title>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* Flatpickr — tema NexusVora */
        .flatpickr-calendar {
            background: #0f1733;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            font-family: Inter, system-ui, sans-serif;
            color: #f8fafc;
            padding: 8px;
        }
        .flatpickr-months { padding: 6px 4px 2px; }
        .flatpickr-month { color: #f8fafc; fill: #f8fafc; }
        .flatpickr-current-month { font-size: 14px; font-weight: 600; color: #f8fafc; }
        .flatpickr-current-month .flatpickr-monthDropdown-months {
            background: #0f1733;
            color: #f8fafc;
            font-weight: 600;
        }
        .flatpickr-current-month .flatpickr-monthDropdown-months option {
            background: #0f1733;
            color: #f8fafc;
        }
        .flatpickr-current-month input.cur-year { color: #f8fafc; font-weight: 600; }
        .flatpickr-prev-month, .flatpickr-next-month { fill: #94a3b8 !important; }
        .flatpickr-prev-month:hover, .flatpickr-next-month:hover { fill: #00d4ff !important; }
        .flatpickr-weekdays { background: transparent; margin-bottom: 2px; }
        span.flatpickr-weekday { color: #4a6cf7; font-weight: 700; font-size: 11px; background: transparent; }
        .flatpickr-day {
            color: #cbd5e1;
            border-radius: 8px;
            border: none;
            font-size: 13px;
            height: 34px;
            line-height: 34px;
        }
        .flatpickr-day:hover { background: rgba(74,108,247,0.2); color: #fff; }
        .flatpickr-day.today { border: 1px solid #4a6cf7; color: #fff; }
        .flatpickr-day.today:hover { background: rgba(74,108,247,0.2); }
        .flatpickr-day.selected, .flatpickr-day.selected:hover {
            background: linear-gradient(135deg, #00d4ff, #4a6cf7);
            color: #fff;
            border: none;
            font-weight: 700;
        }
        .flatpickr-day.prevMonthDay, .flatpickr-day.nextMonthDay { color: rgba(148,163,184,0.3); }
        .flatpickr-day.disabled { color: rgba(148,163,184,0.2); }
        .flatpickr-innerContainer { border: none; }
        .flatpickr-rContainer { width: 100%; }
        .dayContainer { width: 100%; min-width: unset; max-width: unset; }
        .flatpickr-days { width: 100%; border: none; }

        /* Flatpickr altInput — mesmo estilo dos outros inputs */
        .flatpickr-input.form-control,
        input.flatpickr-input[readonly] {
            width: 100% !important;
            background: var(--surface) !important;
            border: 1px solid var(--border) !important;
            color: var(--text) !important;
            padding: 10px 14px !important;
            border-radius: 8px !important;
            font-size: 14px !important;
            font-family: Inter, system-ui, sans-serif !important;
            cursor: pointer;
            box-sizing: border-box !important;
        }
        input.flatpickr-input[readonly]:focus {
            outline: none !important;
            border-color: rgba(0, 212, 255, 0.4) !important;
        }

        /* Remover setas dos inputs numéricos */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] { -moz-appearance: textfield; }
    </style>
    <style>
        :root {
            --bg: #060b20;
            --surface: #0f1733;
            --surface-2: #111936;
            --border: rgba(255, 255, 255, 0.08);
            --text: #f8fafc;
            --muted: #94a3b8;
            --cyan: #00d4ff;
            --blue: #4a6cf7;
            --purple: #8b3fdb;
            --danger: #fb7185;
            --grad: linear-gradient(135deg, var(--cyan), var(--blue), var(--purple));
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
            font-family: Inter, system-ui, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input {
            font: inherit;
        }

        .admin-shell {
            display: grid;
            grid-template-columns: 260px 1fr;
            min-height: 100vh;
        }

        .sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            padding: 24px;
            border-right: 1px solid var(--border);
            background: rgba(10, 15, 46, 0.82);
            display: flex;
            flex-direction: column;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 34px;
            font-weight: 800;
            font-size: 1.3rem;
            letter-spacing: -0.02em;
            text-decoration: none;
        }

        .brand-logo {
            width: 36px;
            height: 36px;
            flex-shrink: 0;
        }

        .brand-name span:first-child { color: #DCEBFF; }
        .brand-name span:last-child  { color: var(--cyan); }

        .nav {
            display: grid;
            gap: 8px;
        }

        .sidebar-account {
            margin-top: auto;
            padding-top: 22px;
            border-top: 1px solid var(--border);
            display: grid;
            gap: 12px;
        }

        .sidebar-user-label {
            margin: 0 0 4px;
            color: var(--muted);
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .sidebar-user-email {
            margin: 0;
            color: var(--text);
            font-size: 0.86rem;
            font-weight: 700;
            line-height: 1.35;
            overflow-wrap: anywhere;
        }

        .nav a {
            padding: 12px 14px;
            border-radius: 8px;
            color: var(--muted);
            font-size: 0.95rem;
            font-weight: 600;
        }

        .nav a.active,
        .nav a:hover {
            background: rgba(255, 255, 255, 0.06);
            color: var(--text);
        }

        .main {
            min-width: 0;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 22px 32px;
            border-bottom: 1px solid var(--border);
            background: rgba(6, 11, 32, 0.76);
        }

        .topbar-title {
            margin: 0;
            font-size: 1.2rem;
        }

        .topbar-user {
            color: var(--muted);
            font-size: 0.9rem;
        }

        .content {
            padding: 32px;
        }

        .logout-button {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid rgba(251, 113, 133, 0.35);
            border-radius: 8px;
            background: rgba(251, 113, 133, 0.08);
            color: #fecdd3;
            cursor: pointer;
            font-weight: 700;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .stat {
            min-height: 132px;
            padding: 20px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--surface);
        }

        .stat-label {
            margin: 0 0 16px;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .stat-value {
            margin: 0;
            font-size: 2.2rem;
            font-weight: 800;
        }

        .panel {
            margin-top: 24px;
            padding: 24px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--surface-2);
        }

        .panel h2 {
            margin: 0 0 10px;
            font-size: 1.1rem;
        }

        .panel p {
            max-width: 760px;
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }

@media (max-width: 900px) {
            .admin-shell {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
                height: auto;
                border-right: 0;
                border-bottom: 1px solid var(--border);
            }

            .sidebar-account {
                margin-top: 22px;
            }

            .grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 560px) {
            .topbar,
            .content,
            .sidebar {
                padding: 20px;
            }

            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="admin-shell">
        <aside class="sidebar">
            <a href="{{ route('admin.dashboard') }}" class="brand">
                <svg class="brand-logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" fill="none" aria-hidden="true">
                    <defs>
                        <linearGradient id="ng-admin" x1="0" y1="0" x2="60" y2="60" gradientUnits="userSpaceOnUse">
                            <stop offset="0%" stop-color="#00D4FF"/>
                            <stop offset="50%" stop-color="#4A6CF7"/>
                            <stop offset="100%" stop-color="#8B3FDB"/>
                        </linearGradient>
                    </defs>
                    <circle cx="30" cy="30" r="7" stroke="url(#ng-admin)" stroke-width="2.5" fill="none"/>
                    <circle cx="30" cy="30" r="3" fill="url(#ng-admin)"/>
                    <line x1="30" y1="23" x2="30" y2="10" stroke="url(#ng-admin)" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="30" cy="8" r="3" fill="url(#ng-admin)"/>
                    <line x1="30" y1="37" x2="30" y2="50" stroke="url(#ng-admin)" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="30" cy="52" r="3" fill="url(#ng-admin)"/>
                    <line x1="23" y1="30" x2="10" y2="30" stroke="url(#ng-admin)" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="8" cy="30" r="3" fill="url(#ng-admin)"/>
                    <line x1="37" y1="30" x2="50" y2="30" stroke="url(#ng-admin)" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="52" cy="30" r="3" fill="url(#ng-admin)"/>
                    <line x1="25" y1="25" x2="16" y2="16" stroke="url(#ng-admin)" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="13.5" cy="13.5" r="3" fill="url(#ng-admin)"/>
                    <line x1="35" y1="35" x2="44" y2="44" stroke="url(#ng-admin)" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="46.5" cy="46.5" r="3" fill="url(#ng-admin)"/>
                    <line x1="35" y1="25" x2="44" y2="16" stroke="url(#ng-admin)" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="46.5" cy="13.5" r="3" fill="url(#ng-admin)"/>
                    <line x1="25" y1="35" x2="16" y2="44" stroke="url(#ng-admin)" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="13.5" cy="46.5" r="3" fill="url(#ng-admin)"/>
                </svg>
                <span class="brand-name"><span>Nexus</span><span>Vora</span></span>
            </a>

            <nav class="nav" aria-label="Administracao">
                <a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')])>Dashboard</a>
                <a href="{{ route('admin.clients.index') }}" @class(['active' => request()->routeIs('admin.clients.*')])>Clientes</a>
                <a href="{{ route('admin.projects.index') }}" @class(['active' => request()->routeIs('admin.projects.*')])>Projetos</a>
                <a href="{{ route('admin.hour-packages.index') }}" @class(['active' => request()->routeIs('admin.hour-packages.*')])>Pacotes de Horas</a>
                <a href="{{ route('admin.secure-shares.index') }}" @class(['active' => request()->routeIs('admin.secure-shares.*')])>Partilhas seguras</a>
                <a href="#">Servicos</a>
                <a href="#">Pedidos de contacto</a>
                <a href="#">Configuracoes</a>
                <a href="{{ route('home') }}">Ver site</a>
            </nav>

            <div class="sidebar-account">
                <div>
                    <p class="sidebar-user-label">Sessao iniciada</p>
                    <p class="sidebar-user-email">{{ auth()->user()->email }}</p>
                </div>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="logout-button" type="submit">Sair</button>
                </form>
            </div>
        </aside>

        <main class="main">
            <header class="topbar">
                <div>
                    <h1 class="topbar-title">@yield('title', 'Admin')</h1>
                </div>
            </header>

            <section class="content">
                @yield('content')
            </section>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
    <script>
        flatpickr.localize(flatpickr.l10ns.pt);
        document.querySelectorAll('input[type="date"]').forEach(function (el) {
            var fp = flatpickr(el, {
                dateFormat: 'Y-m-d',
                altInput: true,
                altFormat: 'd/m/Y',
                allowInput: true,
                disableMobile: true,
                onReady: function (_, __, instance) {
                    var alt = instance.altInput;
                    alt.style.background  = 'var(--surface)';
                    alt.style.border      = '1px solid var(--border)';
                    alt.style.color       = 'var(--text)';
                    alt.style.padding     = '10px 14px';
                    alt.style.borderRadius = '8px';
                    alt.style.fontSize    = '14px';
                    alt.style.fontFamily  = 'Inter, system-ui, sans-serif';
                    alt.style.width       = '100%';
                    alt.style.boxSizing   = 'border-box';
                    alt.style.cursor      = 'pointer';
                },
            });
        });
    </script>
</body>
</html>
