<?php

namespace App\Filament\Widgets;

use App\Models\Job;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UpcomingJobsWidget extends BaseWidget
{
    protected static ?int $sort = 5;
    protected static ?string $heading = 'Upcoming & Active Jobs';
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Job::with('client')
                    ->whereIn('job_status', ['New', 'Scheduled', 'InProgress'])
                    ->whereNull('deleted_at')
                    ->orderBy('job_date_time')
                    ->limit(8)
            )
            ->columns([
                Tables\Columns\TextColumn::make('job_id')
                    ->label('Job #')
                    ->copyable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('job_title')
                    ->label('Title')
                    ->searchable()
                    ->limit(35),
                Tables\Columns\TextColumn::make('client.firstname')
                    ->label('Client')
                    ->formatStateUsing(fn ($record) =>
                        trim(optional($record->client)->firstname . ' ' . optional($record->client)->lastname) ?: '—'
                    ),
                Tables\Columns\BadgeColumn::make('job_status')
                    ->label('Status')
                    ->colors([
                        'gray'    => 'New',
                        'info'    => 'Scheduled',
                        'warning' => 'InProgress',
                    ]),
                Tables\Columns\BadgeColumn::make('assigned_status')
                    ->label('Assigned')
                    ->colors(['danger' => 'Unassigned', 'success' => 'Assigned']),
                Tables\Columns\TextColumn::make('job_date_time')
                    ->label('Scheduled')
                    ->dateTime('d M Y H:i')
                    ->placeholder('Not scheduled'),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->url(fn (Job $record) => route('filament.admin.resources.jobs.view', $record))
                    ->icon('heroicon-o-eye'),
            ])
            ->paginated(false);
    }
}

