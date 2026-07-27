<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuoteResource\Pages;
use App\Models\Quote;
use App\Models\BusinessClient;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class QuoteResource extends Resource
{
    protected static ?string $model = Quote::class;
    protected static ?string $navigationIcon  = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Operations';
    protected static ?int    $navigationSort  = 1;
    protected static ?string $recordTitleAttribute = 'quote_id';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'Draft')->count() ?: null;
    }
    public static function getNavigationBadgeColor(): ?string { return 'warning'; }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Quote Details')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('quote_id')->label('Quote #')->disabled()->hiddenOn('create'),
                    Forms\Components\Select::make('client_id')
                        ->label('Client')
                        ->options(BusinessClient::all()->pluck('firstname', 'client_id')
                            ->map(fn ($fn, $id) => BusinessClient::find($id)?->firstname . ' ' . BusinessClient::find($id)?->lastname . ' (' . $id . ')'))
                        ->searchable()->required(),
                    Forms\Components\Select::make('user_id')
                        ->label('Sales Rep')
                        ->options(User::whereIn('role', ['Admin','SalesRep','SuperAdmin'])->pluck('name','id'))
                        ->default(auth()->id())->searchable(),
                    Forms\Components\TextInput::make('job_title')->label('Subject / Title')->required(),
                    Forms\Components\Select::make('status')
                        ->options(['Draft'=>'Draft','Sent'=>'Sent','Accepted'=>'Accepted','Declined'=>'Declined','Expired'=>'Expired'])
                        ->default('Draft')->required(),
                    Forms\Components\Select::make('opportunity_rating')->label('Opportunity Rating')
                        ->options([1=>'★',2=>'★★',3=>'★★★',4=>'★★★★',5=>'★★★★★'])->default(3),
                    Forms\Components\DateTimePicker::make('quote_date')->label('Quote Date')->default(now())->required(),
                    Forms\Components\DateTimePicker::make('expiry_date')->label('Expiry Date'),
                    Forms\Components\TextInput::make('required_deposit')->label('Required Deposit (R)')->numeric()->default(0),
                ]),

            Forms\Components\Section::make('Line Items')
                ->schema([
                    Forms\Components\Repeater::make('items')
                        ->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('description')->required()->columnSpan(3),
                            Forms\Components\TextInput::make('quantity')->numeric()->default(1)->columnSpan(1)
                                ->live(onBlur: true),
                            Forms\Components\TextInput::make('unit_price')->label('Unit Price (R)')->numeric()->default(0)->columnSpan(1)
                                ->live(onBlur: true),
                            Forms\Components\TextInput::make('tax_rate')->label('Tax %')->numeric()->default(15)->columnSpan(1),
                            Forms\Components\TextInput::make('line_total')->label('Total (R)')->numeric()->disabled()
                                ->dehydrated(false)->columnSpan(1),
                        ])
                        ->columns(7)
                        ->addActionLabel('+ Add Line Item')
                        ->reorderable('sort_order')
                        ->defaultItems(1),
                ]),

            Forms\Components\Section::make('Notes')
                ->columns(2)
                ->schema([
                    Forms\Components\Textarea::make('internal_notes')->label('Internal Notes'),
                    Forms\Components\Textarea::make('client_notes')->label('Client Notes (shown on quote)'),
                ]),

            Forms\Components\Section::make('Totals')
                ->columns(3)
                ->schema([
                    Forms\Components\TextInput::make('sub_total')->label('Subtotal (R)')->numeric()->disabled()->dehydrated(true),
                    Forms\Components\TextInput::make('total_tax')->label('Tax (R)')->numeric()->disabled()->dehydrated(true),
                    Forms\Components\TextInput::make('grand_total')->label('Grand Total (R)')->numeric()->disabled()->dehydrated(true),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('quote_id')->label('Quote #')->copyable()->searchable()->sortable(),
                Tables\Columns\TextColumn::make('client.firstname')->label('Client')
                    ->formatStateUsing(fn ($record) => optional($record->client)->full_name ?? '—')
                    ->searchable(),
                Tables\Columns\TextColumn::make('job_title')->label('Subject')->limit(40)->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors(['gray'=>'Draft','info'=>'Sent','success'=>'Accepted','danger'=>'Declined','warning'=>'Expired']),
                Tables\Columns\TextColumn::make('grand_total')->label('Total')->money('ZAR')->sortable(),
                Tables\Columns\TextColumn::make('quote_date')->label('Date')->date()->sortable(),
                Tables\Columns\TextColumn::make('expiry_date')->label('Expiry')->date()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')->options(['Draft'=>'Draft','Sent'=>'Sent','Accepted'=>'Accepted','Declined'=>'Declined','Expired'=>'Expired']),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('send')
                    ->label('Send to Client')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('info')
                    ->visible(fn ($record) => $record->status === 'Draft')
                    ->action(function ($record) {
                        $record->update(['status' => 'Sent']);
                        // Email dispatched via observer
                        \Filament\Notifications\Notification::make()->title('Quote sent!')->success()->send();
                    }),
                Tables\Actions\Action::make('convert_to_job')
                    ->label('Convert to Job')
                    ->icon('heroicon-o-arrow-right-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'Accepted')
                    ->url(fn ($record) => route('filament.admin.resources.jobs.create', ['quote_id' => $record->quote_id])),
            ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->defaultSort('created_at','desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListQuotes::route('/'),
            'create' => Pages\CreateQuote::route('/create'),
            'view'   => Pages\ViewQuote::route('/{record}'),
            'edit'   => Pages\EditQuote::route('/{record}/edit'),
        ];
    }
}

