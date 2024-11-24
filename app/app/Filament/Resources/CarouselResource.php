<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Works\Web\Models\Carousel;
use App\Filament\Resources\CarouselResource\Pages;


class CarouselResource extends Resource
{
    protected static ?string $model = Carousel::class;

    protected static ?string $navigationIcon = 'mdi-view-carousel-outline';
    protected static ?string $navigationGroup = 'Collections';


    public static function form(Forms\Form $form): Forms\Form

    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Carousel Name'),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\Textarea::make('description')
                    ->nullable(),

                Forms\Components\Repeater::make('contents')
                    ->relationship('contents')
                    ->itemLabel(function ($state) {
                        return $state['name'] ?? 'New image';
                    })
                    ->schema([
                        Forms\Components\TextInput::make('name')->required(),
                        Forms\Components\TextInput::make('slug')->required(),
                        Forms\Components\TextInput::make('title')->nullable(),
                        Forms\Components\TextInput::make('subtitle')->nullable(),
                        Forms\Components\Textarea::make('text')->nullable(),
                        Forms\Components\TextInput::make('url')->label('Image URL')->nullable(),
                        Forms\Components\TextInput::make('alt')->label('Alt Text')->nullable(),
                        Forms\Components\Select::make('content_type')
                            ->options([
                                'image' => 'Image',
                                'video' => 'Video',
                            ])
                            ->default('image'),
                    ])
                    ->createItemButtonLabel('Add Content')
                    ->collapsed() 
                    ->collapsible(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table

    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Name'),
                Tables\Columns\TextColumn::make('slug')->label('Slug'),
                Tables\Columns\TextColumn::make('description')->limit(50),
                Tables\Columns\TextColumn::make('contents_count')->counts('contents')->label('Contents'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarousels::route('/'),
            'create' => Pages\CreateCarousel::route('/create'),
            'edit' => Pages\EditCarousel::route('/{record}/edit'),
        ];
    }
}