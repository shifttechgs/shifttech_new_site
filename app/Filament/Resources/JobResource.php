<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Models\Job;
use App\Models\BusinessClient;
use App\Models\Quote;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;
    protected static ?string $navigationIcon  = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Operations';
    protected static ?int    $navigationSort  = 2;
    protected static ?string $recordTitleAttribute = 'job_id';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereIn('job_status', ['New','InProgress'])->count() ?: null;
    }
    public static function getNavigationBadgeColor(): ?string { return 'info'; }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Job Details')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('job_id')->label('Job #')->disabled()->hiddenOn('create'),
                    Forms\Components\Select::make('client_id')
                        ->label('Client')->required()
                        ->options(BusinessClient::all()->mapWithKeys(fn ($c) => [$c->client_id => "{$c->firstname} {$c->lastname} ({$c->client_id})"])  )
                        ->searchable(),
                    Forms\Components\TextInput::make('job_title')->required(),
                    Forms\Components\Select::make('job_status')
                        ->options(['New'=>'New','Scheduled'=>'Scheduled','InProgress'=>'In Progress','Completed'=>'Completed','Cancelled'=>'Cancelled'])
                        ->default('New')->required(),
                    Forms\Components\Select::make('user_id')->label('Created By / Sales Rep')
                        ->options(User::whereIn('role',['Admin','SalesRep','SuperAdmin'])->pluck('name','id'))->default(auth()->id())->searchable(),
                    Forms\Components\Select::make('team_member_assigned_id')->label('Assign Technician')
                        ->options(User::whereIn('role',['Technician','Admin'])->pluck('name','id'))->searchable()->nullable(),
                    Forms\Components\Select::make('quote_id')->label('Linked Quote')
                        ->options(Quote::pluck('job_title','quote_id'))->searchable()->nullable(),
                    Forms\Components\DateTimePicker::make('job_date_time')->label('Job Date & Time')->default(now())->required(),
                    Forms\Components\Select::make('schedule_later')
                        ->options(['no'=>'Schedule Now','yes'=>'Schedule Later'])->default('no'),
                ]),

            Forms\Components\Section::make('Line Items')
                ->schema([
                    Forms\Components\Repeater::make('items')->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('description')->required()->columnSpan(3),
                            Forms\Components\TextInput::make('quantity')->numeric()->default(1)->columnSpan(1),
                            Forms\Components\TextInput::make('unit_price')->label('Unit Price (R)')->numeric()->default(0)->columnSpan(1),
                            Forms\Components\TextInput::make('tax_rate')->label('Tax %')->numeric()->default(15)->columnSpan(1),
                        ])->columns(6)->addActionLabel('+ Add Item')->reorderable('sort_order')->defaultItems(1),
                ]),

            Forms\Components\Section::make('Notes & Instructions')
                ->columns(2)
                ->schema([
                    Forms\Components\Textarea::make('instructions')->label('Instructions for Technician'),
                    Forms\Components\Textarea::make('job_notes')->label('Job Notes'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('job_id')->label('Job #')->copyable()->sortable()->searchable(),
                Tables\Columns\TextColumn::make('job_title')->label('Title')->limit(35)->searchable(),
                Tables\Columns\TextColumn::make('client.firstname')->label('Client')
                    ->formatStateUsing(fn ($record) => optional($record->client)->full_name ?? '—'),
                Tables\Columns\BadgeColumn::make('job_status')->label('Status')
                    ->colors(['gray'=>'New','info'=>'Scheduled','warning'=>'InProgress','success'=>'Completed','danger'=>'Cancelled']),
                Tables\Columns\TextColumn::make('assignedTo.name')->label('Assigned To')->placeholder('Unassigned'),
                Tables\Columns\TextColumn::make('job_date_time')->label('Date')->dateTime()->sortable(),
            ])
            ->filters([
                SelectFilter::make('job_status')->label('Status')
                    ->options(['New'=>'New','Scheduled'=>'Scheduled','InProgress'=>'In Progress','Completed'=>'Completed','Cancelled'=>'Cancelled']),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('convert_invoice')
                    ->label('Create Invoice')
                    ->icon('heroicon-o-receipt-percent')
                    ->color('success')
                    ->visible(fn ($record) => $record->job_status === 'Completed' && !$record->invoice)
                    ->url(fn ($record) => route('filament.admin.resources.invoices.create', ['job_id' => $record->job_id])),
            ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->defaultSort('created_at','desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'view'   => Pages\ViewJob::route('/{record}'),
            'edit'   => Pages\EditJob::route('/{record}/edit'),
        ];
    }
}

