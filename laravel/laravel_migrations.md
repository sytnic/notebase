## Создание файла миграции

    php artisan make:migration create_products_table --create=products
    // файл создаётся атоматически, 
    // но заполнять надо вручную;
    // таблица в БД этой командой не создаётся

### Примеры заполнения файла миграции  
<br>

Указание своей длины строки:

    $table->string('what_deleted', 255);

Указание возможности null в ячейке

    $table->mediumText('exit_text')->nullable();

Уникальность для столбца

    $table->string('uuid')->unique();

Проиндексировать

    $table->string('email')->index();

    // индекс
    $table->index('is_published');

Другие примеры:

    $table->timestamps();  
    // будущие столбцы created_at, updated_at

    $table->softDeletes(); 
    // будущий столбец deleted_at

    $table->integer('number')->unique('number'); 
    // уникальное число
    
    $table->foreign('room_type_id')->references('id')->on('room_types');  
    // внешний ключ, столбец -> таблица

    $table->boolean('is_weekend')->default(false)->comment('If this is the weekend rate or not.'); 
    // булево, по умолчанию false
    // с комментарием для стоблбца

    $table->unique(['room_type_id', 'is_weekend']); 
    // задано сочетание двух столбцов в этой таблице как уникальное

Задать Внешний связанный ключ

    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    // Благодаря указанию ('user_id') 
    // constrained() извлечет имя связываемой первичной таблицы (users)
    // и ее ключевое поле (id)

### Занимаемые размеры полями   

Текст

    $table->string('name'); 
    // VARCHAR, не более 255 символов,
    // но отработает Schema::defaultStringLength(191) 
    // в app\Providers\AppServiceProvider.php

    $table->text('opisanie')->nullable(); 
    // TEXT, не более 65 535 символов

Числа

    $table->bigInteger('category_id')->unsigned(); 
    // unsigned = больше нуля


    https://laravel.com/docs/8.x/migrations#column-method-float

    $table->float('zakup', 8, 2);  
    // точность плавающего числа
    // Вероятно, создастся тип "double" в MySQL.
    // float по умолчанию создаёт double(8,2) в MySQL,
    // т.е. числа больше 100000 не сохраняются, ограничиваются в SQL,
    // иными словами 8 относится ко всему числу, включая два знака после запятой,
    //  а не к числу только до запятой.

    $table->unsignedInteger('kolvo'); 
    // INT, unsigned, <= 4294967295

    $table->unsignedMediumInteger('kolvo'); 
    // MEDIUMINT, unsigned, <= 16777215

    $table->unsignedSmallInteger('vputi'); 
    // SMALLINT, unsigned, <= 65535

    $table->unsignedTinyInteger('votes');
    // UNSIGNED TINYINT, <= 255

Результаты. Это означает

    $table->id(); 
    // bigint(20) unsigned Автоматическое приращение
    

## Откат миграций

Есть способ использовать откат нескольких последних миграций

    // откатывает и накатывает миграцию
    php artisan migrate:refresh --step=2
    
    // откатывает миграцию, 
    // т.е. удаляет миграцию из последней цепочки (Batch 2) 
    // и удаляет таблицу 
    php artisan migrate:rollback --step=1

Это так же стирает содержимое созданных таблиц. Шаги --step=1 соответствуют цепочкам миграции (пачкам миграции) Batch в таблице ниже.  
--step=1 захватит миграции Batch 2  
--step=2 захватит миграции Batch 1

Статус с миграциями (таблица в БД с ними аналогична): 

    php artisan migrate:status

```
+------+-------------------------------------------------------+-------+  
| Ran? | Migration                                             | Batch |  
+------+-------------------------------------------------------+-------+  
| Yes  | 2014_10_12_000000_create_users_table                  | 1     |  
| Yes  | 2014_10_12_100000_create_password_resets_table        | 1     |  
| Yes  | 2019_08_19_000000_create_failed_jobs_table            | 1     |  
| Yes  | 2019_12_14_000001_create_personal_access_tokens_table | 1     |  
| Yes  | 2023_03_22_080825_create_bbs_table                    | 2     |  
+------+-------------------------------------------------------+-------+  
```







