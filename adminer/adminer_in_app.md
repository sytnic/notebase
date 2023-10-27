### Админер прямо в папке приложения

adminer.css и adminer.php можно закинуть в public и выходить по адресу:  

    http://127.0.0.1:8080/adminer.php

Вход:

    # если так настроено в docker-compose.yml, то
    Движок: MySQL
    Сервер: db
    Имя пользователя: root
    Пароль: 123

### Админер в отдельном контейнере

Либо создать отдельный контейнер под админер, прописав его данные в docker-compose.yml:
```
    adminer:         # имя контейнера
    image: adminer
    restart: on-failure
    ports:           # порт - локальный:внутри_контейнера
      - 6080:8080
    environment:
      ADMINER_DESIGN: rmsoft_blue # синее оформление

```

Адрес:

    http://127.0.0.1:6080

    # если так настроено в docker-compose.yml, то
    Имя пользователя: root
    Пароль: 123