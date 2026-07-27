<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecurringInvoiceResource\Pages;
use App\Models\RecurringInvoice;
use App\Models\BusinessClient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class RecurringInvoiceResource extends Resource
{
    protected static ?string $model = RecurringInvoice::class;
    protected static ?string $navigationIcon  = 'heroicon-o-arrow-path';
    protected static ?string $navigationGroup = 'Finance';
    protected static ?string $navigationLabel = 'Recurring Invoices';
    protected static ?int    $navigationSort  = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Recurring Invoice Details')->columns(2)->schema([
                Forms\Components\Select::make('client_id')
                    ->label('Client')
                    ->options(BusinessClient::orderBy('firstname')->get()->mapWithKeys(fn ($c) =>
                        [$c->client_id => trim("{$c->firstname} {$c->lastname}") . ($c->company ? " ({$c->company})" : '')]
                    ))
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('frequency')
                    ->options([
                        'Weekly'    => 'Weekly',
                        'Monthly'   => 'Monthly',
                        'Quarterly' => 'Quarterly',
                        'Annually'  => 'Annually',
                    ])
                    ->required()
                    ->default('Monthly'),

                Forms\Components\DatePicker::make('start_date')->required()->default(now()),
                Forms\Components\DatePicker::make('end_date')->nullable()->label('End Date (leave blank for ongoing)'),

                Forms\Components\Select::make('status')
                    ->options([
                        'Active'    => 'Active',
                        'Paused'    => 'Paused',
                        'Cancelled' => 'Cancelled',
                        'Completed' => 'Completed',
                    ])
                    ->default('Active')
                    ->required(),

                Forms\Components\TextInput::make('total_amount')->label('Total Amount (R)')->numeric()->required(),
                Forms\Components\TextInput::make('deposit_paid')->label('Deposit Paid (R)')->numeric()->nullable(),
                Forms\Components\TextInput::make('payment_due')->label('Payment Due (R)')->numeric()->nullable(),
            ]),

            Forms\Components\Section::make('Line Items')->schema([
                Forms\Components\Repeater::make('items')
                    ->relationship()
                    ->schema([
                        Forms\Components\TextInput::make('description')->required()->columnSpan(2),
                        Forms\Components\TextInput::make('quantity')->numeric()->default(1)->required(),
                        Forms\Components\TextInput::make('unit_price')->numeric()->required()->label('Unit Price (R)'),
                        Forms\Components\TextInput::make('total')->numeric()->required()->label('Line Total (R)'),
                    ])
                    ->columns(5)
                    ->defaultItems(1)
                    ->addActionLabel('Add Item')
                    ->reorderable(false),
            ]),

            Forms\Components\Section::make('Notes')->columns(1)->schema([
                Forms\Components\Textarea::make('client_message')->label('Message to Client')->nullable(),
                Forms\Components\Textarea::make('internal_notes')->label('Internal Notes')->nullable(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('recurring_invoice_id')->label('ID')->searchable()->copyable(),
                Tables\Columns\TextColumn::make('client.firstname')
                    ->label('Client')
                    ->formatStateUsing(fn ($record) => trim(optional($record->client)->firstname . ' ' . optional($record->client)->lastname))
                    ->searchable(),
                Tables\Columns\TextColumn::make('frequency')->badge()
                    ->color(fn (string $state) => match ($state) {
                        'Weekly'    => 'info',
                        'Monthly'   => 'primary',
                        'Quarterly' => 'warning',
                        'Annually'  => 'success',
                        default     => 'gray',
                    }),
                Tables\Columns\TextColumn::make('total_amount')->money('ZAR')->label('Amount')->sortable(),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->color(fn (string $state) => match ($state) {
                        'Active'    => 'success',
                        'Paused'    => 'warning',
                        'Cancelled' => 'danger',
                        'Completed' => 'gray',
                        default     => 'gray',
                    }),
                Tables\Columns\TextColumn::make('start_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('end_date')->date()->placeholder('Ongoing'),
                Tables\Columns\TextColumn::make('next_invoice_date')->label('Next Invoice')->date()->placeholder('—'),
                Tables\Columns\TextColumn::make('invoices_generated')->label('Generated')->sortable(),
            ])
            ->filters([
                SelectFilter::make('frequency')
                    ->options(['Weekly'=>'Weekly','Monthly'=>'Monthly','Quarterly'=>'Quarterly','Annually'=>'Annually']),
                SelectFilter::make('status')
                    ->options(['Active'=>'Active','Paused'=>'Paused','Cancelled'=>'Cancelled','Completed'=>'Completed']),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('pause')
                    ->label('Pause')
                    ->icon('heroicon-o-pause-circle')
                    ->color('warning')
                    ->visible(fn (RecurringInvoice $r) => $r->status === 'Active')
                    ->action(fn (RecurringInvoice $r) => $r->update(['status' => 'Paused'])),
                Tables\Actions\Action::make('activate')
                    ->label('Activate')
                    ->icon('heroicon-o-play-circle')
                    ->color('success')
                    ->visible(fn (RecurringInvoice $r) => $r->status === 'Paused')
                    ->action(fn (RecurringInvoice $r) => $r->update(['status' => 'Active'])),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListRecurringInvoices::route('/'),
            'create' => Pages\CreateRecurringInvoice::route('/create'),
            'edit'   => Pages\EditRecurringInvoice::route('/{record}/edit'),
        ];
    }
}

