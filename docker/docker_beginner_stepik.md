> Не использовать. Не подходит для Laravel. Не подходит для разработки.

## 1.2 Установка на Windows

Требования:
- 64-bit  
- Windows-7 or above  
- Должна быть включена виртуализация в BIOS.

https://docs.docker.com/desktop/install/windows-install/  
    or  
https://www.docker.com  

Команды после установки:

    // запуск контейнера
    docker run -it ubuntu bash

В контейнере посмотреть:

  информацию о внутренней системе:

    uname -a

  список запущенных процессов
  
    top
    [Ctrl+C]
  
  выход
  
    exit

Установлен ли docker compose

    docker-compose
      or
    docker compose

Другие проверки:

    docker compose version
    docker --version
    docker version

---

## 1.4 Основные команды.

Добавление в группу docker пользователя username.  
Равносильно присвоению прав sudo (root) пользователю username.  

    sudo usermode -aG docker username
    sudo service docker restart

Запуск контейнера из образа ubuntu,  
bash означает запуск /bin/bash,  
-it  означает -i интерактивный режим, -t в термнале.  

    docker run -it ubuntu bash

Выход из контейнера

    exit

Список всех (-a) контейнеров, включая остановленные

    docker ps -a

Список всех запущенных контейнеров

    docker ps

Запуск остановленного контейнера cool_maxwell без входа в него

    docker start cool_maxwell

Запуск остановленного контейнера cool_maxwell и вход в него

    docker start -i cool_maxwell

Остановка запущенного контейнера

    docker stop cool_maxwell

Команды help

    docker --help
    docker start --help
    docker run --help
    docker ps --help
    docker rm --help
    docker push --help
    docker login --help

Запуск контейнера с желаемым именем в терминале (но не в списке контейнеров)

    docker run -h myhostname -it ubuntu bash

Инспектирование контейнера infallible_rubin

    docker inspect infallible_rubin

Инспектирование контейнера infallible_rubin c фильтрацией по слову IPAddress  
(не работает в CMD, работает в BASH)

    docker inspect infallible_rubin | grep IPAddress

Запуск контейнера с желаемым именем в списке контейнеров

    docker run --name UbuntuName -it ubuntu bash 

Чтобы увидеть список файлов, изменённых в работе контейнера UbuntuName:

    docker diff UbuntuName

Логи (все набранные команды) контейнера UbuntuName

    docker logs UbuntuName

Уничтожение остановленного контейнера UbuntuName

    docker rm UbuntuName

Отображение списка всех (-a) ID (-q) с фильтром (-f) по статусу 

    docker ps -aq -f status=exited

Удаление всех остановленных контейнеров со статусом Exited (значение подставляется, как переменная, в команду удаления)

    docker rm -v $(docker ps -aq -f status=exited)

 Получение образа bitnami/apache из hub.docker.com

    docker pull bitnami/apache

Одновременное получение образа bitnami/apache (в фоне, -d) и запуск контейнера.

    docker run -d bitnami/apache

При использовании портов в контейнере, порты должны быть проброшены при запуске контейнера. Проброс портов в ново-запускаемом контейнере.  
8000 - локальный порт, 8080 - порт контейнера.  
Можно открывать в браузере по адресам  
127.0.0.1:8000  
localhost:8000

    docker run -d -p 8000:8080 bitnami/apache    

Список образов

    docker images

Удаление образов с локальной машины

    docker rmi number_ID_image

---

## 2.1 Создание образа

1.0. Создание контейнера используя образ ubuntu и установка приложения

> запуск контейнера с именем контейнера myapp и именем хоста (терминала) myap 
    
    docker run -it --name myapp --hostname myap ubuntu bash

> внутри контейнера:

 1.1 обновление индексов: 

    apt update

 1.2 ставим стороннее приложение cowsay: 

    apt install cowsay

 1.3 создание символьной ссылки в формате -path_to_cowsay_app-  -path_to_bin/app_link_name-. В итоге можно будет писать cowsay вместо /usr/games/cowsay .    

    ln -s /usr/games/cowsay /usr/bin/cowsay
 
 1.4 тест:  

    cowsay "Hello, I'm a cow!"

 1.5 выйти из контейнера:

    exit


2.0. Создание образа на основе нашего контейнера.  
 Создание образа работает и на остановленном, и на запущенном контейнере.  
 myapp - имя контейнера  
 /cowsay - желаемое имя для образа.

    docker commit myapp docker_username/cowsay

3.0. Запуск контейнера на основе нашего образа с указанием другого приложения (cowsay) вместо bash . Будет выполнена команда, входа во внутренний терминал не будет. Будет произведён автоматический выход из контейнера.   

    docker run full_image_name cowsay "hello" 

