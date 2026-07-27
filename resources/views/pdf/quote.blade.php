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
    .brand-tag { font-size: 11px; background: #10b981; color: white; padding: 2px 8px; border-radius: 4px; font-weight: 600; }
    .quote-meta { text-align: right; }
    .quote-meta h2 { font-size: 28px; font-weight: 700; color: #635bff; margin-bottom: 6px; }
    .quote-meta p { color: #64748b; font-size: 12px; }
    .parties { display: flex; justify-content: space-between; margin-bottom: 30px; }
    .party-block h4 { font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; margin-bottom: 8px; }
    .party-block p { font-size: 13px; line-height: 1.6; }
    .party-block strong { color: #1e293b; }
    table { width: 100%; border-collapse: collapse; }
    thead tr { background: #635bff; color: white; }
    thead th { padding: 10px 12px; text-align: left; font-size: 12px; font-weight: 600; }
    thead th:not(:first-child) { text-align: right; }
    tbody tr:nth-child(even) { background: #f8fafc; }
    tbody td { padding: 10px 12px; border-bottom: 1px solid #e2e8f0; font-size: 13px; }
    tbody td:not(:first-child) { text-align: right; }
    .totals-section { border-top: 2px solid #635bff; }
    .totals-row { display: flex; justify-content: flex-end; padding: 6px 12px; }
    .totals-row span { min-width: 160px; text-align: right; }
    .totals-row.grand { font-size: 16px; font-weight: 700; color: #635bff; border-top: 1px solid #e2e8f0; padding-top: 10px; margin-top: 4px; }
    .totals-row.deposit { color: #f59e0b; font-weight: 600; }
    .notes { margin-top: 24px; padding: 16px; background: #f8fafc; border-radius: 6px; border-left: 4px solid #635bff; }
    .notes h4 { font-size: 11px; text-transform: uppercase; color: #94a3b8; margin-bottom: 6px; }
    .accept-box { margin-top: 24px; padding: 16px; background: #eff6ff; border-radius: 6px; border: 1px solid #bfdbfe; }
    .accept-box h4 { font-size: 12px; color: #1d4ed8; font-weight: 600; margin-bottom: 4px; }
    .accept-box p { font-size: 12px; color: #1e40af; }
    .stars { color: #f59e0b; font-size: 14px; letter-spacing: 2px; }
    .validity { margin-top: 16px; padding: 12px; background: #fefce8; border-radius: 6px; border: 1px solid #fde047; font-size: 12px; color: #854d0e; }
    .footer { margin-top: 40px; text-align: center; font-size: 11px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 16px; }
    .logo { max-height: 60px; max-width: 220px; object-fit: contain; margin-bottom: 8px; }
    .status-badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; background: #d1fae5; color: #065f46; }
</style>
</head>
<body>
<div class="page">

    <!-- Header -->
    <div class="header">
        <div>
            @if($business->logo_url)
                <img src="{{ $business->logo_url }}" class="logo" alt="{{ $business->business_name }}">
            @else
                <div class="brand-name">{{ $business->business_name }} <span class="brand-tag">Quote</span></div>
            @endif
            <div style="margin-top:8px; font-size:12px; color:#64748b;">
                @if($business->email){{ $business->email }}<br>@endif
                @if($business->website){{ $business->website }}<br>@endif
                @if($business->vat_number)VAT: {{ $business->vat_number }}<br>@endif
                @if($business->registration_number)Reg: {{ $business->registration_number }}@endif
            </div>
        </div>
        <div class="quote-meta">
            <h2>QUOTATION</h2>
            <p><strong>{{ $quote->quote_id }}</strong></p>
            <p>Date: {{ $quote->quote_date?->format('d M Y') }}</p>
            @if($quote->expiry_date)<p>Valid Until: <strong>{{ $quote->expiry_date->format('d M Y') }}</strong></p>@endif
            <div style="margin-top:6px">
                @if($quote->opportunity_rating > 0)
                <span class="stars">{{ str_repeat('★', $quote->opportunity_rating) }}{{ str_repeat('☆', 5 - $quote->opportunity_rating) }}</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Parties -->
    <div class="parties">
        <div class="party-block">
            <h4>Prepared For</h4>
            <p><strong>{{ $quote->client?->firstname }} {{ $quote->client?->lastname }}</strong></p>
            @if($quote->client?->company)<p>{{ $quote->client->company }}</p>@endif
            @if($quote->client?->email)<p>{{ $quote->client->email }}</p>@endif
            @if($quote->client?->phone_number)<p>{{ $quote->client->phone_number }}</p>@endif
            @if($quote->client?->street)
            <p style="margin-top:4px;color:#64748b;font-size:12px;">
                {{ $quote->client->street }}, {{ $quote->client->city }}<br>
                {{ $quote->client->province }} {{ $quote->client->postal_code }}
            </p>
            @endif
        </div>
        <div class="party-block" style="text-align:right">
            <h4>From</h4>
            <p><strong>{{ $business->business_name }}</strong></p>
            @if($business->formatted_address)<p style="font-size:12px;color:#64748b;">{{ $business->formatted_address }}</p>@endif
            <div style="margin-top:12px">
                <h4>Quote Reference</h4>
                <p><strong>{{ $quote->quote_id }}</strong></p>
            </div>
        </div>
    </div>

    <!-- Subject -->
    <div style="margin-bottom:20px; padding:12px 0; border-bottom:1px solid #e2e8f0;">
        <span style="font-size:11px;text-transform:uppercase;color:#94a3b8;letter-spacing:0.5px;">Subject</span>
        <p style="font-size:16px;font-weight:600;color:#1e293b;margin-top:4px;">{{ $quote->job_title }}</p>
    </div>

    <!-- Line Items -->
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Tax %</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quote->items as $item)
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
        <div class="totals-row"><span>Subtotal:</span><span>R {{ number_format($quote->sub_total, 2) }}</span></div>
        <div class="totals-row"><span>VAT ({{ $business->default_tax_rate }}%):</span><span>R {{ number_format($quote->total_tax, 2) }}</span></div>
        @if($quote->discount > 0)
        <div class="totals-row" style="color:#10b981"><span>Discount:</span><span>-R {{ number_format($quote->discount, 2) }}</span></div>
        @endif
        <div class="totals-row grand"><span>Grand Total:</span><span>R {{ number_format($quote->grand_total, 2) }}</span></div>
        @if($quote->required_deposit > 0)
        <div class="totals-row deposit"><span>Required Deposit:</span><span>R {{ number_format($quote->required_deposit, 2) }}</span></div>
        @endif
    </div>

    <!-- Client Notes -->
    @if($quote->client_notes)
    <div class="notes">
        <h4>Notes</h4>
        <p>{{ $quote->client_notes }}</p>
    </div>
    @endif

    <!-- Accept Instructions -->
    @if($quote->accepted_token && $quote->status === 'Sent')
    <div class="accept-box">
        <h4>How to Accept This Quote</h4>
        <p>Visit: <strong>{{ url('/client-hub/quote/' . $quote->accepted_token) }}</strong></p>
        <p style="margin-top:4px;">Or reply to this email confirming your acceptance.</p>
    </div>
    @endif

    <!-- Validity -->
    @if($quote->expiry_date)
    <div class="validity">
        ⚠ This quotation is valid until <strong>{{ $quote->expiry_date->format('d M Y') }}</strong>.
        Prices are subject to change after this date.
    </div>
    @endif

    <!-- Footer Notes -->
    @if($business->quote_footer_notes)
    <div class="notes" style="margin-top:16px;border-left-color:#94a3b8">
        <p style="font-size:12px;color:#64748b;">{{ $business->quote_footer_notes }}</p>
    </div>
    @endif

    <div class="footer">
        {{ $business->business_name }}
        @if($business->email) · {{ $business->email }}@endif
        @if($business->website) · {{ $business->website }}@endif<br>
        This quotation was prepared on {{ now()->format('d M Y') }} and is computer-generated.
    </div>

</div>
</body>
</html>

