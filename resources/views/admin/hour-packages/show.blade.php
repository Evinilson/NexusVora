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
        <div style="background:var(--surface); border:1px solid var(--border); border-radius:12px; padding:24px; margin-bottom:24px;">
            <h3 style="font-size:15px; font-weight:700; margin:0 0 8px;">Tarefas do pacote</h3>
            <p style="font-size:12px; color:var(--muted); margin:0 0 16px;">Cria tarefas sem teres de criar um projeto.</p>
            @forelse($package->tasks->whereNull('parent_task_id') as $task)
            @php $hasDetails = $task->description || $task->subtasks->isNotEmpty(); @endphp
            <div style="padding:9px 0; border-bottom:1px solid var(--border);">
                <div style="display:flex; justify-content:space-between; gap:12px; align-items:center;">
                @if($hasDetails)
                <button type="button" class="task-toggle" aria-expanded="false" aria-controls="task-body-{{ $task->id }}">
                    <span class="task-chevron">▸</span>
                    <span style="font-size:13px; font-weight:600;">{{ $task->title }}</span>
                    @if($task->due_date)<span style="font-size:11px; color:var(--muted);">{{ $task->due_date->format('d/m/Y') }}</span>@endif
                    @if($task->subtasks->isNotEmpty())<span style="font-size:11px; color:var(--cyan);">· {{ $task->subtasks->count() }} {{ $task->subtasks->count() === 1 ? 'subtarefa' : 'subtarefas' }}</span>@endif
                </button>
                @else
                <div style="min-width:0; padding-left:18px;">
                    <span style="font-size:13px; font-weight:600;">{{ $task->title }}</span>@if($task->due_date)<span style="font-size:11px; color:var(--muted); margin-left:8px;">{{ $task->due_date->format('d/m/Y') }}</span>@endif
                </div>
                @endif
                <div style="display:flex; align-items:center; gap:10px; flex-shrink:0;">
                    <span style="font-size:10px; font-weight:700; padding:3px 8px; border-radius:10px; background:{{ $task->statusColor() }}22; color:{{ $task->statusColor() }};">{{ $task->statusLabel() }}</span>
                    <button type="button" class="edit-package-task"
                        data-url="{{ route('admin.hour-packages.tasks.update', [$package, $task]) }}"
                        data-title="{{ $task->title }}"
                        data-description="{{ $task->description }}"
                        data-status="{{ $task->status }}"
                        data-due-date="{{ $task->due_date?->format('Y-m-d') }}"
                        data-can-move="{{ $task->status !== 'concluido' ? '1' : '0' }}"
                        data-task-id="{{ $task->id }}"
                        data-parent-id=""
                        data-has-subtasks="{{ $task->subtasks->isNotEmpty() ? '1' : '0' }}"
                        style="background:none; border:none; color:var(--cyan); cursor:pointer; font-size:12px; padding:2px 0;">Editar</button>
                    <button type="button" class="add-package-subtask" data-parent-id="{{ $task->id }}" data-parent-title="{{ $task->title }}"
                        style="background:none; border:none; color:var(--muted); cursor:pointer; font-size:12px; padding:2px 0; white-space:nowrap;">+ Subtarefa</button>
                    <form method="POST" action="{{ route('admin.hour-packages.tasks.destroy', [$package, $task]) }}" onsubmit="return confirm('Eliminar esta tarefa e todas as respetivas subtarefas?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="background:none; border:none; color:#fb7185; cursor:pointer; font-size:12px; padding:2px 0;">Eliminar</button>
                    </form>
                </div>
                </div>
                @if($hasDetails)
                <div id="task-body-{{ $task->id }}" hidden>
                @if($task->description)<div style="font-size:12px; color:var(--muted); line-height:1.45; margin:6px 0 0 18px;">{{ $task->description }}</div>@endif
                @if($task->subtasks->isNotEmpty())
                <div style="margin:10px 0 0 18px; padding-left:14px; border-left:2px solid rgba(0,212,255,.3);">
                    @foreach($task->subtasks as $subtask)
                    <div style="padding:7px 0;">
                    <div style="display:flex; justify-content:space-between; gap:12px; align-items:center;">
                        @if($subtask->description)
                        <button type="button" class="task-toggle" aria-expanded="false" aria-controls="task-body-{{ $subtask->id }}">
                            <span class="task-chevron">▸</span>
                            <span style="font-size:12px; font-weight:600; color:var(--text);">{{ $subtask->title }}</span>
                        </button>
                        @else
                        <div style="min-width:0; padding-left:18px;">
                            <span style="font-size:12px; font-weight:600; color:var(--text);">{{ $subtask->title }}</span>
                        </div>
                        @endif
                        <div style="display:flex; align-items:center; gap:8px; flex-shrink:0;">
                            <span style="font-size:9px; font-weight:700; padding:3px 7px; border-radius:10px; background:{{ $subtask->statusColor() }}22; color:{{ $subtask->statusColor() }}; white-space:nowrap;">{{ $subtask->statusLabel() }}</span>
                            <button type="button" class="edit-package-task"
                                data-url="{{ route('admin.hour-packages.tasks.update', [$package, $subtask]) }}"
                                data-title="{{ $subtask->title }}" data-description="{{ $subtask->description }}"
                                data-status="{{ $subtask->status }}" data-due-date="{{ $subtask->due_date?->format('Y-m-d') }}"
                                data-can-move="{{ $subtask->status !== 'concluido' ? '1' : '0' }}"
                                data-task-id="{{ $subtask->id }}"
                                data-parent-id="{{ $subtask->parent_task_id }}"
                                data-has-subtasks="0"
                                style="background:none; border:none; color:var(--cyan); cursor:pointer; font-size:11px; padding:2px 0;">Editar</button>
                            <form method="POST" action="{{ route('admin.hour-packages.tasks.destroy', [$package, $subtask]) }}" onsubmit="return confirm('Eliminar esta subtarefa?')">
                                @csrf @method('DELETE')
                                <button type="submit" style="background:none; border:none; color:#fb7185; cursor:pointer; font-size:11px; padding:2px 0;">Eliminar</button>
                            </form>
                        </div>
                    </div>
                    @if($subtask->description)
                    <div id="task-body-{{ $subtask->id }}" hidden style="font-size:11px; color:var(--muted); line-height:1.4; margin:4px 0 0 18px;">{{ $subtask->description }}</div>
                    @endif
                    </div>
                    @endforeach
                </div>
                @endif
                </div>
                @endif
            </div>
            @empty
            <p style="font-size:12px; color:var(--muted); margin:0 0 14px;">Ainda não existem tarefas neste pacote.</p>
            @endforelse
            <form method="POST" action="{{ route('admin.hour-packages.tasks.store', $package) }}" style="display:grid; grid-template-columns:minmax(0,1fr) 150px 130px auto; gap:10px; margin-top:16px;">
                @csrf
                <input type="text" name="title" required placeholder="Nova tarefa..." style="background:rgba(255,255,255,.05); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:13px; width:100%;">
                <input type="date" name="due_date" style="background:var(--surface); border:1px solid var(--border); color:var(--text); padding:9px 12px; border-radius:8px; font-size:13px;">
                <select name="status" style="background:var(--surface); border:1px solid var(--border); color:var(--text); padding:9px 12px; border-radius:8px; font-size:13px;"><option value="a_fazer">A Fazer</option><option value="em_progresso">Em Progresso</option><option value="bloqueado">Bloqueado</option><option value="concluido">Concluído</option></select>
                <button type="submit" style="background:var(--cyan); color:#000; font-weight:700; font-size:13px; padding:9px 16px; border-radius:8px; border:none; cursor:pointer;">Adicionar</button>
                <textarea name="description" rows="2" placeholder="Descrição da tarefa (aparece no relatório de horas)..." style="grid-column:1 / -1; background:rgba(255,255,255,.05); border:1px solid var(--border); color:var(--text); padding:10px 14px; border-radius:8px; font-size:13px; width:100%; resize:vertical;"></textarea>
            </form>
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
                    @if($entry->tasks->isNotEmpty())
                    <div style="font-size:11px; color:var(--cyan); margin-top:3px;">Tarefas: {{ $entry->tasks->pluck('title')->join(' · ') }}</div>
                    @endif
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
                @php
                    $registeredTaskIds = $package->entries->flatMap(fn ($entry) => $entry->tasks->pluck('id'))->unique();
                    $availableTasks = $package->tasks->reject(fn ($task) => $registeredTaskIds->contains($task->id));
                    $taskStatuses = ['concluido', 'em_progresso', 'a_fazer', 'bloqueado'];
                @endphp
                @if($availableTasks->isNotEmpty())
                <fieldset style="border:1px solid var(--border); border-radius:8px; padding:10px 14px; margin:0;">
                    <legend style="padding:0 5px; font-size:12px; color:var(--muted);">Tarefas realizadas (opcional)</legend>
                    @foreach($taskStatuses as $taskStatus)
                    @php $tasksByStatus = $availableTasks->where('status', $taskStatus); @endphp
                    @if($tasksByStatus->isNotEmpty())
                    <div style="font-size:10px; color:var(--muted); font-weight:700; text-transform:uppercase; letter-spacing:.5px; margin:{{ $loop->first ? '2px' : '12px' }} 0 5px;">{{ $tasksByStatus->first()->statusLabel() }}</div>
                    @foreach($tasksByStatus as $task)
                    <label style="display:flex; align-items:center; gap:7px; font-size:12px; color:var(--text); margin:6px 0; cursor:pointer;">
                        <input type="checkbox" name="project_task_ids[]" value="{{ $task->id }}">
                        <span style="flex:1; {{ $task->parent_task_id ? 'color:var(--muted); padding-left:18px;' : '' }}">{{ $task->parent_task_id ? '↳ ' : '' }}{{ $task->project ? $task->project->title . ' — ' : '' }}{{ $task->title }}</span>
                        @if($task->status === 'concluido' && $task->completed_at)
                        <span style="font-size:11px; color:var(--muted); white-space:nowrap;" title="Data de conclusão">{{ $task->completed_at->format('d/m/Y') }}</span>
                        @endif
                        <span style="font-size:10px; font-weight:700; padding:3px 8px; border-radius:10px; background:{{ $task->statusColor() }}22; color:{{ $task->statusColor() }}; white-space:nowrap;">{{ $task->statusLabel() }}</span>
                    </label>
                    @endforeach
                    @endif
                    @endforeach
                </fieldset>
                @endif
                <input type="text" name="title" placeholder="Descrição do trabalho realizado (preenchida pelas tarefas selecionadas)..."
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
                    <dd class="rich-text" style="font-size:12px; margin:0; color:var(--muted); line-height:1.5;">{!! $package->descriptionHtml() !!}</dd></div>
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
                <div>
                    <div style="font-size:12px; font-weight:600; margin-bottom:6px;">Relatório de Tarefas</div>
                    <div style="display:flex; gap:8px;">
                        <a href="{{ route('admin.hour-packages.pdf.tarefas.preview', $package) }}" target="_blank"
                            style="flex:1; text-align:center; font-size:11px; color:var(--muted); border:1px solid var(--border); padding:6px; border-radius:6px; text-decoration:none;">Ver PDF</a>
                        <a href="{{ route('admin.hour-packages.pdf.tarefas.download', $package) }}"
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

