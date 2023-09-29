# Клонирование Laravel

    git clone https://github.com/some_user/some_project .

    # точка будет означать, положить все файлы и папки в текущую папку,
    # без точки - положить здесь же всё в одну папку, названную как репозиторий в гит-онлайн 

В CMD:

    cd /d E:

    cd E:\Projects\Projects_nonum\laravellynda2

Проверка, в какой мы папке:

    dir

Запуск контейнеров:

    docker compose up -d


- но как ты заметил, нет папки vendor, и сайт пока не заработает, поэтому

Вход в контейнер:

    docker ps

    docker exec -it container_id bash

Проверка, в какой мы папке:

    ls

Проверка версии composer:

    composer -V

Установка Laravel:

    composer install  
    (иногда до этого нужен composer update)

- могут быть отключены папки в gitignore, без них laravel не запустится:
```
    /storage/framework          
    # эта папка может требоваться при установке клонов и новых проектов
    /bootstrap
    # эта папка может требоваться при установке клонов и новых проектов
```

Проверка в браузере, обычно:

    127.0.0.1:8080

    127.0.0.1:6080    
     # может быть адрес для админера

Проверка маршрутов:

    php artisan route:list

Однако все маршруты не заработают, если не установлена БД. Поэтому:

    php artisan migrate
    # будут установлены пустые таблицы

---
В принципе, всё.

---


Если необходимо, то можно стереть и создать пустые таблицы заново:

    php artisan migrate:refresh

Если нужно заполнить таблицы, то:

    php artisan db:seed

При ошибке "Класс не существует":

    composer dump-autoload
    // затем
    php artisan db:seed

Если при запуске Laravel возникают проблемы, можно попробовать заменить ключ APP_KEY в env:

    php artisan key:generate

--------

Обычно не требуется. Команда для добавления дегбара в новом проекте.

    ​composer require barryvdh/laravel-debugbar:~3.0 --dev

--------

Версия фреймворка:

    php artisan -V

Остановка контейнеров:

    docker-compose stop

Удалить контейнеры, находясь в этой же папке с проектом: 

    docker-compose down 