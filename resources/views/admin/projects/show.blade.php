@extends('admin.layout')
@section('title', $project->title)

@section('content')

{{-- Cabeçalho --}}
<div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:28px; gap:16px; flex-wrap:wrap;">
    <div>
        <a href="{{ route('admin.projects.index') }}" style="display:inline-flex; align-items:center; gap:6px; padding:7px 14px; border-radius:8px; background:linear-gradient(135deg,#00d4ff,#4a6cf7,#8b3fdb); color:#fff; font-size:12px; font-weight:700; letter-spacing:.3px; text-decoration:none; margin-bottom:6px;">
            ← Projetos
        </a>
        <h2 style="font-size:22px; font-weight:700; margin:0;">{{ $project->title }}</h2>
        <div style="margin-top:8px; display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
            <span style="background:{{ $project->statusColor() }}22; color:{{ $project->statusColor() }}; border:1px solid {{ $project->statusColor() }}44; padding:4px 12px; border-radius:12px; font-size:12px; font-weight:700;">
                {{ $project->statusLabel() }}
            </span>
            <span style="color:var(--muted); font-size:13px;">{{ $project->client->company ?: $project->client->name }}</span>
            @if($project->end_date)
            <span style="color:var(--muted); font-size:12px;">· Entrega: {{ $project->end_date->format('d/m/Y') }}</span>
            @endif
        </div>
    </div>
    <a href="{{ route('admin.projects.edit', $project) }}" style="background:var(--surface); border:1px solid var(--border); color:var(--text); font-size:13px; padding:10px 18px; border-radius:8px; text-decoration:none; white-space:nowrap;">Editar Projeto</a>
</div>

@if(session('success'))
    <div style="background:rgba(16,185,129,.15); border:1px solid #10b981; color:#10b981; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px;">
        {{ session('success') }}
    </div>
@endif

