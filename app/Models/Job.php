<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Job extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'job_id', 'business_id', 'user_id', 'client_id', 'quote_id',
        'job_title', 'instructions', 'job_notes', 'job_status',
        'scheduled_status', 'assigned_status', 'team_member_assigned_id',
        'job_conversion_type', 'job_converted_by', 'invoicing_reminder',
        'schedule_later', 'job_date_time',
    ];

    protected $casts = [
        'job_date_time' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->job_id)) {
                $model->job_id = 'JOB-' . strtoupper(substr(uniqid(), -6));
            }
        });
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(BusinessClient::class, 'client_id', 'client_id');
    }

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class, 'quote_id', 'quote_id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'team_member_assigned_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(JobItem::class, 'job_id', 'job_id')->orderBy('sort_order');
    }

    public function scheduledJob(): HasOne
    {
        return $this->hasOne(ScheduledJob::class, 'job_id', 'job_id');
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class, 'job_id', 'job_id');
    }
}

