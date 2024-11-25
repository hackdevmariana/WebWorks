<?php

namespace App\Filament\Resources\FeaturedContentResource\Pages;

use App\Filament\Resources\FeaturedContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeaturedContents extends ListRecords
{
    protected static string $resource = FeaturedContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
