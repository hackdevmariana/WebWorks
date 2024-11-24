<?php

namespace App\Filament\Resources\PlaylistResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class VideosRelationManager extends RelationManager
{
    protected static string $relationship = 'videos'; // Relación definida en el modelo Playlist

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                // Configura el campo de 'order' en la tabla pivot
                Forms\Components\TextInput::make('pivot.order')
                    ->label('Order')
                    ->numeric()
                    ->required(),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->sortable(),
                Tables\Columns\TextColumn::make('author')
                    ->label('Author')
                    ->sortable(),
                Tables\Columns\TextColumn::make('pivot.order')
                    ->label('Order'),
            ])
            ->filters([])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }

    protected function getTableQuery(): Builder
    {
        // Accede a la relación 'videos' de la Playlist y carga el pivot 'order'
        return $this->getRelationshipQuery()->withPivot('order');
    }
}
