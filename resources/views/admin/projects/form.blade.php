@extends('admin.layout')
@section('title', $project->exists ? 'Editar Projeto' : 'Novo Projeto')

@section('content')
<div style="max-width:680px;">
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:28px;">
        <a href="{{ route('admin.projects.index') }}" style="display:inline-flex; align-items:center; gap:6px; padding:7px 14px; border-radius:8px; background:linear-gradient(135deg,#00d4ff,#4a6cf7,#8b3fdb); color:#fff; font-size:12px; font-weight:700; letter-spacing:.3px; text-decoration:none;">
            ← Projetos
        </a>
        <h2 style="font-size:20px; font-weight:700; margin:0;">{{ $project->exists ? 'Editar Projeto' : 'Novo Projeto' }}</h2>
    </div>

    @if($errors->any())
        <div style="background:rgba(251,113,133,.15); border:1px solid var(--danger); color:var(--danger); padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px;">
            <ul style="margin:0; padding-left:18px;">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form id="project-form" method="POST" action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}" style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        @if($project->exists) @method('PUT') @endif

        <div>
            <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Título do Projeto *</label>
            <input type="text" name="title" value="{{ old('title', $project->title) }}" required
                style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Cliente *</label>
                <select name="client_id" required style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
                    <option value="">Selecionar cliente...</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" @selected(old('client_id', $project->client_id) == $client->id)>
                            {{ $client->company ?: $client->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Estado *</label>
                <select name="status" required style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
                    @foreach(['proposta' => 'Proposta', 'ativo' => 'Ativo', 'em_pausa' => 'Em Pausa', 'concluido' => 'Concluído', 'cancelado' => 'Cancelado'] as $val => $lbl)
                        <option value="{{ $val }}" @selected(old('status', $project->status) === $val)>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px;">
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Data de Início</label>
                <input type="date" name="start_date" value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}"
                    style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
            </div>
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Data de Entrega</label>
                <input type="date" name="end_date" value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}"
                    style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
            </div>
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Orçamento (€)</label>
                <input type="number" name="budget" step="0.01" min="0" placeholder="0.00" value="{{ old('budget', $project->budget) }}"
                    style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
            </div>
        </div>

        <div>
            <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Descrição / Âmbito</label>
            <textarea name="description" rows="4" style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px; resize:vertical;">{{ old('description', $project->description) }}</textarea>
        </div>

        <div style="display:flex; gap:12px; padding-top:8px;">
            <button id="submit-btn" type="submit"
                @if($project->exists) disabled @endif
                style="background:var(--cyan); color:#000; font-weight:700; font-size:14px; padding:12px 28px; border-radius:8px; border:none; transition:opacity .2s; {{ $project->exists ? 'opacity:.35; cursor:not-allowed;' : 'cursor:pointer;' }}">
                {{ $project->exists ? 'Guardar Alterações' : 'Criar Projeto' }}
            </button>
            <a href="{{ route('admin.projects.index') }}" style="padding:12px 20px; font-size:14px; color:var(--muted); border:1px solid var(--border); border-radius:8px; display:inline-flex; align-items:center;">Cancelar</a>
        </div>
    </form>

    @if($project->exists)
    <script>
        (function () {
            var form    = document.getElementById('project-form');
            var btn     = document.getElementById('submit-btn');
            var initial = new FormData(form);

            function hasChanged() {
                var current = new FormData(form);
                for (var [key, val] of current.entries()) {
                    if (val !== (initial.get(key) ?? '')) return true;
                }
                return false;
            }

            function checkChanged() {
                var changed = hasChanged();
                btn.disabled = !changed;
                btn.style.opacity = changed ? '1' : '.35';
                btn.style.cursor  = changed ? 'pointer' : 'not-allowed';
            }

            form.addEventListener('input', checkChanged);
            form.addEventListener('change', checkChanged);
        })();
    </script>
    @endif
</div>
@endsection
