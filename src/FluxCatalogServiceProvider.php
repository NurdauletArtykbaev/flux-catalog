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


            if (config('flux-catalog.models.use_filament_admin_panel')) {
                Filament::navigation(function (NavigationBuilder $builder): NavigationBuilder {
                    return $builder
                        ->groups([
                            NavigationGroup::make('Каталог')->items([
                                ...CatalogResource::getNavigationItems(),
                                ...PopularCatalogResource::getNavigationItems(),
                            ]),
                            NavigationGroup::make('Доплонительно')->items([
                                ...CatalogSeoOptionResource::getNavigationItems(),
                            ]),

                        ]);
                });
            }
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
            __DIR__ . '/../database/migrations/check_catalogs_table.php.stub' => $this->getMigrationFileName(0,'check_catalogs_table.php'),
            __DIR__ . '/../database/migrations/check_catalog_seo_options_table.php.stub' => $this->getMigrationFileName(1,'check_catalog_seo_options_table.php'),
            __DIR__ . '/../database/migrations/check_popular_categories_table.php.stub' => $this->getMigrationFileName(2,'check_popular_categories_table.php'),
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