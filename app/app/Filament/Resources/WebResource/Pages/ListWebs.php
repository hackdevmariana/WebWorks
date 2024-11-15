<?php

namespace App\Filament\Resources\WebResource\Pages;

use App\Filament\Resources\WebResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebs extends ListRecords
{
    protected static string $resource = WebResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
