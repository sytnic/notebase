# Вход в контейнер

    cd /d E:\
    или
    cd /d E:
    
    cd E:\Projects_greycrud\template_docker
    dir

Или сразу

    cd /d E:\Projects\Projects_learning\laravel8

Посмотреть работающие контейнеры

    docker ps
    
Войти в контейнер # не работает в GitBash, работает в cmd

Вход по id контейнера через docker

    docker exec -it container_id bash

    // установка nano, если необходимо
    apt-get install nano 

    // установка Git, если необходимо
    apt-get install git
    
Вход по имени контейнера через docker-compose

    docker-compose exec container_name bash

## При внесении изменений в docker-compose.yml

Остановка контейнеров

    docker-compose stop

Удалить ранее созданный контейнер под именем container_name (это имя указано в секции services в docker-compose.yml) (-f означает без подтверждения Y/n).

    docker-compose rm container_name -f

Пересобираем и запускаем

    docker-compose build
    docker-compose up -d

---



