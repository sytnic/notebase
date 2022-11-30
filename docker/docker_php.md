# Docker, PHP, Apache

Шаги:

    Создать папку, положить в него проект. index.php находится в /public/

Создание файлов и папок в корне проекта

    
    touch docker-compose.yml
    mkdir .docker
    cd .docker
    touch Dockerfile
    touch vhost.conf

    mkdir .dbfiles (используется в docker-compose.yml)

> docker-compose.yml
```
version: '3.7'  
services:
  db:
    image: mysql:5.7
    restart: always
    ports: 
        - "3306:3306"
    environment:
        MYSQL_DATABASE: 'medlite_db'
        # MYSQL_ALLOW_EMPTY_PASSWORD: 1
        MYSQL_ROOT_PASSWORD: "123"
    volumes:
        - ./dbfiles:/var/lib/mysql
  app:
    build:
        context: .
        dockerfile: docker/Dockerfile
    image: 'medlite'
    ports:
        - 8080:80
    volumes:
        - ./:/var/www/html
```
 

> Dockerfile
```
FROM php:7.4.1-apache
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
## Запуск

Запуск контейнеров

    docker-compose build
    docker-compose up -d

В браузере

    127.0.0.1:8080

## Установка БД

In MySQL Workbench подключенение через Standart TCP/IP.  
Пользователь root.
Пароль из docker-compose MYSQL_ROOT_PASSWORD: "123".

БД устанавливается SQL-запросом. В нём остаётся только выбор базы "USE ..." и создание таблиц.
При создании таблиц важен порядок создания, т.к. иначе может выскочить ошибка из-за создания внешнего ключа к таблице, которая ещё не создана.  

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

adminer.css и adminer.php можно закинуть в public и выходить по адресу:  

    http://127.0.0.1:8080/adminer.php

Вход:

    Движок: MySQL
    Сервер: db
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






    








