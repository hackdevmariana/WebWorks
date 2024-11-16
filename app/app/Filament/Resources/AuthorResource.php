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

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('website_id')
                    ->relationship('website', 'title')
                    ->required(),
                Forms\Components\TextInput::make('username')
                    ->unique()
                    ->required(),
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('surname')->required(),
                Forms\Components\Repeater::make('links')
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->label('Key')
                            ->required(),
                        Forms\Components\TextInput::make('value')
                            ->label('Value')
                            ->url()
                            ->required(),
                    ])
                    ->label('Links')
                    ->nullable()
                    ->default([]),

                Forms\Components\FileUpload::make('photo')
                    ->image(),
                Forms\Components\Textarea::make('biography')->nullable(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('surname')->searchable(),
            Tables\Columns\TextColumn::make('website.url')->label('Website'),
            Tables\Columns\TextColumn::make('username'),
            Tables\Columns\TextColumn::make('links')
                ->label('Links')
                ->formatStateUsing(function ($state) {
                    if (is_array($state) && !empty($state)) {
                        return collect($state)
                            ->map(fn ($value, $key) => "<strong>{$key}:</strong> <a href='{$value}' target='_blank'>{$value}</a>")
                            ->join('<br>');
                    }
                    return '-';
                })
                
                ->html(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
