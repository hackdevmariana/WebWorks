<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialNetworkResource\Pages;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Resources\Table;
use Works\Web\Models\SocialNetwork;

class SocialNetworkResource extends Resource
{
    protected static ?string $model = SocialNetwork::class;

    protected static ?string $navigationIcon = 'heroicon-o-hand-thumb-up';

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                    Forms\Components\BelongsToSelect::make('web_id')
                        ->relationship('web', 'name')
                        ->required(),
                    Forms\Components\TextInput::make('title')
                        ->nullable()
                        ->label('Title'),
                    Forms\Components\TextInput::make('slug')
                        ->unique(ignoreRecord: true)
                        ->required(),
                    Forms\Components\Textarea::make('description')
                        ->nullable(),
                    Forms\Components\TextInput::make('socialnetwork')
                        ->nullable()
                        ->label('Social Network Name'),
                    Forms\Components\TextInput::make('url')
                        ->url()
                        ->required(),
                ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Title')->searchable(),
                Tables\Columns\TextColumn::make('socialnetwork')->label('Social Network')->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->url(fn($record) => $record->url)
                    ->label('Link')
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListSocialNetworks::route('/'),
            'create' => Pages\CreateSocialNetwork::route('/create'),
            'edit' => Pages\EditSocialNetwork::route('/{record}/edit'),
        ];
    }
}
