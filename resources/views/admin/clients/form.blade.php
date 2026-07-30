@extends('admin.layout')
@section('title', $client->exists ? 'Editar Cliente' : 'Novo Cliente')

@section('content')
<div style="max-width:600px;">
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:28px;">
        <a href="{{ route('admin.clients.index') }}" style="display:inline-flex; align-items:center; gap:6px; padding:7px 14px; border-radius:8px; background:linear-gradient(135deg,#00d4ff,#4a6cf7,#8b3fdb); color:#fff; font-size:12px; font-weight:700; letter-spacing:.3px; text-decoration:none;">
            ← Clientes
        </a>
        <h2 style="font-size:20px; font-weight:700; margin:0;">{{ $client->exists ? 'Editar Cliente' : 'Novo Cliente' }}</h2>
    </div>

    @if($errors->any())
        <div style="background:rgba(251,113,133,.15); border:1px solid var(--danger); color:var(--danger); padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px;">
            <ul style="margin:0; padding-left:18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ $client->exists ? route('admin.clients.update', $client) : route('admin.clients.store') }}" style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        @if($client->exists) @method('PUT') @endif

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Nome do Responsável *</label>
                <input type="text" name="name" value="{{ old('name', $client->name) }}" required
                    style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
            </div>
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Empresa</label>
                <input type="text" name="company" value="{{ old('company', $client->company) }}"
                    style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Email *</label>
                <input type="email" name="email" value="{{ old('email', $client->email) }}" required
                    style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
            </div>
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Telefone</label>
                <input type="text" name="phone" value="{{ old('phone', $client->phone) }}"
                    style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">NIF</label>
                <input type="text" name="nif" value="{{ old('nif', $client->nif) }}"
                    style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
            </div>
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Morada</label>
                <input type="text" name="address" value="{{ old('address', $client->address) }}"
                    style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
            </div>
        </div>

        <div style="display:flex; gap:12px; padding-top:8px;">
            <button id="submit-btn" type="submit"
                @if($client->exists) disabled @endif
                style="background:var(--cyan); color:#000; font-weight:700; font-size:14px; padding:12px 28px; border-radius:8px; border:none; cursor:pointer; transition:opacity .2s; {{ $client->exists ? 'opacity:.35; cursor:not-allowed;' : '' }}">
                {{ $client->exists ? 'Guardar Alterações' : 'Criar Cliente' }}
            </button>
            <a href="{{ route('admin.clients.index') }}" style="padding:12px 20px; font-size:14px; color:var(--muted); border:1px solid var(--border); border-radius:8px; display:inline-flex; align-items:center;">Cancelar</a>
        </div>
    </form>

    @if($client->exists)
    <script>
        (function () {
            var form    = document.querySelector('form');
            var btn     = document.getElementById('submit-btn');
            var initial = new FormData(form);

            function hasChanged() {
                var current = new FormData(form);
                for (var [key, val] of current.entries()) {
                    if (val !== (initial.get(key) ?? '')) return true;
                }
                return false;
            }

            form.addEventListener('input', function () {
                var changed = hasChanged();
                btn.disabled = !changed;
                btn.style.opacity = changed ? '1' : '.35';
                btn.style.cursor  = changed ? 'pointer' : 'not-allowed';
            });
        })();
    </script>
    @endif
</div>
@endsection
