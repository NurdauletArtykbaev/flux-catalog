<?php

namespace Nurdaulet\FluxCatalog;

use Nurdaulet\FluxCatalog\Helpers\TextConverterHelper;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Illuminate\Support\ServiceProvider;
use Nurdaulet\FluxCatalog\Models\Catalog;
use Nurdaulet\FluxCatalog\Observers\CatalogObserver;
use Nurdaulet\FluxCatalog\Filament\Resources\CatalogResource;
use Nurdaulet\FluxCatalog\Filament\Resources\CatalogSeoOptionResource;
use Nurdaulet\FluxCatalog\Filament\Resources\PopularCatalogResource;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;

class FluxCatalogServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Catalog::observe(new CatalogObserver());

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/flux-catalog.php' => config_path('flux-catalog.php'),
            ], 'flux-catalog-config');

            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
            $this->publishMigrations();
        }

        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }

    public function register()
    {
        $this->app->bind('textConverter', TextConverterHelper::class);
    }

    protected function publishMigrations()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations/check_catalogs_table.php.stub' => $this->getMigrationFileName(0,'check_flux_catalog_catalogs_table.php'),
            __DIR__ . '/../database/migrations/check_catalog_rent_types_table.php.stub' => $this->getMigrationFileName(2,'check_flux_catalog_catalog_rent_types_table.php'),
            __DIR__ . '/../database/migrations/check_catalog_seo_options_table.php.stub' => $this->getMigrationFileName(3,'check_flux_catalog_catalog_seo_options_table.php'),
            __DIR__ . '/../database/migrations/check_popular_catalogs_table.php.stub' => $this->getMigrationFileName(4,'check_flux_catalog_popular_catalogs_table.php'),
            __DIR__ . '/../database/migrations/check_link_catalogs_table.php.stub' => $this->getMigrationFileName(5,'check_flux_catalog_link_catalogs_table.php'),
        ], 'flux-catalog-migrations');
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     */
    protected function getMigrationFileName($index,string $migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make([$this->app->databasePath() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR])
            ->flatMap(fn($path) => $filesystem->glob($path . '*_' . $migrationFileName))
            ->push($this->app->databasePath() . "/migrations/{$timestamp}{$index}_{$migrationFileName}")
            ->first();
    }
}
