<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $project->title }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">

    <div style="background: #0a0a1a; padding: 24px 30px; border-radius: 8px 8px 0 0;">
        <span style="color: #00d4ff; font-size: 20px; font-weight: 700; letter-spacing: 1px;">NexusVora</span>
    </div>

    <div style="border: 1px solid #e0e0e0; border-top: none; padding: 30px; border-radius: 0 0 8px 8px;">
        <p>Olá, <strong>{{ $project->client->name }}</strong>,</p>

        <p style="margin-top: 14px;">
            Enviamos em anexo o documento
            <strong>
                @if($documentType === 'inicio_projeto') Ficha de Início de Projeto
                @elseif($documentType === 'lista_tarefas') Lista de Tarefas
                @else Relatório de Estado
                @endif
            </strong>
            referente ao projeto <strong>{{ $project->title }}</strong>.
        </p>

        <div style="background: #f0f7ff; border-left: 3px solid #00aacc; padding: 14px 18px; margin: 20px 0; border-radius: 0 6px 6px 0;">
            <p style="margin: 0; font-size: 13px;">
                <strong>Projeto:</strong> {{ $project->title }}<br>
                <strong>Estado:</strong> {{ $project->statusLabel() }}<br>
                @if($project->end_date)
                <strong>Entrega Prevista:</strong> {{ $project->end_date->format('d/m/Y') }}<br>
                @endif
            </p>
        </div>

        <p>Para qualquer questão ou esclarecimento, não hesite em contactar-nos.</p>

        <p style="margin-top: 24px;">
            Com os melhores cumprimentos,<br>
            <strong>Equipa NexusVora</strong>
        </p>
    </div>

    <p style="font-size: 11px; color: #aaa; margin-top: 16px; text-align: center;">
        NexusVora · geral@nexusvora.pt · nexusvora.pt<br>
        Porto, Portugal
    </p>

</body>
</html>
