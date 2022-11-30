> Не использовать. Не подходит для Laravel. Не подходит для разработки.

## Commands

---
# 9

    docker info

    docker run hello-world

-----
# 10

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
# 11

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

    docker commit s105105_id_container

Создать новый образ с именем my-image:

    docker tag 305305_long_number_sha256 my-image
---
## Commit и создание образа одной командой

Создание нового образа из контейнера по NAMES и наименование образа:

    docker commit NAMES_happy_poitras my-image-2
---
# 12
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

Запуск или вход в отстраненный контейнер в другом cmd/терминале

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
# 13

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
# 14

Вероятно,  
--rm            - удаление контейнера после использования  
-ti             - красивое отображение в терминале  
-p 4020:4020    - внутренний и внешний порт  
--name echo     - наначенное имя терминала  

    docker run --rm -ti -p 45678:45678 -p 45679:45679 --name echo-server ubuntu:14.04 bash
    (terminal 1)

Вероятно,  
nc          - программа netcat  
-lp         - слушать порт, listen port  
Запускает возможность прослушки с порта 45678 одного компа (терминала с контейнером) на порт 45679 другого компа (терминала с контейнером). Для этого (на терминале 1) команда должна выполняться и не останавливаться (может остановиться самопроизвольно через некоторое время).

    nc -lp 45678 | nc -lp 45679
    (terminal 1)

Прослушивание порта (в разных терминалах), если установлен netcat в компьютере:

    nc localhost 45678
    (terminal 2)

    nc localhost 45679
    (terminal 3)

Запуск контейнера, если не установлен netcat в компьютере (т.к. внутри установлен netcat):

    docker run -ti --rm ubuntu:14.04 bash
    (terminal 2)
    (terminal 3)

Узнать ip моего компьютера (Ethernet Ethernet, IPv-4):

    ipconfig

Запуск прослушивания на разных терминалах:

    nc 192.168.32.241 45678
    (terminal 2)

    nc 192.168.32.241 45679
    (terminal 3)

---
## Прослушивание без указания внешних портов

Запуск прослушивания без указания внешних портов:

    docker run --rm -ti -p 45678 -p 45679 --name echo-server ubuntu:14.04 bash
    (terminal 1)

    docker port echo-server
    (terminal 2)

Команда для запуска по протококолу UDP вместо TCP:

    docker run -p 1234:1234/udp

---

# 15. Link containers

terminal 1:

    docker run --rm -ti -p 1234:1234 ubuntu:14.04 bash
    nc -lp 1234

terminal 2:

    docker run --rm -ti ubuntu:14.04 bash
    nc 10.35.3.24 1234
    hello

---

terminal 1:

    docker run -ti --rm --name server ubuntu:14.04 bash
    nc -lp 1234

terminal 2:

    docker run -ti --rm --link server --name client ubuntu:14.04 bash
    nc server 1234

    Ctrl+C

    cat /etc/hosts

---
# 16. Dynamic and legacy linking 

Создание сети Docker с именем example.

terminal 1:

    docker network create example

    docker run --rm -ti --net=example --name server ubuntu:14.04 bash

    nc -lp 1234

terminal 2:

    docker run --rm -ti --link server --net=example --name client ubuntu:14.04 bash

    nc server 1234

    hello

Далее, остановить сервер.  

terminal 1:

    Ctrl+C
    
    exit

И запустить его снова.

    docker run --rm -ti --net=example --name server ubuntu:14.04 bash  

    nc -lp 1234

Терминал 2 не выключаем, прослушивание перезапускаем.

terminal 2:

    nc server 1234

---

# 17.Images

Список загруженных образов:

    docker images

Последний контейнер

    docker ps -l

Создание образа по Container ID

    docker commit dc8b8105105 my-image-14

Создание еще одного образа с тэгом версии 2.1

    docker commit dc8b8105105 my-image-14:v2.1

Получение образа

    docker pull ...

Выложить образ

    docker push ...

Удаление образа по image_id и по имени

    docker rmi d0328bf2c007
    docker rmi my-image-14

---

# 18.Volumes

Для расшаривания папок с компьютера.

Создать папку.

    cd Documents
    mkdir example

Команда.

    docker run -ti -v C:\Users\sytnik_dv\Documents\example:/shared-folder ubuntu bash

Посмотреть содержимое папки, не заходя в неё

    ls /shared-folder/

Создание файла в иной директории:

    touch /shared-folder/my-data

---

## Пример Создания Volume

terminal 2:

    docker run -ti -v /shared-data ubuntu bash
    echo hello > /shared-data/data-file

terminal 1:

последний работающий контейнер (из второго терминала):

    docker ps -l

Так запустится новый контейнер, но с данными, расшаренными от первого контейнера (из второго терминала):

    docker run -ti --volumes-from condescending_nightingale ubuntu bash
    ls /shared-data/

Создание ещё файла в расшаренной папке:

    echo more > /shared-data/more-data
    ls /shared-data/

terminal 2:

Завершить работу текущего контейнера:

    exit

все запущенные контейнеры (отобразится едиснственный, из первого терминала):

    docker ps

