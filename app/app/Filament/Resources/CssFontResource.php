<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Works\Web\Models\CssFont;
use App\Filament\Resources\CssFontResource\Pages;

class CssFontResource extends Resource
{
    protected static ?string $model = CssFont::class;

    protected static ?string $navigationIcon = 'coolicon-font';

    protected static ?string $navigationGroup = 'CSS';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Font Name'),
                Forms\Components\TextInput::make('import_url')
                    ->required()
                    ->url()
                    ->label('Import URL'),
                Forms\Components\TextInput::make('variable_name')
                    ->required()
                    ->label('Variable Name'),
                Forms\Components\Select::make('web_id')
                    ->relationship('web', 'name')
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Font Name'),
                Tables\Columns\TextColumn::make('import_url')
                    ->label('Import URL'),
                Tables\Columns\TextColumn::make('variable_name')
                    ->label('Variable Name'),
                Tables\Columns\TextColumn::make('web.name')
                    ->label('Web'),
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListCssFonts::route('/'),
            'create' => Pages\CreateCssFont::route('/create'),
            'edit' => Pages\EditCssFont::route('/{record}/edit'),
        ];
    }
}
