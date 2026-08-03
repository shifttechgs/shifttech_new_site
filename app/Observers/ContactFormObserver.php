<?php

namespace App\Observers;

use App\Models\Lead;
use App\Models\ActivityLog;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Log;

class ContactFormObserver
{
    public function created(Lead $lead): void
    {
        // Audit trail and CRM notifications are secondary to capturing the
        // lead. This runs inside Lead::create(), so an exception here would
        // surface to the caller as if the lead had failed to save.
        try {
            ActivityLog::record('created', 'Lead', $lead->lead_id,
                "New {$lead->source} lead from {$lead->name}" . ($lead->email ? " <{$lead->email}>" : ''));

            $services = $lead->services_interested;

            NotificationService::info(
                "New Lead: {$lead->name}",
                (Lead::sourceOptions()[$lead->source] ?? $lead->source)
                    . (is_array($services) && $services ? ' — ' . implode(', ', $services) : ''),
                '/useluminii/leads'
            );
        } catch (\Throwable $e) {
            Log::error('Lead created but post-save notification failed', [
                'lead_id' => $lead->lead_id,
                'error'   => $e->getMessage(),
            ]);
        }
    }
}
