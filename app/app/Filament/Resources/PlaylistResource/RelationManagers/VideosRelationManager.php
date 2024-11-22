<?php

namespace App\Filament\Resources\PlaylistResource\RelationManagers;


use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;


class VideosRelationManager extends RelationManager
{
    protected static string $relationship = 'videos';

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
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
        // Usa la relación configurada en el RelationManager
        return $this->getRelationship()->getQuery()->withPivot('order');
    }
    


}
