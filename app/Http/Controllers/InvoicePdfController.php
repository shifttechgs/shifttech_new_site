<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoicePdfController extends Controller
{
    public function download(string $invoiceId)
    {
        $invoice = Invoice::with(['client', 'items', 'salesPerson'])->where('invoice_id', $invoiceId)->firstOrFail();
        $pdf = Pdf::loadView('pdf.invoice', compact('invoice'))->setPaper('a4');
        return $pdf->download("Invoice-{$invoice->invoice_id}.pdf");
    }
}

