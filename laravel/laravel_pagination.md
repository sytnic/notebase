## Пагинация и Tailwind

Проблема при использовании tailwind, особенно cdn, что он перезатирает стили, которые уже применяются, и перестановка стилей не помогает, п.что стили tailwind подтягиваются динамически последними. Tailwind использует не css, а подтягивание стилей на страницу через строку со скриптом

    <script src="https://cdn.tailwindcss.com"></script>

Проблема решена ручным встраиванием стилей на страницу через папку стилей /public/css , причём w3css расположен последним.

Последовательность шагов:

> в терминале в проекте:

    php artisan vendor:publish --tag=laravel-pagination

> css вытащил из F12 и вставил сюда  

    public\css\tailwind_copy.css

> скобки с пагинацией во вью вставляются после цикла и до конца энд-секшн
```
    @endforelse

        {{ $thispairs->links() }}    
    <br>
@endsection
```

## Пагинация. Свои стили.

Можно не использовать tailwind и применять свои стили.

> в терминале в проекте набрать:

    php artisan vendor:publish --tag=laravel-pagination

Возникнет папка во вьюхах

    resources\views\vendor\pagination

В ней настроены разные файлы под стили пагинации. Файл default (вероятно) настроен на использование tailwind.  
Тем не менее, эти стили можно перезатирать своими классами.  
И можно указывать свой файл вместо этих. Для этого во вью с пагинацией прописать перед @endsection (пример): 

        @endforelse

        {{ $thispairs->links('vendor.pagination.default2') }}
    @endsection
    
, где resources\views\vendor\pagination\default2.blade.php - это свой файл.

В контроллере должна работать строчка через модель (Replacetext):

    $pairs = Replacetext::paginate(2);
    
---
