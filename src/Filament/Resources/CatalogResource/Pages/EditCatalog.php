<?php

namespace Nurdaulet\FluxCatalog\Filament\Resources\CatalogResource\Pages;

use Nurdaulet\FluxCatalog\Filament\Resources\CatalogResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCatalog extends EditRecord
{
    protected static string $resource = CatalogResource::class;
    use EditRecord\Concerns\Translatable;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
