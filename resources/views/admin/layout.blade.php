<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - NexusVora</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 34px;
            font-weight: 800;
            letter-spacing: 0.02em;
        }

        .brand-mark {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: var(--grad);
            box-shadow: 0 12px 32px rgba(74, 108, 247, 0.35);
        }

        .nav {
            display: grid;
            gap: 8px;
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
            padding: 10px 14px;
            border: 1px solid rgba(251, 113, 133, 0.35);
            border-radius: 8px;
            background: rgba(251, 113, 133, 0.08);
            color: #fecdd3;
            cursor: pointer;
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
                <span class="brand-mark" aria-hidden="true"></span>
                <span>NexusVora Admin</span>
            </a>

            <nav class="nav" aria-label="Administracao">
                <a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a>
                <a href="#">Servicos</a>
                <a href="#">Pedidos de contacto</a>
                <a href="#">Configuracoes</a>
                <a href="{{ route('home') }}">Ver site</a>
            </nav>
        </aside>

        <main class="main">
            <header class="topbar">
                <div>
                    <p class="topbar-user">{{ auth()->user()->email }}</p>
                    <h1 class="topbar-title">@yield('title', 'Admin')</h1>
                </div>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="logout-button" type="submit">Sair</button>
                </form>
            </header>

            <section class="content">
                @yield('content')
            </section>
        </main>
    </div>
</body>
</html>
