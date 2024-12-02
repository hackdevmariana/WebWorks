<?php
namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Works\Web\Models\CssGeneral;
use App\Filament\Resources\CssGeneralResource\Pages;

class CssGeneralResource extends Resource
{
    protected static ?string $model = CssGeneral::class;

    protected static ?string $navigationIcon = 'heroicon-o-variable';
    protected static ?int $navigationSort = 2; 


    protected static ?string $navigationGroup = 'CSS';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('value')
                    ->label('General Value')
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
                    ->label('Value'),
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
            'index' => Pages\ListCssGenerals::route('/'),
            'create' => Pages\CreateCssGeneral::route('/create'),
            'edit' => Pages\EditCssGeneral::route('/{record}/edit'),
        ];
    }
}
