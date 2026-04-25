<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - NexusVora</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #060b20;
            --surface: #0f1733;
            --border: rgba(255, 255, 255, 0.09);
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
            display: grid;
            place-items: center;
            padding: 24px;
            background:
                radial-gradient(circle at top left, rgba(0, 212, 255, 0.16), transparent 34%),
                radial-gradient(circle at bottom right, rgba(139, 63, 219, 0.18), transparent 34%),
                var(--bg);
            color: var(--text);
            font-family: Inter, system-ui, sans-serif;
        }

        a {
            color: inherit;
        }

        .login-card {
            width: min(100%, 430px);
            padding: 32px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: rgba(15, 23, 51, 0.88);
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.28);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 28px;
            font-weight: 800;
        }

        .brand-mark {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--grad);
        }

        h1 {
            margin: 0 0 10px;
            font-size: 1.65rem;
        }

        .intro {
            margin: 0 0 28px;
            color: var(--muted);
            line-height: 1.6;
        }

        .field {
            display: grid;
            gap: 8px;
            margin-bottom: 18px;
        }

        label {
            color: #dbeafe;
            font-size: 0.92rem;
            font-weight: 700;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: rgba(6, 11, 32, 0.8);
            color: var(--text);
            outline: 0;
        }

        input:focus {
            border-color: rgba(0, 212, 255, 0.55);
            box-shadow: 0 0 0 4px rgba(0, 212, 255, 0.12);
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 2px 0 22px;
            color: var(--muted);
            font-size: 0.92rem;
        }

        .error {
            margin: -4px 0 16px;
            color: #fecdd3;
            font-size: 0.9rem;
        }

        .submit {
            width: 100%;
            padding: 14px 18px;
            border: 0;
            border-radius: 8px;
            background: var(--grad);
            color: white;
            cursor: pointer;
            font-weight: 800;
        }

        .back {
            display: block;
            margin-top: 20px;
            color: var(--muted);
            font-size: 0.92rem;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <main class="login-card">
        <div class="brand">
            <span class="brand-mark" aria-hidden="true"></span>
            <span>NexusVora</span>
        </div>

        <h1>Area de administrador</h1>
        <p class="intro">Acede ao painel interno para gerir conteudo, pedidos de contacto e configuracoes do site.</p>

        <form method="POST" action="{{ route('admin.login.store') }}">
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

            <label class="remember">
                <input name="remember" type="checkbox" value="1">
                <span>Manter sessao iniciada</span>
            </label>

            <button class="submit" type="submit">Entrar</button>
        </form>

        <a class="back" href="{{ route('home') }}">Voltar ao site</a>
    </main>
</body>
</html>