4.0. Размещение в docker hub. Будет создан автоматически репозиторий в профиле на hub.docker.com, создавать репозиторий вручную не требуется.

    docker login -u docker_username

    docker push docker_username/cowsay

Добавление желаемого тега (пометки) при пуше.

    docker push docker_username/cowsay:beta

Если удалить образ локально, он будет скачиваться с удалённого репозитория.  

    docker run username/cowsay cowsay "hello" 

---

## 2.2 Dockerfile

Dockerfile сохраняется без расширения как есть.
Он содержит инструкции, включая 
- образ, 
- разработчика, 
- запускаемые команды и 
- используемые умолчания (точка входа).

0) Создайте директорию для проектов
1) Создайте файл с названием "Dockerfile" внтутри этой директории
2) Создайте инструкцию для выполнения внутри Dockerfile:  

указание имени используемого образа  

    FROM ubuntu 

указание имени разработчика  

    MAINTAINER username your_email

указание команд которые будут выполнены внутри образа  

    RUN apt-get update && apt-get install -y cowsay && ln -s /usr/games/cowsay usr/bin/cowsay

определить запускаемый файл при запуске docker run  

    ENTRYPOINT ["cowsay"] 
 

3) Создать образ в том же каталоге (точка обязательна), где расположен Dockerfile

    docker build -t docker_username/mycow . 


4) Запустите контейнера на основе нашего образа

    docker run docker_username/mycow "hello" 

----

## 2.3 Соединение контейнеров

https://hub.docker.com/_/mariadb

официально:

    docker run --detach --name some-mariadb --env MARIADB_USER=example-user --env MARIADB_PASSWORD=my_cool_secret --env MARIADB_ROOT_PASSWORD=my-secret-pw  mariadb:latest

или попробовать:

    docker run --name mysqlserver -e MYSQL_ROOT_PASSWORD=123456 -d mariadb

Создаётся и запускается контейнер mysqlserver на базе образа mariadb .

https://hub.docker.com/_/adminer

Связь между контейнером mysqlserver и новым контейнером на базе образа adminer . db - короткое имя связки, это будет ссылка из adminer'ского контейнера на контейнер mysqlserver; ссылка будет прописана в etc/hosts как обычное указание на другой сервер. Первый порт (8080:) - локальный. Поэтому в браузере по локальному адресу 127.0.0.1:8080 должен заработать adminer с базой данных из другого контейнера (mysqlserver).

    docker run --link mysqlserver:db -p 8080:8080 adminer

Команда продолжит выполняться. Чтобы остановить, нужно будет в другом терминале задать команду stop. При этом первый терминал закроется.

    docker stop adminer_container

----

## 2.4 docker-compose.yml

    docker -v
    docker-compose v-

https://docs.docker.com/compose/compose-file/compose-file-v2/
https://docs.docker.com/compose/compose-file/compose-versioning/

https://hub.docker.com/_/mariadb

Версия compose-файла 3 работает и на docker-compose версии 2 .

    # Use root/example as user/password credentials
    version: '3.1'

    services: # будущие контейнеры

    db:       # имя контейнера 
        image: mariadb   # образ
        restart: always  # перезапуск - всегда .
                        # другие варианты:
                        # no - никогда
                        # on-failure - после падения
        environment:  # аналог -e в cmd, для определения переменных
        MARIADB_ROOT_PASSWORD: 123456

    adminer:  # имя контейнера
        image: adminer   # образ
        restart: always
        ports:  # порт локальный:внутри_контейнера
        - 6080:8080

В папке с файлом docker-compose.yml:

    doocker-compose up

Команда продолжит выполняться (не будет предоставлено возможности вводить новую команду). После строчки

     Version: '10.9.3-MariaDB-1:10.9.3+maria~ubu2204'  socket: '/run/mysqld/mysqld.sock'  port: 3306  mariadb.org binary distribution

можно открывать браузер по адресу:

    localhost:6080
    127.0.0.1:6080

Остановка работающих контейнеров:

    [Ctrl+C]

Запуск контейнеров в фоновом режиме. Команда закончит выполняться (будет предоставлена возможность вводить новую команду). Контейнеры будут запущены.

    docker-compose up --help
    docker-compose up -d

Посмотреть запущенные контейнеры:

    docker-compose ps

---

## 2.5 Dockerfile & docker-compose.yml

