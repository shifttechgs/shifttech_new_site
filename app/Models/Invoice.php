<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_id', 'business_id', 'job_id', 'client_id', 'sales_person_id',
        'created_by', 'invoice_date', 'due_date', 'sub_total', 'total_tax',
        'total_amount', 'discount', 'deposit_paid', 'balance', 'payment_due',
        'internal_notes', 'client_message', 'status', 'payment_method',
        'paid_at', 'payment_reference', 'view_token',
    ];

    protected $casts = [
        'invoice_date' => 'datetime',
        'due_date'     => 'datetime',
        'paid_at'      => 'datetime',
        'total_amount' => 'decimal:2',
        'balance'      => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->invoice_id)) {
                $model->invoice_id = 'INV-' . strtoupper(substr(uniqid(), -6));
            }
            if (empty($model->view_token)) {
                $model->view_token = \Illuminate\Support\Str::uuid();
            }
        });
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(BusinessClient::class, 'client_id', 'client_id');
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id', 'job_id');
    }

    public function salesPerson(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sales_person_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id', 'invoice_id')->orderBy('sort_order');
    }

    public function recalculateTotals(): void
    {
        $subTotal = $this->items->sum('line_total');
        $totalTax = $this->items->sum(fn($i) => $i->line_total * ($i->tax_rate / 100));
        $this->sub_total    = $subTotal;
        $this->total_tax    = $totalTax;
        $this->total_amount = $subTotal + $totalTax - $this->discount;
        $this->balance      = $this->total_amount - $this->deposit_paid;
        $this->save();
    }

    public function isOverdue(): bool
    {
        return $this->due_date && $this->due_date->isPast() && !in_array($this->status, ['Paid', 'Cancelled']);
    }
}

