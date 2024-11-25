<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeaturedContentResource\Pages;
use Works\Web\Models\FeaturedContent;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\TextArea;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Carbon;


class FeaturedContentResource extends Resource
{
    protected static ?string $model = FeaturedContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Blocks';

    protected static ?string $navigationLabel = 'Featured Content';
    protected static ?string $pluralLabel = 'Featured Contents';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                // Selección del contenido asociado
                BelongsToSelect::make('content_id')
                    ->relationship('content', 'name')
                    ->label('Content Name')
                    ->searchable()
                    ->required(),

                TextInput::make('publicationPattern.pattern')
                    ->label('Publication Pattern')
                    ->default(fn($record) => $record ? $record->publicationPattern->pattern : '') // Asegúrate de que este campo sea accesible
                    ->helperText('E.g., "every Monday and Thursday"'),

                DatePicker::make('publicationPeriod.start_date')
                    ->label('Start Date')
                    ->default(fn($record) => $record ? $record->publicationPeriod->start_date : null)
                    ->required(),

                DatePicker::make('publicationPeriod.end_date')
                    ->label('End Date')
                    ->default(fn($record) => $record ? $record->publicationPeriod->end_date : null)
                    ->nullable()
                    ->afterOrEqual('publicationPeriod.start_date')
                    ->helperText('Leave empty for no end date.'),
            ]);
    }


    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('content.name')
                    ->label('Content Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('publicationPattern.pattern')
                    ->label('Publication Pattern')
                    ->toggleable(),

                TextColumn::make('publicationPeriod.start_date')
                    ->label('Start Date')
                    ->date()
                    ->sortable(),

                TextColumn::make('publicationPeriod.end_date')
                    ->label('End Date')
                    ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)->format('Y-m-d') : 'No End Date')
                    ->sortable(),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeaturedContents::route('/'),
            'create' => Pages\CreateFeaturedContent::route('/create'),
            'edit' => Pages\EditFeaturedContent::route('/{record}/edit'),
        ];
    }
}
