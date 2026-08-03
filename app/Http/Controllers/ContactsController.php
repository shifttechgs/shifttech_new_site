<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\Lead;
use App\Models\BusinessService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormNotification;

class ContactsController extends Controller
{
    public function index()
    {
        $services = BusinessService::where('is_active', true)
            ->orderBy('category')
            ->orderBy('name')
            ->get(['service_id', 'name', 'category']);

        return view('contact', compact('services'));
    }

    public function submitForm(ContactFormRequest $request): JsonResponse
    {
        $data      = $request->validated();
        $adminEmail = config('mail.contact_to') ?: config('mail.from.address');

        // 1. Save to local CRM database
        try {
            $services   = $data['services'] ?? [];
            $submission = Lead::create([
                'source'              => 'website',
                'name'                => $data['name'],
                'email'               => $data['email'],
                'phone'               => $data['phone'] ?? null,
                'company'             => $data['company'] ?? null,
                'services_interested' => ! empty($services) ? $services : null,
                'message'             => $data['message'],
                'budget'              => $data['budget'] ?? null,
                'status'              => 'New',
                'priority'            => 'Normal',
                'ip_address'          => $request->ip(),
            ]);
        } catch (\Throwable $e) {
            // The lead is the deliverable — if it did not persist, do not tell
            // the visitor we received it, or the enquiry is lost silently.
            Log::error('Failed to save contact form submission', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Sorry, we could not submit your request. Please email us at ' . $adminEmail . '.',
            ], 500);
        }

        // 2. Send admin email notification. Non-fatal: the lead is already in
        // the CRM, so a mail outage must not fail the visitor's submission.
        try {
            Mail::to($adminEmail)->send(new ContactFormNotification($data, true));
        } catch (\Throwable $e) {
            Log::error('Contact form email failed', ['error' => $e->getMessage()]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your message! We will get back to you shortly.',
        ]);
    }

    /**
     * Hero quick-audit form — name + email, low-friction top-of-funnel
     * capture. Creates the same Lead record the full contact form does.
     */
    public function submitQuickAudit(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'max:150'],
            'honeypot' => ['nullable', 'max:0'],
        ]);

        $adminEmail = config('mail.contact_to') ?: config('mail.from.address');
        $formData = [
            'name'    => $data['name'],
            'email'   => $data['email'],
            'message' => 'Requested a free audit via the hero quick-audit form.',
        ];

        try {
            $submission = Lead::create([
                'source'     => 'website',
                'name'       => $formData['name'],
                'email'      => $formData['email'],
                'message'    => $formData['message'],
                'status'     => 'New',
                'priority'   => 'Normal',
                'ip_address' => $request->ip(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Failed to save quick-audit submission', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Sorry, we could not submit your request. Please email us at ' . $adminEmail . '.',
            ], 500);
        }

        try {
            Mail::to($adminEmail)->send(new ContactFormNotification($formData, true));
        } catch (\Throwable $e) {
            Log::error('Quick-audit email failed', ['error' => $e->getMessage()]);
        }

        return response()->json([
            'success' => true,
            'message' => "Thanks! We'll be in touch shortly with your free audit.",
        ]);
    }
}
