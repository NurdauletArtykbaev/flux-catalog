<?php

use Nurdaulet\FluxCatalog\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function() {

    Route::get('catalogs/popular', [CatalogController::class, 'popular']);
    Route::get('catalogs/seo-options', [CatalogController::class, 'seoOptions']);
    Route::apiResource('catalogs', CatalogController::class)->only(['index']);

});
