<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectTask extends Model
{
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'status',
        'due_date',
        'sort_order',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'a_fazer'     => 'A Fazer',
            'em_progresso' => 'Em Progresso',
            'concluido'   => 'Concluído',
            'bloqueado'   => 'Bloqueado',
            default       => $this->status,
        };
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            'a_fazer'     => '#6b7280',
            'em_progresso' => '#f59e0b',
            'concluido'   => '#10b981',
            'bloqueado'   => '#ef4444',
            default       => '#6b7280',
        };
    }
}
