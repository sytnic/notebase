## Вход-выход

    mysql --version
    mysql -u root -p
    mysql -u root --password=mypassword
    exit;

Вход и одновременно USE db_name

    mysql -u user -p db_name

## Пользователи

Задать привилегии

    GRANT ALL PRIVILEGES ON db_name.*
    TO 'username'@'localhost'
    IDENTIFIED BY 'password';

Проверить привилегии

    SHOW GRANTS FOR 'username'@'localhost';

## Работа с БД

    SHOW DATABASES;
    CREATE DATABASE db_name;
    USE db_name;
    DROP DATABASE db_name;

## Работа с таблицами БД

    SHOW TABLES;    

    CREATE TABLE subjects (
        id INT(11) NOT NULL AUTO_INCREMENT,
        menu_name VARCHAR(30) NOT NULL,
        position INT(3) NOT NULL,
        visible TINYINT(1) NOT NULL,
        PRIMARY KEY (id)
    );

    CREATE TABLE pages (
        id INT(11) NOT NULL AUTO_INCREMENT,
        subject_id INT(11) NOT NULL,
        menu_name VARCHAR(30) NOT NULL,
        position INT(3) NOT NULL,
        visible TINYINT(1) NOT NULL,
        content TEXT,
        PRIMARY KEY (id),
        INDEX (subject_id)
    );

    SHOW COLUMNS FROM table_name;
    DROP TABLE table_name;

### INSERT    

    INSERT INTO subjects (menu_name, position, visible) VALUES ('About Widget Corp', 1, 1);
    
    INSERT INTO pages (subject_id, menu_name, position, visible, content) 
     VALUES (1, 'Our mission', 1, 1, 'Our mission has always been...');

### SELECT

    SELECT * FROM subjects;

    SELECT * FROM subjects WHERE visible = 1;
    SELECT * FROM subjects WHERE id = 2;

    SELECT * FROM subjects WHERE visible = 1 ORDER BY position ASC; (по умолчанию, возрастание)
    SELECT * FROM subjects WHERE visible = 1 ORDER BY position DESC (убывание);

    SELECT menu_name, position FROM subjects WHERE visible = 1;

### UPDATE

    UPDATE subjects SET visible = 1 WHERE id = 4;
    UPDATE subjects SET visible = 1 WHERE id < 4;

### DELETE

    DELETE FROM subjects WHERE id = 4;

    






