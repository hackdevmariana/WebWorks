<?php

namespace App\Filament\Resources\ErrorPageResource\Pages;

use App\Filament\Resources\ErrorPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditErrorPage extends EditRecord
{
    protected static string $resource = ErrorPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
