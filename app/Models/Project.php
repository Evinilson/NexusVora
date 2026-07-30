<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'client_id',
        'title',
        'status',
        'start_date',
        'end_date',
        'description',
        'budget',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'budget'     => 'decimal:2',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(ProjectTask::class)->orderBy('sort_order');
    }

    public function documentLogs(): HasMany
    {
        return $this->hasMany(DocumentLog::class);
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'proposta'  => 'Proposta',
            'ativo'     => 'Ativo',
            'em_pausa'  => 'Em Pausa',
            'concluido' => 'Concluído',
            'cancelado' => 'Cancelado',
            default     => $this->status,
        };
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            'proposta'  => '#6b7280',
            'ativo'     => '#10b981',
            'em_pausa'  => '#f59e0b',
            'concluido' => '#3b82f6',
            'cancelado' => '#ef4444',
            default     => '#6b7280',
        };
    }
}