<div id="edit-package-task-modal" role="dialog" aria-modal="true" aria-labelledby="edit-package-task-title" aria-hidden="true"
    style="position:fixed; inset:0; z-index:1000; display:none; align-items:center; justify-content:center; padding:20px; background:rgba(2,6,23,.78); backdrop-filter:blur(5px);">
    <div style="width:100%; max-width:520px; background:#0f1733; border:1px solid rgba(0,212,255,.25); border-radius:14px; box-shadow:0 24px 70px rgba(0,0,0,.55); overflow:hidden;">
        <div style="padding:20px 24px 16px; border-bottom:1px solid var(--border);">
            <h2 id="edit-package-task-title" style="font-size:18px; margin:0 0 6px;">Editar tarefa</h2>
            <p style="font-size:12px; color:var(--muted); margin:0;">Atualiza os dados desta tarefa.</p>
        </div>
        <form id="edit-package-task-form" method="POST">
            @csrf @method('PUT')
            <div style="display:flex; flex-direction:column; gap:13px; padding:20px 24px;">
                <input id="package-task-name" name="title" required placeholder="Título" style="width:100%; background:var(--surface-2); border:1px solid var(--border); color:var(--text); padding:10px 12px; border-radius:8px; font-size:13px;">
                <textarea id="package-task-description" name="description" rows="3" placeholder="Descrição (opcional)" style="width:100%; background:var(--surface-2); border:1px solid var(--border); color:var(--text); padding:10px 12px; border-radius:8px; font-size:13px; resize:vertical;"></textarea>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <select id="package-task-status" name="status" style="background:var(--surface-2); border:1px solid var(--border); color:var(--text); padding:10px 12px; border-radius:8px; font-size:13px;"><option value="a_fazer">A Fazer</option><option value="em_progresso">Em Progresso</option><option value="bloqueado">Bloqueado</option><option value="concluido">Concluído</option></select>
                    <input id="package-task-due-date" type="date" name="due_date" style="background:var(--surface-2); border:1px solid var(--border); color:var(--text); padding:10px 12px; border-radius:8px; font-size:13px;">
                </div>
                <div>
                    <label for="package-task-parent" style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px;">Tarefa principal</label>
                    <select id="package-task-parent" name="parent_task_id" style="width:100%; background:var(--surface-2); border:1px solid var(--border); color:var(--text); padding:10px 12px; border-radius:8px; font-size:13px;">
                        <option value="">Nenhuma (é uma tarefa principal)</option>
                        @foreach($package->tasks->whereNull('parent_task_id') as $parentOption)
                        <option value="{{ $parentOption->id }}">{{ $parentOption->title }}</option>
                        @endforeach
                    </select>
                    <p id="package-task-parent-note" style="font-size:11px; color:var(--muted); margin:5px 0 0;">Escolhe uma tarefa para transformar esta numa subtarefa.</p>
                </div>
                <div id="package-task-move-wrap">
                    <label for="package-task-target-package" style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px;">Mover para outro pacote</label>
                    <select id="package-task-target-package" name="target_hour_package_id" style="width:100%; background:var(--surface-2); border:1px solid var(--border); color:var(--text); padding:10px 12px; border-radius:8px; font-size:13px;">
                        <option value="">Manter neste pacote</option>
                        @foreach($otherPackages as $otherPackage)
                        <option value="{{ $otherPackage->id }}">{{ $otherPackage->title }} ({{ $otherPackage->statusLabel() }})</option>
                        @endforeach
                    </select>
                    <p id="package-task-move-note" style="font-size:11px; color:var(--muted); margin:5px 0 0;">Só é possível mover tarefas ainda não concluídas.</p>
                </div>
            </div>
            <div style="display:flex; justify-content:flex-end; gap:10px; padding:16px 24px; border-top:1px solid var(--border);">
                <button id="cancel-edit-package-task" type="button" style="background:transparent; border:1px solid var(--border); color:var(--muted); padding:9px 16px; border-radius:8px; cursor:pointer;">Cancelar</button>
                <button type="submit" style="background:var(--cyan); color:#000; font-weight:700; border:none; padding:9px 16px; border-radius:8px; cursor:pointer;">Guardar</button>
            </div>
        </form>
    </div>
