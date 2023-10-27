
## Остановка контейнеров

    docker-compose stop

## Новый запуск 

    docker-compose up -d

---

## При внесении изменений в docker-compose.yml

Остановка контейнеров

    docker-compose stop

Удалить ранее созданный контейнер под именем container_name (это имя указано в секции services в docker-compose.yml) (-f означает без подтверждения Y/n).

    docker-compose rm container_name -f

Пересобираем и запускаем

    docker-compose build
    docker-compose up -d