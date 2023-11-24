# Clean Docker, PHP, Apache

## Создание файлов:

Создать папку проекта.

Создание файлов и папок в корне проекта
```    
2.    touch docker-compose.yml   # файл в корне
3.    mkdir .docker              # папка docker в корне
      cd .docker
4.    touch Dockerfile           # файл в папке docker
5.    touch vhost.conf           # файл в папке docker

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
        MYSQL_DATABASE: 'db_myproject'
        # MYSQL_ALLOW_EMPTY_PASSWORD: 1
        MYSQL_ROOT_PASSWORD: "123"
        # Log in: db, root, 123
    volumes:
        - ./dbfiles:/var/lib/mysql
    command: # для правильной кодировки
        - --character-set-server=utf8mb4
        - --collation-server=utf8mb4_unicode_ci
  app:
    build:
        context: .
        dockerfile: docker/Dockerfile
    image: 'myproject'
    ports:
        - 8080:80  # локально:внутренне
    volumes:
        - ./:/var/www/html

# Если будет использоваться админер отдельным контейнером, то

  adminer:           # имя контейнера
    image: adminer
    restart: on-failure
    ports:           # порты - локальный:внутри_контейнера
      - 6080:8080    # локально:внутренне
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

Согласно этому файлу нужно создать в корне проекта /public/index.php для проверки.  

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

## Запуск контейнеров

Открыть проект в CMD

    cd /d E:\
    или
    cd /d E:
    
    cd E:\Projects\Projects\laravellynda
    
Запуск

    docker-compose build     # для первого раза
    docker-compose up -d

> Если уже есть проект или хотя бы /public/index.php, то

В браузере

    127.0.0.1:8080

> Файл /public/index.php

    <?php
        phpinfo();
    ?>

Остановка

    docker-compose stop