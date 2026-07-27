<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduledJob extends Model
{
    protected $fillable = [
        'job_id', 'scheduled_date', 'scheduled_end', 'status', 'notes',
    ];

    protected $casts = [
        'scheduled_date' => 'datetime',
        'scheduled_end'  => 'datetime',
    ];
}

