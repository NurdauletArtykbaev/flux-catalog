<?php

use Nurdaulet\FluxCatalog\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function() {

    Route::get('catalogs/popular', [CatalogController::class, 'popular']);
    Route::get('catalogs/seo-options', [CatalogController::class, 'seoOptions']);
    Route::get('catalogs/links', [CatalogController::class, 'links']);
    Route::get('catalogs/main', [CatalogController::class, 'mainList']);
    Route::apiResource('catalogs', CatalogController::class)->only(['index']);

});
