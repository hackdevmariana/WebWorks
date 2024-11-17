<?php

namespace Works\Web\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Works\Web\Models\Content;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;

class ContentResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('web_id')
                    ->relationship('web', 'name')
                    ->required(),
                Forms\Components\BelongsToSelect::make('author_id')
                    ->relationship('author', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->unique(ignoreRecord: true)
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subtitle')
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\Textarea::make('text')
                    ->nullable(),
                Forms\Components\TextInput::make('image')
                    ->url()
                    ->nullable(),
                Forms\Components\TextInput::make('url')
                    ->url()
                    ->nullable(),
                Forms\Components\TextInput::make('alt')
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\Select::make('content_type')
                    ->options([
                        'general' => 'General',
                        'article' => 'Article',
                        'news' => 'News',
                        'blog' => 'Blog',
                    ])
                    ->required(),
                Forms\Components\Toggle::make('is_default')
                    ->label('Is Default?'),
                Forms\Components\Toggle::make('draft')
                    ->label('Draft?'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\BooleanColumn::make('is_default'),
                Tables\Columns\BooleanColumn::make('draft'),
                Tables\Columns\TextColumn::make('web.name')->label('Website'),
                Tables\Columns\TextColumn::make('author.name')->label('Author'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRecords::route('/'),
            'create' => CreateRecord::route('/create'),
            'edit' => EditRecord::route('/{record}/edit'),
        ];
    }
}
