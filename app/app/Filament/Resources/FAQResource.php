<?php
namespace App\Filament\Resources;

use App\Filament\Resources\FAQResource\Pages;

use Filament\Forms; // Asegúrate de que esto esté importado
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Works\Web\Models\FAQ;
use App\Filament\Resources\FAQResource\RelationManagers\QuestionAnswersRelationManager;

class FAQResource extends Resource
{
    protected static ?string $model = FAQ::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationGroup = 'Collections';

    protected static ?string $pluralLabel = 'FAQs';
    protected static ?string $label = 'FAQ';

    public static function form(Forms\Form $form): Forms\Form // Cambié aquí para usar Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('web_id')
                    ->relationship('web', 'name')
                    ->required(),
    
                Forms\Components\Repeater::make('questions')
                    ->relationship('questions')
                    ->itemLabel(function ($state) {
                        return $state['title'] ?? 'New ask';
                    })
                    ->schema([
                        Forms\Components\TextInput::make('title')->required(),
                        Forms\Components\TextInput::make('slug')->required(),
                        Forms\Components\Textarea::make('question')->required(),
                        Forms\Components\RichEditor::make('answer')->required(),
                        Forms\Components\TextInput::make('category'),
                    ])
                    ->orderable('id')
                    ->collapsed() 

                    ->collapsible()
                    ->createItemButtonLabel('Add Question'),
            ]);
    }
    

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('web.name')->label('Web')->sortable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime('d/m/Y'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFAQS::route('/'),
            'create' => Pages\CreateFAQ::route('/create'),
            'edit' => Pages\EditFAQ::route('/{record}/edit'),
        ];
    }

    public static function relationManagers(): array
    {
        return [
            QuestionAnswersRelationManager::class,
        ];
    }
}
