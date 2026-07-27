<?php

namespace App\Console\Commands;

use App\Mail\InvoiceMail;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\RecurringInvoice;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ProcessRecurringInvoices extends Command
{
    protected $signature   = 'crm:recurring-invoices';
    protected $description = 'Generate invoices from active recurring invoice schedules';

    public function handle(): void
    {
        $today     = Carbon::today();
        $due       = RecurringInvoice::where('status', 'Active')
            ->where(function ($q) use ($today) {
                $q->whereNull('next_invoice_date')
                  ->orWhereDate('next_invoice_date', '<=', $today);
            })
            ->whereNull('deleted_at')
            ->get();

        foreach ($due as $rec) {
            // Skip if past end date
            if ($rec->end_date && $today->greaterThan($rec->end_date)) {
                $rec->update(['status' => 'Completed']);
                continue;
            }

            $invoiceId = 'INV-' . strtoupper(substr(uniqid(), -6));

            $invoice = Invoice::create([
                'invoice_id'      => $invoiceId,
                'business_id'     => $rec->business_id,
                'client_id'       => $rec->client_id,
                'job_id'          => $rec->job_id,
                'invoice_date'    => $today,
                'due_date'        => $today->copy()->addDays(14),
                'status'          => 'Sent',
                'subtotal'        => $rec->total_amount,
                'vat_amount'      => 0,
                'total_amount'    => $rec->total_amount,
                'balance'         => $rec->total_amount,
                'internal_notes'  => "Auto-generated from recurring schedule #{$rec->recurring_invoice_id}",
                'client_message'  => $rec->client_message,
            ]);

            // Copy items
            foreach ($rec->items as $item) {
                InvoiceItem::create([
                    'invoice_id'  => $invoice->id,
                    'description' => $item->description,
                    'quantity'    => $item->quantity,
                    'unit_price'  => $item->unit_price,
                    'total'       => $item->total,
                ]);
            }

            // Calculate next invoice date
            $nextDate = match ($rec->frequency) {
                'Weekly'    => $today->copy()->addWeek(),
                'Monthly'   => $today->copy()->addMonth(),
                'Quarterly' => $today->copy()->addMonths(3),
                'Annually'  => $today->copy()->addYear(),
                default     => $today->copy()->addMonth(),
            };

            $rec->update([
                'next_invoice_date'  => $nextDate,
                'invoices_generated' => $rec->invoices_generated + 1,
            ]);

            // Send email to client
            try {
                $client = $rec->client;
                if ($client && $client->email) {
                    Mail::to($client->email)->send(new InvoiceMail($invoice));
                }
            } catch (\Throwable $e) {
                $this->warn("Email failed for {$rec->recurring_invoice_id}: {$e->getMessage()}");
            }

            $this->info("Generated {$invoiceId} from {$rec->recurring_invoice_id}");
        }

        $this->info("Done. Processed {$due->count()} recurring schedules.");
    }
}

