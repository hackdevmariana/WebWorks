<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ErrorPageResource\Pages;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Works\Web\Models\ErrorPage;

class ErrorPageResource extends Resource
{
    protected static ?string $model = ErrorPage::class;

    protected static ?string $navigationIcon = 'codicon-error';

    protected static ?string $navigationGroup = 'Web Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('web_id')
                    ->relationship('web', 'name')
                    ->required(),
                Forms\Components\TextInput::make('error_number')
                    ->numeric()
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subtitle')->nullable(),
                Forms\Components\Textarea::make('text')->nullable(),
                Forms\Components\FileUpload::make('image')->nullable(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('error_number')->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable(),
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
            'index' => Pages\ListErrorPages::route('/'),
            'create' => Pages\CreateErrorPage::route('/create'),
            'edit' => Pages\EditErrorPage::route('/{record}/edit'),
        ];
    }
}
