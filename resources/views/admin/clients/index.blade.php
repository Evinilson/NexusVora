@extends('admin.layout')
@section('title', 'Clientes')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <h2 style="font-size:20px; font-weight:700; margin:0;">Clientes</h2>
    <a href="{{ route('admin.clients.create') }}" style="background:var(--cyan); color:#000; font-weight:700; font-size:13px; padding:10px 20px; border-radius:8px; text-decoration:none;">+ Novo Cliente</a>
</div>

@if(session('success'))
    <div style="background:rgba(16,185,129,.15); border:1px solid #10b981; color:#10b981; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px;">
        {{ session('success') }}
    </div>
@endif

@if($clients->isEmpty())
    <div style="text-align:center; padding:60px 0; color:var(--muted); font-size:14px;">
        Nenhum cliente registado ainda.<br>
        <a href="{{ route('admin.clients.create') }}" style="color:var(--cyan); margin-top:8px; display:inline-block;">Criar o primeiro cliente →</a>
    </div>
@else
    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:13px;">
            <thead>
                <tr style="border-bottom:1px solid var(--border);">
                    <th style="text-align:left; padding:10px 14px; color:var(--muted); font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:.5px;">Nome</th>
                    <th style="text-align:left; padding:10px 14px; color:var(--muted); font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:.5px;">Empresa</th>
                    <th style="text-align:left; padding:10px 14px; color:var(--muted); font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:.5px;">Email</th>
                    <th style="text-align:left; padding:10px 14px; color:var(--muted); font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:.5px;">Telefone</th>
                    <th style="text-align:center; padding:10px 14px; color:var(--muted); font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:.5px;">Projetos</th>
                    <th style="padding:10px 14px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr style="border-bottom:1px solid var(--border);">
                    <td style="padding:12px 14px; font-weight:600;">{{ $client->name }}</td>
                    <td style="padding:12px 14px; color:var(--muted);">{{ $client->company ?? '—' }}</td>
                    <td style="padding:12px 14px; color:var(--muted);">{{ $client->email }}</td>
                    <td style="padding:12px 14px; color:var(--muted);">{{ $client->phone ?? '—' }}</td>
                    <td style="padding:12px 14px; text-align:center;">
                        <span style="background:rgba(74,108,247,.2); color:#7c9cff; padding:3px 10px; border-radius:12px; font-size:11px; font-weight:700;">{{ $client->projects_count }}</span>
                    </td>
                    <td style="padding:12px 14px; text-align:right; white-space:nowrap;">
                        <a href="{{ route('admin.clients.edit', $client) }}" style="color:var(--cyan); font-size:12px; margin-right:12px;">Editar</a>
                        <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" style="display:inline;" onsubmit="return confirm('Eliminar este cliente e todos os seus projetos?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:var(--danger); font-size:12px; cursor:pointer; padding:0;">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
