@extends('admin.layout')
@section('title', $package->title)

@section('content')
@php
    $used      = $package->usedHours();
    $remaining = $package->remainingHours();
    $pct       = $package->usedPercent();
    $pctColor  = $pct >= 90 ? '#ef4444' : ($pct >= 60 ? '#f59e0b' : '#10b981');
@endphp

{{-- Cabeçalho --}}
<div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:28px; gap:16px; flex-wrap:wrap;">
    <div>
        <a href="{{ route('admin.hour-packages.index') }}" style="display:inline-flex; align-items:center; gap:6px; padding:7px 14px; border-radius:8px; background:linear-gradient(135deg,#00d4ff,#4a6cf7,#8b3fdb); color:#fff; font-size:12px; font-weight:700; text-decoration:none; margin-bottom:8px;">← Pacotes</a>
        <h2 style="font-size:22px; font-weight:700; margin:0;">{{ $package->title }}</h2>
        <div style="margin-top:8px; display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
            <span style="background:{{ $package->statusColor() }}22; color:{{ $package->statusColor() }}; border:1px solid {{ $package->statusColor() }}44; padding:4px 12px; border-radius:12px; font-size:12px; font-weight:700;">{{ $package->statusLabel() }}</span>
            <span style="color:var(--muted); font-size:13px;">{{ $package->client->company ?: $package->client->name }}</span>
        </div>
    </div>
    <a href="{{ route('admin.hour-packages.edit', $package) }}" style="background:var(--surface); border:1px solid var(--border); color:var(--text); font-size:13px; padding:10px 18px; border-radius:8px; text-decoration:none; white-space:nowrap;">Editar Pacote</a>
</div>

@if(session('success'))
    <div style="background:rgba(16,185,129,.15); border:1px solid #10b981; color:#10b981; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px;">{{ session('success') }}</div>
@endif

