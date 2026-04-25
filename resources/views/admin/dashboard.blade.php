@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="grid">
        <article class="stat">
            <p class="stat-label">Servicos</p>
            <p class="stat-value">{{ $totalServices }}</p>
        </article>

        <article class="stat">
            <p class="stat-label">Servicos publicados</p>
            <p class="stat-value">{{ $publishedServices }}</p>
        </article>

        <article class="stat">
            <p class="stat-label">Pedidos de contacto</p>
            <p class="stat-value">{{ $totalLeads }}</p>
        </article>

        <article class="stat">
            <p class="stat-label">Pedidos novos</p>
            <p class="stat-value">{{ $newLeads }}</p>
        </article>
    </div>

    <section class="panel">
        <h2>Estado do painel</h2>
        <p>
            A base do admin esta pronta: login protegido, middleware de administrador,
            dashboard inicial, models e tabelas principais. O proximo passo e criar
            as paginas CRUD para servicos, pedidos de contacto e configuracoes.
        </p>
    </section>

    <section class="panel">
        <h2>Configuracoes registadas</h2>
        <p>{{ $settingsCount }} configuracoes encontradas na base de dados.</p>
    </section>
@endsection