<div style="display:grid; grid-template-columns:1fr 380px; gap:24px; align-items:start;">

    {{-- Coluna principal --}}
    <div>

        {{-- Tarefas --}}
        <div style="background:var(--surface); border:1px solid var(--border); border-radius:12px; padding:24px; margin-bottom:24px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px;">
                <h3 style="font-size:15px; font-weight:700; margin:0;">Tarefas</h3>
                @php $done = $project->tasks->where('status','concluido')->count(); $total = $project->tasks->count(); @endphp
                @if($total)
                <span style="color:var(--muted); font-size:12px;">{{ $done }}/{{ $total }} concluídas</span>
                @endif
            </div>

            @if($total)
            <div style="background:rgba(255,255,255,.06); border-radius:4px; height:6px; margin-bottom:18px; overflow:hidden;">
                <div style="height:6px; background:#10b981; width:{{ $total > 0 ? round($done/$total*100) : 0 }}%; border-radius:4px;"></div>
            </div>
            @endif

            {{-- Lista de tarefas --}}
            <div id="tasks-list">
                @forelse($project->tasks as $task)
                <div style="display:flex; align-items:center; gap:12px; padding:10px 0; border-bottom:1px solid var(--border);">
                    {{-- Toggle concluído --}}
                    <button onclick="toggleTask({{ $task->id }}, '{{ $task->status === 'concluido' ? 'a_fazer' : 'concluido' }}')"
                        style="width:20px; height:20px; border-radius:5px; border:2px solid {{ $task->status === 'concluido' ? '#10b981' : 'rgba(255,255,255,.2)' }}; background:{{ $task->status === 'concluido' ? '#10b981' : 'transparent' }}; cursor:pointer; flex-shrink:0; display:flex; align-items:center; justify-content:center;"
                        title="Marcar como {{ $task->status === 'concluido' ? 'a fazer' : 'concluído' }}">
                        @if($task->status === 'concluido')
                        <svg width="10" height="8" viewBox="0 0 10 8" fill="none"><path d="M1 4l3 3 5-6" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        @endif
                    </button>

                    <div style="flex:1; min-width:0;">
                        <div style="font-size:13px; font-weight:500; color:{{ $task->status === 'concluido' ? 'var(--muted)' : 'var(--text)' }}; text-decoration:{{ $task->status === 'concluido' ? 'line-through' : 'none' }};">{{ $task->title }}</div>
                        @if($task->description)
                        <div style="font-size:11px; color:var(--muted); margin-top:2px;">{{ $task->description }}</div>
                        @endif
                    </div>

                    @if($task->due_date)
                    <span style="font-size:11px; color:var(--muted); white-space:nowrap;">{{ $task->due_date->format('d/m/Y') }}</span>
                    @endif

                    <span style="font-size:10px; font-weight:700; padding:2px 8px; border-radius:10px; background:{{ $task->statusColor() }}22; color:{{ $task->statusColor() }}; white-space:nowrap;">{{ $task->statusLabel() }}</span>

                    <button type="button" class="edit-task-button"
                        data-update-url="{{ route('admin.projects.tasks.update', [$project, $task]) }}"
                        data-title="{{ $task->title }}"
                        data-description="{{ $task->description }}"
                        data-status="{{ $task->status }}"
                        data-due-date="{{ $task->due_date?->format('Y-m-d') }}"
                        style="background:none; border:none; color:var(--cyan); cursor:pointer; font-size:11px; padding:2px 4px;">
                        Editar
                    </button>

                    <form method="POST" action="{{ route('admin.projects.tasks.destroy', [$project, $task]) }}" onsubmit="return confirm('Eliminar esta tarefa?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="background:none; border:none; color:rgba(251,113,133,.5); cursor:pointer; font-size:16px; line-height:1; padding:0;">×</button>
                    </form>
                </div>
                @empty
                <p style="color:var(--muted); font-size:13px; text-align:center; padding:20px 0; margin:0;">Nenhuma tarefa ainda. Adicione a primeira abaixo.</p>
                @endforelse
            </div>

            {{-- Formulário nova tarefa --}}
            <form method="POST" action="{{ route('admin.projects.tasks.store', $project) }}" style="margin-top:18px; display:flex; flex-direction:column; gap:10px;">
                @csrf
                <input type="text" name="title" placeholder="Nova tarefa..." required
                    style="background:rgba(255,255,255,.05); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:13px; width:100%;">
                <textarea name="description" rows="2" placeholder="Descrição da tarefa (opcional)..."
                    style="background:rgba(255,255,255,.05); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:13px; width:100%; resize:vertical;"></textarea>
                <div style="display:grid; grid-template-columns:1fr 1fr auto; gap:10px; align-items:end;">
                    <div>
                        <select name="status" style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:9px 12px; border-radius:8px; font-size:13px;">
                            <option value="a_fazer">A Fazer</option>
                            <option value="em_progresso">Em Progresso</option>
                            <option value="concluido">Concluído</option>
                            <option value="bloqueado">Bloqueado</option>
                        </select>
                    </div>
                    <div>
                        <input type="date" name="due_date" style="width:100%; background:var(--surface); border:1px solid var(--border); color:var(--text); padding:9px 12px; border-radius:8px; font-size:13px;">
                    </div>
                    <button type="submit" style="background:var(--cyan); color:#000; font-weight:700; font-size:13px; padding:9px 18px; border-radius:8px; border:none; cursor:pointer; white-space:nowrap;">Adicionar</button>
                </div>
            </form>
        </div>

        {{-- Histórico de documentos --}}
        @if($project->documentLogs->count())
        <div style="background:var(--surface); border:1px solid var(--border); border-radius:12px; padding:24px;">
            <h3 style="font-size:15px; font-weight:700; margin:0 0 16px;">Documentos Enviados</h3>
            <table style="width:100%; border-collapse:collapse; font-size:12px;">
                <thead>
                    <tr style="border-bottom:1px solid var(--border);">
                        <th style="text-align:left; padding:8px 10px; color:var(--muted); font-weight:600; font-size:11px;">Tipo</th>
                        <th style="text-align:left; padding:8px 10px; color:var(--muted); font-weight:600; font-size:11px;">Enviado para</th>
                        <th style="text-align:left; padding:8px 10px; color:var(--muted); font-weight:600; font-size:11px;">Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($project->documentLogs as $log)
                    <tr style="border-bottom:1px solid var(--border);">
                        <td style="padding:8px 10px; color:var(--text);">{{ $log->typeLabel() }}</td>
                        <td style="padding:8px 10px; color:var(--muted);">{{ $log->sent_to_email }}</td>
                        <td style="padding:8px 10px; color:var(--muted);">{{ $log->sent_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    {{-- Coluna lateral --}}
    <div>

        {{-- Info do projeto --}}
        <div style="background:var(--surface); border:1px solid var(--border); border-radius:12px; padding:20px; margin-bottom:20px;">
            <h3 style="font-size:13px; font-weight:700; margin:0 0 14px; text-transform:uppercase; letter-spacing:.5px; color:var(--muted);">Informação</h3>
            <dl style="margin:0; display:flex; flex-direction:column; gap:10px;">
                <div>
                    <dt style="font-size:11px; color:var(--muted); margin-bottom:2px;">Cliente</dt>
                    <dd style="font-size:13px; font-weight:600; margin:0;">
                        <a href="{{ route('admin.clients.edit', $project->client) }}" style="color:var(--cyan);">{{ $project->client->company ?: $project->client->name }}</a>
                    </dd>
                </div>
                <div>
                    <dt style="font-size:11px; color:var(--muted); margin-bottom:2px;">Email do Cliente</dt>
                    <dd style="font-size:13px; margin:0; color:var(--text);">{{ $project->client->email }}</dd>
                </div>
                @if($project->start_date)
                <div>
                    <dt style="font-size:11px; color:var(--muted); margin-bottom:2px;">Início</dt>
                    <dd style="font-size:13px; margin:0;">{{ $project->start_date->format('d/m/Y') }}</dd>
                </div>
                @endif
                @if($project->end_date)
                <div>
                    <dt style="font-size:11px; color:var(--muted); margin-bottom:2px;">Entrega Prevista</dt>
                    <dd style="font-size:13px; margin:0;">{{ $project->end_date->format('d/m/Y') }}</dd>
                </div>
                @endif
                @if($project->budget)
                <div>
                    <dt style="font-size:11px; color:var(--muted); margin-bottom:2px;">Orçamento</dt>
                    <dd style="font-size:13px; font-weight:600; margin:0; color:#10b981;">{{ number_format($project->budget, 2, ',', '.') }} €</dd>
                </div>
                @endif
                @if($project->description)
                <div>
                    <dt style="font-size:11px; color:var(--muted); margin-bottom:4px;">Descrição</dt>
                    <dd style="font-size:12px; margin:0; color:var(--muted); line-height:1.5;">{{ $project->description }}</dd>
                </div>
                @endif
            </dl>
        </div>

        {{-- Emitir Documento --}}
        <div style="background:var(--surface); border:1px solid var(--border); border-radius:12px; padding:20px;">
            <h3 style="font-size:13px; font-weight:700; margin:0 0 14px; text-transform:uppercase; letter-spacing:.5px; color:var(--muted);">Emitir Documento</h3>

            {{-- Preview / Download --}}
            <div style="display:flex; flex-direction:column; gap:8px; margin-bottom:16px;">
                @foreach(['inicio_projeto' => 'Ficha de Início', 'lista_tarefas' => 'Lista de Tarefas', 'relatorio_estado' => 'Relatório de Estado'] as $type => $label)
                <div style="display:flex; gap:8px; align-items:center;">
                    <span style="flex:1; font-size:13px; color:var(--text);">{{ $label }}</span>
                    <a href="{{ route('admin.documents.preview', [$project, $type]) }}" target="_blank"
                        style="font-size:11px; color:var(--muted); border:1px solid var(--border); padding:4px 10px; border-radius:6px; text-decoration:none;">Ver PDF</a>
                    <a href="{{ route('admin.documents.download', [$project, $type]) }}"
                        style="font-size:11px; color:var(--cyan); border:1px solid rgba(0,212,255,.3); padding:4px 10px; border-radius:6px; text-decoration:none;">Download</a>
                </div>
                @endforeach
            </div>

            {{-- Enviar por email --}}
            <div style="border-top:1px solid var(--border); padding-top:14px;">
                <p style="font-size:12px; color:var(--muted); margin:0 0 10px;">Enviar por email:</p>
                <form method="POST" action="{{ route('admin.documents.send', $project) }}" style="display:flex; flex-direction:column; gap:8px;">
                    @csrf
                    <select name="type" required style="background:var(--surface-2,#111936); border:1px solid var(--border); color:var(--text); padding:9px 12px; border-radius:8px; font-size:13px; width:100%;">
                        <option value="inicio_projeto">Ficha de Início de Projeto</option>
                        <option value="lista_tarefas">Lista de Tarefas</option>
                        <option value="relatorio_estado">Relatório de Estado</option>
                    </select>
                    <input type="email" name="email" value="{{ $project->client->email }}" required placeholder="Email do destinatário"
                        style="background:var(--surface-2,#111936); border:1px solid var(--border); color:var(--text); padding:9px 12px; border-radius:8px; font-size:13px; width:100%;">
                    <button type="submit" style="background:var(--blue,#4a6cf7); color:#fff; font-weight:700; font-size:13px; padding:10px; border-radius:8px; border:none; cursor:pointer;">
                        Enviar Documento ↗
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<div id="edit-task-modal" role="dialog" aria-modal="true" aria-labelledby="edit-task-title" aria-hidden="true"
    style="position:fixed; inset:0; z-index:1000; display:none; align-items:center; justify-content:center; padding:20px; background:rgba(2,6,23,.78); backdrop-filter:blur(5px);">
    <div role="document"
        style="width:100%; max-width:540px; background:#0f1733; border:1px solid rgba(0,212,255,.25); border-radius:14px; box-shadow:0 24px 70px rgba(0,0,0,.55); overflow:hidden;">
        <div style="padding:22px 24px 16px; border-bottom:1px solid var(--border);">
            <h2 id="edit-task-title" style="font-size:18px; font-weight:700; margin:0 0 6px; color:var(--text);">Editar tarefa</h2>
            <p style="font-size:12px; color:var(--muted); margin:0;">Altere os dados e o estado da tarefa.</p>
        </div>

        <form id="edit-task-form" method="POST">
            @csrf
            @method('PUT')
            <div style="display:flex; flex-direction:column; gap:14px; padding:20px 24px;">
                <div>
                    <label for="edit-task-name" style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Título *</label>
                    <input id="edit-task-name" type="text" name="title" required
                        style="width:100%; background:var(--surface-2); border:1px solid var(--border); color:var(--text); padding:10px 12px; border-radius:8px; font-size:13px;">
                </div>
                <div>
                    <label for="edit-task-description" style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Descrição</label>
                    <textarea id="edit-task-description" name="description" rows="4"
                        style="width:100%; background:var(--surface-2); border:1px solid var(--border); color:var(--text); padding:10px 12px; border-radius:8px; font-size:13px; resize:vertical;"></textarea>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div>
                        <label for="edit-task-status" style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Estado *</label>
                        <select id="edit-task-status" name="status" required
                            style="width:100%; background:var(--surface-2); border:1px solid var(--border); color:var(--text); padding:10px 12px; border-radius:8px; font-size:13px;">
                            <option value="a_fazer">A Fazer</option>
                            <option value="em_progresso">Em Progresso</option>
                            <option value="concluido">Concluído</option>
                            <option value="bloqueado">Bloqueado</option>
                        </select>
                    </div>
                    <div>
                        <label for="edit-task-due-date" style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:600;">Prazo</label>
                        <input id="edit-task-due-date" type="date" name="due_date"
                            style="width:100%; background:var(--surface-2); border:1px solid var(--border); color:var(--text); padding:10px 12px; border-radius:8px; font-size:13px;">
                    </div>
                </div>
            </div>
            <div style="display:flex; justify-content:flex-end; gap:10px; padding:16px 24px; border-top:1px solid var(--border); background:rgba(255,255,255,.02);">
                <button id="cancel-edit-task" type="button"
                    style="background:transparent; border:1px solid var(--border); color:var(--muted); font-weight:600; font-size:13px; padding:9px 16px; border-radius:8px; cursor:pointer;">
                    Cancelar
                </button>
                <button type="submit"
                    style="background:var(--cyan); border:none; color:#000; font-weight:700; font-size:13px; padding:9px 18px; border-radius:8px; cursor:pointer;">
                    Guardar alterações
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleTask(taskId, newStatus) {
    var url = '{{ route('admin.projects.tasks.update', [$project, '__TASK_ID__']) }}'.replace('__TASK_ID__', taskId);

    fetch(url, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
        body: JSON.stringify({ status: newStatus }),
    }).then(r => r.ok && location.reload());
}

(function () {
    var modal = document.getElementById('edit-task-modal');
    var form = document.getElementById('edit-task-form');
    var titleInput = document.getElementById('edit-task-name');
    var descriptionInput = document.getElementById('edit-task-description');
    var statusInput = document.getElementById('edit-task-status');
    var dueDateInput = document.getElementById('edit-task-due-date');
    var cancelButton = document.getElementById('cancel-edit-task');
    var activeButton = null;

    function openModal(button) {
        activeButton = button;
        form.action = button.dataset.updateUrl;
        titleInput.value = button.dataset.title || '';
        descriptionInput.value = button.dataset.description || '';
        statusInput.value = button.dataset.status || 'a_fazer';

        if (dueDateInput._flatpickr) {
            dueDateInput._flatpickr.setDate(button.dataset.dueDate || null, false);
        } else {
            dueDateInput.value = button.dataset.dueDate || '';
        }

        modal.style.display = 'flex';
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        titleInput.focus();
    }

    function closeModal() {
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        if (activeButton) activeButton.focus();
    }

    document.querySelectorAll('.edit-task-button').forEach(function (button) {
        button.addEventListener('click', function () {
            openModal(button);
        });
    });

    cancelButton.addEventListener('click', closeModal);
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
