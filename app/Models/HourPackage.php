<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HourPackage extends Model
{
    protected $fillable = [
        'client_id', 'project_id', 'title', 'total_hours',
        'price', 'purchased_at', 'expires_at', 'status', 'description',
    ];

    protected $casts = [
        'total_hours'  => 'decimal:2',
        'price'        => 'decimal:2',
        'purchased_at' => 'date',
        'expires_at'   => 'date',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function entries(): HasMany
    {
        return $this->hasMany(HourPackageEntry::class)->orderByDesc('performed_at');
    }

    // Horas já utilizadas
    public function usedHours(): float
    {
        return (float) $this->entries()->sum('hours');
    }

    // Horas restantes
    public function remainingHours(): float
    {
        return max(0, (float) $this->total_hours - $this->usedHours());
    }

    // Percentagem consumida
    public function usedPercent(): int
    {
        if ((float) $this->total_hours <= 0) return 0;
        return min(100, (int) round(($this->usedHours() / (float) $this->total_hours) * 100));
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'ativo'     => 'Ativo',
            'esgotado'  => 'Esgotado',
            'expirado'  => 'Expirado',
            'cancelado' => 'Cancelado',
            default     => $this->status,
        };
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            'ativo'     => '#10b981',
            'esgotado'  => '#f59e0b',
            'expirado'  => '#6b7280',
            'cancelado' => '#ef4444',
            default     => '#6b7280',
        };
    }

    // Auto-atualiza o estado com base nas horas e validade
    public function syncStatus(): void
    {
        if ($this->status === 'cancelado') return;

        if ($this->remainingHours() <= 0) {
            $this->update(['status' => 'esgotado']);
        } elseif ($this->expires_at && $this->expires_at->isPast()) {
            $this->update(['status' => 'expirado']);
        } else {
            $this->update(['status' => 'ativo']);
        }
    }
}
