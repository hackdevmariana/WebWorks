<?php

namespace App\Filament\Resources\CssVariableResource\Pages;

use App\Filament\Resources\CssVariableResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCssVariable extends EditRecord
{
    protected static string $resource = CssVariableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
