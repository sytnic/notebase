# Пример создания команды cron

## Крон на базе Laravel

> Создание Крон-команды

    php artisan make:command DemoCron --command=demo:cron

> Запуск крона

После доработки файла app\Console\Commands\DemoCron.php и app\Console\Kernel.php  
ручная проверка работоспособности

    php artisan schedule:run
    или
    php artisan demo:cron

> Описание php artisan schedule:run

`php artisan schedule:run` работает согласно расписанию, указанному в Kernel::schedule(), поэтому может не сработать, если запланированное задание ещё "не готово" к выполнению. Например, при параметре ->everyTwoMinutes() в Kernel `schedule:run` не выполняется по нечётным минутам.

При этом `php artisan schedule:run` постоянно выполняется в назначенное время, то есть может выполняться несколько раз в назначенную минуту. Минуту можно высчитать с помощью `php artisan schedule:list` . Будет отображено ближайшее расписание, а не текущее. Текущее можно высчитать согласно регулярности выполнения задачи, указанному в Kernel.php.  

`php artisan demo:cron` безоговорочно запускает разовое выполнение.

Пример доработки app\Console\Commands\DemoCron.php


```
class DemoCron extends Command
{
    // название, описание

    protected $signature = 'demo:cron';
    protected $description = 'My Demo Command description';

    // сама работа крона

    public function handle()
    {
        // вывод в лог-файл storage\logs\laravel.log
        
        Log::info("Cron is working fine!");
    }
}
```

Пример доработки app\Console\Kernel.php
```
class Kernel extends ConsoleKernel
{    
    // добавление крона в массив команд

    protected $commands = [
        Commands\DemoCron::class,
    ];
    
    // регулярность команды

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('demo:cron')->everyTwoMinutes();
    }

    // общие настройки

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
```
----
## Крон на базе Linux

Команду `php artisan schedule:run` можно также настроить на автозапуск в кроне (для текущего пользователя Linux).  
Крон для всех пользователей - по адресу /etc/crontab.  
`crontab -e` создаст временный файл для крона текущего пользователя в /tmp/cron.Xxxx/crontab .  


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

После создания крон-комнады она и ее описание появятся в списке

    php artisan list

> Вывод в теримнал

Крон-команду можно запустить для вывода лога прямо в терминал после донастройки метода DemoCron::handle()

Донастройка:

    public function handle()
    {      
        // вывод информации в терминал
        
        //$this->line("Cron is working fine!");
          $this->info("Cron is working fine!");
    }

> Вывод в log в методе handle() в файл storage\logs\laravel.log

    public function handle()
    {      
        // вывод в лог-файл storage\logs\laravel.log
        
        Log::info("Cron is working fine!");
    }

> Запуск команды:

Единоразовый запуск выбранного крона:

    php artisan demo:cron

Локальная безостановочная проверка может быть вызвана без файлов crontab (т.е. не используя напрямую Linux) следующей командой, пока не будет остановлена с помощью Ctrl+C

    php artisan schedule:work

Проверочный запуск всех кронов единоразово. Отрабатывает, если кроны в данный момент должны отрабатывать.

    php artisan schedule:run