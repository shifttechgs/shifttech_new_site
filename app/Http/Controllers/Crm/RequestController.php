<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Concerns\HasPerPageSelector;
use App\Models\ActivityLog;
use App\Models\BusinessClient;
use App\Models\ClientRequest;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RequestController extends Controller
{
    use HasPerPageSelector;

    public function index(Request $request)
    {
        $query = ClientRequest::with('client')->orderBy('created_at', 'desc');

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }
        if ($priority = $request->get('priority')) {
            $query->where('priority', $priority);
        }

        $requests = $query->paginate($this->perPage($request))->withQueryString();

        $stats = [
            'total'     => ClientRequest::count(),
            'new'       => ClientRequest::where('status', 'New')->count(),
            'in_review' => ClientRequest::where('status', 'InReview')->count(),
            'quoted'    => ClientRequest::where('status', 'Quoted')->count(),
        ];

        return view('crm.requests.index', compact('requests', 'stats'));
    }

    public function show(ClientRequest $clientRequest)
    {
        $clientRequest->load('client');
        return view('crm.requests.show', compact('clientRequest'));
    }

    public function create()
    {
        $clients = BusinessClient::orderBy('firstname')->get();
        return view('crm.requests.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id'        => 'required|string',
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'status'           => 'required|in:New,InReview,Quoted,Approved,Closed',
            'priority'         => 'nullable|in:Low,Medium,High,Urgent',
            'assessment_notes' => 'nullable|string',
        ]);

        $req = ClientRequest::create($data);

        ActivityLog::record('created', 'ClientRequest', $req->id, "Client request '{$req->title}' created");

        return redirect()->route('crm.requests.show', $req)
            ->with('success', 'Client request created.');
    }

    public function edit(ClientRequest $clientRequest)
    {
        $clients = BusinessClient::orderBy('firstname')->get();
        return view('crm.requests.edit', compact('clientRequest', 'clients'));
    }

    public function update(Request $request, ClientRequest $clientRequest)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'status'           => 'required|in:New,InReview,Quoted,Approved,Closed',
            'priority'         => 'nullable|in:Low,Medium,High,Urgent',
            'assessment_notes' => 'nullable|string',
        ]);

        $clientRequest->update($data);

        return redirect()->route('crm.requests.show', $clientRequest)
            ->with('success', 'Request updated.');
    }

    public function destroy(ClientRequest $clientRequest)
    {
        $clientRequest->delete();
        return redirect()->route('crm.requests.index')->with('success', 'Request removed.');
    }

    public function convertToQuote(ClientRequest $clientRequest)
    {
        $quote = Quote::create([
            'client_id'  => $clientRequest->client_id,
            'user_id'    => auth()->id(),
            'job_title'  => $clientRequest->title,
            'status'     => 'Draft',
            'sub_total'  => 0,
            'total_tax'  => 0,
            'grand_total'=> 0,
            'quote_date' => now(),
        ]);

        $clientRequest->update(['status' => 'Quoted']);

        ActivityLog::record('converted', 'ClientRequest', $clientRequest->id, "Converted to quote {$quote->quote_id}");

        return redirect()->route('crm.quotes.edit', $quote)
            ->with('success', 'Request converted to quote.');
    }
}