<div style="display:grid; grid-template-columns:1fr 340px; gap:24px; align-items:start;">

    {{-- Coluna principal --}}
    <div>

        {{-- Progresso de horas --}}
        <div style="background:var(--surface); border:1px solid var(--border); border-radius:12px; padding:24px; margin-bottom:24px;">
            <h3 style="font-size:15px; font-weight:700; margin:0 0 18px;">Horas</h3>
            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:12px; margin-bottom:18px;">
                <div style="text-align:center; padding:16px; background:rgba(255,255,255,.04); border-radius:10px;">
                    <div style="font-size:28px; font-weight:700; color:#f8fafc;">{{ number_format($package->total_hours, 1) }}h</div>
                    <div style="font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.5px; margin-top:3px;">Total</div>
                </div>
                <div style="text-align:center; padding:16px; background:rgba(245,158,11,.06); border-radius:10px;">
                    <div style="font-size:28px; font-weight:700; color:#f59e0b;">{{ number_format($used, 1) }}h</div>
                    <div style="font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.5px; margin-top:3px;">Utilizado</div>
                </div>
                <div style="text-align:center; padding:16px; background:rgba(16,185,129,.06); border-radius:10px;">
                    <div style="font-size:28px; font-weight:700; color:#10b981;">{{ number_format($remaining, 1) }}h</div>
                    <div style="font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.5px; margin-top:3px;">Disponível</div>
                </div>
            </div>
            <div style="font-size:12px; color:var(--muted); margin-bottom:6px; display:flex; justify-content:space-between;">
                <span>{{ $pct }}% utilizado</span>
                <span style="color:{{ $pctColor }}">{{ number_format($remaining, 1) }}h restantes</span>
            </div>
            <div style="background:rgba(255,255,255,.08); border-radius:6px; height:10px; overflow:hidden;">
                <div style="height:10px; border-radius:6px; background:linear-gradient(90deg,#00d4ff,{{ $pctColor }}); width:{{ $pct }}%; transition:width .3s;"></div>
            </div>
        </div>

        {{-- Registos de utilização --}}
        <div style="background:var(--surface); border:1px solid var(--border); border-radius:12px; padding:24px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px;">
                <h3 style="font-size:15px; font-weight:700; margin:0;">Registos de Utilização</h3>
                <span style="color:var(--muted); font-size:12px;">{{ $package->entries->count() }} entradas</span>
            </div>

            {{-- Lista --}}
            @forelse($package->entries as $entry)
            <div style="display:flex; gap:12px; padding:12px 0; border-bottom:1px solid var(--border); align-items:flex-start;">
                <div style="background:rgba(245,158,11,.15); border-radius:8px; padding:8px 12px; text-align:center; min-width:52px; flex-shrink:0;">
                    <div style="font-size:16px; font-weight:700; color:#f59e0b;">{{ number_format($entry->hours, 1) }}</div>
                    <div style="font-size:9px; color:var(--muted); text-transform:uppercase;">horas</div>
                </div>
                <div style="flex:1; min-width:0;">
                    <div style="font-size:13px; font-weight:600;">{{ $entry->title }}</div>
                    @if($entry->description)
                    <div style="font-size:12px; color:var(--muted); margin-top:3px; line-height:1.5;">{{ $entry->description }}</div>
                    @endif
                    <div style="font-size:11px; color:var(--muted); margin-top:4px;">{{ $entry->performed_at->format('d/m/Y') }}</div>
                </div>
                <form method="POST" action="{{ route('admin.hour-packages.entries.destroy', [$package, $entry]) }}" onsubmit="return confirm('Eliminar este registo?')">
                    @csrf @method('DELETE')
                    <button type="submit" style="background:none; border:none; color:rgba(251,113,133,.4); cursor:pointer; font-size:18px; line-height:1; padding:4px;">×</button>
                </form>
            </div>
            @empty
            <p style="color:var(--muted); font-size:13px; text-align:center; padding:20px 0; margin:0;">Nenhum registo ainda. Adiciona a primeira entrada abaixo.</p>
            @endforelse

            {{-- Formulário nova entrada --}}
            <form method="POST" action="{{ route('admin.hour-packages.entries.store', $package) }}" style="margin-top:20px; display:flex; flex-direction:column; gap:10px;">
                @csrf
                <input type="text" name="title" placeholder="Descrição do trabalho realizado..." required
                    style="background:rgba(255,255,255,.05); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:13px; width:100%;">
                <textarea name="description" rows="2" placeholder="Detalhes adicionais (opcional)..."
                    style="background:rgba(255,255,255,.05); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:13px; width:100%; resize:vertical;"></textarea>
                <div style="display:grid; grid-template-columns:1fr 1fr auto; gap:10px; align-items:end;">
                    <div>
                        <input type="date" name="performed_at" value="{{ now()->format('Y-m-d') }}" required
                            style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:9px 12px; border-radius:8px; font-size:13px;">
                    </div>
                    <div>
                        <input type="number" name="hours" step="0.25" min="0.25" placeholder="Horas (ex: 1.5)" required
                            style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:9px 12px; border-radius:8px; font-size:13px;">
                    </div>
                    <button type="submit" style="background:var(--cyan); color:#000; font-weight:700; font-size:13px; padding:9px 18px; border-radius:8px; border:none; cursor:pointer; white-space:nowrap;">+ Registar</button>
                </div>
            </form>
        </div>

    </div>

    {{-- Coluna lateral --}}
    <div>

        {{-- Info --}}
        <div style="background:var(--surface); border:1px solid var(--border); border-radius:12px; padding:20px; margin-bottom:20px;">
            <h3 style="font-size:13px; font-weight:700; margin:0 0 14px; text-transform:uppercase; letter-spacing:.5px; color:var(--muted);">Informação</h3>
            <dl style="display:flex; flex-direction:column; gap:10px; margin:0;">
                <div><dt style="font-size:11px; color:var(--muted); margin-bottom:2px;">Cliente</dt>
                    <dd style="font-size:13px; font-weight:600; margin:0;"><a href="{{ route('admin.clients.edit', $package->client) }}" style="color:var(--cyan);">{{ $package->client->company ?: $package->client->name }}</a></dd></div>
                @if($package->project)
                <div><dt style="font-size:11px; color:var(--muted); margin-bottom:2px;">Projeto</dt>
                    <dd style="font-size:13px; margin:0;"><a href="{{ route('admin.projects.show', $package->project) }}" style="color:var(--cyan);">{{ $package->project->title }}</a></dd></div>
                @endif
                <div><dt style="font-size:11px; color:var(--muted); margin-bottom:2px;">Adquirido em</dt>
                    <dd style="font-size:13px; margin:0;">{{ $package->purchased_at->format('d/m/Y') }}</dd></div>
                @if($package->expires_at)
                <div><dt style="font-size:11px; color:var(--muted); margin-bottom:2px;">Validade</dt>
                    <dd style="font-size:13px; margin:0; color:{{ $package->expires_at->isPast() ? '#ef4444' : 'var(--text)' }};">{{ $package->expires_at->format('d/m/Y') }}</dd></div>
                @endif
                @if($package->price)
                <div><dt style="font-size:11px; color:var(--muted); margin-bottom:2px;">Valor</dt>
                    <dd style="font-size:13px; font-weight:600; margin:0; color:#10b981;">{{ number_format($package->price, 2, ',', '.') }} €</dd></div>
                @endif
                @if($package->description)
                <div><dt style="font-size:11px; color:var(--muted); margin-bottom:4px;">Âmbito</dt>
                    <dd style="font-size:12px; margin:0; color:var(--muted); line-height:1.5;">{{ $package->description }}</dd></div>
                @endif
            </dl>
        </div>

        {{-- Documentos PDF --}}
        <div style="background:var(--surface); border:1px solid var(--border); border-radius:12px; padding:20px;">
            <h3 style="font-size:13px; font-weight:700; margin:0 0 14px; text-transform:uppercase; letter-spacing:.5px; color:var(--muted);">Documentos PDF</h3>

            <div style="display:flex; flex-direction:column; gap:10px;">
                <div>
                    <div style="font-size:12px; font-weight:600; margin-bottom:6px;">Ficha de Pacote</div>
                    <div style="display:flex; gap:8px;">
                        <a href="{{ route('admin.hour-packages.pdf.ficha.preview', $package) }}" target="_blank"
                            style="flex:1; text-align:center; font-size:11px; color:var(--muted); border:1px solid var(--border); padding:6px; border-radius:6px; text-decoration:none;">Ver PDF</a>
                        <a href="{{ route('admin.hour-packages.pdf.ficha.download', $package) }}"
                            style="flex:1; text-align:center; font-size:11px; color:var(--cyan); border:1px solid rgba(0,212,255,.3); padding:6px; border-radius:6px; text-decoration:none;">Download</a>
                    </div>
                </div>
                <div>
                    <div style="font-size:12px; font-weight:600; margin-bottom:6px;">Relatório de Uso</div>
                    <div style="display:flex; gap:8px;">
                        <a href="{{ route('admin.hour-packages.pdf.relatorio.preview', $package) }}" target="_blank"
                            style="flex:1; text-align:center; font-size:11px; color:var(--muted); border:1px solid var(--border); padding:6px; border-radius:6px; text-decoration:none;">Ver PDF</a>
                        <a href="{{ route('admin.hour-packages.pdf.relatorio.download', $package) }}"
                            style="flex:1; text-align:center; font-size:11px; color:var(--cyan); border:1px solid rgba(0,212,255,.3); padding:6px; border-radius:6px; text-decoration:none;">Download</a>
                    </div>
                </div>
            </div>
        </div>

        <div style="background:rgba(239,68,68,.06); border:1px solid rgba(239,68,68,.25); border-radius:12px; padding:20px; margin-top:20px;">
            <h3 style="font-size:13px; font-weight:700; margin:0 0 8px; text-transform:uppercase; letter-spacing:.5px; color:#fb7185;">Zona de Perigo</h3>
            <p style="font-size:12px; color:var(--muted); line-height:1.5; margin:0 0 14px;">
                A eliminação é permanente e também apaga todos os registos de utilização deste pacote.
            </p>
            <form id="delete-package-form" method="POST" action="{{ route('admin.hour-packages.destroy', $package) }}">
                @csrf
                @method('DELETE')
                <button id="open-delete-modal" type="button"
                    style="width:100%; background:rgba(239,68,68,.12); border:1px solid rgba(239,68,68,.45); color:#fb7185; font-weight:700; font-size:12px; padding:9px 14px; border-radius:7px; cursor:pointer;">
                    Eliminar Pacote
                </button>
            </form>
        </div>

    </div>
