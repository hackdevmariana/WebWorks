<?php

namespace App\Filament\Resources\CustomMenuResource\Pages;

use App\Filament\Resources\CustomMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomMenus extends ListRecords
{
    protected static string $resource = CustomMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
