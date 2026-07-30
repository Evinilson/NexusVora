@extends('admin.layout')
@section('title', 'Pacotes de Horas')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <h2 style="font-size:20px; font-weight:700; margin:0;">Pacotes de Horas</h2>
    <a href="{{ route('admin.hour-packages.create') }}" style="background:var(--cyan); color:#000; font-weight:700; font-size:13px; padding:10px 20px; border-radius:8px; text-decoration:none;">+ Novo Pacote</a>
</div>

@if(session('success'))
    <div style="background:rgba(16,185,129,.15); border:1px solid #10b981; color:#10b981; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px;">{{ session('success') }}</div>
@endif

@if($packages->isEmpty())
    <div style="text-align:center; padding:60px 0; color:var(--muted); font-size:14px;">
        Nenhum pacote criado ainda.<br>
        <a href="{{ route('admin.hour-packages.create') }}" style="color:var(--cyan); margin-top:8px; display:inline-block;">Criar o primeiro pacote →</a>
    </div>
@else
    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:13px;">
            <thead>
                <tr style="border-bottom:1px solid var(--border);">
                    <th style="text-align:left; padding:10px 14px; color:var(--muted); font-weight:600; font-size:11px; text-transform:uppercase;">Pacote</th>
                    <th style="text-align:left; padding:10px 14px; color:var(--muted); font-weight:600; font-size:11px; text-transform:uppercase;">Cliente</th>
                    <th style="text-align:left; padding:10px 14px; color:var(--muted); font-weight:600; font-size:11px; text-transform:uppercase;">Estado</th>
                    <th style="text-align:left; padding:10px 14px; color:var(--muted); font-weight:600; font-size:11px; text-transform:uppercase;">Horas</th>
                    <th style="text-align:left; padding:10px 14px; color:var(--muted); font-weight:600; font-size:11px; text-transform:uppercase;">Valor</th>
                    <th style="text-align:left; padding:10px 14px; color:var(--muted); font-weight:600; font-size:11px; text-transform:uppercase;">Validade</th>
                    <th style="padding:10px 14px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $pkg)
                @php $pct = $pkg->usedPercent(); @endphp
                <tr style="border-bottom:1px solid var(--border);">
                    <td style="padding:12px 14px; font-weight:600;">
                        <a href="{{ route('admin.hour-packages.show', $pkg) }}" style="color:var(--text);">{{ $pkg->title }}</a>
                    </td>
                    <td style="padding:12px 14px; color:var(--muted);">{{ $pkg->client->company ?: $pkg->client->name }}</td>
                    <td style="padding:12px 14px;">
                        <span style="background:{{ $pkg->statusColor() }}22; color:{{ $pkg->statusColor() }}; border:1px solid {{ $pkg->statusColor() }}44; padding:3px 10px; border-radius:12px; font-size:11px; font-weight:700;">{{ $pkg->statusLabel() }}</span>
                    </td>
                    <td style="padding:12px 14px;">
                        <div style="font-size:12px; color:var(--muted); margin-bottom:4px;">
                            {{ number_format($pkg->usedHours(), 1) }}h / {{ number_format($pkg->total_hours, 1) }}h
                        </div>
                        <div style="background:rgba(255,255,255,.08); border-radius:4px; height:5px; width:100px; overflow:hidden;">
                            <div style="height:5px; border-radius:4px; background:linear-gradient(90deg,#00d4ff,#4a6cf7); width:{{ $pct }}%;"></div>
                        </div>
                    </td>
                    <td style="padding:12px 14px; color:var(--muted); font-size:12px;">{{ $pkg->price ? number_format($pkg->price, 2, ',', '.') . ' €' : '—' }}</td>
                    <td style="padding:12px 14px; color:var(--muted); font-size:12px;">{{ $pkg->expires_at ? $pkg->expires_at->format('d/m/Y') : '—' }}</td>
                    <td style="padding:12px 14px; text-align:right; white-space:nowrap;">
                        <a href="{{ route('admin.hour-packages.show', $pkg) }}" style="color:var(--cyan); font-size:12px; margin-right:12px;">Ver</a>
                        <a href="{{ route('admin.hour-packages.edit', $pkg) }}" style="color:var(--muted); font-size:12px;">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
