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
            <label for="description-input" style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Âmbito / Serviços Incluídos</label>
            <div id="md-toolbar" style="display:flex; gap:6px; flex-wrap:wrap; margin-bottom:6px;">
                <button type="button" data-md="bold" title="Negrito (Ctrl/⌘+B)" class="md-btn" style="font-weight:800;">B</button>
                <button type="button" data-md="italic" title="Itálico (Ctrl/⌘+I)" class="md-btn" style="font-style:italic;">I</button>
                <button type="button" data-md="heading" title="Título" class="md-btn">Título</button>
                <button type="button" data-md="ul" title="Lista com marcadores" class="md-btn">• Lista</button>
                <button type="button" data-md="ol" title="Lista numerada" class="md-btn">1. Lista</button>
            </div>
            <textarea id="description-input" name="description" rows="12" placeholder="Descreve os serviços cobertos por este pacote de horas..." style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:14px; line-height:1.5; resize:vertical;">{{ old('description', $package->description) }}</textarea>
            <p style="font-size:11px; color:var(--muted); margin:6px 0 0;">
                Suporta formatação: <code>**negrito**</code>, <code>*itálico*</code>, <code>## Título</code>, listas com <code>- </code> ou <code>1. </code>.
                <strong>Tab</strong> / <strong>Shift+Tab</strong> indentam e desindentam (sub-itens), <strong>Enter</strong> continua a lista e <strong>Ctrl/⌘+Z</strong> desfaz.
                Para sair do campo com o teclado, usa o rato ou <strong>Esc</strong> seguido de Tab.
            </p>
        </div>
        <style>
            .md-btn { background:var(--surface); border:1px solid var(--border); color:var(--text); font-size:12px; padding:5px 10px; border-radius:6px; cursor:pointer; min-width:30px; }
            .md-btn:hover { border-color:var(--cyan); color:var(--cyan); }
        </style>

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

        // --- Barra de formatação Markdown do âmbito ---
        var desc   = document.getElementById('description-input');
        var INDENT = '   '; // 3 espaços = sub-item de lista em Markdown
        var LIST_RE = /^(\s*)([-*]|\d+\.)(\s+)/;

        // Substitui texto via execCommand para manter o histórico nativo (Ctrl/⌘+Z e Ctrl/⌘+Shift+Z)
        function replaceRange(start, end, text) {
            desc.focus();
            desc.setSelectionRange(start, end);
            var ok = text === '' ? document.execCommand('delete') : document.execCommand('insertText', false, text);
            if (!ok) {
                desc.setRangeText(text, start, end, 'end');
                desc.dispatchEvent(new Event('input', { bubbles: true }));
            }
        }

        // Linhas abrangidas pela seleção atual
        function lineBlock() {
            var value = desc.value, s = desc.selectionStart, e = desc.selectionEnd;
            if (e > s && value[e - 1] === '\n') e--;
            var start = value.lastIndexOf('\n', s - 1) + 1;
            var end = value.indexOf('\n', e);
            return { start: start, end: end === -1 ? value.length : end };
        }

        function transformLines(fn) {
            var caret = desc.selectionStart, collapsed = caret === desc.selectionEnd;
            var block = lineBlock();
            var lines = desc.value.slice(block.start, block.end).split('\n');
            var updated = lines.map(fn);
            var text = updated.join('\n');
            if (text === lines.join('\n')) return;
            replaceRange(block.start, block.end, text);
            if (collapsed) {
                var pos = Math.max(block.start, caret + updated[0].length - lines[0].length);
                desc.setSelectionRange(pos, pos);
            } else {
                desc.setSelectionRange(block.start, block.start + text.length);
            }
        }

        function wrapSelection(marker, placeholder) {
            var start = desc.selectionStart, end = desc.selectionEnd;
            var selected = desc.value.slice(start, end) || placeholder;
            replaceRange(start, end, marker + selected + marker);
            desc.setSelectionRange(start + marker.length, start + marker.length + selected.length);
        }

        // Insere o prefixo depois da indentação existente (e substitui um marcador de lista já presente)
        function setPrefix(prefixFor) {
            transformLines(function (line, i) {
                var indent = line.match(/^\s*/)[0];
                var rest = line.slice(indent.length).replace(/^([-*]|\d+\.|#{1,6})\s+/, '');
                return indent + prefixFor(i) + rest;
            });
        }

        // Ao indentar, um item numerado passa a sub-lista e recomeça em 1.
        function indentLines() { transformLines(function (line) { return INDENT + line.replace(/^(\s*)\d+\.(?=\s)/, '$11.'); }); }
        function outdentLines() { transformLines(function (line) { return line.replace(/^(\t| {1,3})/, ''); }); }

        function applyFormat(type) {
            if (type === 'bold') wrapSelection('**', 'texto');
            else if (type === 'italic') wrapSelection('*', 'texto');
            else if (type === 'heading') setPrefix(function () { return '## '; });
            else if (type === 'ul') setPrefix(function () { return '- '; });
            else if (type === 'ol') setPrefix(function (i) { return (i + 1) + '. '; });
        }

        // Enter dentro de uma lista continua a lista; Enter num item vazio termina-a
        function continueList() {
            var pos = desc.selectionStart;
            if (pos !== desc.selectionEnd) return false;
            var value = desc.value;
            var lineStart = value.lastIndexOf('\n', pos - 1) + 1;
            var lineEnd = value.indexOf('\n', pos);
            if (lineEnd === -1) lineEnd = value.length;
            var line = value.slice(lineStart, lineEnd);
            var m = line.match(LIST_RE);
            if (!m || pos < lineStart + m[0].length) return false;

            // Linha em branco depois da lista, senão o Markdown junta o texto seguinte ao último item
            if (line.slice(m[0].length).trim() === '') {
                replaceRange(lineStart, lineEnd, '\n');
                return true;
            }
            var marker = /^\d+\.$/.test(m[2]) ? (parseInt(m[2], 10) + 1) + '.' : m[2];
            replaceRange(pos, pos, '\n' + m[1] + marker + m[3]);
            return true;
        }

        document.querySelectorAll('#md-toolbar [data-md]').forEach(function (button) {
            button.addEventListener('click', function () { applyFormat(button.dataset.md); });
        });

        // Esc liberta o próximo Tab para sair do campo (acessibilidade por teclado)
        var releaseTab = false;
        desc.addEventListener('blur', function () { releaseTab = false; });

        desc.addEventListener('keydown', function (e) {
            if (e.isComposing) return;

            if (e.key === 'Escape') { releaseTab = true; return; }
            if (e.key === 'Tab' && releaseTab) { releaseTab = false; return; }
            if (e.key !== 'Shift') releaseTab = false;

            if (e.key === 'Tab' && !e.metaKey && !e.ctrlKey && !e.altKey) {
                e.preventDefault();
                if (e.shiftKey) {
                    outdentLines();
                } else if (desc.selectionStart === desc.selectionEnd && !LIST_RE.test(desc.value.slice(lineBlock().start, lineBlock().end))) {
                    replaceRange(desc.selectionStart, desc.selectionEnd, INDENT);
                } else {
                    indentLines();
                }
                return;
            }

            if (e.key === 'Enter' && !e.shiftKey && !e.metaKey && !e.ctrlKey && !e.altKey) {
                if (continueList()) e.preventDefault();
                return;
            }

            if (e.metaKey || e.ctrlKey) {
                var key = e.key.toLowerCase();
                if (key === 'b' || key === 'i') {
                    e.preventDefault();
                    applyFormat(key === 'b' ? 'bold' : 'italic');
                } else if (e.key === ']' || e.key === '[') {
                    e.preventDefault();
                    e.key === ']' ? indentLines() : outdentLines();
                }
            }
        });

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
