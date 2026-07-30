<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentLog extends Model
{
    protected $fillable = [
        'project_id',
        'client_id',
        'type',
        'sent_to_email',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function typeLabel(): string
    {
        return match ($this->type) {
            'inicio_projeto'  => 'Ficha de Início de Projeto',
            'lista_tarefas'   => 'Lista de Tarefas',
            'relatorio_estado' => 'Relatório de Estado',
            default           => $this->type,
        };
    }
}
