# 

Установить Докер вместе с PHP, Apache в новую папку.

[Docker,PHP,Apache](../docker/docker_php_apache.md)

Зайти в контейнер, команда для установки Laravel 5.8:

    composer create-project --prefer-dist laravel/laravel blog "5.8.*"

Указание точки (.) вместо папки (blog) вызовет ошибку, если папка не пустая.  
После чего нужно вырезать и вставить все файлы в верхнюю папку из подпапки.  

Так устанавливается готовый чистый laravel без git-репозитория.  
В случае клонирования существующего проекта через git clone нужно учитывать, что в нём будет скрытая папка git-репозитория с коммитами. А также потребуется задать команду composer install для установки vendor'ov, которые отключены по умолчанию.

Доработка .env файла в соответсвии с docker-compose.yml

    DB_HOST=db                # container service name (services:  db:)
    DB_PORT=3308              # ports: - "3308:3306"
    DB_DATABASE=laratest_db   # environment: MYSQL_DATABASE: 'laratest_db'
    DB_PASSWORD=123           # MYSQL_ROOT_PASSWORD: "123"

Отключение папок в .gitignore

    /dbfiles

> Установка дебаг-бара

> Вход в контейнер

    cd /d E:\
    cd E:\folder\folder\myproject
    dir

    docker ps
    docker exec -it container_id bash 
    (не работает в GitBash, работает в cmd)

> Debugbar

Будет прописан в /vendor, composer.json

    composer require barryvdh/laravel-debugbar --dev

При ошибке установки на Laravel 5.8 встала версия 3.0:

    composer require barryvdh/laravel-debugbar:~3.0 --dev


Debugbar включается/отключается в файле .env

    APP_DEBUG=true
        или
    APP_DEBUG=false

> Проверка версии Laravel

    php artisan -V

> ## При внесении изменений в docker-compose.yml

Остановка контейнеров

    docker-compose stop

Удалить ранее созданные контейнеры:  
 под именем container_name (это имя указано в секции services в docker-compose.yml) (-f означает без подтверждения Y/n).

    docker-compose rm container_name -f

Пересобираем и запускаем

    docker-compose build
    docker-compose up -d
