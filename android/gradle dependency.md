## как подключить зависимость gradle в проект Android

> Алиса

**Зависимости в проекте Android подключаются с помощью системы Gradle**. Это позволяет включать внешние библиотеки или модули библиотек в сборку проекта. Зависимости могут быть расположены на машине или в удалённом репозитории.  
practicum.yandex. rudeveloper.android.com

**Через Android Studio**

В Android Studio есть графический интерфейс для подключения зависимостей:  
ru.stackoverflow.com

1. Открыть окно структуры проекта (File → Project Structure).
2. Перейти к основному модулю проекта (слева — секция Modules, кликнуть по названию модуля приложения).
3. В открывшемся окне перейти на вкладку Dependencies.
4. Нажать на значок с плюсом и выбрать нужный вариант зависимости.  
Например:
* Library dependency — добавление библиотеки из внешнего репозитория. По умолчанию в конфиге Gradle всего проекта в качестве внешнего репозитория используется JCenter, но можно прописать и другие репозитории.
* File dependency — добавление библиотеки из локального скомпилированного .jar-файла. Перед импортом локальной библиотеки в виде .jar-файла необходимо скопировать сам файл библиотеки в папку /libs проекта.

 ru.stackoverflow.com developer.alexanderklimov.ru

**Ручно**

В файле build.gradle проекта нужно указать зависимость с помощью ключевого слова 

`dependencies`

. Например, если проект использует библиотеку Google Play Services, можно добавить строку: 

`dependencies { implementation 'com.google.android.gms:play-services-location:17.0.0' }`

 practicum.yandex.ru

**Важно:**

* implementation

   указывает, что зависимость должна быть включена в окончательный Android Package Kit — архив, куда упаковывается всё необходимое для запуска приложения.

* com.google.android.gms:play-services-location:17.0.0

   — координаты зависимости, которые включают группу пакетов (com.google.android.gms), название пакета (play-services-location) и конкретную версию (17.0.0).

> Как устанавливал я

Взял значения из github репозитория. Например,

    dependencies {
        implementation 'com.jakewharton.timber:timber:5.0.1'
    }

Вставил эту строку `implementation` в файл `app/build.gradle.kts` в секцию `dependencies {...}`.  
При наведении курсора Android Studio просит переконвертировать в новый формат. Жму. Получаю.

    implementation(libs.timber)

Нужные зависимости при этом автоматически прописываются в файле `gradle/libs.versions.toml`

###   

