<?php

namespace Nurdaulet\FluxCatalog\Filament\Resources\CatalogResource\Pages;

use Nurdaulet\FluxCatalog\Filament\Resources\CatalogResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCatalog extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = CatalogResource::class;
    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
