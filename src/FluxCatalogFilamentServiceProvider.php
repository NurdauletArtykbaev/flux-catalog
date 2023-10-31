<?php

namespace Nurdaulet\FluxCatalog;


use Filament\PluginServiceProvider;
use Nurdaulet\FluxCatalog\Filament\Resources\CatalogResource;
use Nurdaulet\FluxCatalog\Filament\Resources\CatalogSeoOptionResource;
use Nurdaulet\FluxCatalog\Filament\Resources\PopularCatalogResource;
use Spatie\LaravelPackageTools\Package;

class FluxCatalogFilamentServiceProvider extends PluginServiceProvider
{
    protected array $resources = [
        PopularCatalogResource::class,
        CatalogSeoOptionResource::class,
        CatalogResource::class,
    ];

    public function configurePackage(Package $package): void
    {
        $this->packageConfiguring($package);
        $package->name('catalog-package');
    }
}
