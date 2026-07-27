<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice->invoice_id }} – ShiftTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50">

    <header class="bg-white border-b border-slate-200 px-6 py-4">
        <div class="max-w-4xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-2xl font-bold text-slate-800">ShiftTech</span>
                <span class="bg-emerald-600 text-white text-xs px-2 py-0.5 rounded font-semibold">Invoice</span>
            </div>
            <span class="text-slate-500 text-sm">{{ $invoice->invoice_id }}</span>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-10 space-y-8">

        <!-- Status Banner -->
        @if($invoice->status === 'Paid')
            <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-6 py-4 text-emerald-800 font-medium">
                ✅ This invoice was paid on {{ $invoice->paid_at?->format('d M Y') }}.
            </div>
        @elseif($invoice->status === 'Overdue')
            <div class="bg-red-50 border border-red-200 rounded-xl px-6 py-4 text-red-800 font-medium">
                ⚠️ This invoice is overdue. Please make payment as soon as possible.
            </div>
        @endif

        <!-- Invoice Header -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
            <div class="flex flex-col md:flex-row md:justify-between gap-6">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Tax Invoice</h1>
                    <p class="text-slate-500 mt-1">Billed to: <strong>{{ $invoice->client?->firstname }} {{ $invoice->client?->lastname }}</strong>
                        @if($invoice->client?->company) · {{ $invoice->client->company }} @endif
                    </p>
                    @if($invoice->client?->email)<p class="text-slate-500 text-sm">{{ $invoice->client->email }}</p>@endif
                </div>
                <div class="text-right text-sm text-slate-500 space-y-1">
                    <div><span class="font-medium text-slate-700">Invoice #:</span> {{ $invoice->invoice_id }}</div>
                    <div><span class="font-medium text-slate-700">Date:</span> {{ $invoice->invoice_date?->format('d M Y') }}</div>
                    @if($invoice->due_date)
                    <div><span class="font-medium text-slate-700">Due:</span> {{ $invoice->due_date->format('d M Y') }}</div>
                    @endif
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ match($invoice->status) { 'Paid' => 'bg-emerald-100 text-emerald-800', 'Sent' => 'bg-blue-100 text-blue-800', 'Overdue' => 'bg-red-100 text-red-800', default => 'bg-slate-100 text-slate-600' } }}">
                            {{ $invoice->status }}
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
                    @foreach($invoice->items as $item)
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
            <div class="border-t border-slate-200 px-6 py-4 bg-slate-50">
                <div class="max-w-xs ml-auto space-y-2 text-sm">
                    <div class="flex justify-between text-slate-600"><span>Subtotal</span><span>R {{ number_format($invoice->sub_total, 2) }}</span></div>
                    <div class="flex justify-between text-slate-600"><span>VAT</span><span>R {{ number_format($invoice->total_tax, 2) }}</span></div>
                    @if($invoice->discount > 0)
                    <div class="flex justify-between text-emerald-600"><span>Discount</span><span>-R {{ number_format($invoice->discount, 2) }}</span></div>
                    @endif
                    @if($invoice->deposit_paid > 0)
                    <div class="flex justify-between text-slate-600"><span>Deposit Paid</span><span>-R {{ number_format($invoice->deposit_paid, 2) }}</span></div>
                    @endif
                    <div class="flex justify-between text-lg font-bold text-slate-800 border-t border-slate-200 pt-2">
                        <span>Balance Due</span><span>R {{ number_format($invoice->balance ?? $invoice->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Client Message -->
        @if($invoice->client_message)
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <h3 class="font-semibold text-slate-800 mb-2">Message</h3>
            <p class="text-slate-600 text-sm whitespace-pre-line">{{ $invoice->client_message }}</p>
        </div>
        @endif

        <!-- Banking Details -->
        <div class="bg-slate-800 text-white rounded-2xl p-6 space-y-2 text-sm">
            <h3 class="font-semibold text-lg mb-3">Payment Details (EFT)</h3>
            <div class="grid grid-cols-2 gap-2">
                <span class="text-slate-400">Bank:</span><span>FNB</span>
                <span class="text-slate-400">Account Name:</span><span>ShiftTech General Solutions</span>
                <span class="text-slate-400">Account Number:</span><span>XXXXXXXX</span>
                <span class="text-slate-400">Branch Code:</span><span>250655</span>
                <span class="text-slate-400">Reference:</span><span class="font-bold text-amber-400">{{ $invoice->invoice_id }}</span>
            </div>
        </div>

        <p class="text-center text-slate-400 text-xs pb-6">Questions? Contact us at <a href="mailto:sales@shifttechgs.com" class="text-indigo-500">sales@shifttechgs.com</a></p>
    </main>
</body>
</html>

