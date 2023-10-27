# Лямбда-функция


1. Объявление лямбда.  

Функция не использует имени. Её значение будет присвоено переменной.

```
    $filterByAuthor = function ($books, $author)
    {
        ...
    };
```   

2. Использование.  

Переменная, которой присваивается функция, использует параметры, полученные от функции.

```
$filteredBooks = $filterByAuthor($books, 'Andy Weir');

```

пример кода  
<https://gist.github.com/sytnic/30e38f534713554239d10bbe0546f0f6>


результат выполнения  
<https://gist.github.com/sytnic/30e38f534713554239d10bbe0546f0f6>


Ссылки. Авторы.
- [Laracasts, youtube ](https://www.youtube.com/watch?v=cFpBK2EBrMY&list=PL3VM-unCzF8ipG50KDjnzhugceoSG3RTC&index=9 "Youtube Channel Laracasts")
