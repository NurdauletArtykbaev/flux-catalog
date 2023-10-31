<?php

namespace Nurdaulet\FluxCatalog\Filament\Resources\PopularCatalogResource\Pages;

use Nurdaulet\FluxCatalog\Filament\Resources\PopularCatalogResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePopularCatalogs extends ManageRecords
{
    protected static string $resource = PopularCatalogResource::class;

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
