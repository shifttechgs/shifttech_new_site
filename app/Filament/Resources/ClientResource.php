<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\BusinessClient;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class ClientResource extends Resource
{
    protected static ?string $model = BusinessClient::class;
    protected static ?string $navigationIcon  = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'CRM';
    protected static ?int    $navigationSort  = 1;
    protected static ?string $modelLabel      = 'Client';
    protected static ?string $pluralModelLabel = 'Clients';
    protected static ?string $recordTitleAttribute = 'firstname';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('client_type', 'Lead')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Personal Details')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('firstname')->required()->maxLength(100),
                    Forms\Components\TextInput::make('lastname')->required()->maxLength(100),
                    Forms\Components\TextInput::make('email')->email()->maxLength(255),
                    Forms\Components\TextInput::make('phone_number')->tel()->maxLength(30),
                    Forms\Components\TextInput::make('company')->maxLength(255),
                ]),

            Forms\Components\Section::make('Address')
                ->columns(2)
                ->collapsed()
                ->schema([
                    Forms\Components\TextInput::make('street'),
                    Forms\Components\TextInput::make('city'),
                    Forms\Components\TextInput::make('province'),
                    Forms\Components\TextInput::make('postal_code'),
                    Forms\Components\TextInput::make('country')->default('South Africa'),
                ]),

            Forms\Components\Section::make('CRM Details')
                ->columns(2)
                ->schema([
                    Forms\Components\Select::make('client_type')
                        ->options(['Lead' => 'Lead', 'Prospect' => 'Prospect', 'Client' => 'Client'])
                        ->default('Lead')->required(),
                    Forms\Components\Select::make('status')
                        ->options(['Active' => 'Active', 'Inactive' => 'Inactive'])
                        ->default('Active')->required(),
                    Forms\Components\Select::make('lead_source')
                        ->options([
                            'website'    => 'Website Contact Form',
                            'referral'   => 'Referral',
                            'social'     => 'Social Media',
                            'walk-in'    => 'Walk-In',
                            'cold-call'  => 'Cold Call',
                            'other'      => 'Other',
                        ]),
                    Forms\Components\Select::make('communication_preference')
                        ->options([
                            'email'    => 'Email',
                            'phone'    => 'Phone',
                            'whatsapp' => 'WhatsApp',
                        ])->default('email'),
                    Forms\Components\Select::make('user_id')
                        ->label('Assigned Sales Rep')
                        ->options(User::where('role', 'SalesRep')->orWhere('role', 'Admin')->pluck('name', 'id'))
                        ->searchable()->nullable(),
                    Forms\Components\Textarea::make('notes')->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client_id')->label('ID')->sortable()->searchable()->copyable(),
                Tables\Columns\TextColumn::make('firstname')->label('Name')
                    ->formatStateUsing(fn ($record) => "{$record->firstname} {$record->lastname}")
                    ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('company')->searchable()->placeholder('—'),
                Tables\Columns\TextColumn::make('email')->searchable()->copyable(),
                Tables\Columns\TextColumn::make('phone_number')->label('Phone')->placeholder('—'),
                Tables\Columns\BadgeColumn::make('client_type')
                    ->colors([
                        'warning' => 'Lead',
                        'info'    => 'Prospect',
                        'success' => 'Client',
                    ]),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors(['success' => 'Active', 'danger' => 'Inactive']),
                Tables\Columns\TextColumn::make('lead_source')->label('Source')->placeholder('—'),
                Tables\Columns\TextColumn::make('created_at')->label('Added')->date()->sortable(),
            ])
            ->filters([
                SelectFilter::make('client_type')
                    ->options(['Lead' => 'Lead', 'Prospect' => 'Prospect', 'Client' => 'Client']),
                SelectFilter::make('status')
                    ->options(['Active' => 'Active', 'Inactive' => 'Inactive']),
                SelectFilter::make('lead_source')
                    ->options([
                        'website'   => 'Website',
                        'referral'  => 'Referral',
                        'social'    => 'Social Media',
                        'walk-in'   => 'Walk-In',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('convert')
                    ->label('Convert to Client')
                    ->icon('heroicon-o-arrow-up-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->client_type !== 'Client')
                    ->action(fn ($record) => $record->update(['client_type' => 'Client'])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'view'   => Pages\ViewClient::route('/{record}'),
            'edit'   => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}

