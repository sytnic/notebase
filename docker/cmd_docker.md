## Commands

---
9

    docker info

    docker run hello-world

-----
10

Сохраненные Images:

    docker images

Загрузка образа Ubuntu из hub.docker.com:

    docker pull ubuntu

Запуск контейнера из изображения (образа) "ubuntu-latest",
(-ti - добавляет красивый вид в терминал)
(bash - добавляет интерактивный shell):

    docker run -ti ubuntu:latest bash
      or (without tag)
    docker run -ti ubuntu bash


    docker run -ti my-image bash

Список файлов в директории:

    ls

Создание файла:

    touch MY-FILE-HERE

Версия Ubuntu:

    cat /etc/lsb-release

Выход (Ctrl + D):

    exit

Запущенные Контейнеры:

    docker ps

То же самое в определенном формате отображения (возможно, только для MAC и Linux):

    docker ps --format $FORMAT 

Посмотреть шаблон формата отображения (возможно, только для MAC и Linux):

    echo $FORMAT

---
11

## Список Контейнеров:

все запущенные контейнеры:

    docker ps

все контейнеры, включая остановленные

    docker ps -a

последний остановленный контейнер:

    docker ps -l
    docker ps -l --format=$FORMAT
---
## Commit и создание образа двумя командами

Фиксация контейнера для создания нового образа:

    docker commit 105105_id_container

Создать нового образа с именем my-image:

    docker tag 305305_long_number_id my-image
---
## Commit и создание образа одной командой

Создание нового образа из контейнера по NAMES и наименование образа:

    docker commit NAMES_happy_poitras my-image-2
---
12
## Команды run

### Удаление контейнера

Долгий путь:

    docker run
    ... something do...
    docker exit
    docker rm image_name

Заблаговременный путь (удаление после команды exit):

    docker run --rm -ti image_name

Совершить удаление и автоматический выход (exit) через 5 секунд

    docker run --rm -ti image_name sleep 5 
---
Последовательное выполнение команд (sleep, echo)

    docker run -ti image_name bash -c "sleep 3; echo all done"



---
Создать возможность "отстраненного", открепленного контейнера:

    docker run -d -ti image_name bash

Запуск или вход в отсраненный контейнер в другом cmd/терминале

    docker attach container_stupid_name

Выход из открепленного контейнера:  
Ctrl+P + Ctrl+Q  
Но контейнер при этом запущен.

Можно вновь войти командой:

    docker attach container_stupid_name

## Запуск параллельного процесса контейнера в другом терминале: 

    docker exec -ti container_stupidname bash

Выход (exit) из прикрепленного контейнера приводит к выходу из всех таких параллельных контейнеров, открытых в терминалах.

---
13

--name example:     присвоение имени контейнеру.  
-d:     detach, отсоединеённый контейнер (12 chapter).  
-c "lose /etc/password":    запуск этой команды в контейнере.     

    docker run --name example-name -d ubuntu bash -c "lose /etc/password"

Просмотр логов контейнера (происходит выход с кодом 127):

    docker logs example-name

Жёсткая остановка контейнера (не удаляет контейнер, выход с кодом 137): 

    docker kill container_name

Удаление контейнера:

    docker rm container_name
---
Ограничение памяти при запуске контейнера:

    docker run --memory maximum-allowed-memory image-name command

Разграничение ресурсов процессора:

    docker run --cpu-shares (relative to other containers)

    docker run --cpu-quota (to limit it in general)
---
14

