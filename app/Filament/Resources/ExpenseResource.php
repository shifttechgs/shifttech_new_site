<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;
    protected static ?string $navigationIcon  = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Finance';
    protected static ?int    $navigationSort  = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->columns(2)->schema([
                Forms\Components\TextInput::make('description')->required(),
                Forms\Components\TextInput::make('vendor')->nullable(),
                Forms\Components\Select::make('category_id')->label('Category')
                    ->options(ExpenseCategory::pluck('name', 'id'))->searchable()->nullable()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')->required(),
                        Forms\Components\ColorPicker::make('color')->default('#6366f1'),
                    ])
                    ->createOptionUsing(fn (array $data) => ExpenseCategory::create($data)->id),
                Forms\Components\TextInput::make('amount')->label('Amount (R)')->numeric()->required(),
                Forms\Components\DatePicker::make('expense_date')->label('Date')->default(now())->required(),
                Forms\Components\Select::make('recurrence_type')->label('Recurrence')
                    ->options(['none'=>'One-time','weekly'=>'Weekly','monthly'=>'Monthly','yearly'=>'Yearly'])->default('none'),
                Forms\Components\Toggle::make('is_recurring')->label('Recurring Expense')->reactive(),
                Forms\Components\Textarea::make('notes')->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('expense_id')->label('ID')->searchable()->copyable(),
                Tables\Columns\TextColumn::make('description')->searchable()->limit(40),
                Tables\Columns\TextColumn::make('vendor')->placeholder('—'),
                Tables\Columns\TextColumn::make('category.name')->label('Category')->placeholder('—'),
                Tables\Columns\TextColumn::make('amount')->money('ZAR')->sortable(),
                Tables\Columns\IconColumn::make('is_recurring')->label('Recurring')->boolean(),
                Tables\Columns\TextColumn::make('expense_date')->label('Date')->date()->sortable(),
            ])
            ->filters([
                SelectFilter::make('category_id')->label('Category')
                    ->options(ExpenseCategory::pluck('name', 'id')),
                SelectFilter::make('is_recurring')->label('Type')
                    ->options(['1' => 'Recurring', '0' => 'One-time']),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->defaultSort('expense_date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit'   => Pages\EditExpense::route('/{record}/edit'),
        ];
    }
}

