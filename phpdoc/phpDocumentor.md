## Документация

https://docs.phpdoc.org/

https://phpdoc.org/



## Установка

phpDocumentor.phar нужен, composer не подходит, не работает

PHP > 8.1.2

## Запуск

    php phpDocumentor.phar run -d . -t docs/api

-d - указываемая директория  
-t - целевая создаваемая директория

## Документирование файлов или всего приложения в отдельных файлах

https://docs.phpdoc.org/guide/getting-started/what-is-a-docblock.html#what-is-a-docblock

```php
<?php
/**
 * I belong to a file
 */

/**
 * I belong to a class
 */
class Def
{
}
```


```php
<?php
/**
 * A summary informing the user what the associated element does.
 *
 * A *description*, that can span multiple lines, to go _in-depth_ into
 * the details of this element and to provide some background information
 * or textual references.
 *
 * @param string $myArgument With a *description* of this argument,
 *                           these may also span multiple lines.
 *
 * @return void
 */
 function myFunction($myArgument)
 {
 }
```

Другие примеры.  
При этом поддерживается Markdown, за исключением первой строки, которая всегда пишется курсивом по умолчанию.

```php
<?php
/**
 * Этот файл описывает Behind The Code этого приложения.  
 * Adminer - ***Compact database management***.  
 
 * Описание. A *description*, that can span **multiple lines**, to go _in-depth_ into
 * the details of this element and to provide some background information
 * or textual references.
 *
 * @link https://www.adminer.org/
 * @author Jakub Vrana, https://www.vrana.cz/
 * @copyright 2007 Jakub Vrana
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 * @version 4.6.2
 */
```

Примерный Результат

```md
Этот файл описывает Behind The Code этого приложения.

Adminer - Compact database management.

Описание. A description, that can span multiple lines, to go in-depth into the details of this element and to provide some background information or textual references.

Tags 

link
    https://www.adminer.org/
author
    Jakub Vrana, https://www.vrana.cz/

copyright
    2007 Jakub Vrana

license
    https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0

license
    https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)

version
    4.6.2
```

Пример

```php
<?php
/**
 * Этот файл описывает приложение.
 *
 * Bootstrap v4.6.1 (https://getbootstrap.com/)
 
 * Copyright 2011-2021 The Bootstrap Authors
 
 * Copyright 2011-2021 Twitter, Inc.
 
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 *
 * Описание. A *description*, that can span multiple lines, to go _in-depth_ into
 * the details of this element and to provide some background information
 * or textual references.
 */
```

Примерный результат

```
Этот файл описывает приложение.

Bootstrap v4.6.1 (https://getbootstrap.com/)

Copyright 2011-2021 The Bootstrap Authors

Copyright 2011-2021 Twitter, Inc.

Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)

Описание. A description, that can span multiple lines, to go in-depth into the details of this element and to provide some background information or textual references.
```


## Указание или игнорирование отдельных папок и файлов

https://docs.phpdoc.org/guide/guides/running-phpdocumentor.html

Указание папок. Обязательно без пробела между папками.

    -d «src/phpDocumentor,src/SomethingElse» 

    php phpDocumentor.phar run -d "private,public,behind_the_code" -t docs

Игнорирование папок

    --ignore "vendor/"
    --ignore "vendor/" --ignore "about/"

    --ignore "tests/excludeme.php"

    php phpDocumentor.phar run -d . -t docs/api --ignore "vendor/" --ignore "public/"

Можно также указывать или игнорировать отдельные файлы.  

## Поддержка других цветов

На выходе могут быть другие цвета у некоторых заголовков

https://docs.phpdoc.org/guide/features/theming/changing-the-color.html#changing-the-color

## Альтернативы phpDocumentor

- Doxygen
- Daux.io
- Sandcastle
- ApiGen
- DoxyS 
- CppDoc 
- Natural Docs 

и другие.

https://topalter.com/

https://get.alternative.to/phpdocumentor-2


---
