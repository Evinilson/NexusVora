<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class HourPackageEntry extends Model
{
    protected $fillable = [
        'hour_package_id', 'performed_at', 'title', 'description', 'hours',
        'project_task_id',
    ];

    protected $casts = [
        'performed_at' => 'date',
        'hours'        => 'decimal:2',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(HourPackage::class, 'hour_package_id');
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(ProjectTask::class, 'project_task_id');
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(
            ProjectTask::class,
            'hour_package_entry_task',
            'hour_package_entry_id',
            'project_task_id'
        );
    }
}
