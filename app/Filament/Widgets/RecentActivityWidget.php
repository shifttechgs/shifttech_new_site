<?php

namespace App\Filament\Widgets;

use App\Models\ActivityLog;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentActivityWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int|string|array $columnSpan = 'full';
    protected static ?string $heading = 'Recent Activity';

    public function table(Table $table): Table
    {
        return $table
            ->query(ActivityLog::with('user')->latest()->limit(10))
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('User')->placeholder('System'),
                Tables\Columns\BadgeColumn::make('action')
                    ->colors(['success'=>'created','info'=>'sent','warning'=>'updated','danger'=>'deleted','gray'=>'paid']),
                Tables\Columns\TextColumn::make('entity_type')->label('Type'),
                Tables\Columns\TextColumn::make('description')->limit(60),
                Tables\Columns\TextColumn::make('created_at')->label('When')->since(),
            ])
            ->paginated(false);
    }
}

