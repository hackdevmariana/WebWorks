<?php

namespace App\Filament\Resources;

use Works\Web\Models\Web;


use App\Filament\Resources\WebResource\Pages;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;

class WebResource extends Resource
{
    protected static ?string $model = Web::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt'; // Icono de navegación
    protected static ?string $navigationGroup = 'Content Management'; // Agrupación en el menú

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Name'),

                Forms\Components\TextInput::make('slug')
                    ->disabled()
                    ->required()
                    ->label('Slug'),

                Forms\Components\TextInput::make('url')
                    ->required()
                    ->url()
                    ->label('URL'),

                Forms\Components\TextInput::make('home')
                    ->url()
                    ->nullable()
                    ->label('Home Page'),

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('Title'),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->nullable(),

                Forms\Components\TextInput::make('keywords')
                    ->maxLength(255)
                    ->label('Keywords')
                    ->nullable(),

                Forms\Components\TextInput::make('favicon')
                    ->url()
                    ->nullable()
                    ->label('Favicon URL'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Name'),

                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->label('Slug'),

                Tables\Columns\TextColumn::make('url')
                    ->label('URL'),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Title'),

                
            ])
            ->filters([
                // Puedes agregar filtros personalizados aquí
            ])
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
        return [
            // Aquí se agregarán los Relation Managers cuando los modelos relacionados estén disponibles.
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWebs::route('/'),
            'create' => Pages\CreateWeb::route('/create'),
            'edit' => Pages\EditWeb::route('/{record}/edit'),
        ];
    }
}


