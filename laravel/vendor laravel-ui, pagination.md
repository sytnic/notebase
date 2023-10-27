----
Создание моделей

    php artisan make:model Payments -m
    php artisan make:model PaymentsList -m

----
Вручную подготавливаются файлы миграции (для таблиц) в database/migration/ ,
 запускается команда создания таблиц:

    php artisan migrate

При доработке может понадобиться:  

    php artisan migrate:refresh

----
Создание HomeController  

    php artisan make:controller HomeController

Аутентификация, Создание базовых файлов (для Laravel v8)  

    composer require laravel/ui
    php artisan ui:auth


----
Создание PaymentsController  
    
    php artisan make:controller PaymentsController

Добавление use App\Http\Controllers\PaymentsController; в web.php

Проверка маршрутов 

    php artisan route:list
----
Добавлены бутстраповские  
/public/css/app.css  
/public/js/app.js

Нормально работает вход-выход.

----

    php artisan make:import PaymentsImport --model=Payments

Доработка вручную моделей и этого файла импорта

----

Перезагрузка БД

    php artisan migrate:refresh --seed

----
При использовании пагинации в Laravel 8
для правильного отображения верстки
нужно добавить строчки в AppServiseProvider
```
use Illuminate\Pagination\Paginator;

public function boot()
{
    ...
    Paginator::useBootstrap();
}
```
https://laravel.com/docs/8.x/pagination#using-bootstrap


----