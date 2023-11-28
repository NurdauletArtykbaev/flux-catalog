<?php
return [
    'table_names'=> [
        'catalog' => 'catalogs',
        'popular_catalog' => 'popular_catalogs',
        'catalog_seo_options' => 'catalog_seo_options',
    ],
    'models' => [
        'catalog' => \Nurdaulet\FluxCatalog\Models\Catalog::class,
        'catalog_seo_option' => \Nurdaulet\FluxCatalog\Models\CatalogSeoOption::class,
        'link_catalog' => \Nurdaulet\FluxCatalog\Models\LinkCatalog::class,
        'popular_catalog' => \Nurdaulet\FluxCatalog\Models\PopularCatalog::class,
        'rent_type' => \Nurdaulet\FluxCatalog\Models\RentType::class,
        'item' => \Nurdaulet\FluxCatalog\Models\Item::class,
        'catalog_rent_type' => \Nurdaulet\FluxCatalog\Models\CatalogRentType::class,

    ],
    'languages' => [
        'ru', 'en', 'kk'
    ],
    'options' => [
        'use_filament_admin_panel' => true,
        'storage_disk' => 's3',
        'use_list_items_count' => false,
        'cache_expiration' => 269746
    ],
    'column_names' => [
        'role_pivot_key' => null, //default 'role_id',
        'permission_pivot_key' => null, //default 'permission_id',
    ]
];
