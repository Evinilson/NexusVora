<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<style>
    * { margin:0; padding:0; box-sizing:border-box; }
    body { font-family:Arial,sans-serif; font-size:12px; color:#1a1a2e; background:#fff; }
    .header { background:#0a0a1a; color:#fff; padding:22px 40px; }
    .header-table { width:100%; border-collapse:collapse; }
    .header-title { text-align:right; color:#fff; font-size:13px; font-weight:bold; }
    .header-logo img { width:34px; height:34px; vertical-align:middle; }
    .header-logo-text { display:inline-block; vertical-align:middle; margin-left:10px; font-size:20px; font-weight:bold; letter-spacing:-0.5px; }
    .nx { color:#dcebff; } .vr { color:#00d4ff; }
    .header-meta { text-align:right; vertical-align:top; padding-top:5px; font-size:11px; color:#aaa; line-height:1.7; }
    .doc-title { background:linear-gradient(135deg,#0d1b4b,#1a3a7a); color:#fff; padding:20px 40px; }
    .doc-title h1 { font-size:20px; font-weight:700; } .doc-title p { font-size:11px; color:#a0b4d0; margin-top:4px; }
    .content { padding:30px 40px; } .section { margin-bottom:26px; }
    .section-title { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:#00aacc; border-bottom:1px solid #e0e0e0; padding-bottom:6px; margin-bottom:14px; }
    .kpis { width:100%; border-collapse:separate; border-spacing:8px 0; margin:0 -8px; }
    .kpis td { width:25%; border:1px solid #e0e0e0; border-radius:8px; padding:12px 8px; text-align:center; }
    .kpi-val { font-size:22px; font-weight:700; } .kpi-label { font-size:9px; color:#888; text-transform:uppercase; letter-spacing:.5px; margin-top:3px; }
    .task { border:1px solid #e1e6ef; border-radius:8px; margin-bottom:10px; page-break-inside:avoid; }
    .task-head { width:100%; border-collapse:collapse; background:#f6f9ff; } .task-head td { padding:10px 12px; vertical-align:top; }
    .task-title { font-size:13px; font-weight:700; color:#0d1b4b; } .task-date { color:#666; font-size:10px; text-align:right; white-space:nowrap; }
    .badge { display:inline-block; margin-top:5px; padding:3px 8px; border-radius:10px; color:#fff; font-size:9px; font-weight:700; text-transform:uppercase; }
    .task-body { padding:10px 12px; color:#555; font-size:11px; line-height:1.5; }
    .subtasks { margin:0 12px 12px 26px; border-left:2px solid #9addeb; padding-left:12px; }
    .subtask { border-top:1px solid #e7ebf0; padding:8px 0; } .subtask:first-child { border-top:0; }
    .subtask-title { color:#1c356d; font-size:11px; font-weight:700; } .subtask-desc { color:#666; font-size:10px; line-height:1.45; margin-top:3px; }
    .empty { color:#888; padding:16px 0; }
    .footer { position:fixed; bottom:0; left:0; right:0; background:#f8f8f8; border-top:1px solid #e0e0e0; padding:16px 40px; } .footer table { width:100%; } .footer td { font-size:10px; color:#888; } .footer td:last-child { text-align:right; }
</style>
</head>
<body>
<div class="header">
    <table class="header-table"><tr><td><div class="header-logo"><img src="{{ public_path('img/logo/logo-pdf.jpg') }}" alt="NexusVora"><div class="header-logo-text"><span class="nx">Nexus</span><span class="vr">Vora</span></div></div></td><td class="header-title">Relatório de Tarefas</td></tr><tr><td></td><td class="header-meta">Ref.: NVT-{{ str_pad($package->id, 4, '0', STR_PAD_LEFT) }}<br>Gerado em: {{ now()->format('d/m/Y') }}<br>Documento confidencial</td></tr></table>
</div>
<div class="doc-title"><h1>{{ $package->title }}</h1><p>Planeamento e estado das tarefas — {{ $package->client->company ?: $package->client->name }}</p></div>
<div class="content">
    @php
        $tasks = $package->tasks;
        $total = $tasks->count();
        $completed = $tasks->where('status', 'concluido')->count();
        $inProgress = $tasks->where('status', 'em_progresso')->count();
        $blocked = $tasks->where('status', 'bloqueado')->count();
    @endphp
    <div class="section"><div class="section-title">Resumo</div><table class="kpis"><tr><td><div class="kpi-val" style="color:#0d1b4b">{{ $total }}</div><div class="kpi-label">Tarefas</div></td><td><div class="kpi-val" style="color:#10b981">{{ $completed }}</div><div class="kpi-label">Concluídas</div></td><td><div class="kpi-val" style="color:#f59e0b">{{ $inProgress }}</div><div class="kpi-label">Em progresso</div></td><td><div class="kpi-val" style="color:#ef4444">{{ $blocked }}</div><div class="kpi-label">Bloqueadas</div></td></tr></table></div>
    <div class="section"><div class="section-title">Tarefas do Pacote</div>
        @forelse($tasks->whereNull('parent_task_id') as $task)
        <div class="task">
            <table class="task-head"><tr><td><div class="task-title">{{ $task->title }}</div><span class="badge" style="background:{{ $task->statusColor() }}">{{ $task->statusLabel() }}</span></td><td class="task-date">@if($task->due_date)Prazo: {{ $task->due_date->format('d/m/Y') }}@endif</td></tr></table>
            @if($task->description)<div class="task-body">{{ $task->description }}</div>@endif
            @if($task->subtasks->isNotEmpty())<div class="subtasks">@foreach($task->subtasks as $subtask)<div class="subtask"><div class="subtask-title">{{ $subtask->title }} <span class="badge" style="background:{{ $subtask->statusColor() }}; margin:0 0 0 5px; vertical-align:middle;">{{ $subtask->statusLabel() }}</span></div>@if($subtask->description)<div class="subtask-desc">{{ $subtask->description }}</div>@endif</div>@endforeach</div>@endif
        </div>
        @empty
        <p class="empty">Ainda não existem tarefas neste pacote.</p>
        @endforelse
    </div>
</div>
<div class="footer"><table><tr><td>NexusVora — geral@nexusvora.pt · nexusvora.pt</td><td>Documento gerado em {{ now()->format('d/m/Y \à\s H:i') }}</td></tr></table></div>
</body>
</html>
