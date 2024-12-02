<?php

namespace App\Filament\Resources\CssGeneralResource\Pages;

use App\Filament\Resources\CssGeneralResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCssGeneral extends EditRecord
{
    protected static string $resource = CssGeneralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
