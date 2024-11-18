<?php

namespace App\Filament\Resources\DevelopedResource\Pages;

use App\Filament\Resources\DevelopedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeveloped extends EditRecord
{
    protected static string $resource = DevelopedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
