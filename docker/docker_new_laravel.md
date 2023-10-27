# Docker, Laravel, Apache

## Подготовка Docker

https://webomnizz.com/containerize-your-laravel-application-with-docker-compose/  
https://www.youtube.com/watch?v=Ra1CetTcSeo

Другой пример: https://github.com/veevidify/laravel-apache-docker

Шаги:

    git clone https://github.com/laravel/laravel.git laravelapp

---
> Docker

Это описано в файле [docker_php_apache](./docker_php_apache.md)

Создание файлов и папок в корне laravel

    cp .env.example .env
    touch docker-compose.yml
    mkdir .docker
    cd .docker
    touch Dockerfile
    touch vhost.conf

    mkdir .dbfiles (используется в docker-compose.yml)

docker-compose.yml
```
version: '3.7'  
services:
  db:
    image: mysql:5.7
    restart: on-failure
    ports: 
        - "3306:3306"
    environment:
        MYSQL_DATABASE: 'vitrina_db'
        # MYSQL_ALLOW_EMPTY_PASSWORD: 1
        MYSQL_ROOT_PASSWORD: "123"
        # Log in: db, root, 123
    volumes:
        - ./dbfiles:/var/lib/mysql
  app:
    build:
        context: .
        dockerfile: docker/Dockerfile
    image: 'laravelapp'
    ports:
        - 8080:80
    volumes:
        - ./:/var/www/html
```

---


Доработка .env файла в соответсвии с docker-compose.yml

    DB_HOST=db (container service name)
    DB_DATABASE=laratest_db   

---
> Docker

Это описано в файле [docker_php_apache](./docker_php_apache.md)

Dockerfile
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

vhost.conf
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
---

## Запуск Docker & Laravel

Откорректировать env, если необходимо

> Docker

Запуск контейнеров

    docker-compose build
    docker-compose up -d

Вход в контейнер

    cd /d E:\
    cd develop_train\dockerphp\medlite
    dir
    docker ps
    docker exec -it container_id bash
    (не работает в GitBash, работает в cmd)

    # apt-get install nano

    chown -R www-data:www-data *

В терминале в папке с проектом

    ls -la
    composer install

Установка ключа для запуска Laravel

    php artisan key:generate

## Запуск Laravel в браузере

В браузере

    127.0.0.1:8080

## Выяснение ошибок (если необходимо)

Для выяснения ошибок
  
    docker-compose logs

Остановка и Удаление контейнеров

    docker-compose down 

Вход в контейнер и миграция

    docker ps
    docker exec -it container_id bash

## Запуск миграций

! Остановить и запустить контейнеры, затем:

    php artisan migrate

> Проверка в браузере

    127.0.0.1:8080/adminer.php

## Остановка контейнеров

    docker-compose stop



    








