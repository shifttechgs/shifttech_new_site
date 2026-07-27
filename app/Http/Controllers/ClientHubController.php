<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Invoice;
use Illuminate\Http\Request;

class ClientHubController extends Controller
{
    /**
     * Public quote view — client can view & accept their quote
     */
    public function viewQuote(string $token)
    {
        $quote = Quote::with(['client', 'items'])
            ->where('accepted_token', $token)
            ->firstOrFail();

        return view('client-hub.quote', compact('quote'));
    }

    /**
     * Accept quote action from client hub
     */
    public function acceptQuote(string $token)
    {
        $quote = Quote::where('accepted_token', $token)->firstOrFail();

        if ($quote->status === 'Sent') {
            $quote->update([
                'status'      => 'Accepted',
                'accepted_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Thank you! Your quote has been accepted. We will be in touch shortly.');
    }

    /**
     * Public invoice view — client can view their invoice
     */
    public function viewInvoice(string $token)
    {
        $invoice = Invoice::with(['client', 'items'])
            ->where('view_token', $token)
            ->firstOrFail();

        return view('client-hub.invoice', compact('invoice'));
    }
}

