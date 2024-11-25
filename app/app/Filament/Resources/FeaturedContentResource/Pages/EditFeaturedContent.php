<?php

namespace App\Filament\Resources\FeaturedContentResource\Pages;

use App\Filament\Resources\FeaturedContentResource;
use Filament\Resources\Pages\EditRecord;

class EditFeaturedContent extends EditRecord
{
    protected static string $resource = FeaturedContentResource::class;

    // Modifica los datos antes de llenar el formulario
    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($this->record->publicationPattern) {
            $data['publicationPattern'] = [
                'pattern' => $this->record->publicationPattern->pattern ?? '',
            ];
        }

        if ($this->record->publicationPeriod) {
            $data['publicationPeriod'] = [
                'start_date' => $this->record->publicationPeriod->start_date ?? null,
                'end_date' => $this->record->publicationPeriod->end_date ?? null,
            ];
        }

        return $data;
    }


    // Modifica los datos antes de guardarlos en la base de datos
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $record = $this->record;

        // Actualiza o crea el patrón de publicación
        if (isset($data['publicationPattern']['pattern'])) {
            $record->publicationPattern()->updateOrCreate(
                [],
                ['pattern' => $data['publicationPattern']['pattern']]
            );
        }

        // Actualiza o crea el período de publicación
        if (isset($data['publicationPeriod']['start_date']) || isset($data['publicationPeriod']['end_date'])) {
            $record->publicationPeriod()->updateOrCreate(
                [],
                [
                    'start_date' => $data['publicationPeriod']['start_date'],
                    'end_date' => $data['publicationPeriod']['end_date'],
                ]
            );
        }

        return $data;
    }

}
