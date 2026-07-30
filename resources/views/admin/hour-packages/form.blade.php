@extends('admin.layout')
@section('title', $package->exists ? 'Editar Pacote' : 'Novo Pacote de Horas')

@section('content')
<div style="max-width:700px;">
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:28px;">
        <a href="{{ route('admin.hour-packages.index') }}" style="display:inline-flex; align-items:center; gap:6px; padding:7px 14px; border-radius:8px; background:linear-gradient(135deg,#00d4ff,#4a6cf7,#8b3fdb); color:#fff; font-size:12px; font-weight:700; text-decoration:none;">← Pacotes</a>
        <h2 style="font-size:20px; font-weight:700; margin:0;">{{ $package->exists ? 'Editar Pacote' : 'Novo Pacote de Horas' }}</h2>
    </div>

    @if($errors->any())
        <div style="background:rgba(251,113,133,.15); border:1px solid var(--danger); color:var(--danger); padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px;">
            <ul style="margin:0; padding-left:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form id="hour-package-form" method="POST" action="{{ $package->exists ? route('admin.hour-packages.update', $package) : route('admin.hour-packages.store') }}" style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        @if($package->exists) @method('PUT') @endif

        <div>
            <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Título do Pacote *</label>
            <input type="text" name="title" value="{{ old('title', $package->title) }}" required placeholder="ex: Pacote 10h — Junho 2026"
                style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Cliente *</label>
                <select name="client_id" required style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
                    <option value="">Selecionar cliente...</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" @selected(old('client_id', $package->client_id) == $client->id)>{{ $client->company ?: $client->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Projeto Associado <span style="font-weight:400;">(opcional)</span></label>
                <select name="project_id" style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
                    <option value="">Nenhum</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" @selected(old('project_id', $package->project_id) == $project->id)>{{ $project->title }} — {{ $project->client->company ?: $project->client->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Horas Adquiridas *</label>
                <input type="number" name="total_hours" step="0.5" min="0.5" placeholder="10" value="{{ old('total_hours', $package->total_hours) }}" required
                    style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
            </div>
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">
                    Valor do Pacote (€)
                    <span id="rate-hint" style="font-weight:400; color:var(--cyan); margin-left:6px; font-size:11px;"></span>
                </label>
                <input type="number" id="price-input" name="price" step="0.01" min="0" placeholder="Calculado automaticamente" value="{{ old('price', $package->price) }}"
                    style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr @if($package->exists) 1fr @endif; gap:16px;">
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Data de Aquisição *</label>
                <input type="date" name="purchased_at" value="{{ old('purchased_at', $package->purchased_at?->format('Y-m-d')) }}" required
                    style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
            </div>
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Validade <span style="font-weight:400;">(opcional)</span></label>
                <input type="date" name="expires_at" value="{{ old('expires_at', $package->expires_at?->format('Y-m-d')) }}"
                    style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
            </div>
            @if($package->exists)
            <div>
                <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Estado</label>
                <select name="status" style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px;">
                    @foreach(['ativo' => 'Ativo', 'esgotado' => 'Esgotado', 'expirado' => 'Expirado', 'cancelado' => 'Cancelado'] as $val => $lbl)
                        <option value="{{ $val }}" @selected(old('status', $package->status) === $val)>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>
            @endif
        </div>

        <div>
            <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Âmbito / Serviços Incluídos</label>
            <textarea name="description" rows="4" placeholder="Descreve os serviços cobertos por este pacote de horas..." style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px; resize:vertical;">{{ old('description', $package->description) }}</textarea>
        </div>

        <div style="display:flex; gap:12px; padding-top:8px;">
            <button id="submit-btn" type="submit"
                @if($package->exists) disabled @endif
                style="background:var(--cyan); color:#000; font-weight:700; font-size:14px; padding:12px 28px; border-radius:8px; border:none; transition:opacity .2s; {{ $package->exists ? 'opacity:.35; cursor:not-allowed;' : 'cursor:pointer;' }}">
                {{ $package->exists ? 'Guardar Alterações' : 'Criar Pacote' }}
            </button>
            <a href="{{ route('admin.hour-packages.index') }}" style="padding:12px 20px; font-size:14px; color:var(--muted); border:1px solid var(--border); border-radius:8px; display:inline-flex; align-items:center;">Cancelar</a>
        </div>
    </form>

    <script>
    (function () {
        var form       = document.getElementById('hour-package-form');
        var btn        = document.getElementById('submit-btn');
        var hoursInput = document.querySelector('input[name="total_hours"]');
        var priceInput = document.getElementById('price-input');
        var rateHint   = document.getElementById('rate-hint');
        var isEdit     = {{ $package->exists ? 'true' : 'false' }};
        var initial    = null;
        var autoFilling = false; // flag para ignorar eventos disparados pelo cálculo automático

        // --- Cálculo automático de preço ---
        function getRate(h) {
            if (h >= 20) return 15;
            if (h >= 10) return 17;
            if (h >=  5) return 20;
            return null;
        }

        function calcPrice() {
            var hours = parseFloat(hoursInput.value);
            if (!hours || hours < 5) {
                rateHint.textContent = (hours > 0 && hours < 5) ? '⚠ Mínimo 5h' : '';
                return;
            }
            var rate  = getRate(hours);
            var total = (hours * rate).toFixed(2);
            rateHint.textContent = rate + '€/h → ' + total.replace('.', ',') + '€';
            if (!priceInput.dataset.manual) {
                autoFilling = true;
                priceInput.value = total;
                autoFilling = false;
            }
        }

        // Marcar edição manual do preço (só quando NÃO é o cálculo automático)
        priceInput.addEventListener('input', function () {
            if (!autoFilling) priceInput.dataset.manual = '1';
        });

        // Recalcular ao mudar horas
        hoursInput.addEventListener('input', function () {
            delete priceInput.dataset.manual;
            calcPrice();
            if (isEdit) checkChanged();
        });

        // Calcular ao carregar a página (apenas no criar)
        if (!isEdit) calcPrice();

        // --- Deteção de alterações (apenas no editar) ---
        // Captura estado inicial depois do DOM estar pronto
        if (isEdit) {
            setTimeout(function () {
                initial = {};
                new FormData(form).forEach(function (v, k) { initial[k] = v; });
            }, 100);

            function checkChanged() {
                if (!initial) return;
                var changed = false;
                new FormData(form).forEach(function (v, k) {
                    if (v !== (initial[k] ?? '')) changed = true;
                });
                btn.disabled      = !changed;
                btn.style.opacity = changed ? '1' : '.35';
                btn.style.cursor  = changed ? 'pointer' : 'not-allowed';
            }

            form.addEventListener('input', checkChanged);
            form.addEventListener('change', checkChanged);
        }
    })();
    </script>
</div>
@endsection
