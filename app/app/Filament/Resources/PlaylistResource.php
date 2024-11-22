<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlaylistResource\RelationManagers\VideosRelationManager;


use App\Filament\Resources\PlaylistResource\Pages;
use Works\Web\Models\Playlist;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Columns\TextColumn;

class PlaylistResource extends Resource
{
    protected static ?string $model = Playlist::class;

    protected static ?string $navigationIcon = 'bi-collection-play';
    protected static ?string $navigationGroup = 'Collections';
    protected static ?string $pluralLabel = 'Playlists';
    protected static ?string $label = 'Playlist';

    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form

    {
        return $form
            ->schema([
                BelongsToSelect::make('web_id')
                    ->relationship('web', 'name')
                    ->required()
                    ->label('Web'),
                TextInput::make('name')
                    ->required()
                    ->label('Nombre')
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->label('Slug')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(3),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table

    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('web.name')
                    ->label('Web')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i'),
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
        return [
            VideosRelationManager::class,
        ];
    }
    
    


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlaylists::route('/'),
            'create' => Pages\CreatePlaylist::route('/create'),
            'edit' => Pages\EditPlaylist::route('/{record}/edit'),
        ];
    }
}
