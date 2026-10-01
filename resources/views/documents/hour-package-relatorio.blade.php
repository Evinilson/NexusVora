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

    .kpi-grid { display:flex; gap:12px; margin-bottom:10px; }
    .kpi-card { flex:1; border:1px solid #e0e0e0; border-radius:8px; padding:14px 10px; text-align:center; }
    .kpi-card .val { font-size:24px; font-weight:700; }
    .kpi-card .lbl { font-size:10px; color:#888; text-transform:uppercase; letter-spacing:.5px; margin-top:3px; }

    .progress-table { width:100%; height:10px; border-collapse:collapse; table-layout:fixed; margin-top:4px; }
    .progress-table td { height:10px; padding:0; font-size:0; line-height:0; }
    .progress-used { background:#4a6cf7; }
    .progress-remaining { background:#e5e7eb; }
    .package-meta { border-collapse:collapse; margin-top:14px; font-size:12px; color:#555; }
    .package-meta td { padding:0 16px 0 0; vertical-align:middle; white-space:nowrap; }
    .package-meta .badge { vertical-align:middle; line-height:1.2; margin-left:3px; }

    table.entries { width:100%; border-collapse:collapse; font-size:12px; }
    table.entries th { background:#0d1b4b; color:#fff; padding:9px 12px; text-align:left; font-size:11px; }
    table.entries td { padding:9px 12px; border-bottom:1px solid #eee; vertical-align:top; }
    table.entries tr:nth-child(even) td { background:#f9f9f9; }
    table.entries .entry-desc { font-size:11px; color:#666; margin-top:2px; }
    .tasks-row td { padding:0 12px 10px; background:#f9f9f9; }
    .task-list { width:100%; border-collapse:collapse; }
    .task-list td { padding:8px 0; border-top:1px solid #e5e7eb; vertical-align:top; background:transparent; }
    .task-list tr:first-child td { border-top:0; }
    .task-title { width:31%; padding-right:12px !important; font-size:11px; font-weight:700; color:#0d1b4b; }
    .task-desc { width:59%; font-size:10px; color:#666; line-height:1.45; }
    .task-status { display:inline-block; margin-top:5px; padding:2px 6px; border-radius:8px; font-size:8px; font-weight:700; text-transform:uppercase; color:#fff; }
    table.entries tfoot td { background:#f0f4ff; font-weight:700; border-top:2px solid #0d1b4b; }

    .badge { display:inline-block; padding:3px 10px; border-radius:12px; font-size:10px; font-weight:700; text-transform:uppercase; color:#fff; }
    .highlight-box { background:#f0f7ff; border-left:3px solid #00aacc; padding:14px 18px; border-radius:0 6px 6px 0; }
    .highlight-box p { font-size:12px; line-height:1.7; color:#333; }

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
            <td class="header-title">Relatório de Uso de Horas</td>
        </tr>
        <tr>
            <td></td>
            <td class="header-meta">
                Ref.: NVH-{{ str_pad($package->id, 4, '0', STR_PAD_LEFT) }}<br>
                Gerado em: {{ now()->format('d/m/Y') }}<br>
                Documento confidencial
            </td>
        </tr>
    </table>
</div>

<div class="doc-title">
    <h1>{{ $package->title }}</h1>
    <p>Relatório detalhado de utilização — {{ $package->client->company ?: $package->client->name }}</p>
</div>

<div class="content">

    @php
        $used      = $package->usedHours();
        $remaining = $package->remainingHours();
        $pct       = $package->usedPercent();
        $pctColor  = $pct >= 90 ? '#ef4444' : ($pct >= 60 ? '#f59e0b' : '#10b981');
    @endphp

    {{-- KPIs --}}
    <div class="section">
        <div class="section-title">Resumo do Pacote</div>
        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="val" style="color:#0d1b4b">{{ number_format($package->total_hours, 1) }}h</div>
                <div class="lbl">Total</div>
            </div>
            <div class="kpi-card">
                <div class="val" style="color:#f59e0b">{{ number_format($used, 1) }}h</div>
                <div class="lbl">Utilizado</div>
            </div>
            <div class="kpi-card">
                <div class="val" style="color:#10b981">{{ number_format($remaining, 1) }}h</div>
                <div class="lbl">Disponível</div>
            </div>
            <div class="kpi-card">
                <div class="val" style="color:{{ $pctColor }}">{{ $pct }}%</div>
                <div class="lbl">Consumido</div>
            </div>
            <div class="kpi-card">
                <div class="val" style="color:#6b7280">{{ $package->entries->count() }}</div>
                <div class="lbl">Registos</div>
            </div>
        </div>
        <div style="font-size:11px;color:#555;margin-bottom:4px;margin-top:4px;">Utilização acumulada</div>
        <table class="progress-table" aria-label="{{ $pct }}% utilizado">
            <tr>
                @if($pct > 0)
                    <td class="progress-used" style="width:{{ $pct }}%; background:{{ $pctColor }}"></td>
                @endif
                @if($pct < 100)
                    <td class="progress-remaining" style="width:{{ 100 - $pct }}%"></td>
                @endif
            </tr>
        </table>

        <table class="package-meta">
            <tr>
                <td><strong>Estado:</strong> <span class="badge" style="background:{{ $package->statusColor() }}">{{ $package->statusLabel() }}</span></td>
                <td><strong>Adquirido em:</strong> {{ $package->purchased_at->format('d/m/Y') }}</td>
            @if($package->expires_at)
                <td><strong>Validade:</strong> {{ $package->expires_at->format('d/m/Y') }}</td>
            @endif
            @if($package->price)
                <td><strong>Valor:</strong> {{ number_format($package->price, 2, ',', '.') }} €</td>
            @endif
            </tr>
        </table>
    </div>

    {{-- Registos de utilização --}}
    <div class="section">
        <div class="section-title">Detalhe de Utilização</div>
        @if($package->entries->count())
        <table class="entries">
            <thead>
                <tr>
                    <th style="width:12%">Data</th>
                    <th style="width:65%">Trabalho Realizado</th>
                    <th style="width:11%; text-align:right">Horas</th>
                    <th style="width:12%; text-align:right">Acum.</th>
                </tr>
            </thead>
            <tbody>
                @php $acum = 0; @endphp
                @foreach($package->entries->sortBy('performed_at') as $entry)
                @php $acum += (float)$entry->hours; @endphp
                <tr>
                    <td>{{ $entry->performed_at->format('d/m/Y') }}</td>
                    <td>
                        <strong>{{ $entry->title }}</strong>
                        @if($entry->description)
                        <div class="entry-desc">{{ $entry->description }}</div>
                        @endif
                    </td>
                    <td style="text-align:right; font-weight:700; color:#f59e0b">{{ number_format($entry->hours, 1) }}h</td>
                    <td style="text-align:right; color:#6b7280">{{ number_format($acum, 1) }}h</td>
                </tr>
                @if($entry->tasks->isNotEmpty())
                <tr class="tasks-row">
                    <td></td>
                    <td colspan="3">
                        <table class="task-list">
                            @foreach($entry->tasks as $task)
                            <tr>
                                <td class="task-title">
                                    {{ $task->title }}<br>
                                    <span class="task-status" style="background:{{ $task->statusColor() }}">{{ $task->statusLabel() }}</span>
                                </td>
                                <td class="task-desc">{{ $task->description ?: 'Sem descrição.' }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="padding:9px 12px; font-weight:700;">Total Utilizado</td>
                    <td style="padding:9px 12px; text-align:right; font-weight:700; color:#f59e0b;">{{ number_format($used, 1) }}h</td>
                    <td style="padding:9px 12px; text-align:right; color:#10b981; font-weight:700;">{{ number_format($remaining, 1) }}h restantes</td>
                </tr>
            </tfoot>
        </table>
        @else
        <p style="color:#888; font-size:12px; padding:16px 0;">Nenhuma utilização registada ainda.</p>
        @endif
    </div>

    {{-- Nota --}}
    <div class="section">
        <div class="section-title">Nota</div>
        <div class="highlight-box">
            <p>
                Este relatório reflete o estado de utilização do pacote <strong>{{ $package->title }}</strong>
                à data de <strong>{{ now()->format('d \d\e F \d\e Y') }}</strong>.
                Para questões, contacte <strong>geral@nexusvora.pt</strong>.
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