Так будет запущен новый контейнер, который подхватит расшариваемаые данные из контейнера из первого терминала:

    docker run -ti --volumes-from musing_saha ubuntu bash

Таким образом, расшариваемые данные могут размножаться на новые контейнеры, несмотря на закрытие старых.

terminal 2:

    exit

terminal 1:

    exit

---

# 19.Docker registries

Посик Ubuntu в онлайн-реестре

    docker search ubuntu

Вход/выход из реестра

    docker login
    docker logout

Скачать образ

    docker pull debian:sid

Создание своего образа, на основе скачанного:

    docker tag debian:sid user_login/my-test-image-42:v99.9

Выкладка своего образа в реестр:

    docker push user_login/my-test-image-42:v99.9

---

# 20 Dockerfiles

    docker build -t name-of-result .

Точка - это указание на текущую директорию, где будут докерфайлы.

---
# 21.Building Dockerfiles

Создание папки и Dockerfile. Можно выполнять в Git Bash.

    mkdir example
    cd example
    ls
    nano Dockerfile

Ввод данных:

    FROM busybox
    RUN echo "building simple docker image."
    CMD echo "Hello container"

Выход из nano с сохранением файла

    Ctrl + X
    "Y"
    Enter

Построение Docker-файла с именем hello в текущей папке

    docker build -t hello .

Запуск контейнера из образа hello с самоудалением

    docker run --rm hello
    
---
Более сложный пример:

    FROM debian:sid
    RUN apt-get -y update 
    RUN apt-get install nano
    CMD ["/bin/nano", "/tmp/notes"]

Ввести данные, перезаписав Dockerfile.
Построить новый образ.

    docker build -t example/nanoer .

Запуск, проверка. В CMD работает. В GitBash нет.

    docker run --rm -ti example/nanoer

Запустится в nano файл tmp/notes.  
Любой текст в нём.  
Изменения в файле Dockerfile:

    FROM example/nanoer
    ADD notes.txt /notes.txt
    CMD ["nano", "/notes.txt"]

В этой же папке с Dockerfile создаём новый файл:  

    nano notes.txt

С любым текстом.
Далее

    docker build -t example/notes .
    docker run -ti --rm example/notes

---
# 22.Dockerfile syntax

Example:

    FROM java:8  

    MAINTAINER Firstname Lastname < email@example.com>

    RUN unzip install.zip /opt/install/
        or
    RUN echo hello docker

    ADD run.sh  /run.sh
        or
    ADD project.tar.gz  /install/
        or
    ADD https://project.example.com/download/1.0/project.rpm  /project/
 
    ENV DB_HOST=db.production.example.com
    ENV DB_PORT=4532

Для запуска команд: 

    ENTRYPOINT
    ENTRYPOINT RUN
    CMD

Указание порта в контейнере:

    EXPOSE 8080

Volume

    VOLUME ["/host/path/" "/container/path/"]
    VOLUME ["/shared-data"]

WORKDIR, подобно CD, задаёт директорию, в которой должен стартовать контейнер

    WORKDIR /install/

USER задает, от имени какого пользователя будет выполняться контейнер

    USER arthur
        or
    USER 1000

---
# 23.Multi-project Docker files

Dockerfile:

    FROM ubuntu:16.04
    RUN apt-get update
    RUN apt-get -y install curl
    RUN curl https://google.com | wc -c > google-size
    ENTRYPOINT echo google is this big; cat google-size

Будет измерено количество символов на домашней странице google.  
wc - word count, -c - count of characters.

Построение имэджа tooo-big. Запуск команды в CMD в папке с Dockerfile:

    docker build -t tooo-big .

Запуск образа. Будет запущен контейнер и остановлен. Будет выведено число подсчитанных символов в терминал.

    docker run tooo-big

Попытка уменьшить образ, изменённый Dockerfile:

    FROM ubuntu:16.04 as builder
    RUN apt-get update
    RUN apt-get -y install curl
    RUN curl https://google.com | wc -c > google-size

    FROM alpine 
    COPY --from=builder /google-size  /google-size
    ENTRYPOINT echo google is this big; cat google-size

Создание нового образа

    docker build -t google-size .

Запуск образа.

    docker run google-size

Результат вывода в CMD тот же. Но размер образа меньше:

    docker images

---
# 24.Avoid golden images
---
# 25
---
# 26.Networking and namespaces

    docker run -ti --rm --net=host ubuntu:16.04 bash

В контейнере:

    apt-get update && apt-get install bridge-utils

    brctl show

В новом терминале:

    docker network create my-new-network

---

    docker run -ti --rm --net=host --priveleged=true ubuntu bash

В контейнере:

    apt-get update
    apt-get install iptables
    iptables -n -L -t nat

В другом терминале:

    docker run -ti --rm -p 8080:8080 ubuntu bash

---
# 27 Processes

    docker run -ti --rm --name hello ubuntu bash

В другом терминале:

    docker inspect --format '{{State.Pid}}' hello

Копируется полученный id, например 7658

    docker run -ti --rm --priveleged=true --pid=host ubuntu bash
    kill 7658
    // уничтожит первый запущенный контейнер 
 
---
# 28
















