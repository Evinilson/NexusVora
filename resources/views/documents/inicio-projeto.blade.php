<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: Arial, sans-serif; font-size: 13px; color: #1a1a2e; background: #fff; }

    .header { background: #0a0a1a; color: #fff; padding: 22px 40px; }
    .header-table { width: 100%; border-collapse: collapse; }
    .header-brand, .header-title { vertical-align: middle; }
    .header-title { text-align: right; color: #fff; font-size: 13px; font-weight: bold; }
    .header-logo img { width: 34px; height: 34px; vertical-align: middle; }
    .header-logo-text { display: inline-block; vertical-align: middle; margin-left: 10px; font-size: 20px; font-weight: bold; letter-spacing: -0.5px; }
    .header-logo-text .nx { color: #dcebff; }
    .header-logo-text .vr { color: #00d4ff; }
    .header-meta { text-align: right; vertical-align: top; padding-top: 5px; font-size: 11px; color: #aaa; line-height: 1.7; }

    .doc-title { background: linear-gradient(135deg, #0d1b4b, #1a3a7a); color: #fff; padding: 20px 40px; }
    .doc-title h1 { font-size: 20px; font-weight: 700; letter-spacing: 0.5px; }
    .doc-title p { font-size: 11px; color: #a0b4d0; margin-top: 4px; }

    .content { padding: 30px 40px; }

    .section { margin-bottom: 28px; }
    .section-title { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #00aacc; border-bottom: 1px solid #e0e0e0; padding-bottom: 6px; margin-bottom: 14px; }

    .info-grid { display: table; width: 100%; border-collapse: collapse; }
    .info-row { display: table-row; }
    .info-label { display: table-cell; width: 35%; padding: 7px 10px 7px 0; font-weight: 700; color: #555; font-size: 12px; vertical-align: top; }
    .info-value { display: table-cell; padding: 7px 0; color: #1a1a2e; font-size: 12px; vertical-align: top; }

    .highlight-box { background: #f0f7ff; border-left: 3px solid #00aacc; padding: 14px 18px; border-radius: 0 6px 6px 0; margin-bottom: 10px; }
    .highlight-box p { font-size: 12px; line-height: 1.7; color: #333; }

    .services-list { list-style: none; padding: 0; }
    .services-list li { padding: 8px 12px; font-size: 12px; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; }
    .services-list li:before { content: "✓"; color: #00aacc; font-weight: 700; margin-right: 10px; }

    .footer { background: #f8f8f8; border-top: 1px solid #e0e0e0; padding: 16px 40px; display: flex; justify-content: space-between; align-items: center; }
    .footer-left { font-size: 10px; color: #888; }
    .footer-right { font-size: 10px; color: #888; }

    table.data-table { width: 100%; border-collapse: collapse; font-size: 12px; }
    table.data-table th { background: #0d1b4b; color: #fff; padding: 9px 12px; text-align: left; font-size: 11px; }
    table.data-table td { padding: 8px 12px; border-bottom: 1px solid #eee; vertical-align: top; }
    table.data-table tr:nth-child(even) td { background: #f9f9f9; }

    .badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #fff; }
</style>
</head>
<body>

<div class="header">
    <table class="header-table">
        <tr>
            <td class="header-brand">
                <div class="header-logo">
                    <img src="{{ public_path('img/logo/logo-pdf.jpg') }}" alt="NexusVora">
                    <div class="header-logo-text"><span class="nx">Nexus</span><span class="vr">Vora</span></div>
                </div>
            </td>
            <td class="header-title">Ficha de Início de Projeto</td>
        </tr>
        <tr>
            <td></td>
            <td class="header-meta">
                Referência: NV-{{ str_pad($project->id, 4, '0', STR_PAD_LEFT) }}<br>
                Data: {{ now()->format('d/m/Y') }}<br>
                Documento confidencial
            </td>
        </tr>
    </table>
</div>

<div class="doc-title">
    <h1>{{ $project->title }}</h1>
    <p>Documento de arranque e definição de âmbito do projeto</p>
</div>

<div class="content">

    {{-- Dados do Cliente --}}
    <div class="section">
        <div class="section-title">Dados do Cliente</div>
        <div class="info-grid">
            @if($project->client->company)
            <div class="info-row">
                <div class="info-label">Empresa</div>
                <div class="info-value">{{ $project->client->company }}</div>
            </div>
            @endif
            <div class="info-row">
                <div class="info-label">Nome do Responsável</div>
                <div class="info-value">{{ $project->client->name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email</div>
                <div class="info-value">{{ $project->client->email }}</div>
            </div>
            @if($project->client->phone)
            <div class="info-row">
                <div class="info-label">Telefone</div>
                <div class="info-value">{{ $project->client->phone }}</div>
            </div>
            @endif
            @if($project->client->nif)
            <div class="info-row">
                <div class="info-label">NIF</div>
                <div class="info-value">{{ $project->client->nif }}</div>
            </div>
            @endif
            @if($project->client->address)
            <div class="info-row">
                <div class="info-label">Morada</div>
                <div class="info-value">{{ $project->client->address }}</div>
            </div>
            @endif
        </div>
    </div>

    {{-- Dados do Projeto --}}
    <div class="section">
        <div class="section-title">Dados do Projeto</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Nome do Projeto</div>
                <div class="info-value">{{ $project->title }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Estado</div>
                <div class="info-value">
                    <span class="badge" style="background: {{ $project->statusColor() }}">{{ $project->statusLabel() }}</span>
                </div>
            </div>
            @if($project->start_date)
            <div class="info-row">
                <div class="info-label">Data de Início</div>
                <div class="info-value">{{ $project->start_date->format('d/m/Y') }}</div>
            </div>
            @endif
            @if($project->end_date)
            <div class="info-row">
                <div class="info-label">Data Prevista de Entrega</div>
                <div class="info-value">{{ $project->end_date->format('d/m/Y') }}</div>
            </div>
            @endif
            @if($project->budget)
            <div class="info-row">
                <div class="info-label">Orçamento</div>
                <div class="info-value">{{ number_format($project->budget, 2, ',', '.') }} €</div>
            </div>
            @endif
        </div>
    </div>

    {{-- Descrição / Âmbito --}}
    @if($project->description)
    <div class="section">
        <div class="section-title">Âmbito e Objetivos</div>
        <div class="highlight-box">
            <p>{{ $project->description }}</p>
        </div>
    </div>
    @endif

    {{-- Tarefas / Entregáveis --}}
    @if($project->tasks->count())
    <div class="section">
        <div class="section-title">Entregáveis Previstos</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tarefa / Entregável</th>
                    <th>Prazo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($project->tasks as $i => $task)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->due_date ? $task->due_date->format('d/m/Y') : '—' }}</td>
                    <td><span class="badge" style="background: {{ $task->statusColor() }}">{{ $task->statusLabel() }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    {{-- Nota de rodapé do conteúdo --}}
    <div class="section">
        <div class="section-title">Declaração de Arranque</div>
        <div class="highlight-box">
            <p>
                O presente documento confirma o arranque formal do projeto <strong>{{ $project->title }}</strong>
                entre a <strong>NexusVora</strong> e o cliente <strong>{{ $project->client->company ?: $project->client->name }}</strong>.
                Ao receber este documento, o cliente confirma que os dados, âmbito e entregáveis descritos
                correspondem ao acordado.
            </p>
        </div>
    </div>

</div>

<div class="footer">
    <div class="footer-left">NexusVora — geral@nexusvora.pt · nexusvora.pt</div>
    <div class="footer-right">Documento gerado em {{ now()->format('d/m/Y \à\s H:i') }}</div>
</div>

</body>
</html>
