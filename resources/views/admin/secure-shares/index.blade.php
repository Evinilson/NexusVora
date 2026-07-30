@extends('admin.layout')

@section('title', 'Partilhas seguras')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:18px; margin-bottom:24px;">
        <div>
            <h2 style="font-size:20px; font-weight:800; margin:0;">Partilhas seguras</h2>
            <p style="margin:8px 0 0; color:var(--muted); max-width:760px; line-height:1.6;">
                Envia links ou dados sensiveis com codigo de acesso e prazo de expiracao.
            </p>
        </div>
        <a href="{{ route('admin.secure-shares.create') }}" style="background:var(--cyan); color:#00111a; font-weight:800; font-size:13px; padding:10px 18px; border-radius:8px; text-decoration:none; white-space:nowrap;">+ Nova partilha</a>
    </div>

    @if(session('success'))
        <div style="background:rgba(16,185,129,.15); border:1px solid #10b981; color:#10b981; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px;">
            {{ session('success') }}
        </div>
    @endif

    @if($shares->isEmpty())
        <section style="border:1px solid var(--border); border-radius:8px; background:var(--surface-2); padding:48px 24px; text-align:center;">
            <h3 style="margin:0 0 8px; font-size:18px;">Ainda nao existem partilhas</h3>
            <p style="margin:0 0 18px; color:var(--muted);">Cria uma partilha temporaria para enviar credenciais, links privados ou notas sensiveis.</p>
            <a href="{{ route('admin.secure-shares.create') }}" style="color:var(--cyan); font-weight:800;">Criar primeira partilha</a>
        </section>
    @else
        <div style="overflow-x:auto; border:1px solid var(--border); border-radius:8px; background:var(--surface-2);">
            <table style="width:100%; border-collapse:collapse; font-size:13px;">
                <thead>
                    <tr style="border-bottom:1px solid var(--border);">
                        <th style="text-align:left; padding:12px 14px; color:var(--muted); font-weight:700; font-size:11px; text-transform:uppercase; letter-spacing:.5px;">Partilha</th>
                        <th style="text-align:left; padding:12px 14px; color:var(--muted); font-weight:700; font-size:11px; text-transform:uppercase; letter-spacing:.5px;">Destinatario</th>
                        <th style="text-align:left; padding:12px 14px; color:var(--muted); font-weight:700; font-size:11px; text-transform:uppercase; letter-spacing:.5px;">Estado</th>
                        <th style="text-align:left; padding:12px 14px; color:var(--muted); font-weight:700; font-size:11px; text-transform:uppercase; letter-spacing:.5px;">Link publico</th>
                        <th style="text-align:right; padding:12px 14px; color:var(--muted); font-weight:700; font-size:11px; text-transform:uppercase; letter-spacing:.5px;">Acessos</th>
                        <th style="padding:12px 14px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shares as $share)
                        @php $publicUrl = route('secure-shares.public.show', $share->token); @endphp
                        <tr style="border-bottom:1px solid var(--border);">
                            <td style="padding:14px; min-width:190px;">
                                <div style="font-weight:800;">{{ $share->title }}</div>
                                <div style="color:var(--muted); font-size:12px; margin-top:4px;">Criada em {{ $share->created_at->format('d/m/Y H:i') }}</div>
                            </td>
                            <td style="padding:14px; color:var(--muted); min-width:180px;">
                                <div>{{ $share->recipient_name ?: '—' }}</div>
                                <div style="font-size:12px;">{{ $share->recipient_email ?: '' }}</div>
                            </td>
                            <td style="padding:14px; min-width:150px;">
                                <span style="display:inline-flex; padding:4px 10px; border-radius:999px; background:{{ $share->statusColor() }}22; color:{{ $share->statusColor() }}; border:1px solid {{ $share->statusColor() }}55; font-size:11px; font-weight:800;">{{ $share->statusLabel() }}</span>
                                <div style="color:var(--muted); font-size:12px; margin-top:6px;">{{ $share->timeLeftLabel() }}</div>
                            </td>
                            <td style="padding:14px; min-width:280px;">
                                <input readonly value="{{ $publicUrl }}" onclick="this.select()" style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:9px 10px; border-radius:8px; font-size:12px;">
                            </td>
                            <td style="padding:14px; text-align:right; color:var(--muted);">{{ $share->access_count }}</td>
                            <td style="padding:14px; text-align:right;">
                                <form method="POST" action="{{ route('admin.secure-shares.destroy', $share) }}" onsubmit="return confirm('Eliminar esta partilha segura?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:none; border:0; color:var(--danger); font-size:12px; cursor:pointer; padding:0;">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
