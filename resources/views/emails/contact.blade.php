<!DOCTYPE html>
<html>
<head>
    <title>Novo Contacto - NexusVora</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Novo pedido de contacto recebido!</h2>
    <p><strong>Nome:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Telefone:</strong> {{ $data['phone'] ?? 'Não indicado' }}</p>
    <p><strong>Empresa:</strong> {{ $data['company'] ?? 'Não indicada' }}</p>
    <p><strong>Sector:</strong> {{ $data['sector'] ?? 'Não indicado' }}</p>
    <p><strong>Categoria selecionada:</strong> {{ $data['category'] ?? 'Não indicada' }}</p>
    <p><strong>Plano selecionado:</strong> {{ $data['plan'] ?? 'Não indicado' }}</p>
    <p><strong>Serviços de interesse:</strong> {{ $data['services'] ?? 'Não indicado' }}</p>
    <br>
    <p><strong>Mensagem:</strong></p>
    <p style="background: #f4f4f4; padding: 15px; border-radius: 5px;">
        {!! nl2br(e($data['message'])) !!}
    </p>
</body>
</html>
