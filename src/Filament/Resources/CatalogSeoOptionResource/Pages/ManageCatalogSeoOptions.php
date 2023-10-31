<?php

namespace Nurdaulet\FluxCatalog\Filament\Resources\CatalogSeoOptionResource\Pages;

use Nurdaulet\FluxCatalog\Filament\Resources\CatalogSeoOptionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCatalogSeoOptions extends ManageRecords
{
    protected static string $resource = CatalogSeoOptionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                return $data;
            }),
        ];
    }
}
