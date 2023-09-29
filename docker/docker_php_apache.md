# Docker, PHP, Apache

По аналогии - добавляется docker в существующий проект.

## Создание файлов:

1.    Создать папку, положить в него проект. index.php находится в /public/

Создание файлов и папок в корне проекта
```    
2.    touch docker-compose.yml   # файл в корне
3.    mkdir .docker              # папка в корне
      cd .docker
4.    touch Dockerfile           # файл в папке
5.    touch vhost.conf           # файл в папке

6.    mkdir .dbfiles (используется в docker-compose.yml)
                                 # папка в корне
```

## Заполнение файлов

> docker-compose.yml
```
version: '3.7'  
services:
  db:
    image: mysql:5.7
    restart: on-failure
    ports: 
        - "3306:3306"
    environment:
        MYSQL_DATABASE: 'db_laravellynda'
        # MYSQL_ALLOW_EMPTY_PASSWORD: 1
        MYSQL_ROOT_PASSWORD: "123"
        # Log in: db, root, 123
    volumes:
        - ./dbfiles:/var/lib/mysql
  app:
    build:
        context: .
        dockerfile: docker/Dockerfile
    image: 'laravellynda'
    ports:
        - 8080:80
    volumes:
        - ./:/var/www/html

# Если будет использоваться админер отдельным контейнером, то

  adminer:           # имя контейнера
    image: adminer
    restart: on-failure
    ports:           # порт - локальный:внутри_контейнера
      - 6080:8080
    environment:
      ADMINER_DESIGN: rmsoft_blue # синее оформление
  
```
 

> Dockerfile
```
FROM php:7.4.32-apache
USER root
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-source delete

COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

```

> vhost.conf
```
<VirtualHost *:80>
    DocumentRoot /var/www/html/public

    <Directory "/var/www/html">
        AllowOverride all
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
## БД

Если это существующий laravel-проект и уже существует БД, то прописываем значения БД в env файле. Данные берутся из docker-compose.yml
```
DB_CONNECTION=mysql
DB_HOST=db      # имя контейнера
DB_PORT=3306    # порт контейнера
DB_DATABASE=db_laravellynda  # имя бд, указанное в контейнере
DB_USERNAME=root # согласно директиве  MYSQL_ROOT_PASSWORD
DB_PASSWORD=123  # согласно директиве  MYSQL_ROOT_PASSWORD

```

## Открыть проект в CMD

    cd /d E:\
    или
    cd /d E:
    
    cd E:\Projects\Projects\laravellynda
    
## Запуск

Запуск контейнеров

    docker-compose build
    docker-compose up -d

В браузере

    127.0.0.1:8080

## Иногда требуется менять ключ для запуска Laravel

APP_KEY в env файле.

Посмотреть работающие контейнеры

    docker ps

Вход по id контейнера через docker

    docker exec -it container_id bash

Установка ключа для запуска Laravel

    php artisan key:generate

## Проверить, все ли маршруты работают нормально

Посмотреть работающие контейнеры

    docker ps

Вход по id контейнера через docker

    docker exec -it container_id bash

Проверка маршрутов:

    php artisan route:list

Можно проверить БД по любому маршруту GET, но она пока пуста.

## Установка БД 

### Запуск миграций (Laravel)

> ! Остановить и запустить контейнеры, затем:

    // создание таблиц
    php artisan migrate

> ! Если Проект будет тестироваться по старым коммитам, то заполнять БД сразу не обязательно.

    // заполнение таблиц
    php artisan db:seed

---
В принципе, всё.

---

> Пояснение по migrate:

Создание БД

    // Запускаем миграции и сиды одной командой
    php artisan migrate --seed

При ошибке команды можно удалить созданные таблицы перед следующим запуском команды.

Возможен последовательный запуск двумя командами:

    // создание таблиц
    // Будут созданы пустые таблицы из файлов миграций.  
    php artisan migrate

    // заполнение таблиц
    php artisan db:seed

При ошибке "Класс не существует":

    composer dump-autoload
    // затем
    php artisan db:seed

Миграции - это описание столбцов таблиц  
Сидеры и Фабрики - чем заполнять таблицы  
database\seeds\DatabaseSeeder@run - в какой последовательности заполнять БД


### Подключение к интерфейсу СУБД Workbench (не Laravel)

In MySQL Workbench подключенение через Standart TCP/IP.  
Пользователь root.  
Пароль из docker-compose MYSQL_ROOT_PASSWORD: "123".  

БД устанавливается SQL-запросом. В нём остаётся только выбор базы "USE ..." и создание таблиц.
При создании таблиц важен порядок создания, т.к. иначе может выскочить ошибка из-за создания внешнего ключа к таблице, которая ещё не создана.  

### Прописывание данных в приложении (db_connection.php, не Laravel)

Подключение к БД нужно прописать в приложении в файле подключения (db_connection.php), где  
```
    define("DB_SERVER", "db");
    // имя контейнера из docker-compose
    // services:
    //       db:
    
	define("DB_USER", "root");
    // root, вероятно, используется по умолчанию для контейнера с mysql

	define("DB_PASS", "123");
    // пароль из docker-compose

	define("DB_NAME", "medlite_db");
    // имя БД взято из docker-compose

```
## Остановка контейнеров

    docker-compose stop

## Новый запуск 

    docker-compose up -d

--- 
## Можно применять админер

### Админер прямо в папке приложения

adminer.css и adminer.php можно закинуть в public и выходить по адресу:  

    http://127.0.0.1:8080/adminer.php

Вход:

    Движок: MySQL
    Сервер: db
    Имя пользователя: root
    Пароль: 123

### Админер в отдельном контейнере

Либо создать отдельный контейнер под админер, прописав его данные в docker-compose.yml:
```
    adminer:           # имя контейнера
    image: adminer
    restart: on-failure
    ports:           # порт - локальный:внутри_контейнера
      - 6080:8080
    environment:
      ADMINER_DESIGN: rmsoft_blue # синее оформление

```

Адрес:

    http://127.0.0.1:6080

    Имя пользователя: root
    Пароль: 123

---


## Если необходимо:

Вход в контейнер

    docker ps
    docker exec -it container_id bash 
    (не работает в GitBash, работает в cmd)

В терминале в папке с проектом

    ls -la



## Выяснение ошибок (если необходимо)

Для выяснения ошибок
  
    docker-compose logs

Остановка и Удаление контейнеров

    docker-compose down 