</div>

<div id="add-package-subtask-modal" role="dialog" aria-modal="true" aria-labelledby="add-package-subtask-title" aria-hidden="true"
    style="position:fixed; inset:0; z-index:1000; display:none; align-items:center; justify-content:center; padding:20px; background:rgba(2,6,23,.78); backdrop-filter:blur(5px);">
    <div style="width:100%; max-width:520px; background:#0f1733; border:1px solid rgba(0,212,255,.25); border-radius:14px; box-shadow:0 24px 70px rgba(0,0,0,.55); overflow:hidden;">
        <div style="padding:20px 24px 16px; border-bottom:1px solid var(--border);">
            <h2 id="add-package-subtask-title" style="font-size:18px; margin:0 0 6px;">Adicionar subtarefa</h2>
            <p id="add-package-subtask-parent" style="font-size:12px; color:var(--muted); margin:0;"></p>
        </div>
        <form method="POST" action="{{ route('admin.hour-packages.tasks.store', $package) }}">
            @csrf
            <input id="package-subtask-parent-id" type="hidden" name="parent_task_id">
            <div style="display:flex; flex-direction:column; gap:13px; padding:20px 24px;">
                <input id="package-subtask-title" name="title" required placeholder="Título da subtarefa" style="width:100%; background:var(--surface-2); border:1px solid var(--border); color:var(--text); padding:10px 12px; border-radius:8px; font-size:13px;">
                <textarea name="description" rows="3" placeholder="Descrição (opcional)" style="width:100%; background:var(--surface-2); border:1px solid var(--border); color:var(--text); padding:10px 12px; border-radius:8px; font-size:13px; resize:vertical;"></textarea>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <select name="status" style="background:var(--surface-2); border:1px solid var(--border); color:var(--text); padding:10px 12px; border-radius:8px; font-size:13px;"><option value="a_fazer">A Fazer</option><option value="em_progresso">Em Progresso</option><option value="bloqueado">Bloqueado</option><option value="concluido">Concluído</option></select>
                    <input type="date" name="due_date" style="background:var(--surface-2); border:1px solid var(--border); color:var(--text); padding:10px 12px; border-radius:8px; font-size:13px;">
                </div>
            </div>
            <div style="display:flex; justify-content:flex-end; gap:10px; padding:16px 24px; border-top:1px solid var(--border);">
                <button id="cancel-add-package-subtask" type="button" style="background:transparent; border:1px solid var(--border); color:var(--muted); padding:9px 16px; border-radius:8px; cursor:pointer;">Cancelar</button>
                <button type="submit" style="background:var(--cyan); color:#000; font-weight:700; border:none; padding:9px 16px; border-radius:8px; cursor:pointer;">Adicionar</button>
            </div>
        </form>
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

