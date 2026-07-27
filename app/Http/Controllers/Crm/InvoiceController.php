<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\ActivityLog;
use App\Models\BusinessClient;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::with('client')->orderBy('created_at', 'desc');

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('invoice_id', 'like', "%$search%")
                  ->orWhereHas('client', fn($c) => $c->where('firstname', 'like', "%$search%")
                      ->orWhere('lastname', 'like', "%$search%")
                      ->orWhere('company', 'like', "%$search%"));
            });
        }
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $invoices = $query->paginate(25)->withQueryString();

        $stats = [
            'total'      => Invoice::count(),
            'draft'      => Invoice::where('status', 'Draft')->count(),
            'sent'       => Invoice::whereIn('status', ['Sent', 'PartiallyPaid'])->count(),
            'paid'       => Invoice::where('status', 'Paid')->count(),
            'overdue'    => Invoice::where('status', 'Overdue')->count(),
            'revenue'    => Invoice::where('status', 'Paid')->sum('total_amount'),
            'outstanding'=> Invoice::whereIn('status', ['Sent', 'PartiallyPaid', 'Overdue'])->sum('balance'),
        ];

        return view('crm.invoices.index', compact('invoices', 'stats'));
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['client', 'items', 'job', 'salesPerson']);
        return view('crm.invoices.show', compact('invoice'));
    }

    public function create(Request $request)
    {
        $clients = BusinessClient::orderBy('firstname')->get();
        $selectedClient = $request->get('client_id') ? BusinessClient::find($request->get('client_id')) : null;
        return view('crm.invoices.create', compact('clients', 'selectedClient'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id'      => 'required|string',
            'invoice_date'   => 'required|date',
            'due_date'       => 'required|date',
            'status'         => 'required|in:Draft,Sent,PartiallyPaid,Paid,Overdue,Cancelled',
            'discount'       => 'nullable|numeric|min:0',
            'deposit_paid'   => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|string',
            'internal_notes' => 'nullable|string',
            'client_message' => 'nullable|string',
            'items'              => 'array',
            'items.*.description'=> 'required|string',
            'items.*.quantity'   => 'required|numeric|min:0',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $invoice = Invoice::create([
            'client_id'      => $data['client_id'],
            'created_by'     => auth()->id(),
            'invoice_date'   => $data['invoice_date'],
            'due_date'       => $data['due_date'],
            'status'         => $data['status'],
            'discount'       => $data['discount'] ?? 0,
            'deposit_paid'   => $data['deposit_paid'] ?? 0,
            'payment_method' => $data['payment_method'] ?? 'EFT',
            'internal_notes' => $data['internal_notes'] ?? null,
            'client_message' => $data['client_message'] ?? null,
            'sub_total'      => 0,
            'total_tax'      => 0,
            'total_amount'   => 0,
            'balance'        => 0,
        ]);

        if (!empty($data['items'])) {
            foreach ($data['items'] as $i => $item) {
                InvoiceItem::create([
                    'invoice_id'  => $invoice->invoice_id,
                    'description' => $item['description'],
                    'quantity'    => $item['quantity'],
                    'unit_price'  => $item['unit_price'],
                    'line_total'  => $item['quantity'] * $item['unit_price'],
                    'sort_order'  => $i,
                ]);
            }
        }

        $invoice->refresh()->load('items');
        $invoice->recalculateTotals();

        ActivityLog::record('created', 'Invoice', $invoice->invoice_id, "Invoice {$invoice->invoice_id} created");
        NotificationService::info('New Invoice', "Invoice {$invoice->invoice_id} created for {$invoice->client->full_name}", route('crm.invoices.show', $invoice));

        return redirect()->route('crm.invoices.show', $invoice)->with('success', 'Invoice created.');
    }

    public function edit(Invoice $invoice)
    {
        $invoice->load(['client', 'items']);
        $clients = BusinessClient::orderBy('firstname')->get();
        return view('crm.invoices.edit', compact('invoice', 'clients'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $data = $request->validate([
            'invoice_date'   => 'required|date',
            'due_date'       => 'required|date',
            'status'         => 'required|in:Draft,Sent,PartiallyPaid,Paid,Overdue,Cancelled',
            'discount'       => 'nullable|numeric|min:0',
            'deposit_paid'   => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|string',
            'internal_notes' => 'nullable|string',
            'client_message' => 'nullable|string',
            'items'              => 'array',
            'items.*.description'=> 'required|string',
            'items.*.quantity'   => 'required|numeric|min:0',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $invoice->update([
            'invoice_date'   => $data['invoice_date'],
            'due_date'       => $data['due_date'],
            'status'         => $data['status'],
            'discount'       => $data['discount'] ?? 0,
            'deposit_paid'   => $data['deposit_paid'] ?? 0,
            'payment_method' => $data['payment_method'] ?? 'EFT',
            'internal_notes' => $data['internal_notes'] ?? null,
            'client_message' => $data['client_message'] ?? null,
        ]);

        $invoice->items()->delete();
        if (!empty($data['items'])) {
            foreach ($data['items'] as $i => $item) {
                InvoiceItem::create([
                    'invoice_id'  => $invoice->invoice_id,
                    'description' => $item['description'],
                    'quantity'    => $item['quantity'],
                    'unit_price'  => $item['unit_price'],
                    'line_total'  => $item['quantity'] * $item['unit_price'],
                    'sort_order'  => $i,
                ]);
            }
        }

        $invoice->refresh()->load('items');
        $invoice->recalculateTotals();

        return redirect()->route('crm.invoices.show', $invoice)->with('success', 'Invoice updated.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('crm.invoices.index')->with('success', 'Invoice deleted.');
    }

    public function send(Invoice $invoice)
    {
        $invoice->load(['client', 'items']);

        if (!$invoice->client->email) {
            return back()->with('error', 'Client has no email address.');
        }

        Mail::to($invoice->client->email)->send(new InvoiceMail($invoice));
        $invoice->update(['status' => 'Sent']);

        ActivityLog::record('sent', 'Invoice', $invoice->invoice_id, "Invoice {$invoice->invoice_id} emailed to {$invoice->client->email}");

        return back()->with('success', 'Invoice sent to ' . $invoice->client->email);
    }

    public function recordPayment(Request $request, Invoice $invoice)
    {
        $data = $request->validate([
            'amount'     => 'required|numeric|min:0.01',
            'method'     => 'required|string',
            'reference'  => 'nullable|string',
        ]);

        $newDeposit = ($invoice->deposit_paid ?? 0) + $data['amount'];
        $balance    = $invoice->total_amount - $newDeposit;

        $status = $balance <= 0 ? 'Paid' : 'PartiallyPaid';

        $invoice->update([
            'deposit_paid'       => $newDeposit,
            'balance'            => max(0, $balance),
            'status'             => $status,
            'payment_method'     => $data['method'],
            'payment_reference'  => $data['reference'] ?? null,
            'paid_at'            => $status === 'Paid' ? now() : $invoice->paid_at,
        ]);

        ActivityLog::record('payment', 'Invoice', $invoice->invoice_id, "Payment of R{$data['amount']} recorded ({$data['method']})");

        if ($status === 'Paid') {
            NotificationService::success('Invoice Paid', "Invoice {$invoice->invoice_id} fully paid", route('crm.invoices.show', $invoice));
        }

        return back()->with('success', 'Payment recorded.');
    }
}

