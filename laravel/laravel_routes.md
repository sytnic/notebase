# Посмотреть зарегистрированные маршруты внутри контейнера docker

Список запущенных контейнеров

    docker ps

Войти в контейнер

    docker exec -it container_id bash
    // не работает в GitBash, работает в cmd

Убедиться, что находимся в нужной папке

    ls -la

Список маршрутов

    php artisan route:list

Создать файл с маршрутами

    php artisan route:list > routes.txt