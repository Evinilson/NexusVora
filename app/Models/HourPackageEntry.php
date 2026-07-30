<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HourPackageEntry extends Model
{
    protected $fillable = [
        'hour_package_id', 'performed_at', 'title', 'description', 'hours',
    ];

    protected $casts = [
        'performed_at' => 'date',
        'hours'        => 'decimal:2',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(HourPackage::class, 'hour_package_id');
    }
}
