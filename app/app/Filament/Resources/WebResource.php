<?php

namespace App\Filament\Resources;

use Str;
use Works\Web\Models\Web;


use App\Filament\Resources\WebResource\Pages;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Schmeits\FilamentCharacterCounter\Forms\Components\TextInput;
use Schmeits\FilamentCharacterCounter\Forms\Components\Textarea;
use Filament\Forms\Get;
use Filament\Forms\Set;

class WebResource extends Resource
{
    protected static ?string $model = Web::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt'; // Icono de navegación
    protected static ?string $navigationGroup = 'Content Management'; // Agrupación en el menú


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->maxLength(255)
                    ->label('Name')
                    ->characterLimit(255),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->label('Slug'),

                Forms\Components\TextInput::make('url')
                    ->required()
                    ->url()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('home', $state))
                    ->label('URL'),

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('Title'),

                Forms\Components\TextInput::make('home')
                    ->url()
                    ->nullable()
                    ->label('Home Page'),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->nullable(),

                TextInput::make('keywords')
                    ->maxLength(255)
                    ->label('Keywords')
                    ->characterLimit(255)
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


