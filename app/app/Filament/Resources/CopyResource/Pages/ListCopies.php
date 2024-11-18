<?php

namespace App\Filament\Resources\CopyResource\Pages;

use App\Filament\Resources\CopyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCopies extends ListRecords
{
    protected static string $resource = CopyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
