# Vendor-Excel

Добавление недостающего пакета в vendor

```
composer require maatwebsite/excel

config\app.php
    'aliases' => [
        ...
        'Excel' => Maatwebsite\Excel\Facades\Excel::class,
    ]

config\app.php
    'providers' => [
        /*
        * Package Service Providers...
        */
        Maatwebsite\Excel\ExcelServiceProvider::class,
    ]

php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config
```



