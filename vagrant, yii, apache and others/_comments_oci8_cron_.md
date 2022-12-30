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

# Подключение yajra/laravel-oci8

    composer require yajra/laravel-oci8:^8


Следующей командой вроде как: 
- создастся конфиг config\oracle.php
- будет использован в первую очередь конфиг config\oracle.php, а уже потом .env  
https://github.com/yajra/laravel-oci8

    php artisan vendor:publish --tag=oracle

<br><br>
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

# Пример создания команды cron

## Крон на базе Laravel

    php artisan make:command DemoCron --command=demo:cron

После доработки файла app\Console\Commands\DemoCron.php и app\Console\Kernel.php  
ручная проверка работоспособности

    php artisan schedule:run
    или
    php artisan demo:cron

`php artisan schedule:run` работает согласно расписанию, указанному в Kernel::schedule(), поэтому может не сработать, если запланированное задание ещё "не готово" к выполнению. Например, при параметре ->everyTwoMinutes() в Kernel `schedule:run` не выполняется по нечётным минутам.  
`php artisan demo:cron` безоговорочно запускает разовое сиюминутное выполнение.

Пример доработки app\Console\Commands\DemoCron.php

```
class DemoCron extends Command
{
    protected $signature = 'demo:cron';
    protected $description = 'My Demo Command description';

    public function handle()
    {
        Log::info("Cron is working fine!");
    }
}
```

Пример доработки app\Console\Kernel.php
```
class Kernel extends ConsoleKernel
{    
    protected $commands = [
        Commands\DemoCron::class,
    ];
    
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('demo:cron')->everyTwoMinutes();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
```
----
## Крон на базе Linux

Команду php artisan schedule:run можно также настроить на автозапуск в кроне (для текущего пользователя).  
Крон для всех пользователей по адресу /etc/crontab.  
crontab -e создаст временный файл для крона текущего пользователя в /tmp/cron.Xxxx/crontab .  


    crontab -e

Вставить строчку (или удалить её для отмены крон-задания).  
Если используется "всеобщий" /etc/crontab, то нужно дополнительно не забывать указывать пользователя (текущего или root) согласно пометкам в этом crontab-файле.

    * * * * *  cd /var/www/kassa && php artisan schedule:run >> /dev/null 2>&1
/dev/null 2>&1 - отменяет отправку логов на почту администратора  
    * * * * * - настройка расписания 


Проверить, какие крон-задания сейчас числятся для текущего пользователя

    crontab -l
----
##  Крон в Laravel

Крон-команда и ее описание появятся в списке

    php artisan list

Крон-команду можно запустить для вывода лога прямо в терминал после настройки метода DemoCron::handle()

    public function handle()
    {      
        $this->info("Cron is working fine!");
    }

    php artisan demo:cron

Локальная безостановочная проверка может быть вызвана без файлов crontab (т.е. не используя напрямую Linux) следующей командой, пока не будет остановлена с помощью Ctrl+C

    php artisan schedule:work

    
