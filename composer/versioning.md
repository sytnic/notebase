# Versioning

## Links

https://wp-kama.ru/note/kak-ukazyvat-versii-dlya-paketov-v-composer-json

https://getcomposer.org/doc/articles/versions.md

## Examples

----

(C) wp-kama.ru:

^ например "^1.2.3"

Оператор каретка. Похож на тильду, только позволяет повышаться всем числам кроме первой (мажорной версии).

Обычно используется для обозначения минимальной мажорной версии. Т.е. указывает основную допустимую версию, и разрешает все вложенные (минорные) версии.

    ^1.2.3 тоже что >=1.2.3 <2.0.0 (допускает все до 2.0, но не включая 2.0).

    Если мажорная версия начинается с 0, то разрешает все обновления до второго числа. Т.е. для версий до 1.0 он также учитывает безопасность обновлений и рассматривает ^0.3 как >=0.3.0 <0.4.0.

Это рекомендованный оператор для максимальной совместимости при написании кода библиотеки.

Пример:

"erusev/parsedown": "^4.0"

----

Тильда ~ обновляет до высшей патч версии. Домик ^ до высшей минорной версии. https://habr.com/ru/post/258891/

```
    "require": {
        "php": "~7.3.28",
        ...
        "laravel/framework": "6.0.*",
        ...
        "laravel/ui": "~1.0"
    },
    "require-dev": {
        "barryvdh/laravel-debugbar": "~3.0",
        ...
        "nunomaduro/collision": "~3.0",
        "phpunit/phpunit": "~8.0"
    },

```