Используются подпапки с Dockerfile'ами и один (над ними) docker-compose.yml :

    version: '3.1'

    services: # будущие контейнеры

    db:       # имя контейнера
        build: ./db      # из какой папки использовать Dockerfile с образом
        restart: always  # перезапуск - всегда .
                        # другие варианты:
                        # no - никогда
                        # on-failure - после падения
        environment:  # аналог -e в cmd, для определения переменных
        MARIADB_ROOT_PASSWORD: 123456

    adminer:  # имя контейнера
        build: ./adminer
        restart: always
        ports:  # порт локальный:внутри_контейнера
        - 6080:8080

Сначала строится проект:

    docker-compose build

Запуск:

    docker-compose up

Этот подход позволяет вносить изменения перед запуском в каждый контейнер отдельно путём прописывания необходимых команд в соответствующих Dockerfile'ах. 

## Volumes (Тома) - расшаривания

> Способ 1 .    

Контейнер будет расшаривать каталог /data .  
Том /data в контейнере представляет собой ссылку на каталог с длинными именем /var/lib/docker/volumes/6cdd.../data .  

    docker run -v/data ubuntu

Где каталог расшаривается на хосте (хозяине):

    docker inspect -f{{.Mounts}} container_name

> Способ 2.

Указать в Dockerfile 

    VOLUME /data    

> Способ 3.

Указать в команде "docker run" /директорию_на_компе:/директорию_в_контейнере , напр.:

    /home/develop/data:/data

    docker run --name some-mariadb -v /my/own/datadir:/var/lib/mysql -e MARIADB_ROOT_PASSWORD=my-secret-pw -d mariadb:latest

> Способ 4. docker-compose.yml

    version: '3.1'

    services: # будущие контейнеры

    db:        # имя контейнера
        build: ./db      # из какой папки использовать Dockerfile с образом
        restart: always  # перезапуск - всегда
        environment:     # аналог -e в cmd, для определения переменных
        MARIADB_ROOT_PASSWORD: 123456
        volumes:   # расшаривание
        - ./databases:/var/lib/mysql

    adminer:   # имя контейнера
        build: ./adminer
        restart: always
        ports:  # порт локальный:внутри_контейнера
        - 6080:8080

Остановить работающие контейнеры:

    [Ctrl+C]

Удалить ранее созданный контейнер с базой данных (-f без подтверждения Y/n)

    docker-compose rm db -f

Пересобираем и запускаем

    docker-compose build
    docker-compose up

Остановка контейнеров (при работающей команде)

    [Ctrl+C]

---

## 2.7

Просмотр образов:

    docker images

Просмотр истории образа:

    docker history image_name

Удалить все контейнеры

    docker rm -v $(docker ps -aq -f status=exited)

Удалить все образы

    docker rmi $(docker images -q) --force

---

## Laravel + Docker

.env

    # PATHS

    DB_PATH_HOST=./databases

    # локальный путь к проекту
    APP_PATH_HOST=./laravel_folder

    # путь в контейнере к проекту 
    APP_PATH_CONTAINER=/var/www/html


docker-compose.yml

    version: '3'

    services:

        web:
            build: ./web
            environment: 
                - APACHE_RUN_USER=www-data
            volumes:
                - $(APP_PATH_HOST):$(APP_PATH_CONTAINER)
            ports:
                - 8080:80
            working_dir: $(APP_PATH_CONTAINER)

        db:
            image: mariadb
            restart: always
            environment:
            MARIADB_ROOT_PASSWORD: example
            volumes:
                - $(DB_PATH_HOST):/var/lib/mysql
        
        adminer:
            image: adminer
            restart: always
            ports:
                - 6080:8080

        composer:
            image: composer:1.6 
            volumes:
                - $(APP_PATH_HOST):$(APP_PATH_CONTAINER)
            working_dir: $(APP_PATH_CONTAINER)
            command: composer install
            # command: composer update

web/Dockerfile

    FROM php:7.2-apache

    RUN docker-php-ext-install \
        pdo_mysql \
        && a2enmode \
        rewrite

Команды:

    mkdir databases

    git clone https://github.com/sytnic/myproject.git
    
    docker-compose up --build

После этой команды я вижу остановленный контейнер compose, exit выход с кодом ноль.
Команда продолжает выполняться.

Зайти в контейнер web в новом терминале.

    docker-compose exec web bash

  В GitBash эта команда может выполняться "в темноте", не указан внутренний терминал, не указана внутренняя папка, но ты уже там.


    php artisan key:generate

После создания базы данных в админере через браузер 127.0.0.1:6080, в терминале:

    php artisan migrate

  Будет заполнена БД.

По адресу 127.0.0.1:8080/public/ запускается Laravel.

Выход из второго терминала.

    exit 

В первом терминале остановка контейнеров

    [Ctrl+C]

Новый запуск серверов:

    docker-compose up
