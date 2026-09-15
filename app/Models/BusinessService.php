<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessService extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $fillable = [
        'service_id', 'business_id', 'name', 'description',
        'category', 'unit_price', 'unit_type', 'is_active',
        'show_on_contact_form',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'is_active'  => 'boolean',
        'show_on_contact_form' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->service_id)) {
                $model->service_id = 'SVC-' . strtoupper(substr(uniqid(), -6));
            }
        });
    }
}

