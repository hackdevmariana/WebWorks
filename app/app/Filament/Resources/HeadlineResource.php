<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeadlineResource\Pages;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Resources\Table;
use Works\Web\Models\Headline;


class HeadlineResource extends Resource
{
    protected static ?string $model = Headline::class;


    protected static ?string $navigationIcon = 'fluentui-text-case-title-16';

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Forms\Form $form): Forms\Form
{
    return $form
        ->schema([
            Forms\Components\BelongsToSelect::make('web_id')
                ->relationship('web', 'name')
                ->required(),
            Forms\Components\TextInput::make('slug')
                ->unique(ignoreRecord: true)
                ->required(),
            Forms\Components\Textarea::make('description')
                ->nullable(),
            Forms\Components\TextInput::make('text')
                ->required(),
            Forms\Components\Select::make('h')
                
                ->options([
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                ])
                ->required(),
            Forms\Components\TextInput::make('class')
                ->nullable(),
        ]);
}

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slug')->searchable(),
                Tables\Columns\TextColumn::make('text')->searchable(),
                Tables\Columns\TextColumn::make('h')->label('Heading Level'),
                Tables\Columns\TextColumn::make('class'),
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
            'index' => Pages\ListHeadlines::route('/'),
            'create' => Pages\CreateHeadline::route('/create'),
            'edit' => Pages\EditHeadline::route('/{record}/edit'),
        ];
    }
}
