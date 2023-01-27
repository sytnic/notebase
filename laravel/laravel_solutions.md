# Laravel solutions

## Множественное число таблиц

app\Models\Replacetext.php

// Если в БД используется таблица не во множественном числе, то  
// вот так прописывается единственное число для таблицы, к-рая есть в БД  

    protected $table = 'replacetext';

---

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

### Занимаемые размеры    

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

    $table->float('zakup', 8, 2);  
    // точность плавающего числа
    // Вероятно, создастся тип "double" в MySQL

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
    

---