<style>
    .task-toggle { display:flex; align-items:baseline; flex-wrap:wrap; gap:4px 8px; flex:1; min-width:0; background:none; border:none; padding:0; color:var(--text); text-align:left; cursor:pointer; font:inherit; }
    .task-toggle:hover > span:nth-child(2) { color:var(--cyan); }
    .task-chevron { width:10px; flex-shrink:0; font-size:11px; color:var(--muted); transition:transform .15s; }
    .task-toggle[aria-expanded="true"] .task-chevron { transform:rotate(90deg); }
    .rich-text > :first-child { margin-top:0; }
    .rich-text > :last-child { margin-bottom:0; }
    .rich-text p, .rich-text ul, .rich-text ol { margin:0 0 8px; }
    .rich-text ul, .rich-text ol { padding-left:18px; }
    .rich-text li > p { margin:0 0 2px; }
    .rich-text ul ul, .rich-text ol ul, .rich-text ol ol { margin:2px 0 4px; }
    .rich-text strong, .rich-text h1, .rich-text h2, .rich-text h3 { color:var(--text); }
    .rich-text h1, .rich-text h2, .rich-text h3 { font-size:13px; margin:12px 0 6px; }
    .rich-text a { color:var(--cyan); }
</style>

<script>
    document.querySelectorAll('.task-toggle').forEach(function (button) {
        button.addEventListener('click', function () {
            var body = document.getElementById(button.getAttribute('aria-controls'));
            var open = button.getAttribute('aria-expanded') !== 'true';
            button.setAttribute('aria-expanded', open ? 'true' : 'false');
            body.hidden = !open;
        });
    });

    (function () {
        var modal = document.getElementById('edit-package-task-modal');
        var form = document.getElementById('edit-package-task-form');
        var cancel = document.getElementById('cancel-edit-package-task');
        var name = document.getElementById('package-task-name');
        var description = document.getElementById('package-task-description');
        var status = document.getElementById('package-task-status');
        var dueDate = document.getElementById('package-task-due-date');
        var targetPackage = document.getElementById('package-task-target-package');
        var moveNote = document.getElementById('package-task-move-note');
        var parent = document.getElementById('package-task-parent');
        var parentNote = document.getElementById('package-task-parent-note');

        document.querySelectorAll('.edit-package-task').forEach(function (button) {
            button.addEventListener('click', function () {
                form.action = button.dataset.url;
                name.value = button.dataset.title || '';
                description.value = button.dataset.description || '';
                status.value = button.dataset.status || 'a_fazer';
                dueDate.value = button.dataset.dueDate || '';
                targetPackage.value = '';
                targetPackage.disabled = button.dataset.canMove !== '1';
                moveNote.textContent = targetPackage.disabled
                    ? 'Uma tarefa concluída não pode ser movida para outro pacote.'
                    : 'Só é possível mover tarefas ainda não concluídas.';
                Array.prototype.forEach.call(parent.options, function (option) {
                    option.hidden = option.disabled = option.value !== '' && option.value === button.dataset.taskId;
                });
                parent.value = button.dataset.parentId || '';
                parent.disabled = button.dataset.hasSubtasks === '1';
                parentNote.textContent = parent.disabled
                    ? 'Esta tarefa tem subtarefas, por isso não pode passar a subtarefa.'
                    : 'Escolhe uma tarefa para transformar esta numa subtarefa.';
                modal.style.display = 'flex';
                modal.setAttribute('aria-hidden', 'false');
                name.focus();
            });
        });
        function close() { modal.style.display = 'none'; modal.setAttribute('aria-hidden', 'true'); }
        cancel.addEventListener('click', close);
        modal.addEventListener('click', function (event) { if (event.target === modal) close(); });
    })();

    (function () {
        var modal = document.getElementById('add-package-subtask-modal');
        var parentId = document.getElementById('package-subtask-parent-id');
        var parentLabel = document.getElementById('add-package-subtask-parent');
        var title = document.getElementById('package-subtask-title');
        var cancel = document.getElementById('cancel-add-package-subtask');

        document.querySelectorAll('.add-package-subtask').forEach(function (button) {
            button.addEventListener('click', function () {
                parentId.value = button.dataset.parentId;
                parentLabel.textContent = 'Tarefa principal: ' + button.dataset.parentTitle;
                title.value = '';
                modal.style.display = 'flex';
                modal.setAttribute('aria-hidden', 'false');
                title.focus();
            });
        });

        function close() { modal.style.display = 'none'; modal.setAttribute('aria-hidden', 'true'); }
        cancel.addEventListener('click', close);
        modal.addEventListener('click', function (event) { if (event.target === modal) close(); });
    })();

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
