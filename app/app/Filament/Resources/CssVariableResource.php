<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Works\Web\Models\CssVariable;
use App\Filament\Resources\CssVariableResource\Pages;

class CssVariableResource extends Resource
{
    protected static ?string $model = CssVariable::class;

    protected static ?string $navigationIcon = 'heroicon-o-variable';

    protected static ?string $navigationGroup = 'CSS';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->maxLength(255),
                Forms\Components\ColorPicker::make('value')
                    ->label('Color Value')
                    ->required(),
                Forms\Components\Select::make('web_id')
                    ->relationship('web', 'name')
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Key'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Value')
                    ->formatStateUsing(fn(CssVariable $record) => "<div style='width: 30px; height: 30px; background-color: {$record->value}; border: 1px solid #000; border-radius: 15px;'></div>")
                    ->html(),
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
            'index' => Pages\ListCssVariables::route('/'),
            'create' => Pages\CreateCssVariable::route('/create'),
            'edit' => Pages\EditCssVariable::route('/{record}/edit'),
        ];
    }
}
