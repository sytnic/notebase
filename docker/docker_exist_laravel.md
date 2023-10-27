# Adding Docker in existing Laravel

По аналогии - добавляется docker в существующий проект.

> Docker

Установка Docker,PHP,Apache

[Docker,PHP,Apache](../docker/docker_php_apache.md)

---
> Laravel
## БД

Если это существующий laravel-проект и уже существует БД, то прописываем значения БД в env файле. Данные берутся из docker-compose.yml
```
DB_CONNECTION=mysql
DB_HOST=db      # имя контейнера
DB_PORT=3306    # порт контейнера
DB_DATABASE=db_laravellynda  # имя бд, указанное в контейнере
DB_USERNAME=root # согласно директиве  MYSQL_ROOT_PASSWORD
DB_PASSWORD=123  # согласно директиве  MYSQL_ROOT_PASSWORD

```
---
> Docker

Запуск контейнеров

[Docker,PHP,Apache](../docker/docker_php_apache.md)

---
> Laravel
## Иногда требуется менять ключ для запуска Laravel

APP_KEY в env файле.

Посмотреть работающие контейнеры

    docker ps

Вход по id контейнера через docker

    docker exec -it container_id bash

Установка ключа для запуска Laravel

    php artisan key:generate

---

## Проверить, все ли маршруты работают нормально

> Docker

[Вход в контейнер](./cmd_enter_to_container.md)

> Laravel

Проверка маршрутов:

    php artisan route:list

Можно проверить БД по любому маршруту GET, но она пока пуста.

---
> Laravel
## Установка БД 

### Запуск миграций (Laravel)

> ! Остановить и запустить контейнеры, затем:

    // создание таблиц
    php artisan migrate

> ! Если Проект будет тестироваться по старым коммитам, то заполнять БД сразу не обязательно.

    // заполнение таблиц
    php artisan db:seed

---
В принципе, всё.

---

> Пояснение по migrate:

Создание БД

    // Запускаем миграции и сиды одной командой
    php artisan migrate --seed

При ошибке команды можно удалить созданные таблицы перед следующим запуском команды.

Возможен последовательный запуск двумя командами:

    // создание таблиц
    // Будут созданы пустые таблицы из файлов миграций.  
    php artisan migrate

    // заполнение таблиц
    php artisan db:seed

## Ошибка "Класс не существует"

При ошибке "Класс не существует":

    composer dump-autoload
    // затем
    php artisan db:seed

Миграции - это описание столбцов таблиц  
Сидеры и Фабрики - чем заполнять таблицы  
database\seeds\DatabaseSeeder@run - в какой последовательности заполнять БД


## Подключение к интерфейсу СУБД Workbench (не Laravel)  


In MySQL Workbench подключенение через Standart TCP/IP.  
Пользователь root.  
Пароль из docker-compose MYSQL_ROOT_PASSWORD: "123".  

БД устанавливается SQL-запросом. В нём остаётся только выбор базы "USE ..." и создание таблиц.
При создании таблиц важен порядок создания, т.к. иначе может выскочить ошибка из-за создания внешнего ключа к таблице, которая ещё не создана.  


### Прописывание данных в приложении (db_connection.php, не Laravel)


Подключение к БД нужно прописать в приложении в файле подключения (db_connection.php), где  
```
    define("DB_SERVER", "db");
    // имя контейнера из docker-compose
    // services:
    //       db:
    
	define("DB_USER", "root");
    // root, вероятно, используется по умолчанию для контейнера с mysql

	define("DB_PASS", "123");
    // пароль из docker-compose

	define("DB_NAME", "medlite_db");
    // имя БД взято из docker-compose

```
> Docker

[Остановка контейнеров, новый запуск](./cmd_stop_container.md)

--- 
> Adminer
## Можно применять админер

Как в папке как часть приложения, так и отдельным контейнером.

[Админер в приложениях](../adminer/adminer_in_app.md)


---

## Выяснение ошибок (если необходимо)

Для выяснения ошибок
  
    docker-compose logs

Остановка и Удаление контейнеров

    docker-compose down 



