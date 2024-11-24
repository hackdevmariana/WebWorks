<?php

namespace App\Filament\Resources\FAQResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;

class QuestionAnswersRelationManager extends RelationManager
{
    protected static string $relationship = 'questionAnswers'; // Debería ser 'questionAnswers', no 'questions'
    protected static ?string $recordTitleAttribute = 'title';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\TextInput::make('slug')->required(),
            Forms\Components\Textarea::make('question')->required(),
            Forms\Components\RichEditor::make('answer')->required(),
            Forms\Components\TextInput::make('category'),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->label('Title'),
            Tables\Columns\TextColumn::make('category')->label('Category'),
        ])
        ->filters([])
        ->headerActions([
            Tables\Actions\CreateAction::make(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }
}
