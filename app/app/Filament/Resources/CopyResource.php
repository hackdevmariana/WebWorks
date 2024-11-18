<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CopyResource\Pages;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Works\Web\Models\Copy;

class CopyResource extends Resource
{
    protected static ?string $model = Copy::class;

    protected static ?string $navigationIcon = 'lucide-copyleft';
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Forms\Form $form): Forms\Form
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
                Forms\Components\Textarea::make('subtext')
                    ->nullable(),
                Forms\Components\Textarea::make('copy')
                    ->nullable(),
                Forms\Components\TextInput::make('license')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('url')
                    ->url()
                    ->nullable(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('license'),
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
            'index' => Pages\ListCopies::route('/'),
            'create' => Pages\CreateCopy::route('/create'),
            'edit' => Pages\EditCopy::route('/{record}/edit'),
        ];
    }
}