</div>

<div id="delete-package-modal" role="dialog" aria-modal="true" aria-labelledby="delete-package-title" aria-hidden="true"
    style="position:fixed; inset:0; z-index:1000; display:none; align-items:center; justify-content:center; padding:20px; background:rgba(2,6,23,.78); backdrop-filter:blur(5px);">
    <div role="document"
        style="width:100%; max-width:460px; background:#0f1733; border:1px solid rgba(251,113,133,.35); border-radius:14px; box-shadow:0 24px 70px rgba(0,0,0,.55); overflow:hidden;">
        <div style="padding:24px 24px 18px; border-bottom:1px solid var(--border);">
            <div style="width:42px; height:42px; display:flex; align-items:center; justify-content:center; border-radius:10px; background:rgba(239,68,68,.12); border:1px solid rgba(239,68,68,.3); color:#fb7185; font-size:22px; margin-bottom:16px;">!</div>
            <h2 id="delete-package-title" style="font-size:18px; font-weight:700; margin:0 0 8px; color:var(--text);">Eliminar pacote?</h2>
            <p style="font-size:13px; line-height:1.6; color:var(--muted); margin:0;">
                O pacote <strong style="color:var(--text);">{{ $package->title }}</strong> e todos os seus registos de utilização serão eliminados permanentemente.
            </p>
        </div>
        <div style="display:flex; justify-content:flex-end; gap:10px; padding:16px 24px; background:rgba(255,255,255,.02);">
            <button id="cancel-delete-package" type="button"
                style="background:transparent; border:1px solid var(--border); color:var(--muted); font-weight:600; font-size:13px; padding:9px 16px; border-radius:8px; cursor:pointer;">
                Cancelar
            </button>
            <button id="confirm-delete-package" type="button"
                style="background:#ef4444; border:1px solid #ef4444; color:#fff; font-weight:700; font-size:13px; padding:9px 16px; border-radius:8px; cursor:pointer;">
                Sim, eliminar
            </button>
        </div>
    </div>
</div>

<script>
    (function () {
        var modal = document.getElementById('delete-package-modal');
        var openButton = document.getElementById('open-delete-modal');
        var cancelButton = document.getElementById('cancel-delete-package');
        var confirmButton = document.getElementById('confirm-delete-package');
        var form = document.getElementById('delete-package-form');

        function openModal() {
            modal.style.display = 'flex';
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            cancelButton.focus();
        }

        function closeModal() {
            modal.style.display = 'none';
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            openButton.focus();
        }

        openButton.addEventListener('click', openModal);
        cancelButton.addEventListener('click', closeModal);
        confirmButton.addEventListener('click', function () {
            confirmButton.disabled = true;
            confirmButton.textContent = 'A eliminar...';
            form.submit();
        });

        modal.addEventListener('click', function (event) {
            if (event.target === modal) closeModal();
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && modal.getAttribute('aria-hidden') === 'false') {
                closeModal();
            }
        });
    })();
</script>
@endsection
