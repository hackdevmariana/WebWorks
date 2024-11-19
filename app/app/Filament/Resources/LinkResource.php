<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LinkResource\Pages;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Works\Web\Models\Link;

class LinkResource extends Resource
{
    protected static ?string $model = Link::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('web_id')
                    ->relationship('web', 'name')
                    ->required(),
                Forms\Components\TextInput::make('text')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('url')
                    ->url()
                    ->required(),
                Forms\Components\TextInput::make('icon')->nullable(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('text')->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->url(fn($record) => $record->url) // Hacer clic redirige a la URL
                    ->label('URL'), // Opcional, para personalizar el encabezado de la columna
                Tables\Columns\TextColumn::make('icon')->label('Icon'),
                Tables\Columns\TextColumn::make('web.name')->label('Web'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLinks::route('/'),
            'create' => Pages\CreateLink::route('/create'),
            'edit' => Pages\EditLink::route('/{record}/edit'),
        ];
    }
}
