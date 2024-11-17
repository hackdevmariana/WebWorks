<?php

namespace App\Filament\Resources;

use Works\Web\Models\Contact;
use App\Filament\Resources\ContactResource\Pages;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('web_id')
                    ->relationship('web', 'name')
                    ->required()
                    ->label('Website'),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Name'),

                Forms\Components\TextInput::make('slug')
                    ->disabled()
                    ->label('Slug'),

                Forms\Components\TextInput::make('title')
                    ->maxLength(255)
                    ->label('Title'),

                Forms\Components\TextInput::make('phone')
                    ->maxLength(20)
                    ->label('Phone'),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->label('Email'),

                Forms\Components\TextInput::make('address')
                    ->label('Address'),

                Forms\Components\TextInput::make('city')
                    ->label('City'),

                Forms\Components\TextInput::make('country')
                    ->label('Country'),

                Forms\Components\Textarea::make('other')
                    ->label('Other Information'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable()->label('Name'),
                Tables\Columns\TextColumn::make('slug')->sortable()->label('Slug'),
                Tables\Columns\TextColumn::make('city')->sortable()->label('City'),
                Tables\Columns\TextColumn::make('country')->sortable()->label('Country'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Created At'),
            ])
            ->filters([])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
