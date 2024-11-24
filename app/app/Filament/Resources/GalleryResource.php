<?php

namespace App\Filament\Resources;


use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Works\Web\Models\Gallery;
use App\Filament\Resources\GalleryResource\Pages;


class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationGroup = 'Collections';
    protected static ?string $navigationIcon = 'grommet-gallery';


    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form

    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('slug')->required()->unique(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\Repeater::make('contents')
                    ->relationship()
                    ->schema([
                        Forms\Components\TextInput::make('name')->required(),
                        Forms\Components\TextInput::make('slug')->required(),
                        Forms\Components\TextInput::make('image'),
                        Forms\Components\TextInput::make('url'),
                    ])
                    ->collapsed() 
                    ->collapsible()
                    ->itemLabel(fn ($state) => $state['name'] ?? 'New image'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table

    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('description'),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
