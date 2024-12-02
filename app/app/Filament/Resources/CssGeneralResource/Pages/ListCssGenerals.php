<?php

namespace App\Filament\Resources\CssGeneralResource\Pages;

use App\Filament\Resources\CssGeneralResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCssGenerals extends ListRecords
{
    protected static string $resource = CssGeneralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
