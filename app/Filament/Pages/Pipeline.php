<?php

namespace App\Filament\Pages;

use App\Models\ClientRequest;
use App\Models\ActivityLog;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class Pipeline extends Page
{
    protected static ?string $navigationIcon  = 'heroicon-o-view-columns';
    protected static ?string $navigationGroup = 'CRM';
    protected static ?string $navigationLabel = 'Pipeline';
    protected static ?string $title           = 'Request Pipeline';
    protected static ?int    $navigationSort  = 3;
    protected static string  $view            = 'filament.pages.pipeline';

    public static function getColumns(): array
    {
        return [
            'New'      => ['label' => 'New',       'color' => '#94a3b8', 'icon' => '📥'],
            'InReview' => ['label' => 'In Review',  'color' => '#f59e0b', 'icon' => '🔍'],
            'Quoted'   => ['label' => 'Quoted',     'color' => '#635bff', 'icon' => '📄'],
            'Approved' => ['label' => 'Approved',   'color' => '#10b981', 'icon' => '✅'],
            'Closed'   => ['label' => 'Closed',     'color' => '#64748b', 'icon' => '🔒'],
        ];
    }

    public function getRequests(): array
    {
        return ClientRequest::with(['client', 'assignedTo'])
            ->orderByRaw("FIELD(priority, 'Urgent', 'High', 'Normal', 'Low')")
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('status')
            ->toArray();
    }

    public function moveCard(string $requestId, string $newStatus): void
    {
        $request = ClientRequest::where('request_id', $requestId)->firstOrFail();
        $old     = $request->status;
        $request->update(['status' => $newStatus]);

        ActivityLog::record(
            'updated', 'ClientRequest', $requestId,
            "Request '{$request->title}' moved from {$old} → {$newStatus}"
        );

        Notification::make()
            ->title("Moved to " . self::getColumns()[$newStatus]['label'])
            ->success()
            ->send();
    }

    public function updatePriority(string $requestId, string $priority): void
    {
        ClientRequest::where('request_id', $requestId)->update(['priority' => $priority]);
        Notification::make()->title("Priority updated to {$priority}")->success()->send();
    }
}

