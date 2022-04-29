## Установка Laravel

> Создать новую папку

> Под Vagrant потребуется 2 файла (можно из старого проекта):
- Vagrantfile и 
- bootstrap.sh 

> Подправить в Vagrantfile название будущего сайта и порт

На основе bootstrap.sh  
автоматически будет настроено для Apache в /etc/apache2/sites-enabled/default.conf 
- имя сайта (оно может иметь дополнительный префикс),
- корневая папка сайта.

> В Windows имя сайта также нужно прописать в hosts .

> Запуск: vagrant up

Если потребуется старая версия composer:  
https://stackoverflow.com/questions/64597051/how-to-downgrade-or-install-a-specific-version-of-composer

> Проверка сайта в браузере 

Подгружается из корневой папки. 
Но если использовалась переменная document_root="public", особенно в секции VHOST= для Апача, то подгружаться будет из папки public/.

> Проверка установок в терминале

Войти: vagrant ssh  
    composer -V  
    php -v

> Установка Laravel

    vagrant ssh

 Перейтив нужную папку. /var/www/...
 или
 /vagrant/

    composer create-project laravel/laravel

другие варианты:

    composer create-project --prefer-dist laravel/laravel
    composer create-project --prefer-dist laravel/laravel blog

--prefer-dist - это команда композера, она пытается загрузить и распаковать архивы зависимостей с помощью GitHub или другого API, когда это возможно. В большинстве случаев это используется для более быстрой загрузки зависимостей.

    composer create-project --prefer-dist laravel/laravel blog "5.8.*"

Этой командой из текущей папки устанавливается версия 5.8 в пустую подпапку (blog), она создастся автоматически. Указание подпапки blog в этой команде (в случае указания версии laravel) - обязательно.    

После чего нужно вырезать и вставить все файлы в верхнюю папку из подпапки.  
По идее всегда устанавливается в подпапку; если не указать подпапку, установится в подпапку "laravel".

> Проверка в браузере

Через папку public

> Проверка в терминале

    php artisan -V


> Установка дебаг-бара

Будет прописан в /vendor, composer.json

    composer require barryvdh/laravel-debugbar --dev 

При ошибке установки barryvdh/laravel-debugbar на Laravel 5.8 командой

        composer require barryvdh/laravel-debugbar --dev 

встала версия 3.0

        composer require barryvdh/laravel-debugbar:~3.0 --dev

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
---
## Создание нового соединения в Workbench

Новое соединение: MySQL Connections (+)

Заполнить:
- connection name: любое
- connection method: Standart TCP/IP over SSH
- SSH hostname: 127.0.0.1:2222 (Вагрант подключается через :2222)
- SSH username: vagrant (это особенность Вагранта, при подключении командой - vagrant ssh)
- SSH keyfile: отсутствует
- MySQL hostname: 127.0.0.1
- MySQL server port: 3306
- username: posty (создавался в Vagrantfile & bootstrap.sh в секции про MySQL как $PROJECT_SLUG)

Вход через SSH в MySQL: 
- vagrant vagrant (особенности Вагранта по SSH)
- posty posty (соответствует названию сайта; особенности настройки $PROJECT_SLUG в bootstrap.sh в строке # Create a database user)

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

Значения заданы на основе $PROJECT_SLUG в bootstrap.sh

---

## Git

Отключение папок в .gitignore

    /.vagrant
    /storage
    /bootstrap/cache

Новый локальный репозиторий

    git init

Коммит

    git add .

    git commit -m "..."

> Создать удаленный репозиторий  
> Добавить связку удаленного и локального репозиториев

    git remote add origin https://github.com/myuser/myrepo.git

    git push origin master

> Создать желаемые ветки

    git branch develop

    git checkout develop






