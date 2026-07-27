<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quotation {{ $quote->quote_id }}</title>
<style>
    body { margin: 0; padding: 0; background: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
    .wrapper { max-width: 600px; margin: 32px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,.1); }
    .header { background: linear-gradient(135deg, #635bff 0%, #4f46e5 100%); padding: 32px; text-align: center; }
    .header h1 { color: white; margin: 0; font-size: 22px; font-weight: 700; }
    .header p { color: rgba(255,255,255,0.8); margin: 6px 0 0; font-size: 14px; }
    .body { padding: 32px; }
    .greeting { font-size: 16px; color: #1e293b; margin-bottom: 16px; }
    .quote-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin: 24px 0; }
    .quote-box-row { display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
    .quote-box-row:last-child { border-bottom: none; }
    .quote-box-row .label { color: #64748b; }
    .quote-box-row .value { font-weight: 600; color: #1e293b; }
    .total-row { background: #635bff; color: white; border-radius: 6px; padding: 12px 16px; display: flex; justify-content: space-between; margin-top: 12px; font-weight: 700; font-size: 16px; }
    .deposit-note { background: #fffbeb; border: 1px solid #fde68a; border-radius: 6px; padding: 12px 16px; margin-top: 12px; font-size: 13px; color: #92400e; }
    .cta-button { display: block; text-align: center; background: #635bff; color: white !important; text-decoration: none; padding: 14px 32px; border-radius: 8px; font-weight: 600; font-size: 15px; margin: 28px 0; }
    .message-box { background: #f0fdf4; border-left: 4px solid #10b981; padding: 16px; border-radius: 4px; font-size: 14px; color: #065f46; margin: 20px 0; }
    .footer-note { font-size: 12px; color: #94a3b8; margin-top: 24px; line-height: 1.6; }
    .footer { background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 20px 32px; text-align: center; }
    .footer p { font-size: 12px; color: #94a3b8; margin: 0; line-height: 1.6; }
    .validity-banner { background: #fefce8; border: 1px solid #fde047; border-radius: 6px; padding: 10px 16px; font-size: 13px; color: #854d0e; margin-top: 12px; }
</style>
</head>
<body>
<div class="wrapper">

    <!-- Header -->
    <div class="header">
        <h1>{{ $business->business_name }}</h1>
        <p>Quotation · {{ $quote->quote_id }}</p>
    </div>

    <!-- Body -->
    <div class="body">
        <p class="greeting">
            Dear {{ $quote->client?->firstname ?? 'Valued Client' }},
        </p>

        <p style="color:#475569;font-size:15px;line-height:1.6;">
            Thank you for your interest in our services. Please find attached your quotation for
            <strong>{{ $quote->job_title }}</strong>.
        </p>

        <!-- Quote Summary Box -->
        <div class="quote-box">
            <div class="quote-box-row">
                <span class="label">Quote Number</span>
                <span class="value">{{ $quote->quote_id }}</span>
            </div>
            <div class="quote-box-row">
                <span class="label">Date</span>
                <span class="value">{{ $quote->quote_date?->format('d M Y') }}</span>
            </div>
            @if($quote->expiry_date)
            <div class="quote-box-row">
                <span class="label">Valid Until</span>
                <span class="value">{{ $quote->expiry_date->format('d M Y') }}</span>
            </div>
            @endif
            <div class="quote-box-row">
                <span class="label">Items</span>
                <span class="value">{{ $quote->items->count() }} line item(s)</span>
            </div>
        </div>

        <div class="total-row">
            <span>Grand Total</span>
            <span>R {{ number_format($quote->grand_total, 2) }}</span>
        </div>

        @if($quote->required_deposit > 0)
        <div class="deposit-note">
            💳 A deposit of <strong>R {{ number_format($quote->required_deposit, 2) }}</strong> is required to confirm this booking.
        </div>
        @endif

        @if($quote->expiry_date)
        <div class="validity-banner">
            ⏳ This quote expires on <strong>{{ $quote->expiry_date->format('d M Y') }}</strong>. Kindly respond before this date.
        </div>
        @endif

        @if($quote->client_notes)
        <div class="message-box">
            <strong>Note:</strong> {{ $quote->client_notes }}
        </div>
        @endif

        <!-- CTA -->
        <a href="{{ url('/client-hub/quote/' . $quote->accepted_token) }}" class="cta-button">
            ✅ View & Accept Quote Online
        </a>

        <p style="color:#64748b;font-size:14px;line-height:1.6;">
            The full quotation PDF is attached to this email for your records.<br>
            If you have any questions, please don't hesitate to reach out.
        </p>

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

