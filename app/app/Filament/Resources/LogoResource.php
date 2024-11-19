<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogoResource\Pages;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Resources\Table;
use Works\Web\Models\Logo;

class LogoResource extends Resource
{
    protected static ?string $model = Logo::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Web Management';

    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\BelongsToSelect::make('web_id')
                    ->relationship('web', 'name')
                    ->required(),
                \Filament\Forms\Components\TextInput::make('slug')
                    ->unique(ignoreRecord: true)
                    ->required(),
                \Filament\Forms\Components\Textarea::make('description')
                    ->nullable(),
                \Filament\Forms\Components\TextInput::make('url')
                    ->url()
                    ->nullable(),
                \Filament\Forms\Components\FileUpload::make('image')
                    ->nullable()
                    ->image(),
            ]);
    }


    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slug')->searchable(),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('url')
    ->url(fn ($record) => $record->url) // Hace que la columna sea un enlace
    ->label('Link'),

                Tables\Columns\ImageColumn::make('image')->label('Image'),
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
            'index' => Pages\ListLogos::route('/'),
            'create' => Pages\CreateLogo::route('/create'),
            'edit' => Pages\EditLogo::route('/{record}/edit'),
        ];
    }
}
