<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon  = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Blog Posts';
    protected static ?int    $navigationSort  = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->columns(2)->schema([
                Forms\Components\TextInput::make('title')
                    ->required()->live(onBlur: true)->columnSpanFull()
                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->required()->unique(ignoreRecord: true)
                    ->helperText('Used in the URL: /blog/your-slug'),

                Forms\Components\Select::make('category')
                    ->options(array_combine(Post::CATEGORIES, Post::CATEGORIES))
                    ->default('Engineering')->required(),

                Forms\Components\TextInput::make('author_name')->default('Prosper')->required(),

                Forms\Components\DateTimePicker::make('published_at')->default(now()),

                Forms\Components\Textarea::make('excerpt')
                    ->rows(2)->maxLength(500)->columnSpanFull()
                    ->helperText('Shown in the blog list and used as the meta description if none is set below.'),

                Forms\Components\RichEditor::make('body')
                    ->required()->columnSpanFull()
                    ->toolbarButtons(['bold', 'italic', 'link', 'bulletList', 'orderedList', 'h2', 'h3', 'blockquote', 'codeBlock', 'redo', 'undo']),

                Forms\Components\FileUpload::make('cover_image')
                    ->image()->disk('public')->directory('blog')
                    ->helperText('Optional — leave blank to use the generated cover art for this category.'),

                Forms\Components\TextInput::make('meta_title')
                    ->label('Meta title')->maxLength(191)->columnSpanFull()
                    ->helperText('Optional — the full <title> for search results. Leave blank to use "Post title | ShiftTech Insights".'),

                Forms\Components\TextInput::make('meta_description')->maxLength(191)->columnSpanFull(),

                Forms\Components\Toggle::make('is_published')->label('Published')->default(false),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->weight(FontWeight::SemiBold)
                    ->description(fn (Post $record) => $record->slug)
                    ->searchable()->limit(50),

                Tables\Columns\TextColumn::make('category')
                    ->badge()->color('gray'),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')->boolean(),

                Tables\Columns\TextColumn::make('published_at')
                    ->date()->sortable()
                    ->since()->color('gray')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')->since()->color('gray')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall),
            ])
            ->filters([
                SelectFilter::make('category')->options(array_combine(Post::CATEGORIES, Post::CATEGORIES)),
                Tables\Filters\TernaryFilter::make('is_published')->label('Published'),
            ])
            ->defaultSort('published_at', 'desc')
            ->striped();
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
