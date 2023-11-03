Установите пакет с помощью Composer:

``` bash
 composer require nurdaulet/flux-catalog
```

## Конфигурация
После установки пакета, вам нужно опубликовать конфигурационный файлы. Вы можете сделать это с помощью следующей команды:
``` bash
php artisan vendor:publish --provider="Nurdaulet\FluxCatalog\FluxCatalogServiceProvider"
php artisan vendor:publish --tag flux-catalog-config
```

Вы можете самостоятельно добавить поставщика услуг административной панели Filament в файл config/app.php.
``` php
'providers' => [
    // ...
    Nurdaulet\FluxCatalog\FluxCatalogFilamentServiceProvider::class,
];
```

