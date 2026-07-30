@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    @php
        $money = fn ($value) => number_format((float) $value, 2, ',', '.') . ' €';
        $projectStatuses = [
            'proposta' => 'Proposta',
            'ativo' => 'Ativo',
            'em_pausa' => 'Em pausa',
            'concluido' => 'Concluido',
            'cancelado' => 'Cancelado',
        ];
        $packageStatuses = [
            'ativo' => 'Ativo',
            'esgotado' => 'Esgotado',
            'expirado' => 'Expirado',
            'cancelado' => 'Cancelado',
        ];
        $projectSlice = max(0, min(100, $profitShare['projects']));
    @endphp

    <style>
        .dash-hero {
            display: grid;
            grid-template-columns: minmax(0, 1.35fr) minmax(280px, 0.65fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .hero-main,
        .hero-side,
        .chart-panel,
        .table-panel {
            border: 1px solid var(--border);
            border-radius: 8px;
            background: linear-gradient(180deg, rgba(17,25,54,0.96), rgba(10,15,46,0.96));
            box-shadow: 0 18px 52px rgba(0,0,0,0.22);
        }

        .hero-main {
            position: relative;
            overflow: hidden;
            min-height: 260px;
            padding: 26px;
        }

        .hero-main::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 18% 18%, rgba(0,212,255,0.2), transparent 28%),
                radial-gradient(circle at 82% 18%, rgba(74,108,247,0.22), transparent 30%),
                linear-gradient(135deg, rgba(0,212,255,0.12), rgba(139,63,219,0.08));
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .eyebrow {
            margin: 0 0 8px;
            color: var(--cyan);
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .hero-title {
            max-width: 760px;
            margin: 0;
            font-size: clamp(1.8rem, 3vw, 3rem);
            line-height: 1.05;
            letter-spacing: 0;
        }

        .hero-copy {
            max-width: 680px;
            margin: 14px 0 0;
            color: #cbd5e1;
            line-height: 1.65;
        }

        .hero-metrics {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-top: 26px;
        }

        .metric-card {
            min-height: 126px;
            padding: 18px;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            background: rgba(6,11,32,0.58);
        }

        .metric-label {
            margin: 0 0 12px;
            color: var(--muted);
            font-size: 0.82rem;
            font-weight: 700;
        }

        .metric-value {
            margin: 0;
            color: #f8fafc;
            font-size: clamp(1.3rem, 1.9vw, 2rem);
            font-weight: 800;
            line-height: 1.08;
            white-space: nowrap;
        }

        .metric-note {
            margin: 10px 0 0;
            color: var(--muted);
            font-size: 0.78rem;
        }

        .hero-side {
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 22px;
        }

        .donut-wrap {
            display: grid;
            place-items: center;
            min-height: 210px;
        }

        .donut {
            width: min(210px, 100%);
            aspect-ratio: 1;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background:
                radial-gradient(circle at center, var(--surface-2) 0 54%, transparent 55%),
                conic-gradient(#00d4ff 0 {{ $projectSlice }}%, #8b3fdb {{ $projectSlice }}% 100%);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.08), 0 20px 50px rgba(0,0,0,0.25);
        }

        .donut-center {
            text-align: center;
        }

        .donut-number {
            margin: 0;
            font-size: 2rem;
            font-weight: 800;
        }

        .donut-label {
            margin: 4px 0 0;
            color: var(--muted);
            font-size: 0.78rem;
        }

        .legend {
            display: grid;
            gap: 10px;
        }

        .legend-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            color: var(--muted);
            font-size: 0.86rem;
        }

        .legend-name {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #dbeafe;
            font-weight: 700;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .dot-projects { background: #00d4ff; }
        .dot-packages { background: #8b3fdb; }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(116px, 1fr)) auto;
            gap: 10px;
            align-items: end;
        }

        .chart-filters {
            margin: 14px 0 20px;
            padding: 14px;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 8px;
            background: rgba(6,11,32,0.42);
            grid-template-columns: repeat(5, minmax(110px, 1fr));
        }

        .field label {
            display: block;
            margin-bottom: 7px;
            color: var(--muted);
            font-size: 0.78rem;
            font-weight: 700;
        }

        .field input,
        .field select {
            width: 100%;
            min-height: 42px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--surface);
            color: var(--text);
            padding: 10px 12px;
            font-size: 0.88rem;
        }

        .chart-filters .field input,
        .chart-filters .field select {
            min-height: 38px;
            padding: 8px 10px;
            font-size: 0.8rem;
        }

        .chart-filters .field label {
            font-size: 0.7rem;
        }

        .filter-actions {
            display: flex;
            gap: 10px;
            min-width: 0;
        }

        .button-primary,
        .button-muted {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 0.86rem;
            font-weight: 800;
            cursor: pointer;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        .chart-filters .button-primary,
        .chart-filters .button-muted {
            min-height: 38px;
            padding: 8px 12px;
            font-size: 0.78rem;
        }

        .chart-filters .filter-actions {
            grid-column: 1 / -1;
            justify-content: flex-end;
        }

        .button-primary {
            background: var(--cyan);
            color: #00111a;
        }

        .button-muted {
            background: rgba(255,255,255,0.04);
            border-color: var(--border);
            color: var(--muted);
        }

        .chart-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 20px;
            margin-bottom: 20px;
        }

        .chart-panel,
        .table-panel {
            padding: 22px;
        }

        .panel-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 18px;
        }

        .panel-heading h2 {
            margin: 0;
            font-size: 1.05rem;
        }

        .panel-kicker {
            margin: 5px 0 0;
            color: var(--muted);
            font-size: 0.82rem;
        }

        .panel-total {
            color: var(--cyan);
            font-size: 0.92rem;
            font-weight: 800;
            white-space: nowrap;
        }

        .bar-chart {
            display: grid;
            grid-template-columns: repeat({{ max(1, $monthlyProfit->count()) }}, minmax(44px, 1fr));
            gap: 14px;
            min-height: 280px;
            align-items: end;
            padding: 10px 0 0;
        }

        .bar-group {
            min-width: 0;
            display: grid;
            grid-template-rows: 1fr auto auto;
            gap: 10px;
            height: 260px;
        }

        .bar-stack {
            height: 190px;
            display: flex;
            align-items: end;
            justify-content: center;
            gap: 5px;
            padding: 0 2px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .bar {
            width: 18px;
            min-height: 4px;
            border-radius: 6px 6px 0 0;
        }

        .bar.projects {
            background: linear-gradient(180deg, #7ee7ff, #00d4ff);
        }

        .bar.packages {
            background: linear-gradient(180deg, #c084fc, #8b3fdb);
        }

        .bar-value {
            color: #dbeafe;
            font-size: 0.72rem;
            font-weight: 800;
            text-align: center;
            min-height: 28px;
            overflow-wrap: anywhere;
        }

        .bar-label {
            color: var(--muted);
            font-size: 0.72rem;
            text-align: center;
            white-space: nowrap;
        }

        .mini-stats {
            display: grid;
            gap: 12px;
        }

        .mini-stat {
            padding: 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: rgba(255,255,255,0.035);
        }

        .mini-stat p {
            margin: 0;
            color: var(--muted);
            font-size: 0.8rem;
        }

        .mini-stat strong {
            display: block;
            margin-top: 8px;
            color: var(--text);
            font-size: 1.35rem;
            overflow-wrap: anywhere;
        }

        .table-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .dashboard-table {
            width: 100%;
            border-collapse: collapse;
        }

        .dashboard-table th {
            padding: 0 0 10px;
            color: var(--muted);
            font-size: 0.72rem;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .dashboard-table td {
            padding: 12px 0;
            border-top: 1px solid var(--border);
            font-size: 0.86rem;
            vertical-align: top;
        }

        .dashboard-table td:last-child,
        .dashboard-table th:last-child {
            text-align: right;
        }

        .item-title {
            margin: 0 0 4px;
            font-weight: 700;
        }

        .item-meta,
        .empty-state {
            margin: 0;
            color: var(--muted);
            font-size: 0.78rem;
            line-height: 1.55;
        }

        @media (max-width: 1180px) {
            .dash-hero,
            .chart-grid,
            .table-grid {
                grid-template-columns: 1fr;
            }

            .filter-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .hero-metrics,
            .filter-grid {
                grid-template-columns: 1fr;
            }

            .filter-actions {
                flex-direction: column;
            }

            .bar-chart {
                overflow-x: auto;
                grid-template-columns: repeat({{ max(1, $monthlyProfit->count()) }}, 72px);
                padding-bottom: 6px;
            }
        }
    </style>

    <section class="dash-hero">
        <div class="hero-main">
            <div class="hero-content">
                <p class="eyebrow">Dashboard financeiro</p>
                <h2 class="hero-title">Lucros acumulados, pipeline e vendas num so painel</h2>
                <p class="hero-copy">
                    Uma leitura rapida do valor bruto estimado: projetos fechados ou planeados,
                    pacotes de horas vendidos e pedidos comerciais que ainda precisam de resposta.
                </p>

                <div class="hero-metrics">
                    <article class="metric-card">
                        <p class="metric-label">Lucro acumulado</p>
                        <p class="metric-value">{{ $money($totalProfit) }}</p>
                        <p class="metric-note">Projetos + pacotes filtrados</p>
                    </article>

                    <article class="metric-card">
                        <p class="metric-label">Projetos</p>
                        <p class="metric-value">{{ $filteredProjects->count() }}</p>
                        <p class="metric-note">{{ $money($projectProfit) }} em orcamentos</p>
                    </article>

                    <article class="metric-card">
                        <p class="metric-label">Pacotes</p>
                        <p class="metric-value">{{ $filteredPackages->count() }}</p>
                        <p class="metric-note">{{ $money($packageProfit) }} em horas</p>
                    </article>
                </div>
            </div>
        </div>

        <aside class="hero-side">
            <div>
                <p class="eyebrow">Grafico circular</p>
                <h2 style="margin:0; font-size:1.1rem;">Origem do lucro</h2>
            </div>

            <div class="donut-wrap">
                <div class="donut" role="img" aria-label="Distribuicao do lucro entre projetos e pacotes">
                    <div class="donut-center">
                        <p class="donut-number">{{ $profitShare['projects'] }}%</p>
                        <p class="donut-label">Projetos</p>
                    </div>
                </div>
            </div>

            <div class="legend">
                <div class="legend-row">
                    <span class="legend-name"><span class="dot dot-projects"></span>Projetos</span>
                    <strong>{{ $money($projectProfit) }}</strong>
                </div>
                <div class="legend-row">
                    <span class="legend-name"><span class="dot dot-packages"></span>Pacotes</span>
                    <strong>{{ $money($packageProfit) }}</strong>
                </div>
            </div>
        </aside>
    </section>

    <section class="chart-grid">
        <div class="chart-panel">
            <div class="panel-heading">
                <div>
                    <h2>Evolucao mensal</h2>
                    <p class="panel-kicker">Grafico normal por mes, separado por projetos e pacotes.</p>
                </div>
                <span class="panel-total">{{ $money($totalProfit) }}</span>
            </div>

            <form method="GET" action="{{ route('admin.dashboard') }}" class="filter-grid chart-filters">
                <div class="field">
                    <label for="from">Desde</label>
                    <input id="from" type="date" name="from" value="{{ $filters['from'] ?? '' }}">
                </div>

                <div class="field">
                    <label for="to">Ate</label>
                    <input id="to" type="date" name="to" value="{{ $filters['to'] ?? '' }}">
                </div>

                <div class="field">
                    <label for="client_id">Cliente</label>
                    <select id="client_id" name="client_id">
                        <option value="">Todos</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" @selected(($filters['client_id'] ?? '') == $client->id)>
                                {{ $client->company ?: $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label for="project_status">Projeto</label>
                    <select id="project_status" name="project_status">
                        <option value="">Todos</option>
                        @foreach($projectStatuses as $value => $label)
                            <option value="{{ $value }}" @selected(($filters['project_status'] ?? '') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label for="package_status">Pacote</label>
                    <select id="package_status" name="package_status">
                        <option value="">Todos</option>
                        @foreach($packageStatuses as $value => $label)
                            <option value="{{ $value }}" @selected(($filters['package_status'] ?? '') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-actions">
                    <button type="submit" class="button-primary">Filtrar</button>
                    <a href="{{ route('admin.dashboard') }}" class="button-muted">Limpar</a>
                </div>
            </form>

            <div class="bar-chart">
                @foreach($monthlyProfit as $month)
                    @php
                        $projectHeight = max(4, round(((float) $month['projects'] / $maxMonthlyProfit) * 170));
                        $packageHeight = max(4, round(((float) $month['packages'] / $maxMonthlyProfit) * 170));
                    @endphp
                    <div class="bar-group">
                        <div class="bar-stack" title="{{ $month['label'] }}: {{ $money($month['total']) }}">
                            <span class="bar projects" style="height:{{ $projectHeight }}px"></span>
                            <span class="bar packages" style="height:{{ $packageHeight }}px"></span>
                        </div>
                        <div class="bar-value">{{ $money($month['total']) }}</div>
                        <div class="bar-label">{{ $month['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <aside class="chart-panel">
            <div class="panel-heading">
                <div>
                    <h2>Operacao</h2>
                    <p class="panel-kicker">Sinais rapidos do admin.</p>
                </div>
            </div>

            <div class="mini-stats">
                <div class="mini-stat">
                    <p>Pedidos novos</p>
                    <strong>{{ $newLeads }}</strong>
                </div>
                <div class="mini-stat">
                    <p>Pedidos de contacto</p>
                    <strong>{{ $totalLeads }}</strong>
                </div>
                <div class="mini-stat">
                    <p>Servicos publicados</p>
                    <strong>{{ $publishedServices }} / {{ $totalServices }}</strong>
                </div>
                <div class="mini-stat">
                    <p>Configuracoes</p>
                    <strong>{{ $settingsCount }}</strong>
                </div>
            </div>
        </aside>
    </section>

    <section class="table-grid">
        <div class="table-panel">
            <div class="panel-heading">
                <div>
                    <h2>Projetos no filtro</h2>
                    <p class="panel-kicker">Top 8 resultados mais recentes.</p>
                </div>
                <span class="panel-total">{{ $money($projectProfit) }}</span>
            </div>

            @if($filteredProjects->isEmpty())
                <p class="empty-state">Nao existem projetos para os filtros selecionados.</p>
            @else
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Projeto</th>
                            <th>Estado</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($filteredProjects->take(8) as $project)
                            <tr>
                                <td>
                                    <p class="item-title">
                                        <a href="{{ route('admin.projects.show', $project) }}">{{ $project->title }}</a>
                                    </p>
                                    <p class="item-meta">{{ $project->client?->company ?: $project->client?->name ?: 'Sem cliente' }}</p>
                                </td>
                                <td>{{ $project->statusLabel() }}</td>
                                <td>{{ $money($project->budget) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="table-panel">
            <div class="panel-heading">
                <div>
                    <h2>Pacotes de horas</h2>
                    <p class="panel-kicker">Top 8 resultados mais recentes.</p>
                </div>
                <span class="panel-total">{{ $money($packageProfit) }}</span>
            </div>

            @if($filteredPackages->isEmpty())
                <p class="empty-state">Nao existem pacotes de horas para os filtros selecionados.</p>
            @else
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Pacote</th>
                            <th>Estado</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($filteredPackages->take(8) as $package)
                            <tr>
                                <td>
                                    <p class="item-title">
                                        <a href="{{ route('admin.hour-packages.show', $package) }}">{{ $package->title }}</a>
                                    </p>
                                    <p class="item-meta">{{ $package->client?->company ?: $package->client?->name ?: 'Sem cliente' }}</p>
                                </td>
                                <td>{{ $package->statusLabel() }}</td>
                                <td>{{ $money($package->price) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>
@endsection
