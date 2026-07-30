@extends('admin.layout')
@section('title', 'Projetos')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <h2 style="font-size:20px; font-weight:700; margin:0;">Projetos</h2>
    <a href="{{ route('admin.projects.create') }}" style="background:var(--cyan); color:#000; font-weight:700; font-size:13px; padding:10px 20px; border-radius:8px; text-decoration:none;">+ Novo Projeto</a>
</div>

@if(session('success'))
    <div style="background:rgba(16,185,129,.15); border:1px solid #10b981; color:#10b981; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px;">
        {{ session('success') }}
    </div>
@endif

@if($projects->isEmpty())
    <div style="text-align:center; padding:60px 0; color:var(--muted); font-size:14px;">
        Nenhum projeto criado ainda.<br>
        <a href="{{ route('admin.projects.create') }}" style="color:var(--cyan); margin-top:8px; display:inline-block;">Criar o primeiro projeto →</a>
    </div>
@else
    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:13px;">
            <thead>
                <tr style="border-bottom:1px solid var(--border);">
                    <th style="text-align:left; padding:10px 14px; color:var(--muted); font-weight:600; font-size:11px; text-transform:uppercase;">Projeto</th>
                    <th style="text-align:left; padding:10px 14px; color:var(--muted); font-weight:600; font-size:11px; text-transform:uppercase;">Cliente</th>
                    <th style="text-align:left; padding:10px 14px; color:var(--muted); font-weight:600; font-size:11px; text-transform:uppercase;">Estado</th>
                    <th style="text-align:left; padding:10px 14px; color:var(--muted); font-weight:600; font-size:11px; text-transform:uppercase;">Entrega</th>
                    <th style="text-align:left; padding:10px 14px; color:var(--muted); font-weight:600; font-size:11px; text-transform:uppercase;">Orçamento</th>
                    <th style="padding:10px 14px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr style="border-bottom:1px solid var(--border);">
                    <td style="padding:12px 14px; font-weight:600;">
                        <a href="{{ route('admin.projects.show', $project) }}" style="color:var(--text);">{{ $project->title }}</a>
                    </td>
                    <td style="padding:12px 14px; color:var(--muted);">{{ $project->client->company ?: $project->client->name }}</td>
                    <td style="padding:12px 14px;">
                        <span style="background:{{ $project->statusColor() }}22; color:{{ $project->statusColor() }}; border:1px solid {{ $project->statusColor() }}44; padding:3px 10px; border-radius:12px; font-size:11px; font-weight:700;">
                            {{ $project->statusLabel() }}
                        </span>
                    </td>
                    <td style="padding:12px 14px; color:var(--muted); font-size:12px;">{{ $project->end_date ? $project->end_date->format('d/m/Y') : '—' }}</td>
                    <td style="padding:12px 14px; color:var(--muted); font-size:12px;">{{ $project->budget ? number_format($project->budget, 2, ',', '.') . ' €' : '—' }}</td>
                    <td style="padding:12px 14px; text-align:right; white-space:nowrap;">
                        <a href="{{ route('admin.projects.show', $project) }}" style="color:var(--cyan); font-size:12px; margin-right:12px;">Ver</a>
                        <a href="{{ route('admin.projects.edit', $project) }}" style="color:var(--muted); font-size:12px;">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
