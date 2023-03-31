## Случайно удалил вручную БД через админер

Если БД удалена, то следует

- удалить расшареную с докером и контейнерами папку dbfiles, она указывается в docker-compose.yml как

```
    volumes:  
        - ./dbfiles:/var/lib/mysql
```

Удаление dbfiles требуется, т.к. иначе в ней сохраняются все предыдущие данные (в том числе всё, что уже отсутствует). Переустановка контейнеров и образа не поможет.

- запустить 

```
    docker-compose down 
```    
для удаления контейнеров 


- удалить image вручную

- запустить
```
    docker-compose build  
    docker-compose up -d
```

для запуска новых контейнеров.

## Задать кодировку для БД в docker-compose.yml

Можно так
```
    volumes:
        - ./dbfiles:/var/lib/mysql
    command:
        - --character-set-server=utf8
        - --collation-server=utf8_unicode_ci
```