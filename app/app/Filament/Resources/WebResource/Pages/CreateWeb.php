<?php
namespace App\Filament\Resources\WebResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\WebResource;
use Filament\Actions;


class CreateWeb extends CreateRecord
{
    protected static string $resource = WebResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}