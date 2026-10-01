<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectTask extends Model
{
    protected $fillable = [
        'project_id',
        'hour_package_id',
        'parent_task_id',
        'title',
        'description',
        'status',
        'due_date',
        'sort_order',
    ];

    protected $casts = [
        'due_date' => 'date',
        'completed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $task) {
            if ($task->status !== 'concluido') {
                $task->completed_at = null;

                return;
            }

            // Numa tarefa concluída, a data da tarefa é a data de conclusão.
            if ($task->isDirty('due_date') && $task->due_date) {
                $task->completed_at = $task->due_date;
            } elseif ($task->isDirty('status')) {
                $task->completed_at = $task->due_date && $task->due_date->lte(today())
                    ? $task->due_date
                    : now();
            }
        });
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function hourPackage(): BelongsTo
    {
        return $this->belongsTo(HourPackage::class);
    }

    public function parentTask(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_task_id');
    }

    public function subtasks(): HasMany
    {
        return $this->hasMany(self::class, 'parent_task_id')->orderBy('sort_order');
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
