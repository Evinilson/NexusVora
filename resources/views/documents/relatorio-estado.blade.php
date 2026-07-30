<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: Arial, sans-serif; font-size: 13px; color: #1a1a2e; background: #fff; }

    .header { background: #0a0a1a; color: #fff; padding: 22px 40px; }
    .header-table { width: 100%; border-collapse: collapse; }
    .header-brand, .header-title { vertical-align: middle; }
    .header-title { text-align: right; color: #fff; font-size: 13px; font-weight: bold; }
    .header-logo img { width: 34px; height: 34px; vertical-align: middle; }
    .header-logo-text { display: inline-block; vertical-align: middle; margin-left: 10px; font-size: 20px; font-weight: bold; letter-spacing: -0.5px; }
    .header-logo-text .nx { color: #dcebff; }
    .header-logo-text .vr { color: #00d4ff; }
    .header-meta { text-align: right; vertical-align: top; padding-top: 5px; font-size: 11px; color: #aaa; line-height: 1.7; }

    .doc-title { background: linear-gradient(135deg, #0d1b4b, #1a3a7a); color: #fff; padding: 20px 40px; }
    .doc-title h1 { font-size: 20px; font-weight: 700; }
    .doc-title p { font-size: 11px; color: #a0b4d0; margin-top: 4px; }

    .content { padding: 30px 40px; }

    .section { margin-bottom: 28px; }
    .section-title { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #00aacc; border-bottom: 1px solid #e0e0e0; padding-bottom: 6px; margin-bottom: 14px; }

    .info-grid { display: table; width: 100%; }
    .info-row { display: table-row; }
    .info-label { display: table-cell; width: 35%; padding: 7px 10px 7px 0; font-weight: 700; color: #555; font-size: 12px; vertical-align: top; }
    .info-value { display: table-cell; padding: 7px 0; color: #1a1a2e; font-size: 12px; }

    .kpi-grid { display: flex; gap: 12px; margin-bottom: 10px; }
    .kpi-card { flex: 1; border: 1px solid #e0e0e0; border-radius: 8px; padding: 16px 12px; text-align: center; }
    .kpi-card .kpi-val { font-size: 28px; font-weight: 700; }
    .kpi-card .kpi-lbl { font-size: 10px; color: #888; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 3px; }
    .kpi-card .kpi-sub { font-size: 10px; color: #aaa; margin-top: 2px; }

    .progress-table { width: 100%; height: 10px; border-collapse: collapse; table-layout: fixed; }
    .progress-table td { height: 10px; padding: 0; font-size: 0; line-height: 0; }
    .progress-remaining { background: #e5e7eb; }

    .tasks-done-list { list-style: none; padding: 0; }
    .tasks-done-list li { padding: 7px 12px; font-size: 12px; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; gap: 10px; }
    .tasks-done-list li .dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }

    .highlight-box { background: #f0f7ff; border-left: 3px solid #00aacc; padding: 14px 18px; border-radius: 0 6px 6px 0; }
    .highlight-box p { font-size: 12px; line-height: 1.7; color: #333; }

    .badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 10px; font-weight: 700; text-transform: uppercase; color: #fff; }

    table.docs-table { width: 100%; border-collapse: collapse; font-size: 11px; }
    table.docs-table th { background: #0d1b4b; color: #fff; padding: 8px 12px; text-align: left; }
    table.docs-table td { padding: 7px 12px; border-bottom: 1px solid #eee; }
    table.docs-table tr:nth-child(even) td { background: #f9f9f9; }

    .footer { background: #f8f8f8; border-top: 1px solid #e0e0e0; padding: 16px 40px; display: flex; justify-content: space-between; }
    .footer div { font-size: 10px; color: #888; }
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
            <td class="header-title">Relatório de Estado</td>
        </tr>
        <tr>
            <td></td>
            <td class="header-meta">
                Projeto: NV-{{ str_pad($project->id, 4, '0', STR_PAD_LEFT) }}<br>
                Data: {{ now()->format('d/m/Y') }}<br>
                Documento confidencial
            </td>
        </tr>
    </table>
</div>

<div class="doc-title">
    <h1>{{ $project->title }}</h1>
    <p>Relatório de estado e progresso — {{ $project->client->company ?: $project->client->name }}</p>
</div>

<div class="content">

    @php
        $total      = $project->tasks->count();
        $concluidas = $project->tasks->where('status', 'concluido')->count();
        $emProgresso = $project->tasks->where('status', 'em_progresso')->count();
        $pendentes  = $project->tasks->whereIn('status', ['a_fazer', 'bloqueado'])->count();
        $pct        = $total > 0 ? round(($concluidas / $total) * 100) : 0;

        $pctColor = $pct >= 75 ? '#10b981' : ($pct >= 40 ? '#f59e0b' : '#ef4444');
    @endphp

    {{-- Informação do Projeto --}}
    <div class="section">
        <div class="section-title">Identificação do Projeto</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Cliente</div>
                <div class="info-value">{{ $project->client->company ?: $project->client->name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Projeto</div>
                <div class="info-value">{{ $project->title }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Estado Atual</div>
                <div class="info-value"><span class="badge" style="background: {{ $project->statusColor() }}">{{ $project->statusLabel() }}</span></div>
            </div>
            @if($project->start_date)
            <div class="info-row">
                <div class="info-label">Início</div>
                <div class="info-value">{{ $project->start_date->format('d/m/Y') }}</div>
            </div>
            @endif
            @if($project->end_date)
            <div class="info-row">
                <div class="info-label">Entrega Prevista</div>
                <div class="info-value">{{ $project->end_date->format('d/m/Y') }}</div>
            </div>
            @endif
        </div>
    </div>

    {{-- KPIs de Progresso --}}
    <div class="section">
        <div class="section-title">Indicadores de Progresso</div>
        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-val" style="color: {{ $pctColor }}">{{ $pct }}%</div>
                <div class="kpi-lbl">Concluído</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-val" style="color:#10b981">{{ $concluidas }}</div>
                <div class="kpi-lbl">Tarefas Concluídas</div>
                <div class="kpi-sub">de {{ $total }} totais</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-val" style="color:#f59e0b">{{ $emProgresso }}</div>
                <div class="kpi-lbl">Em Progresso</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-val" style="color:#6b7280">{{ $pendentes }}</div>
                <div class="kpi-lbl">Pendentes</div>
            </div>
        </div>
        <div style="font-size:11px; color:#555; margin-bottom:5px; margin-top:4px;">Progresso geral do projeto</div>
        <table class="progress-table" aria-label="{{ $pct }}% concluído">
            <tr>
                @if($pct > 0)
                    <td style="width: {{ $pct }}%; background: {{ $pctColor }}"></td>
                @endif
                @if($pct < 100)
                    <td class="progress-remaining" style="width: {{ 100 - $pct }}%"></td>
                @endif
            </tr>
        </table>
    </div>

    {{-- Tarefas por estado --}}
    @if($project->tasks->count())
    <div class="section">
        <div class="section-title">Estado das Tarefas</div>
        <ul class="tasks-done-list">
            @foreach($project->tasks as $task)
            <li>
                <span class="dot" style="background: {{ $task->statusColor() }}"></span>
                <span style="flex:1">{{ $task->title }}</span>
                <span class="badge" style="background: {{ $task->statusColor() }}">{{ $task->statusLabel() }}</span>
                @if($task->due_date)
                <span style="font-size:10px; color:#aaa; margin-left:8px">{{ $task->due_date->format('d/m/Y') }}</span>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Histórico de documentos enviados --}}
    @if($project->documentLogs->count())
    <div class="section">
        <div class="section-title">Documentos Anteriormente Enviados</div>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Tipo de Documento</th>
                    <th>Enviado Para</th>
                    <th>Data de Envio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($project->documentLogs as $log)
                <tr>
                    <td>{{ $log->typeLabel() }}</td>
                    <td>{{ $log->sent_to_email }}</td>
                    <td>{{ $log->sent_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    {{-- Nota --}}
    <div class="section">
        <div class="section-title">Nota da NexusVora</div>
        <div class="highlight-box">
            <p>
                Este relatório reflete o estado do projeto <strong>{{ $project->title }}</strong> à data de
                <strong>{{ now()->format('d \d\e F \d\e Y') }}</strong>.
                Para questões ou esclarecimentos, contacte-nos através de
                <strong>geral@nexusvora.pt</strong> ou pelo telefone indicado no seu contrato.
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
