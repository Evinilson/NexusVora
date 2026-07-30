<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SecureShare extends Model
{
    protected $fillable = [
        'title',
        'recipient_name',
        'recipient_email',
        'token',
        'access_code_hash',
        'secure_url',
        'secret_payload',
        'expires_at',
        'last_accessed_at',
        'access_count',
    ];

    protected $casts = [
        'secure_url' => 'encrypted',
        'secret_payload' => 'encrypted',
        'expires_at' => 'datetime',
        'last_accessed_at' => 'datetime',
    ];

    public static function makeToken(): string
    {
        do {
            $token = Str::random(48);
        } while (self::where('token', $token)->exists());

        return $token;
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    public function statusLabel(): string
    {
        return $this->isExpired() ? 'Expirada' : 'Ativa';
    }

    public function statusColor(): string
    {
        return $this->isExpired() ? '#fb7185' : '#10b981';
    }

    public function timeLeftLabel(): string
    {
        if ($this->isExpired()) {
            return 'Expirou em '.$this->expires_at->format('d/m/Y H:i');
        }

        return 'Expira '.$this->expires_at->diffForHumans();
    }

    public function checkAccessCode(string $code): bool
    {
        return Hash::check($code, $this->access_code_hash);
    }

    public function recordAccess(): void
    {
        $this->forceFill([
            'last_accessed_at' => Carbon::now(),
            'access_count' => $this->access_count + 1,
        ])->save();
    }
}
