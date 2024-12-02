<?php

namespace App\Filament\Resources\CssFontResource\Pages;

use App\Filament\Resources\CssFontResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCssFonts extends ListRecords
{
    protected static string $resource = CssFontResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
