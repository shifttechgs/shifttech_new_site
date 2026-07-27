<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote {{ $quote->quote_id }} – ShiftTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background: #f8fafc; }
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    </style>
</head>
<body class="min-h-screen bg-slate-50">

    <!-- Header -->
    <header class="bg-white border-b border-slate-200 px-6 py-4">
        <div class="max-w-4xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-2xl font-bold text-slate-800">ShiftTech</span>
                <span class="bg-indigo-600 text-white text-xs px-2 py-0.5 rounded font-semibold">Quote</span>
            </div>
            <span class="text-slate-500 text-sm">{{ $quote->quote_id }}</span>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-10 space-y-8">

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-6 py-4 flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Status Banner -->
        @if($quote->status === 'Accepted')
            <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-6 py-4 text-emerald-800 font-medium">
                ✅ This quote has been accepted on {{ $quote->accepted_at?->format('d M Y') }}.
            </div>
        @elseif($quote->status === 'Expired')
            <div class="bg-amber-50 border border-amber-200 rounded-xl px-6 py-4 text-amber-800 font-medium">
                ⚠️ This quote has expired. Please contact us for a revised quote.
            </div>
        @endif

        <!-- Quote Header -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
            <div class="flex flex-col md:flex-row md:justify-between gap-6">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">{{ $quote->job_title }}</h1>
                    <p class="text-slate-500 mt-1">Prepared for: <strong>{{ $quote->client?->firstname }} {{ $quote->client?->lastname }}</strong>
                        @if($quote->client?->company) · {{ $quote->client->company }} @endif
                    </p>
                </div>
                <div class="text-right text-sm text-slate-500 space-y-1">
                    <div><span class="font-medium text-slate-700">Quote #:</span> {{ $quote->quote_id }}</div>
                    <div><span class="font-medium text-slate-700">Date:</span> {{ $quote->quote_date?->format('d M Y') }}</div>
                    @if($quote->expiry_date)
                    <div><span class="font-medium text-slate-700">Valid Until:</span> {{ $quote->expiry_date->format('d M Y') }}</div>
                    @endif
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ match($quote->status) { 'Accepted' => 'bg-emerald-100 text-emerald-800', 'Sent' => 'bg-blue-100 text-blue-800', 'Draft' => 'bg-slate-100 text-slate-600', default => 'bg-amber-100 text-amber-800' } }}">
                            {{ $quote->status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Line Items -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr class="text-left text-slate-600 font-semibold">
                        <th class="px-6 py-3">Description</th>
                        <th class="px-4 py-3 text-center">Qty</th>
                        <th class="px-4 py-3 text-right">Unit Price</th>
                        <th class="px-4 py-3 text-right">Tax</th>
                        <th class="px-4 py-3 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($quote->items as $item)
                    <tr class="text-slate-700">
                        <td class="px-6 py-4">{{ $item->description }}</td>
                        <td class="px-4 py-4 text-center">{{ $item->quantity }}</td>
                        <td class="px-4 py-4 text-right">R {{ number_format($item->unit_price, 2) }}</td>
                        <td class="px-4 py-4 text-right">{{ $item->tax_rate }}%</td>
                        <td class="px-4 py-4 text-right font-medium">R {{ number_format($item->line_total, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Totals -->
            <div class="border-t border-slate-200 px-6 py-4 bg-slate-50">
                <div class="max-w-xs ml-auto space-y-2 text-sm">
                    <div class="flex justify-between text-slate-600"><span>Subtotal</span><span>R {{ number_format($quote->sub_total, 2) }}</span></div>
                    <div class="flex justify-between text-slate-600"><span>VAT</span><span>R {{ number_format($quote->total_tax, 2) }}</span></div>
                    @if($quote->discount > 0)
                    <div class="flex justify-between text-emerald-600"><span>Discount</span><span>-R {{ number_format($quote->discount, 2) }}</span></div>
                    @endif
                    <div class="flex justify-between text-lg font-bold text-slate-800 border-t border-slate-200 pt-2">
                        <span>Grand Total</span><span>R {{ number_format($quote->grand_total, 2) }}</span>
                    </div>
                    @if($quote->required_deposit > 0)
                    <div class="flex justify-between text-amber-700 font-medium"><span>Required Deposit</span><span>R {{ number_format($quote->required_deposit, 2) }}</span></div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Client Notes -->
        @if($quote->client_notes)
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <h3 class="font-semibold text-slate-800 mb-2">Notes</h3>
            <p class="text-slate-600 text-sm whitespace-pre-line">{{ $quote->client_notes }}</p>
        </div>
        @endif

        <!-- Accept Action -->
        @if($quote->status === 'Sent')
        <div class="bg-indigo-50 border border-indigo-200 rounded-2xl p-8 text-center space-y-4">
            <h3 class="text-xl font-bold text-slate-800">Happy with this quote?</h3>
            <p class="text-slate-600">Click below to accept it and we'll get started.</p>
            <form method="POST" action="{{ route('client-hub.quote.accept', $quote->accepted_token) }}">
                @csrf
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-3 rounded-xl transition-colors shadow-sm">
                    ✅ Accept Quote
                </button>
            </form>
        </div>
        @endif

        <!-- Footer -->
        <p class="text-center text-slate-400 text-xs pb-6">Questions? Contact us at <a href="mailto:sales@shifttechgs.com" class="text-indigo-500">sales@shifttechgs.com</a></p>
    </main>
</body>
</html>

