<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Concerns\HasPerPageSelector;
use App\Models\ActivityLog;
use App\Models\BusinessClient;
use App\Models\ContactFormSubmission;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
    use HasPerPageSelector;

    public function index(Request $request)
    {
        $query = ContactFormSubmission::orderBy('created_at', 'desc');

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $leads = $query->paginate($this->perPage($request))->withQueryString();

        $stats = [
            'total'    => ContactFormSubmission::count(),
            'new'      => ContactFormSubmission::where('status', 'New')->count(),
            'reviewed' => ContactFormSubmission::where('status', 'Reviewed')->count(),
            'converted'=> ContactFormSubmission::where('status', 'Converted')->count(),
        ];

        return view('crm.leads.index', compact('leads', 'stats'));
    }

    public function show(ContactFormSubmission $lead)
    {
        return view('crm.leads.show', compact('lead'));
    }

    public function convert(ContactFormSubmission $lead)
    {
        $client = BusinessClient::create([
            'firstname'   => explode(' ', $lead->name)[0],
            'lastname'    => implode(' ', array_slice(explode(' ', $lead->name), 1)) ?: '-',
            'email'       => $lead->email,
            'phone_number'=> $lead->phone,
            'company'     => $lead->company,
            'client_type' => 'Lead',
            'lead_source' => 'Website',
            'notes'       => $lead->message,
            'user_id'     => auth()->id(),
        ]);

        $lead->update(['status' => 'Converted']);

        ActivityLog::record('converted', 'ContactFormSubmission', $lead->id, "Lead converted to client {$client->client_id}");

        return redirect()->route('crm.clients.show', $client)
            ->with('success', 'Lead converted to client.');
    }

    public function destroy(ContactFormSubmission $lead)
    {
        $lead->delete();
        return redirect()->route('crm.leads.index')->with('success', 'Lead removed.');
    }
}


