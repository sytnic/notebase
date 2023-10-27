# Подключение yajra/laravel-oci8

Сначала должны быть установлены пакеты в операционную систему: pecl и от Оракла.

[pecl, oci8](../vagrant_workbench_yii_oci8/php-pecl_oci8.txt)

Pecl:

https://pecl.php.net/package/oci8

Oci8:

https://www.php.net/manual/ru/oci8.installation.php

Laravel-Oci8:

https://github.com/yajra/laravel-oci8

https://yajrabox.com/docs/laravel-oci8/9.0

## Установка Oci8 in Laravel

    composer require yajra/laravel-oci8:^8


Следующей командой вроде как: 
- создастся конфиг config\oracle.php
- будет использован в первую очередь конфиг config\oracle.php, а уже потом .env  
https://github.com/yajra/laravel-oci8

```
    php artisan vendor:publish --tag=oracle
```

В config/app.php:

    Yajra\Oci8\Oci8ServiceProvider::class,

В config\auth.php (не уверен в нужности, решает проблемы с чувствительностью к регистру при аутентификации):

    'providers' => [
        'users' => [
            'driver' => 'oracle',
            'model' => App\User::class,
        ],
    ]

Создание контроллера

    php artisan make:controller OracleController

Создание вью, вручную

    resources\views\oracle.blade.php

Создание маршрута в routes\web.php

    Route::get('/oracle', [App\Http\Controllers\OracleController::class, 'oracle'])->name('oraclename');

Заполнение значениями config\oracle.php и .env

----