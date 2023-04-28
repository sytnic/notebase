# Особенности docker-compose.yml

Пример v.3
```
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

```

Если нужно будет поменять имя Dockerfile на другое, то подобный код

```
web:
    build: ./web
```
нужно будет поменять на подобный
```
web:
    build:
        context: .
        dockerfile: web/Dockerfile_newname
```

Пример v3.1
```
# based at https://hub.docker.com/_/adminer
#       or https://hub.docker.com/_/mariadb
# Use root/example as user/password credentials

version: '3.1'

services:            # будущие контейнеры

  db:                # имя контейнера
    build: ./db      # из какой папки использовать Dockerfile с образом
    restart: on-failure  # перезапуск always - всегда, no - никогда, on-failure - после падения
    environment:     # аналог docker run -e для определения переменных
      MARIADB_ROOT_PASSWORD: 123456
    volumes:         # расшаривание
      - ./databases:/var/lib/mysql

  adminer:           # имя контейнера
    build: ./adminer
    restart: on-failure
    ports:           # порт - локальный:внутри_контейнера
      - 6080:8080
    environment:
      ADMINER_DESIGN: rmsoft_blue

```

