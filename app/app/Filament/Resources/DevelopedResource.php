<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DevelopedResource\Pages;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Works\Web\Models\Developed;

class DevelopedResource extends Resource
{
    protected static ?string $model = Developed::class;

    protected static ?string $navigationIcon = 'antdesign-code';

    protected static ?string $navigationGroup = 'Web Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('web_id')
                    ->relationship('web', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('text')->nullable(),
                Forms\Components\TextInput::make('author')->nullable(),
                Forms\Components\TextInput::make('url')->url()->nullable(),
                Forms\Components\TextInput::make('technology')->nullable(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('technology')->sortable(),
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
            'index' => Pages\ListDevelopeds::route('/'),
            'create' => Pages\CreateDeveloped::route('/create'),
            'edit' => Pages\EditDeveloped::route('/{record}/edit'),
        ];
    }
}
