## Установка в Ubuntu

https://timeweb.cloud/tutorials/mysql/kak-ustanovit-mysql-na-ubuntu-1804?ysclid=m1ooph55jh634930497

https://losst.pro/ustanovka-mysql-ubuntu-16-04


    sudo apt update

    sudo apt install mysql-server

MySQL будет установлена, но при этом у вас не запросят задать пароль или сделать другие изменения в конфигурации.

https://selectel.ru/blog/ubuntu-mysql-install/?ysclid=m1op1a61da588064675

Проверить версию

    mysql --version

https://ubuntu.com/server/docs/install-and-configure-a-mysql-server

Проверить статус

    sudo service mysql status

If the server is not running correctly, you can type the following command to start it:

    sudo service mysql restart
    
Вход. Возможен через sudo без создания пользователя и пароля.

    sudo mysql

    show databases;

    -- Просмотр пользователей с правами

    SELECT user,authentication_string,plugin,host FROM mysql.user;
    
    exit

> Создание пользователя root через создание политики безопасности.

Следующая команда проведет вас через серию запросов, в которых вы можете внести изменения в параметры безопасности вашей MySQL. Сначала вас спросят, хотите ли вы настроить плагин проверки пароля (Validate Password Plugin), который можно использовать для проверки надежности паролей MySQL. Независимо от вашего выбора, далее вам нужно будет установить пароль для пользователя root MySQL.

    mysql_secure_installation

Команда для создания пользователя root без дополнительных политик не заработала. Видимо, требуется предыдущая команда. 

    sudo mysqladmin password -u root -p

Создание пароля без политик теперь делается через команду. Для этого нужно останавливать и перезапускать mysql.

https://stackoverflow.com/questions/50308555/how-to-set-root-pasword-in-mysql-8-in-ubuntu

    alter user 'root'@'localhost' identified by 'your_new_password';

После установки входа по паролю, вход по `sudo mysql` будет невозможен и потребуется Вход пользователем root

    mysql -u root -p

> Удаление mysql с настройками

Если же вы хотите полностью удалить MySQL, используйте команду purge:

    sudo apt purge mysql-server [mysql-client]

