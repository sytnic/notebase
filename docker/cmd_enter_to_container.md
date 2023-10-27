# Вход в контейнер

## Кратко, только вход

Посмотреть работающие контейнеры

    docker ps

Вход по id контейнера через docker  
(не работает в GitBash, работает в cmd)

    docker exec -it container_id bash

    

---

## Подробно, с вариациями:

    cd /d E:\
    или
    cd /d E:
    
    cd E:\Projects_greycrud\template_docker
    dir

Или сразу

    cd /d E:\Projects\Projects_learning\laravel8

Посмотреть работающие контейнеры

    docker ps
    

Вход по id контейнера через docker

    docker exec -it container_id bash

    // установка nano, если необходимо
    apt-get install nano 

    // установка Git, если необходимо
    apt-get install git
    
Вход по имени контейнера через docker-compose

    docker-compose exec container_name bash

[Остановка контейнеров](./cmd_stop_container.md)



---



