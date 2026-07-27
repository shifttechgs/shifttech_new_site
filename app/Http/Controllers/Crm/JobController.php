<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\BusinessClient;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Job;
use App\Models\JobItem;
use App\Models\Quote;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with('client')->orderBy('created_at', 'desc');

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('job_id', 'like', "%$search%")
                  ->orWhere('job_title', 'like', "%$search%")
                  ->orWhereHas('client', fn($c) => $c->where('firstname', 'like', "%$search%")
                      ->orWhere('lastname', 'like', "%$search%")
                      ->orWhere('company', 'like', "%$search%"));
            });
        }
        if ($status = $request->get('status')) {
            $query->where('job_status', $status);
        }

        $jobs = $query->paginate(25)->withQueryString();

        $stats = [
            'total'      => Job::count(),
            'active'     => Job::whereIn('job_status', ['New','InProgress'])->count(),
            'scheduled'  => Job::where('job_status', 'Scheduled')->count(),
            'completed'  => Job::where('job_status', 'Completed')->count(),
        ];

        return view('crm.jobs.index', compact('jobs', 'stats'));
    }

    public function show(Job $job)
    {
        $job->load(['client', 'items', 'quote', 'invoice', 'scheduledJob', 'assignedTo']);
        return view('crm.jobs.show', compact('job'));
    }

    public function create(Request $request)
    {
        $clients = BusinessClient::orderBy('firstname')->get();
        $quotes  = Quote::where('status', 'Accepted')->orderBy('created_at','desc')->get();
        $team    = User::where('is_active', true)->orderBy('name')->get();
        $selectedClient = $request->get('client_id') ? BusinessClient::find($request->get('client_id')) : null;
        return view('crm.jobs.create', compact('clients', 'quotes', 'team', 'selectedClient'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id'               => 'required|string',
            'job_title'               => 'required|string|max:255',
            'quote_id'                => 'nullable|string',
            'job_status'              => 'required|in:New,Scheduled,InProgress,Completed,Cancelled',
            'job_date_time'           => 'nullable|date',
            'team_member_assigned_id' => 'nullable|exists:users,id',
            'instructions'            => 'nullable|string',
            'job_notes'               => 'nullable|string',
            'items'                   => 'array',
            'items.*.description'     => 'required|string',
            'items.*.quantity'        => 'required|numeric|min:0',
            'items.*.unit_price'      => 'required|numeric|min:0',
        ]);

        $job = Job::create([
            'client_id'               => $data['client_id'],
            'user_id'                 => auth()->id(),
            'quote_id'                => $data['quote_id'] ?? null,
            'job_title'               => $data['job_title'],
            'job_status'              => $data['job_status'],
            'job_date_time'           => $data['job_date_time'] ?? null,
            'team_member_assigned_id' => $data['team_member_assigned_id'] ?? null,
            'instructions'            => $data['instructions'] ?? null,
            'job_notes'               => $data['job_notes'] ?? null,
            'scheduled_status'        => 'Unscheduled',
            'assigned_status'         => $data['team_member_assigned_id'] ? 'Assigned' : 'Unassigned',
        ]);

        if (!empty($data['items'])) {
            foreach ($data['items'] as $i => $item) {
                JobItem::create([
                    'job_id'      => $job->job_id,
                    'description' => $item['description'],
                    'quantity'    => $item['quantity'],
                    'unit_price'  => $item['unit_price'],
                    'line_total'  => $item['quantity'] * $item['unit_price'],
                    'sort_order'  => $i,
                ]);
            }
        }

        ActivityLog::record('created', 'Job', $job->job_id, "Job {$job->job_id} created");

        return redirect()->route('crm.jobs.show', $job)->with('success', 'Job created.');
    }

    public function edit(Job $job)
    {
        $job->load(['client', 'items']);
        $clients = BusinessClient::orderBy('firstname')->get();
        $quotes  = Quote::where('status', 'Accepted')->orderBy('created_at','desc')->get();
        $team    = User::where('is_active', true)->orderBy('name')->get();
        return view('crm.jobs.edit', compact('job', 'clients', 'quotes', 'team'));
    }

    public function update(Request $request, Job $job)
    {
        $data = $request->validate([
            'job_title'               => 'required|string|max:255',
            'job_status'              => 'required|in:New,Scheduled,InProgress,Completed,Cancelled',
            'job_date_time'           => 'nullable|date',
            'team_member_assigned_id' => 'nullable|exists:users,id',
            'instructions'            => 'nullable|string',
            'job_notes'               => 'nullable|string',
            'items'                   => 'array',
            'items.*.description'     => 'required|string',
            'items.*.quantity'        => 'required|numeric|min:0',
            'items.*.unit_price'      => 'required|numeric|min:0',
        ]);

        $job->update([
            'job_title'               => $data['job_title'],
            'job_status'              => $data['job_status'],
            'job_date_time'           => $data['job_date_time'] ?? null,
            'team_member_assigned_id' => $data['team_member_assigned_id'] ?? null,
            'instructions'            => $data['instructions'] ?? null,
            'job_notes'               => $data['job_notes'] ?? null,
            'assigned_status'         => $data['team_member_assigned_id'] ? 'Assigned' : 'Unassigned',
        ]);

        $job->items()->delete();
        if (!empty($data['items'])) {
            foreach ($data['items'] as $i => $item) {
                JobItem::create([
                    'job_id'      => $job->job_id,
                    'description' => $item['description'],
                    'quantity'    => $item['quantity'],
                    'unit_price'  => $item['unit_price'],
                    'line_total'  => $item['quantity'] * $item['unit_price'],
                    'sort_order'  => $i,
                ]);
            }
        }

        return redirect()->route('crm.jobs.show', $job)->with('success', 'Job updated.');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('crm.jobs.index')->with('success', 'Job deleted.');
    }

    public function updateStatus(Request $request, Job $job)
    {
        $request->validate(['status' => 'required|in:New,Scheduled,InProgress,Completed,Cancelled']);
        $job->update(['job_status' => $request->status]);
        return back()->with('success', 'Job status updated.');
    }

    public function createInvoice(Job $job)
    {
        $job->load('items', 'client');

        $invoice = Invoice::create([
            'client_id'      => $job->client_id,
            'job_id'         => $job->job_id,
            'created_by'     => auth()->id(),
            'invoice_date'   => now(),
            'due_date'       => now()->addDays(30),
            'status'         => 'Draft',
            'sub_total'      => 0,
            'total_tax'      => 0,
            'total_amount'   => 0,
            'discount'       => 0,
            'balance'        => 0,
            'payment_method' => 'EFT',
        ]);

        foreach ($job->items as $i => $item) {
            InvoiceItem::create([
                'invoice_id'  => $invoice->invoice_id,
                'description' => $item->description,
                'quantity'    => $item->quantity,
                'unit_price'  => $item->unit_price,
                'line_total'  => $item->line_total,
                'sort_order'  => $i,
            ]);
        }

        $invoice->refresh()->load('items');
        $invoice->recalculateTotals();

        ActivityLog::record('created', 'Invoice', $invoice->invoice_id, "Invoice created from job {$job->job_id}");

        return redirect()->route('crm.invoices.edit', $invoice)->with('success', 'Invoice created from job.');
    }
}

