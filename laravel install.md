## Установка Laravel

> Vagrant

Под Vagrant потребуется 2 файла:
- Vagrantfile и 
- bootstrap.sh 

На основе bootstrap.sh  
в /etc/apache2/sites-enabled/default.conf автоматически будет настроено
- имя сайта (оно может иметь дополнительный префикс),
- корневая папка сайта.

В Windows имя сайта также нужно прописать в hosts .

> Запуск: vagrant up

Если потребуется старая версия composer:  
https://stackoverflow.com/questions/64597051/how-to-downgrade-or-install-a-specific-version-of-composer

> Проверка сайта в браузере 

Подгружается из корневой папки.

> Проверка установок в терминале

    composer -V
    php -v

> Установка Laravel
    
    composer create-project laravel/laravel

другие варианты:

    composer create-project --prefer-dist laravel/laravel
    composer create-project --prefer-dist laravel/laravel blog
    composer create-project --prefer-dist laravel/laravel blog "5.8.*"
    
Этой командой из текущей папки устанавливается версия 5.8 в пустую подпапку (blog), она создастся автоматически.    

После чего нужно вырезать и вставить все файлы в верхнюю папку из подпапки.  
По идее всегда устанавливается в подпапку; если не указать подпапку, установится в подпапку "laravel".

> Проверка в браузере

Через папку public

> Проверка в терминале

    php artisan -V


> Установка дебаг-бара

Будет прописан в /vendor

    composer require barryvdh/laravel-debugbar --dev 

Debugbar включается/отключается в файле .env

    APP_DEBUG=true
        или
    APP_DEBUG=false

> Подстройка под MySQL
 
 Для MySQL/MariaDB нужно будет добавить следующие строки в  
 app\Providers\AppServiceProvider.php,  
    описание здесь:  
    Index Lengths & MySQL / MariaDB
    https://laravel.com/docs/5.7/migrations#indexes https://laravel.com/docs/8.x/migrations#indexes :

    
    ...
    use Illuminate\Support\Facades\Schema;
    ...    
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

> Создание нового соединения в Workbench

Новое соединение: MySQL Connections (+)

Заполнить:
- connection name: любое
- connection method: Standart TCP/IP over SSH
- SSH hostname: 127.0.0.1:2222 (Вагрант подключается через :2222)
- SSH username: vagrant (это особенность Вагранта, при подключении командой - vagrant ssh)
- SSH keyfile: отсутствует
- MySQL hostname: 127.0.0.1
- MySQL server port: 3306
- username: posty (создавался в bootstrap.sh как $PROJECT_SLUG)

Вход через SSH в MySQL: 
- vagrant vagrant (особенности Вагранта по SSH)
- posty posty (особенности настройки $PROJECT_SLUG в bootstrap.sh в строке # Create a database user)

> Создание базы данных

Она уже создана из bootstrap.sh. Использовалась строка типа
    
    CREATE SCHEMA `poligon` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    
Кодировка utf8mb4 описана здесь:

    Index Lengths & MySQL / MariaDB
        https://laravel.com/docs/5.7/migrations#indexes :
    Laravel uses the utf8mb4 character set by default

> Настройка .env файла

    DB_DATABASE=posty
    DB_USERNAME=posty
    DB_PASSWORD=posty

Значения заданы с помощью $PROJECT_SLUG в bootstrap.sh







