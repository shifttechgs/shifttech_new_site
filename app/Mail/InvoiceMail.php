<?php

namespace App\Mail;

use App\Models\Invoice;
use App\Models\BusinessSetup;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public BusinessSetup $business;

    public function __construct(public Invoice $invoice)
    {
        $this->business = BusinessSetup::current();
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Invoice {$this->invoice->invoice_id} from {$this->business->business_name}",
            replyTo: [
                new \Illuminate\Mail\Mailables\Address(
                    $this->business->email ?? config('mail.from.address'),
                    $this->business->business_name
                ),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice',
        );
    }

    public function attachments(): array
    {
        $pdf = Pdf::loadView('pdf.invoice', [
            'invoice'  => $this->invoice->load(['client', 'items']),
            'business' => $this->business,
        ])->setPaper('a4');

        return [
            Attachment::fromData(
                fn () => $pdf->output(),
                "Invoice-{$this->invoice->invoice_id}.pdf"
            )->withMime('application/pdf'),
        ];
    }
}

