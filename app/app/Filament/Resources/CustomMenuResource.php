<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Works\Web\Models\CustomMenu;
use Works\Web\Models\Link;
use Filament\Resources\Table;
use Filament\Forms\Components\Repeater;
use App\Filament\Resources\CustomMenuResource\Pages;

class CustomMenuResource extends Resource
{
protected static ?string $model = CustomMenu::class;
protected static ?string $navigationIcon = 'uiw-menu';
protected static ?string $navigationGroup = 'Collections';

public static function form(Forms\Form $form): Forms\Form
{
return $form
->schema([
Forms\Components\TextInput::make('name')
->label('Menu Name')
->required(),
Forms\Components\TextInput::make('slug')
->label('Menu Slug')
->unique(ignoreRecord: true)
->required(),

Repeater::make('links')
->label('Links')
->relationship('links')
->itemLabel(function ($state) {
return $state['text'] ?? 'Nuevo Link';
})
->schema([
Forms\Components\TextInput::make('text')
->label('Text')
->required()
->columns(2),
Forms\Components\TextInput::make('slug')
->label('Slug')
->required()
->columns(2),
Forms\Components\TextInput::make('url')
->label('URL')
->required()
->columns(2),
Forms\Components\TextInput::make('icon')
->label('Icon')
->nullable()
->columns(2),
])
->createItemButtonLabel('Add Link')
->collapsible()
->columns(2),
]);
}

public static function table(Tables\Table $table): Tables\Table
{
return $table
->columns([
Tables\Columns\TextColumn::make('name')->label('Menu Name'),
Tables\Columns\TextColumn::make('slug')->label('Slug'),
Tables\Columns\TextColumn::make('links_count')->label('Links Count'),
])
->filters([])
->actions([])
->bulkActions([]);
}

public static function getPages(): array
{
return [
'index' => Pages\ListCustomMenus::route('/'),
'create' => Pages\CreateCustomMenu::route('/create'),
'edit' => Pages\EditCustomMenu::route('/{record}/edit'),
];
}
}
