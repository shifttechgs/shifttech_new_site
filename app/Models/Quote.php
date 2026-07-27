<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quote extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'business_id', 'user_id', 'client_id', 'job_title',
        'opportunity_rating', 'required_deposit', 'internal_notes', 'client_notes',
        'status', 'sub_total', 'total_tax', 'grand_total', 'discount', 'discount_type',
        'quote_date', 'expiry_date', 'accepted_token', 'accepted_at',
    ];

    protected $casts = [
        'quote_date'   => 'datetime',
        'expiry_date'  => 'datetime',
        'accepted_at'  => 'datetime',
        'sub_total'    => 'decimal:2',
        'total_tax'    => 'decimal:2',
        'grand_total'  => 'decimal:2',
        'required_deposit' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->quote_id)) {
                $model->quote_id = 'QUO-' . strtoupper(substr(uniqid(), -6));
            }
            if (empty($model->accepted_token)) {
                $model->accepted_token = \Illuminate\Support\Str::uuid();
            }
        });
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(BusinessClient::class, 'client_id', 'client_id');
    }

    public function salesRep(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuoteItem::class, 'quote_id', 'quote_id')->orderBy('sort_order');
    }

    public function job(): HasMany
    {
        return $this->hasMany(Job::class, 'quote_id', 'quote_id');
    }

    public function recalculateTotals(): void
    {
        $subTotal = $this->items->sum('line_total');
        $totalTax = $this->items->sum(fn($i) => $i->line_total * ($i->tax_rate / 100));
        $this->sub_total  = $subTotal;
        $this->total_tax  = $totalTax;
        $this->grand_total = $subTotal + $totalTax - $this->discount;
        $this->save();
    }
}

