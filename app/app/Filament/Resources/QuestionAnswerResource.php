<?php

namespace App\Filament\Resources;


use Works\Web\Models\QuestionAnswer;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class QuestionAnswerResource extends Resource
{
    protected static ?string $model = QuestionAnswer::class;

    protected static ?string $navigationIcon = 'vaadin-question';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?string $pluralLabel = 'Questions and answers';
    protected static ?string $label = 'Question and answer';

    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form->schema([
            Forms\Components\BelongsToSelect::make('web_id')
                ->relationship('web', 'name')
                ->required(),
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('slug')
                ->unique(ignoreRecord: true)
                ->required()
                ->maxLength(255),
            Forms\Components\Textarea::make('question')
                ->required(),
            Forms\Components\Textarea::make('answer')
                ->required(),
            Forms\Components\TextInput::make('category')
                ->required()
                ->maxLength(255),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('category')->sortable(),
            Tables\Columns\TextColumn::make('web.name')->label('Web')->sortable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime('d/m/Y'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => QuestionAnswerResource\Pages\ListQuestionAnswers::route('/'),
            'create' => QuestionAnswerResource\Pages\CreateQuestionAnswer::route('/create'),
            'edit' => QuestionAnswerResource\Pages\EditQuestionAnswer::route('/{record}/edit'),
        ];
    }

}
