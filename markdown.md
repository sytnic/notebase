# Markdown

## Шпаргалки, ссылки

https://skillbox.ru/media/code/yazyk-razmetki-markdown-shpargalka-po-sintaksisu-s-primerami/

https://gist.github.com/Jekins/2bf2d0638163f1294637

http://konvut.github.io/k50articles/

https://dillinger.io/


## Изображения
```
![table](./img/table_git_reset.png)

<img src="drawing.jpg" alt="drawing" width="200"/>
```
## Комментарии
```
[//]: Закомментировано
[//]: <img src="../img/git/table_git_reset.png" alt="drawing" width="400"/>
```
## Ссылки

[Laravel Docs](https://laravel.com/docs/10.x "Необязательная подсказка")

<https://skillbox.ru/media/code/>

Ссылка на файл. Иcпользование пробелов в именах файлов:

[02-5. Операторы](./02-05%20Operators.md)  

### Якоря

Ссылки на якоря в файлах. Создаются на основе заголовков (#, ##).

В той же папке в другом файле:  
[laravel_migrations.md#откат-миграций](./laravel_migrations.md#откат-миграций)

В том же файле:  
[laravel_install.md#Laravel, Docker, Bootstrap](./laravel_install.md#laravel-docker-bootstrap)

[Перейти к Заголовку 1](#title1)
## <a id="title1">Заголовок 1</a>
Какой-то контент

[Some title 1](#some-title-1)
## Some Title 1
Some content

## Выпадающий список

<details>
  <summary>
    <i>Click to view features</i>
  </summary>
  <p>

  - Dark / Light Theme Mode
  - Localized UI language
  - Pinned Posts
  - Hierarchical Categories
  - Trending Tags
  - Table of Contents
  - Last Modified Date of Posts
  - Syntax Highlighting
  - Mathematical Expressions
  - Mermaid Diagram & Flowchart
  - Dark / Light Mode Images
  - Embed Videos
  - Disqus / Utterances / Giscus Comments
  - Search
  - Atom Feeds
  - Google Analytics
  - Page Views Reporting
  - SEO & Performance Optimization

  </p>
</details>
