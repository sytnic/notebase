Набираем в командной строке

	C:\WebServers\usr\local\mysql-5.5\bin\mysql.exe -h 127.0.0.1 -u root -p

http://jeka.by/post/1003/rabotaem-s-mysql-cherez-komandnuyu-stroku/


Для запуска консоли, если пароль не требуется

	C:\WebServers\usr\local\mysql-5.5\bin\mysql.exe -h 127.0.0.1 -u root

Для запуска консоли и одновременного вызова определенной базы данных

	C:\WebServers\usr\local\mysql-5.5\bin\mysql.exe -h 127.0.0.1 -u root -p my_baza

Будут ограничены права на видимость баз, их чтение и редактирование, если не указать хост 127.0.0.1 и просто набрать:

	C:\WebServers\usr\local\mysql-5.5\bin\mysql.exe -u root -p

Для запуска и вызова определенного пользовател¤ с его собственной(ыми) базой данных

	C:\WebServers\usr\local\mysql-5.5\bin\mysql.exe -h 127.0.0.1 -u widget_cms -p

Для запуска и вызова определенного пользователя с его собственной(ыми) базой данных
	и с одновременным подключением к определенной базе данных

	C:\WebServers\usr\local\mysql-5.5\bin\mysql.exe -h 127.0.0.1 -u widget_cms -p widget_corp



Посмотреть список баз данных:

	show databases;

Выбрать базу данных baza_dannyh:

	use baza_dannyh;

Посмотреть названия всех таблиц в конкретной базе данных (после выполнения use):

	show tables;

вывести список колонок в таблице:

	show columns from this_table;

Вывести содержание всей таблицы на экран:

	SELECT * FROM this_table;

Вывести названия полей и их свойства:

	SHOW FIELDS FROM this_table;


	CREATE DATABASE DB_NAME; - создать новую бд;
	SHOW COLUMNS FROM TABLE_NAME; - просмотр колонок и их свойств;
	CREATE TABLE TABLE_NAME (`ID` INT(11),`NAME` VARCHAR(255)); - создание таблицы;

	ALTER TABLE TABLE_NAME ADD COLUMN_NAME INT(11); - добавить колонку в таблицу;
	ALTER TABLE TABLE_NAME DROP COLUMN_NAME; - удалить колонку из таблицы ;

Просмотреть структуру таблицы (имена и тип полей):

	describe post_estimations;
	SHOW FIELDS FROM this_table;

	MYSQL -UUSERNAME -PPASSWORD -HHOST DB_NAME < FILE_NAME.SQL - залить бд;
	MYSQLDUMP -UUSERNAME -PPASSWORD -HHOST DB_NAME > FILE_NAME.SQL - сделать дамп бд;
	QUIT; - выход из консольки MySQL.

	CHECK TABLE имя_таблицы - проверка таблицы на предмет ошибок в различных режимах.
	OPTIMIZE TABLE имя_таблицы - оптимизация таблиц.
	REPAIR TABLE имя_таблицы - восстановление таблицы.


