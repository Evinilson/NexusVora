@extends('admin.layout')
@section('title', 'Tarefas')

@section('content')
@php
    $openTasks = $tasks->where('status', '!=', 'concluido')->count();
    $overdueTasks = $tasks->filter(fn ($task) => $task->status !== 'concluido' && $task->due_date?->isPast())->count();
@endphp
<div style="display:flex; justify-content:space-between; align-items:flex-start; gap:16px; margin-bottom:24px; flex-wrap:wrap;">
    <div>
        <h2 style="font-size:20px; font-weight:700; margin:0;">Tarefas</h2>
        <p style="margin:7px 0 0; color:var(--muted); font-size:13px;">Uma visão única do trabalho pendente em todos os clientes e projetos.</p>
    </div>
    <div style="display:flex; gap:10px; font-size:12px;">
        <span style="padding:7px 11px; border-radius:8px; background:rgba(0,212,255,.1); color:var(--cyan);">{{ $openTasks }} por concluir</span>
        @if($overdueTasks)<span style="padding:7px 11px; border-radius:8px; background:rgba(239,68,68,.12); color:#fb7185;">{{ $overdueTasks }} em atraso</span>@endif
    </div>
</div>

<form method="GET" style="display:flex; gap:10px; margin-bottom:20px; flex-wrap:wrap;">
    <select name="client_id" style="min-width:200px; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:9px 12px; border-radius:8px; font-size:13px;">
        <option value="">Todos os clientes</option>
        @foreach($clients as $client)<option value="{{ $client->id }}" @selected(($filters['client_id'] ?? '') == $client->id)>{{ $client->company ?: $client->name }}</option>@endforeach
    </select>
    <select name="status" style="min-width:170px; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:9px 12px; border-radius:8px; font-size:13px;">
        <option value="">Todos os estados</option>
        <option value="a_fazer" @selected(($filters['status'] ?? '') === 'a_fazer')>A Fazer</option>
        <option value="em_progresso" @selected(($filters['status'] ?? '') === 'em_progresso')>Em Progresso</option>
        <option value="bloqueado" @selected(($filters['status'] ?? '') === 'bloqueado')>Bloqueado</option>
        <option value="concluido" @selected(($filters['status'] ?? '') === 'concluido')>Concluído</option>
    </select>
    <button type="submit" style="background:var(--cyan); color:#000; border:none; font-weight:700; padding:9px 16px; border-radius:8px; cursor:pointer;">Filtrar</button>
    @if(request()->hasAny(['client_id', 'status']))<a href="{{ route('admin.tasks.index') }}" style="color:var(--muted); padding:9px 4px; font-size:13px;">Limpar</a>@endif
</form>

<div style="background:var(--surface); border:1px solid var(--border); border-radius:12px; overflow:hidden;">
    @forelse($tasks as $task)
    @php $isOverdue = $task->status !== 'concluido' && $task->due_date?->isPast(); @endphp
    <div style="display:grid; grid-template-columns:minmax(220px,1.5fr) minmax(130px,.8fr) minmax(130px,.8fr) 105px 100px; gap:16px; align-items:center; padding:16px 20px; border-bottom:1px solid var(--border);">
        <div>
            <a href="{{ $task->project ? route('admin.projects.show', $task->project) : route('admin.hour-packages.show', $task->hourPackage) }}" style="font-size:14px; font-weight:700; color:var(--text);">{{ $task->title }}</a>
            <div style="font-size:11px; color:var(--muted); margin-top:5px;">
                @if($task->project)
                    {{ $task->project->client->company ?: $task->project->client->name }} · {{ $task->project->title }}
                @else
                    {{ $task->hourPackage->client->company ?: $task->hourPackage->client->name }} · tarefa do pacote
                @endif
            </div>
        </div>
        <div style="font-size:12px; color:var(--muted);">{{ $task->hourPackage?->title ?? 'Sem pacote associado' }}</div>
        <div style="font-size:12px; color:{{ $isOverdue ? '#fb7185' : 'var(--muted)' }};">{{ $task->due_date ? ($isOverdue ? 'Atrasada: ' : '') . $task->due_date->format('d/m/Y') : 'Sem prazo' }}</div>
        <span style="font-size:10px; font-weight:700; padding:4px 8px; border-radius:10px; background:{{ $task->statusColor() }}22; color:{{ $task->statusColor() }}; text-align:center;">{{ $task->statusLabel() }}</span>
        <a href="{{ $task->project ? route('admin.projects.show', $task->project) : route('admin.hour-packages.show', $task->hourPackage) }}" style="font-size:12px; color:var(--cyan); text-align:right;">Abrir →</a>
    </div>
    @empty
    <div style="padding:48px 20px; text-align:center; color:var(--muted); font-size:13px;">Não existem tarefas com estes filtros. Cria tarefas dentro de cada projeto.</div>
    @endforelse
</div>
@endsection
