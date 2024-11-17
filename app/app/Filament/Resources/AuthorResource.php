<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Works\Web\Models\Author;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?string $label = 'Author';
    protected static ?string $pluralLabel = 'Authors';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('website_id')
                    ->label('Website ID')
                    ->required()
                    ->numeric(),

                Forms\Components\TextInput::make('username')
                    ->required()
                    ->unique(ignorable: fn ($record) => $record)
                    ->maxLength(255),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('surname')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Repeater::make('links')
                    ->label('Links')
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->label('Platform')
                            ->required(),
                        Forms\Components\TextInput::make('value')
                            ->label('URL')
                            ->required()
                            ->url(),
                    ])
                    ->default([])
                    ->columnSpan('full'),

                Forms\Components\FileUpload::make('photo')
                    ->label('Photo')
                    ->image(),

                Forms\Components\Textarea::make('biography')
                    ->label('Biography'),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignorable: fn ($record) => $record)
                    ->maxLength(255),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('website_id')->label('Website'),
                Tables\Columns\TextColumn::make('username')->searchable(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('surname')->searchable(),
                Tables\Columns\TextColumn::make('slug')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }
}
