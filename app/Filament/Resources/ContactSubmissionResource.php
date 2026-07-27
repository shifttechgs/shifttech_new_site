<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactSubmissionResource\Pages;
use App\Models\ContactFormSubmission;
use App\Models\BusinessClient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactFormSubmission::class;
    protected static ?string $navigationIcon  = 'heroicon-o-inbox-arrow-down';
    protected static ?string $navigationGroup = 'CRM';
    protected static ?string $navigationLabel = 'Website Leads';
    protected static ?int    $navigationSort  = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'New')->count() ?: null;
    }
    public static function getNavigationBadgeColor(): ?string { return 'danger'; }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Submission Details')->columns(2)->schema([
                Forms\Components\TextInput::make('name')->disabled(),
                Forms\Components\TextInput::make('email')->disabled(),
                Forms\Components\TextInput::make('phone')->disabled(),
                Forms\Components\TextInput::make('company')->disabled(),
                Forms\Components\TextInput::make('subject')->disabled(),
                Forms\Components\TextInput::make('service_interest')->label('Service Interest')->disabled(),
                Forms\Components\Textarea::make('message')->disabled()->columnSpanFull(),
            ]),
            Forms\Components\Section::make('CRM Management')->columns(2)->schema([
                Forms\Components\Select::make('status')
                    ->options(['New'=>'New','Contacted'=>'Contacted','Converted'=>'Converted to Client','Closed'=>'Closed'])
                    ->required(),
                Forms\Components\Textarea::make('admin_notes')->label('Your Notes')->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable()->copyable(),
                Tables\Columns\TextColumn::make('phone')->placeholder('—'),
                Tables\Columns\TextColumn::make('service_interest')->label('Service')->placeholder('—')->limit(25),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors(['danger'=>'New','warning'=>'Contacted','success'=>'Converted','gray'=>'Closed']),
                Tables\Columns\TextColumn::make('lead_source')->label('Source'),
                Tables\Columns\TextColumn::make('created_at')->label('Submitted')->since()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')->options(['New'=>'New','Contacted'=>'Contacted','Converted'=>'Converted','Closed'=>'Closed']),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('convert_to_lead')
                    ->label('Create Lead')
                    ->icon('heroicon-o-user-plus')
                    ->color('success')
                    ->visible(fn ($record) => $record->status !== 'Converted')
                    ->action(function ($record) {
                        $client = BusinessClient::create([
                            'firstname'   => explode(' ', $record->name)[0],
                            'lastname'    => implode(' ', array_slice(explode(' ', $record->name), 1)) ?: '—',
                            'email'       => $record->email,
                            'phone_number'=> $record->phone,
                            'company'     => $record->company,
                            'lead_source' => 'website',
                            'client_type' => 'Lead',
                        ]);
                        $record->update(['status' => 'Converted', 'converted_client_id' => $client->id]);
                        \Filament\Notifications\Notification::make()
                            ->title("Lead created: {$client->firstname} {$client->lastname}")
                            ->success()->send();
                    }),
            ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactSubmissions::route('/'),
            'view'  => Pages\ViewContactSubmission::route('/{record}'),
            'edit'  => Pages\EditContactSubmission::route('/{record}/edit'),
        ];
    }
}

