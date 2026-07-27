<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use App\Models\BusinessClient;
use App\Models\Job;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;
    protected static ?string $navigationIcon  = 'heroicon-o-receipt-percent';
    protected static ?string $navigationGroup = 'Finance';
    protected static ?int    $navigationSort  = 1;
    protected static ?string $recordTitleAttribute = 'invoice_id';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'Overdue')->count() ?: null;
    }
    public static function getNavigationBadgeColor(): ?string { return 'danger'; }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Invoice Details')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('invoice_id')->label('Invoice #')->disabled()->hiddenOn('create'),
                    Forms\Components\Select::make('client_id')->label('Client')->required()
                        ->options(BusinessClient::all()->mapWithKeys(fn ($c) => [$c->client_id => "{$c->firstname} {$c->lastname} ({$c->client_id})"]))
                        ->searchable(),
                    Forms\Components\Select::make('job_id')->label('Linked Job')
                        ->options(Job::pluck('job_title','job_id'))->searchable()->nullable(),
                    Forms\Components\Select::make('sales_person_id')->label('Sales Person')
                        ->options(User::whereIn('role',['Admin','SalesRep','SuperAdmin'])->pluck('name','id'))->default(auth()->id())->searchable(),
                    Forms\Components\Select::make('status')
                        ->options(['Draft'=>'Draft','Sent'=>'Sent','Paid'=>'Paid','PartiallyPaid'=>'Partially Paid','Overdue'=>'Overdue','Cancelled'=>'Cancelled'])
                        ->default('Draft')->required(),
                    Forms\Components\DateTimePicker::make('invoice_date')->label('Invoice Date')->default(now())->required(),
                    Forms\Components\DateTimePicker::make('due_date')->label('Due Date'),
                    Forms\Components\TextInput::make('deposit_paid')->label('Deposit Paid (R)')->numeric()->default(0),
                ]),

            Forms\Components\Section::make('Line Items')
                ->schema([
                    Forms\Components\Repeater::make('items')->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('description')->required()->columnSpan(3),
                            Forms\Components\TextInput::make('quantity')->numeric()->default(1)->columnSpan(1),
                            Forms\Components\TextInput::make('unit_price')->label('Unit Price (R)')->numeric()->default(0)->columnSpan(1),
                            Forms\Components\TextInput::make('tax_rate')->label('Tax %')->numeric()->default(15)->columnSpan(1),
                        ])->columns(6)->addActionLabel('+ Add Line Item')->reorderable('sort_order')->defaultItems(1),
                ]),

            Forms\Components\Section::make('Totals & Payment')
                ->columns(3)
                ->schema([
                    Forms\Components\TextInput::make('sub_total')->label('Subtotal (R)')->numeric()->disabled()->dehydrated(true),
                    Forms\Components\TextInput::make('total_tax')->label('Tax (R)')->numeric()->disabled()->dehydrated(true),
                    Forms\Components\TextInput::make('total_amount')->label('Total (R)')->numeric()->disabled()->dehydrated(true),
                    Forms\Components\Select::make('payment_method')
                        ->options(['cash'=>'Cash','eft'=>'EFT','card'=>'Card','other'=>'Other'])->nullable(),
                    Forms\Components\TextInput::make('payment_reference')->label('Payment Reference')->nullable(),
                    Forms\Components\DateTimePicker::make('paid_at')->label('Payment Date')->nullable(),
                ]),

            Forms\Components\Section::make('Notes')
                ->columns(2)
                ->schema([
                    Forms\Components\Textarea::make('internal_notes')->label('Internal Notes'),
                    Forms\Components\Textarea::make('client_message')->label('Message to Client'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_id')->label('Invoice #')->copyable()->sortable()->searchable(),
                Tables\Columns\TextColumn::make('client.firstname')->label('Client')
                    ->formatStateUsing(fn ($record) => optional($record->client)->full_name ?? '—'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors(['gray'=>'Draft','info'=>'Sent','success'=>'Paid','warning'=>'PartiallyPaid','danger'=>'Overdue','secondary'=>'Cancelled']),
                Tables\Columns\TextColumn::make('total_amount')->label('Total')->money('ZAR')->sortable(),
                Tables\Columns\TextColumn::make('balance')->label('Balance')->money('ZAR')->sortable(),
                Tables\Columns\TextColumn::make('invoice_date')->label('Date')->date()->sortable(),
                Tables\Columns\TextColumn::make('due_date')->label('Due')->date()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')->options(['Draft'=>'Draft','Sent'=>'Sent','Paid'=>'Paid','PartiallyPaid'=>'Partially Paid','Overdue'=>'Overdue']),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('send')
                    ->label('Send Invoice')
                    ->icon('heroicon-o-paper-airplane')->color('info')
                    ->visible(fn ($record) => $record->status === 'Draft')
                    ->action(function ($record) {
                        $record->update(['status' => 'Sent']);
                        \App\Jobs\SendInvoiceEmail::dispatch($record);
                        \Filament\Notifications\Notification::make()->title('Invoice sent!')->success()->send();
                    }),
                Tables\Actions\Action::make('mark_paid')
                    ->label('Mark as Paid')
                    ->icon('heroicon-o-check-circle')->color('success')
                    ->visible(fn ($record) => !in_array($record->status, ['Paid','Cancelled']))
                    ->action(fn ($record) => $record->update(['status'=>'Paid','paid_at'=>now(),'balance'=>0])),
                Tables\Actions\Action::make('view_pdf')
                    ->label('PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->url(fn ($record) => route('invoice.pdf', $record->invoice_id))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->defaultSort('created_at','desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'view'   => Pages\ViewInvoice::route('/{record}'),
            'edit'   => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}

