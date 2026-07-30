<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link indisponivel - NexusVora</title>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #060b20;
            --surface: #0d1530;
            --border: rgba(255,255,255,0.1);
            --text: #f8fafc;
            --muted: #94a3b8;
            --cyan: #00d4ff;
            --danger: #fb7185;
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 24px;
            background:
                radial-gradient(circle at 16% 18%, rgba(0,212,255,0.18), transparent 28%),
                radial-gradient(circle at 84% 14%, rgba(251,113,133,0.14), transparent 26%),
                linear-gradient(135deg, #060b20 0%, #080f2a 52%, #0d1028 100%);
            color: var(--text);
            font-family: Inter, system-ui, sans-serif;
        }

        .card {
            width: min(620px, 100%);
            padding: 34px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: linear-gradient(180deg, rgba(17,25,54,0.96), rgba(10,15,46,0.96));
            box-shadow: 0 28px 80px rgba(0,0,0,0.42);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
            font-size: 1.2rem;
            font-weight: 800;
        }

        .brand img {
            width: 36px;
            height: 36px;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border: 1px solid rgba(251,113,133,0.28);
            border-radius: 999px;
            background: rgba(251,113,133,0.08);
            color: #fecdd3;
            font-size: 0.82rem;
            font-weight: 800;
        }

        .dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--danger);
        }

        h1 {
            margin: 22px 0 0;
            font-size: clamp(1.85rem, 5vw, 3rem);
            line-height: 1.05;
        }

        p {
            margin: 14px 0 0;
            color: var(--muted);
            line-height: 1.7;
            font-size: 1rem;
        }

        .notice {
            margin-top: 24px;
            padding: 16px;
            border: 1px solid rgba(0,212,255,0.16);
            border-radius: 8px;
            background: rgba(0,212,255,0.06);
            color: #c4eefd;
        }
    </style>
</head>
<body>
    <main class="card">
        <div class="brand">
            <img src="/favicon.svg" alt="">
            <span>NexusVora</span>
        </div>

        <span class="pill"><span class="dot"></span>Link indisponivel</span>

        <h1>Este link seguro nao esta disponivel</h1>
        <p>
            O endereco pode estar incompleto, ter sido digitado incorretamente, ou a partilha pode ja nao existir.
        </p>

        <div class="notice">
            Confirma se copiaste o link completo. Se o problema continuar, pede uma nova partilha a quem te enviou o acesso.
        </div>
    </main>
</body>
</html>
