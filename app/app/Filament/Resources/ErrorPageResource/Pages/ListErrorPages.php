<?php

namespace App\Filament\Resources\ErrorPageResource\Pages;

use App\Filament\Resources\ErrorPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListErrorPages extends ListRecords
{
    protected static string $resource = ErrorPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
