<?php

namespace App\Filament\Resources\FeaturedContentResource\Pages;

use App\Filament\Resources\FeaturedContentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFeaturedContent extends CreateRecord
{
    protected static string $resource = FeaturedContentResource::class;
}
