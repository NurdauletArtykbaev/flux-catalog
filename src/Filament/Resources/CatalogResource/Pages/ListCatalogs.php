<?php

namespace Nurdaulet\FluxCatalog\Filament\Resources\CatalogResource\Pages;

use Nurdaulet\FluxCatalog\Filament\Resources\CatalogResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Artisan;

class ListCatalogs extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = CatalogResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
            Actions\CreateAction::make(),
            Actions\Action::make('Очистить-кэш')
                ->action(function (): void {
                    Artisan::call('optimize:clear');

                })
                ->color('success')
                ->icon('heroicon-o-check'),
        ];
    }
}
