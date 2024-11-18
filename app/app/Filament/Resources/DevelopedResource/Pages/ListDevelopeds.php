<?php

namespace App\Filament\Resources\DevelopedResource\Pages;

use App\Filament\Resources\DevelopedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDevelopeds extends ListRecords
{
    protected static string $resource = DevelopedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
