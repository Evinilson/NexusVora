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

    .summary-bar { display: flex; gap: 12px; margin-bottom: 24px; }
    .summary-card { flex: 1; background: #f8f9ff; border: 1px solid #e0e8ff; border-radius: 8px; padding: 14px; text-align: center; }
    .summary-card .num { font-size: 24px; font-weight: 700; color: #0d1b4b; }
    .summary-card .lbl { font-size: 10px; color: #888; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 2px; }

    table.tasks-table { width: 100%; border-collapse: collapse; font-size: 12px; }
    table.tasks-table th { background: #0d1b4b; color: #fff; padding: 10px 14px; text-align: left; font-size: 11px; }
    table.tasks-table td { padding: 10px 14px; border-bottom: 1px solid #eee; vertical-align: top; }
    table.tasks-table tr:nth-child(even) td { background: #f9f9f9; }
    table.tasks-table .task-desc { font-size: 11px; color: #666; margin-top: 3px; }

    .badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 10px; font-weight: 700; text-transform: uppercase; color: #fff; }
    .check-box { width: 14px; height: 14px; border: 2px solid #ccc; border-radius: 3px; display: inline-block; }
    .check-box.done { background: #10b981; border-color: #10b981; }

    .footer { background: #f8f8f8; border-top: 1px solid #e0e0e0; padding: 16px 40px; display: flex; justify-content: space-between; }
    .footer div { font-size: 10px; color: #888; }

    .progress-table { width: 100%; height: 8px; border-collapse: collapse; table-layout: fixed; margin-top: 6px; }
    .progress-table td { height: 8px; padding: 0; font-size: 0; line-height: 0; }
    .progress-used { background: #10b981; }
    .progress-remaining { background: #e5e7eb; }
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
            <td class="header-title">Lista de Tarefas</td>
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
    <p>Lista de tarefas e estado de execução — {{ $project->client->company ?: $project->client->name }}</p>
</div>

<div class="content">

    @php
        $total     = $project->tasks->count();
        $concluidas = $project->tasks->where('status', 'concluido')->count();
        $emProgresso = $project->tasks->where('status', 'em_progresso')->count();
        $aFazer    = $project->tasks->where('status', 'a_fazer')->count();
        $bloqueadas = $project->tasks->where('status', 'bloqueado')->count();
        $pct       = $total > 0 ? round(($concluidas / $total) * 100) : 0;
    @endphp

    {{-- Resumo --}}
    <div class="section">
        <div class="section-title">Resumo de Progresso</div>
        <div class="summary-bar">
            <div class="summary-card">
                <div class="num">{{ $total }}</div>
                <div class="lbl">Total</div>
            </div>
            <div class="summary-card">
                <div class="num" style="color:#10b981">{{ $concluidas }}</div>
                <div class="lbl">Concluídas</div>
            </div>
            <div class="summary-card">
                <div class="num" style="color:#f59e0b">{{ $emProgresso }}</div>
                <div class="lbl">Em Progresso</div>
            </div>
            <div class="summary-card">
                <div class="num" style="color:#6b7280">{{ $aFazer }}</div>
                <div class="lbl">A Fazer</div>
            </div>
            <div class="summary-card">
                <div class="num" style="color:#ef4444">{{ $bloqueadas }}</div>
                <div class="lbl">Bloqueadas</div>
            </div>
        </div>
        <div style="font-size:11px; color:#555; margin-bottom:4px;">Progresso geral: <strong>{{ $pct }}%</strong></div>
        <table class="progress-table" aria-label="{{ $pct }}% concluído">
            <tr>
                @if($pct > 0)
                    <td class="progress-used" style="width: {{ $pct }}%"></td>
                @endif
                @if($pct < 100)
                    <td class="progress-remaining" style="width: {{ 100 - $pct }}%"></td>
                @endif
            </tr>
        </table>
    </div>

    {{-- Tabela de tarefas --}}
    @if($total)
    <div class="section">
        <div class="section-title">Detalhe das Tarefas</div>
        <table class="tasks-table">
            <thead>
                <tr>
                    <th style="width:4%">#</th>
                    <th style="width:44%">Tarefa</th>
                    <th style="width:18%">Prazo</th>
                    <th style="width:20%">Estado</th>
                    <th style="width:14%; text-align:center">Feito</th>
                </tr>
            </thead>
            <tbody>
                @foreach($project->tasks as $i => $task)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        {{ $task->title }}
                        @if($task->description)
                        <div class="task-desc">{{ $task->description }}</div>
                        @endif
                    </td>
                    <td>{{ $task->due_date ? $task->due_date->format('d/m/Y') : '—' }}</td>
                    <td><span class="badge" style="background: {{ $task->statusColor() }}">{{ $task->statusLabel() }}</span></td>
                    <td style="text-align:center">
                        <span class="check-box {{ $task->status === 'concluido' ? 'done' : '' }}"></span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="section">
        <p style="color:#888; font-size:12px;">Nenhuma tarefa registada para este projeto.</p>
    </div>
    @endif

</div>

<div class="footer">
    <div>NexusVora — geral@nexusvora.pt · nexusvora.pt</div>
    <div>Documento gerado em {{ now()->format('d/m/Y \à\s H:i') }}</div>
</div>

</body>
</html>
