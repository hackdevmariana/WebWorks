<?php

namespace App\Filament\Resources\CssVariableResource\Pages;

use App\Filament\Resources\CssVariableResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCssVariables extends ListRecords
{
    protected static string $resource = CssVariableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
