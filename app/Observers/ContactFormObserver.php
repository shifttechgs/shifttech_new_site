<?php

namespace App\Observers;

use App\Models\ContactFormSubmission;
use App\Models\ActivityLog;
use App\Services\NotificationService;

class ContactFormObserver
{
    public function created(ContactFormSubmission $submission): void
    {
        ActivityLog::record('created', 'Lead', $submission->id,
            "New website lead from {$submission->name} <{$submission->email}> — {$submission->service}");

        NotificationService::info(
            "🌐 New Website Lead: {$submission->name}",
            "{$submission->service} — {$submission->email}",
            '/useluminii/contact-submissions'
        );
    }
}

