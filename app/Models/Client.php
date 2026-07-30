<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $fillable = [
        'name',
        'company',
        'email',
        'phone',
        'nif',
        'address',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function documentLogs(): HasMany
    {
        return $this->hasMany(DocumentLog::class);
    }
}
