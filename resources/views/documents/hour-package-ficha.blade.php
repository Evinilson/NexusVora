<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<style>
    * { margin:0; padding:0; box-sizing:border-box; }
    body { font-family:Arial,sans-serif; font-size:13px; color:#1a1a2e; background:#fff; }

    .header { background:#0a0a1a; color:#fff; padding:22px 40px; }
    .header-table { width:100%; border-collapse:collapse; }
    .header-brand, .header-title { vertical-align:middle; }
    .header-title { text-align:right; color:#fff; font-size:13px; font-weight:bold; }
    .header-logo img { width:34px; height:34px; vertical-align:middle; }
    .header-logo-text { display:inline-block; vertical-align:middle; margin-left:10px; font-size:20px; font-weight:bold; letter-spacing:-0.5px; }
    .header-logo-text .nx { color:#dcebff; }
    .header-logo-text .vr { color:#00d4ff; }
    .header-meta { text-align:right; vertical-align:top; padding-top:5px; font-size:11px; color:#aaa; line-height:1.7; }

    .doc-title { background:linear-gradient(135deg,#0d1b4b,#1a3a7a); color:#fff; padding:20px 40px; }
    .doc-title h1 { font-size:20px; font-weight:700; }
    .doc-title p { font-size:11px; color:#a0b4d0; margin-top:4px; }

    .content { padding:30px 40px; }
    .section { margin-bottom:26px; }
    .section-title { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:#00aacc; border-bottom:1px solid #e0e0e0; padding-bottom:6px; margin-bottom:14px; }

    .info-grid { display:table; width:100%; }
    .info-row { display:table-row; }
    .info-label { display:table-cell; width:35%; padding:6px 10px 6px 0; font-weight:700; color:#555; font-size:12px; vertical-align:top; }
    .info-value { display:table-cell; padding:6px 0; font-size:12px; color:#1a1a2e; }

    .hours-box { display:flex; gap:12px; margin-bottom:10px; }
    .hours-card { flex:1; border:1px solid #e0e0e0; border-radius:8px; padding:16px 12px; text-align:center; }
    .hours-card .val { font-size:26px; font-weight:700; }
    .hours-card .lbl { font-size:10px; color:#888; text-transform:uppercase; letter-spacing:.5px; margin-top:3px; }

    .progress-table { width:100%; height:10px; border-collapse:collapse; table-layout:fixed; margin-top:6px; }
    .progress-table td { height:10px; padding:0; font-size:0; line-height:0; }
    .progress-used { background:#4a6cf7; }
    .progress-remaining { background:#e5e7eb; }

    .highlight-box { background:#f0f7ff; border-left:3px solid #00aacc; padding:14px 18px; border-radius:0 6px 6px 0; }
    .highlight-box p { font-size:12px; line-height:1.7; color:#333; }
    .rich-text { font-size:12px; line-height:1.7; color:#333; }
    .rich-text p, .rich-text ul, .rich-text ol { margin:0 0 8px; }
    .rich-text ul, .rich-text ol { padding-left:20px; }
    .rich-text li > p { margin:0; }
    .rich-text ul ul, .rich-text ol ul, .rich-text ol ol { margin:2px 0 6px; }
    .rich-text h1, .rich-text h2, .rich-text h3 { font-size:13px; color:#0d1b4b; margin:10px 0 6px; }

    .badge { display:inline-block; padding:3px 10px; border-radius:12px; font-size:10px; font-weight:700; text-transform:uppercase; color:#fff; }

    .footer { background:#f8f8f8; border-top:1px solid #e0e0e0; padding:16px 40px; display:flex; justify-content:space-between; }
    .footer div { font-size:10px; color:#888; }
</style>
</head>
<body>

<div class="header">
    <table class="header-table">
        <tr>
            <td class="header-brand">
                <div class="header-logo">
                    <img src="{{ public_path('img/logo/logo-pdf.jpg') }}" alt="NexusVora">
                    <div class="header-logo-text"><span class="nx">Nexus</span><span class="vr">Vora</span></div>
                </div>
            </td>
            <td class="header-title">Ficha de Pacote de Horas</td>
        </tr>
        <tr>
            <td></td>
            <td class="header-meta">
                Ref.: NVH-{{ str_pad($package->id, 4, '0', STR_PAD_LEFT) }}<br>
                Emitido em: {{ now()->format('d/m/Y') }}<br>
                Documento confidencial
            </td>
        </tr>
    </table>
</div>

<div class="doc-title">
    <h1>{{ $package->title }}</h1>
    <p>Ficha de aquisição e âmbito do pacote de horas</p>
</div>

<div class="content">

    {{-- Cliente --}}
    <div class="section">
        <div class="section-title">Dados do Cliente</div>
        <div class="info-grid">
            @if($package->client->company)
            <div class="info-row">
                <div class="info-label">Empresa</div>
                <div class="info-value">{{ $package->client->company }}</div>
            </div>
            @endif
            <div class="info-row">
                <div class="info-label">Responsável</div>
                <div class="info-value">{{ $package->client->name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email</div>
                <div class="info-value">{{ $package->client->email }}</div>
            </div>
            @if($package->client->nif)
            <div class="info-row">
                <div class="info-label">NIF</div>
                <div class="info-value">{{ $package->client->nif }}</div>
            </div>
            @endif
        </div>
    </div>

    {{-- Detalhe do pacote --}}
    <div class="section">
        <div class="section-title">Detalhe do Pacote</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Pacote</div>
                <div class="info-value">{{ $package->title }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Estado</div>
                <div class="info-value"><span class="badge" style="background:{{ $package->statusColor() }}">{{ $package->statusLabel() }}</span></div>
            </div>
            <div class="info-row">
                <div class="info-label">Data de Aquisição</div>
                <div class="info-value">{{ $package->purchased_at->format('d/m/Y') }}</div>
            </div>
            @if($package->expires_at)
            <div class="info-row">
                <div class="info-label">Validade</div>
                <div class="info-value">{{ $package->expires_at->format('d/m/Y') }}</div>
            </div>
            @endif
            @if($package->price)
            <div class="info-row">
                <div class="info-label">Valor</div>
                <div class="info-value"><strong>{{ number_format($package->price, 2, ',', '.') }} €</strong></div>
            </div>
            @endif
            @if($package->project)
            <div class="info-row">
                <div class="info-label">Projeto Associado</div>
                <div class="info-value">{{ $package->project->title }}</div>
            </div>
            @endif
        </div>
    </div>

    {{-- Horas --}}
    <div class="section">
        <div class="section-title">Resumo de Horas</div>
        @php
            $used      = $package->usedHours();
            $remaining = $package->remainingHours();
            $pct       = $package->usedPercent();
        @endphp
        <div class="hours-box">
            <div class="hours-card">
                <div class="val" style="color:#0d1b4b">{{ number_format($package->total_hours, 1) }}h</div>
                <div class="lbl">Total Adquirido</div>
            </div>
            <div class="hours-card">
                <div class="val" style="color:#f59e0b">{{ number_format($used, 1) }}h</div>
                <div class="lbl">Utilizado</div>
            </div>
            <div class="hours-card">
                <div class="val" style="color:#10b981">{{ number_format($remaining, 1) }}h</div>
                <div class="lbl">Disponível</div>
            </div>
            <div class="hours-card">
                <div class="val" style="color:#4a6cf7">{{ $pct }}%</div>
                <div class="lbl">Consumido</div>
            </div>
        </div>
        <div style="font-size:11px;color:#555;margin-bottom:4px;">Utilização do pacote</div>
        <table class="progress-table" aria-label="{{ $pct }}% utilizado">
            <tr>
                @if($pct > 0)
                    <td class="progress-used" style="width:{{ $pct }}%"></td>
                @endif
                @if($pct < 100)
                    <td class="progress-remaining" style="width:{{ 100 - $pct }}%"></td>
                @endif
            </tr>
        </table>
    </div>

    {{-- Âmbito --}}
    @if($package->description)
    <div class="section">
        <div class="section-title">Âmbito e Serviços Incluídos</div>
        <div class="highlight-box rich-text">
            {!! $package->descriptionHtml() !!}
        </div>
    </div>
    @endif

    {{-- Declaração --}}
    <div class="section">
        <div class="section-title">Declaração de Aquisição</div>
        <div class="highlight-box">
            <p>
                O presente documento confirma a aquisição do pacote de horas <strong>{{ $package->title }}</strong>
                pelo cliente <strong>{{ $package->client->company ?: $package->client->name }}</strong>,
                em <strong>{{ $package->purchased_at->format('d \d\e F \d\e Y') }}</strong>.
                As horas serão prestadas pela <strong>NexusVora</strong> conforme acordado,
                com registo detalhado de todas as utilizações disponível a qualquer momento.
            </p>
        </div>
    </div>

</div>

<div class="footer">
    <div>NexusVora — geral@nexusvora.pt · nexusvora.pt</div>
    <div>Documento gerado em {{ now()->format('d/m/Y \à\s H:i') }}</div>
</div>

</body>
</html>
