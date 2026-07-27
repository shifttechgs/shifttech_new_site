<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invoice {{ $invoice->invoice_id }}</title>
<style>
    body { margin: 0; padding: 0; background: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
    .wrapper { max-width: 600px; margin: 32px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,.1); }
    .header { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 32px; text-align: center; }
    .header h1 { color: white; margin: 0; font-size: 22px; font-weight: 700; }
    .header p { color: rgba(255,255,255,0.6); margin: 6px 0 0; font-size: 14px; }
    .status-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; margin-top: 10px; }
    .status-sent { background: #dbeafe; color: #1d4ed8; }
    .status-overdue { background: #fee2e2; color: #dc2626; }
    .status-paid { background: #d1fae5; color: #065f46; }
    .body { padding: 32px; }
    .greeting { font-size: 16px; color: #1e293b; margin-bottom: 16px; }
    .invoice-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin: 24px 0; }
    .invoice-box-row { display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
    .invoice-box-row:last-child { border-bottom: none; }
    .invoice-box-row .label { color: #64748b; }
    .invoice-box-row .value { font-weight: 600; color: #1e293b; }
    .total-row { background: #0f172a; color: white; border-radius: 6px; padding: 12px 16px; display: flex; justify-content: space-between; margin-top: 12px; font-weight: 700; font-size: 16px; }
    .overdue-banner { background: #fef2f2; border: 1px solid #fecaca; border-radius: 6px; padding: 12px 16px; margin-top: 12px; font-size: 13px; color: #991b1b; }
    .banking-box { background: #1e293b; color: white; border-radius: 8px; padding: 20px; margin: 24px 0; }
    .banking-box h3 { font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; margin: 0 0 12px; }
    .banking-row { display: flex; justify-content: space-between; padding: 5px 0; font-size: 13px; border-bottom: 1px solid #334155; }
    .banking-row:last-child { border-bottom: none; }
    .banking-row .bk-label { color: #94a3b8; }
    .banking-row .bk-value { color: white; font-weight: 500; }
    .ref-value { color: #fbbf24 !important; font-weight: 700 !important; font-size: 15px !important; }
    .view-button { display: block; text-align: center; background: #635bff; color: white !important; text-decoration: none; padding: 14px 32px; border-radius: 8px; font-weight: 600; font-size: 15px; margin: 28px 0; }
    .message-box { background: #f0fdf4; border-left: 4px solid #10b981; padding: 16px; border-radius: 4px; font-size: 14px; color: #065f46; margin: 20px 0; }
    .footer-note { font-size: 12px; color: #94a3b8; margin-top: 24px; line-height: 1.6; }
    .footer { background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 20px 32px; text-align: center; }
    .footer p { font-size: 12px; color: #94a3b8; margin: 0; line-height: 1.6; }
</style>
</head>
<body>
<div class="wrapper">

    <!-- Header -->
    <div class="header">
        <h1>{{ $business->business_name }}</h1>
        <p>Tax Invoice · {{ $invoice->invoice_id }}</p>
        @php
            $badgeClass = match($invoice->status) {
                'Paid'    => 'status-paid',
                'Overdue' => 'status-overdue',
                default   => 'status-sent',
            };
        @endphp
        <span class="status-badge {{ $badgeClass }}">{{ $invoice->status }}</span>
    </div>

    <!-- Body -->
    <div class="body">
        <p class="greeting">
            Dear {{ $invoice->client?->firstname ?? 'Valued Client' }},
        </p>

        <p style="color:#475569;font-size:15px;line-height:1.6;">
            Please find attached your invoice
            @if($invoice->job_id) for job <strong>{{ $invoice->job_id }}</strong>@endif.
            @if($invoice->due_date)
                Payment is due by <strong>{{ $invoice->due_date->format('d M Y') }}</strong>.
            @endif
        </p>

        @if($invoice->status === 'Overdue')
        <div class="overdue-banner">
            ⚠️ <strong>This invoice is overdue.</strong> Please make payment as soon as possible to avoid any disruption of services.
        </div>
        @endif

        <!-- Invoice Summary -->
        <div class="invoice-box">
            <div class="invoice-box-row">
                <span class="label">Invoice Number</span>
                <span class="value">{{ $invoice->invoice_id }}</span>
            </div>
            <div class="invoice-box-row">
                <span class="label">Invoice Date</span>
                <span class="value">{{ $invoice->invoice_date?->format('d M Y') }}</span>
            </div>
            @if($invoice->due_date)
            <div class="invoice-box-row">
                <span class="label">Due Date</span>
                <span class="value">{{ $invoice->due_date->format('d M Y') }}</span>
            </div>
            @endif
            @if($invoice->deposit_paid > 0)
            <div class="invoice-box-row">
                <span class="label">Deposit Paid</span>
                <span class="value" style="color:#10b981;">-R {{ number_format($invoice->deposit_paid, 2) }}</span>
            </div>
            @endif
        </div>

        <div class="total-row">
            <span>Amount Due</span>
            <span>R {{ number_format($invoice->balance ?? $invoice->total_amount, 2) }}</span>
        </div>

        @if($invoice->client_message)
        <div class="message-box" style="margin-top:16px;">
            <strong>Message:</strong> {{ $invoice->client_message }}
        </div>
        @endif

        <!-- Banking Details -->
        @if($business->bank_account_number)
        <div class="banking-box">
            <h3>EFT Payment Details</h3>
            @if($business->bank_name)
            <div class="banking-row"><span class="bk-label">Bank</span><span class="bk-value">{{ $business->bank_name }}</span></div>
            @endif
            @if($business->bank_account_name)
            <div class="banking-row"><span class="bk-label">Account Name</span><span class="bk-value">{{ $business->bank_account_name }}</span></div>
            @endif
            <div class="banking-row"><span class="bk-label">Account Number</span><span class="bk-value">{{ $business->bank_account_number }}</span></div>
            @if($business->bank_branch_code)
            <div class="banking-row"><span class="bk-label">Branch Code</span><span class="bk-value">{{ $business->bank_branch_code }}</span></div>
            @endif
            <div class="banking-row">
                <span class="bk-label">Reference</span>
                <span class="bk-value ref-value">{{ $invoice->invoice_id }}</span>
            </div>
            @if($business->payment_instructions)
            <p style="margin-top:10px;font-size:12px;color:#94a3b8;">{{ $business->payment_instructions }}</p>
            @endif
        </div>
        @endif

        <!-- View Invoice Button -->
        <a href="{{ url('/client-hub/invoice/' . $invoice->view_token) }}" class="view-button">
            📄 View Invoice Online
        </a>

        <p style="color:#64748b;font-size:14px;line-height:1.6;">
            A PDF copy of this invoice is attached to this email for your records.
            If you have any questions about this invoice, please contact us.
        </p>

        @if($business->invoice_footer_notes)
        <p style="color:#94a3b8;font-size:13px;margin-top:16px;font-style:italic;">{{ $business->invoice_footer_notes }}</p>
        @endif

        <p class="footer-note">
            Warm regards,<br>
            <strong>{{ $business->business_name }}</strong><br>
            @if($business->email)📧 {{ $business->email }}<br>@endif
            @if($business->phone)📞 {{ $business->phone }}<br>@endif
            @if($business->website)🌐 {{ $business->website }}@endif
        </p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>
            © {{ date('Y') }} {{ $business->business_name }}. All rights reserved.<br>
            @if($business->vat_number)VAT: {{ $business->vat_number }} · @endif
            @if($business->registration_number)Reg: {{ $business->registration_number }}@endif
        </p>
    </div>

</div>
</body>
</html>

