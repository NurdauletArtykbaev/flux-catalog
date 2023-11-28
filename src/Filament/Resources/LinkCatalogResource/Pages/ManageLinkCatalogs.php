<?php

namespace Nurdaulet\FluxCatalog\Filament\Resources\LinkCatalogResource\Pages;

use Nurdaulet\FluxCatalog\Filament\Resources\LinkCatalogResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLinkCatalogs extends ManageRecords
{
    protected static string $resource = LinkCatalogResource::class;

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
