# Вход в контейнер

    cd /d E:\
    cd E:\Projects_greycrud\template_docker
    dir

Посмотреть работающие контейнеры

    docker ps
    
Войти в контейнер # не работает в GitBash, работает в cmd

    docker exec -it container_id bash

    // установка nano, если необходимо
    # apt-get install nano 
    

## При внесении изменений в docker-compose.yml

Остановка контейнеров

    docker-compose stop

Удалить ранее созданный контейнер под именем container_name (это имя указано в секции services в docker-compose.yml) (-f означает без подтверждения Y/n).

    docker-compose rm container_name -f

Пересобираем и запускаем

    docker-compose build
    docker-compose up -d

---

