<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: Arial, sans-serif; font-size: 13px; color: #1e293b; background: #fff; }
    .page { padding: 40px; }
    .header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px; padding-bottom: 20px; border-bottom: 2px solid #635bff; }
    .brand-name { font-size: 24px; font-weight: 700; color: #1e293b; }
    .brand-tag { font-size: 11px; background: #635bff; color: white; padding: 2px 8px; border-radius: 4px; font-weight: 600; }
    .invoice-meta { text-align: right; }
    .invoice-meta h2 { font-size: 28px; font-weight: 700; color: #635bff; margin-bottom: 6px; }
    .invoice-meta p { color: #64748b; font-size: 12px; }
    .parties { display: flex; justify-content: space-between; margin-bottom: 30px; }
    .party-block h4 { font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; margin-bottom: 8px; }
    .party-block p { font-size: 13px; line-height: 1.6; }
    .party-block strong { color: #1e293b; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 0; }
    thead tr { background: #635bff; color: white; }
    thead th { padding: 10px 12px; text-align: left; font-size: 12px; font-weight: 600; }
    thead th:not(:first-child) { text-align: right; }
    tbody tr:nth-child(even) { background: #f8fafc; }
    tbody td { padding: 10px 12px; border-bottom: 1px solid #e2e8f0; font-size: 13px; }
    tbody td:not(:first-child) { text-align: right; }
    .totals-section { margin-top: 0; border-top: 2px solid #635bff; }
    .totals-row { display: flex; justify-content: flex-end; padding: 6px 12px; }
    .totals-row span { min-width: 140px; text-align: right; }
    .totals-row.grand { font-size: 16px; font-weight: 700; color: #635bff; border-top: 1px solid #e2e8f0; padding-top: 10px; margin-top: 4px; }
    .notes { margin-top: 30px; padding: 16px; background: #f8fafc; border-radius: 6px; border-left: 4px solid #635bff; }
    .notes h4 { font-size: 11px; text-transform: uppercase; color: #94a3b8; margin-bottom: 6px; }
    .banking { margin-top: 24px; padding: 16px; background: #1e293b; color: white; border-radius: 6px; }
    .banking h4 { font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px; color: #94a3b8; }
    .banking table td { border: none; color: white; background: transparent; padding: 4px 0; }
    .banking table td:first-child { color: #94a3b8; width: 150px; }
    .ref { color: #fbbf24; font-weight: 700; }
    .footer { margin-top: 40px; text-align: center; font-size: 11px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 16px; }
    .status-badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; background: #dcfce7; color: #166534; }
</style>
</head>
<body>
<div class="page">
    <!-- Header -->
    <div class="header">
        <div>
            <div class="brand-name">ShiftTech <span class="brand-tag">Invoice</span></div>
            <div style="margin-top:8px; font-size:12px; color:#64748b;">
                ShiftTech General Solutions<br>
                sales@shifttechgs.com · shifttechgs.com
            </div>
        </div>
        <div class="invoice-meta">
            <h2>TAX INVOICE</h2>
            <p><strong>{{ $invoice->invoice_id }}</strong></p>
            <p>Date: {{ $invoice->invoice_date?->format('d M Y') }}</p>
            @if($invoice->due_date)<p>Due: {{ $invoice->due_date->format('d M Y') }}</p>@endif
            <div style="margin-top:6px"><span class="status-badge">{{ $invoice->status }}</span></div>
        </div>
    </div>

    <!-- Parties -->
    <div class="parties">
        <div class="party-block">
            <h4>Billed To</h4>
            <p><strong>{{ $invoice->client?->firstname }} {{ $invoice->client?->lastname }}</strong></p>
            @if($invoice->client?->company)<p>{{ $invoice->client->company }}</p>@endif
            @if($invoice->client?->email)<p>{{ $invoice->client->email }}</p>@endif
            @if($invoice->client?->phone_number)<p>{{ $invoice->client->phone_number }}</p>@endif
        </div>
        <div class="party-block" style="text-align:right">
            <h4>Reference</h4>
            <p><strong>{{ $invoice->invoice_id }}</strong></p>
            @if($invoice->job_id)<p>Job: {{ $invoice->job_id }}</p>@endif
        </div>
    </div>

    <!-- Line Items -->
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Tax %</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
            <tr>
                <td>{{ $item->description }}</td>
                <td>{{ $item->quantity }}</td>
                <td>R {{ number_format($item->unit_price, 2) }}</td>
                <td>{{ $item->tax_rate }}%</td>
                <td>R {{ number_format($item->line_total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totals -->
    <div class="totals-section">
        <div class="totals-row"><span>Subtotal:</span><span>R {{ number_format($invoice->sub_total, 2) }}</span></div>
        <div class="totals-row"><span>VAT:</span><span>R {{ number_format($invoice->total_tax, 2) }}</span></div>
        @if($invoice->discount > 0)
        <div class="totals-row"><span>Discount:</span><span>-R {{ number_format($invoice->discount, 2) }}</span></div>
        @endif
        @if($invoice->deposit_paid > 0)
        <div class="totals-row"><span>Deposit Paid:</span><span>-R {{ number_format($invoice->deposit_paid, 2) }}</span></div>
        @endif
        <div class="totals-row grand"><span>Balance Due:</span><span>R {{ number_format($invoice->balance ?? $invoice->total_amount, 2) }}</span></div>
    </div>

    @if($invoice->client_message)
    <div class="notes">
        <h4>Note to Client</h4>
        <p>{{ $invoice->client_message }}</p>
    </div>
    @endif

    <!-- Banking Details -->
    <div class="banking">
        <h4>Payment Details (EFT)</h4>
        <table>
            <tr><td>Bank:</td><td>FNB</td></tr>
            <tr><td>Account Name:</td><td>ShiftTech General Solutions</td></tr>
            <tr><td>Account Number:</td><td>XXXXXXXX</td></tr>
            <tr><td>Branch Code:</td><td>250655</td></tr>
            <tr><td>Reference:</td><td class="ref">{{ $invoice->invoice_id }}</td></tr>
        </table>
    </div>

    <div class="footer">
        Thank you for your business · ShiftTech General Solutions · sales@shifttechgs.com · www.shifttechgs.com<br>
        This is a computer-generated document.
    </div>
</div>
</body>
</html>

