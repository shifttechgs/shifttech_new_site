<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\BusinessSetup;
use Barryvdh\DomPDF\Facade\Pdf;

class QuotePdfController extends Controller
{
    public function download(string $quoteId)
    {
        $quote    = Quote::with(['client', 'items', 'salesRep'])->where('quote_id', $quoteId)->firstOrFail();
        $business = BusinessSetup::current();

        $pdf = Pdf::loadView('pdf.quote', compact('quote', 'business'))->setPaper('a4');
        return $pdf->download("Quote-{$quote->quote_id}.pdf");
    }
}

