r = 4  
w = 2  
x = 1  
  = 0  

Найти процесс httpd Апача :  

    ps aux | grep httpd
    ps aux | grep -v grep | grep "apache"

поменять владельца:

    sudo chown root file.txt
	
поменять владельца всем файлам в папке:

    sudo chown dmitry *
	
поменять права - 600, 644, 666 ...  
файлу:

    sudo chmod 777 testfile.txt

текущей папке:

    sudo chmod 777 .
	

---------------------------------------
Создание папки
    
    mkdir foo

Переименование

    mv foo foo2
    mv file file_new

Посмотреть содержимое файла. Создать новый файл.

    nano file

---------------------------------------

посмотреть скрытые файлы

    ls -an
    ls -la

    ls -R
    (посмотреть все файлы во вложенных папках)  

удалить скрытый файл

    sudo rm .gitignore

удалить папку

    sudo rm -rf  project2
        или
    sudo rm -r  project2

удалить всё содержимое в текущей директории

    rm -rf *

Посмотреть содержимое папки, не заходя в неё

    ls /var/

Список файлов в директории:

    ls

Создание файла:

    touch MY-FILE-HERE

Создание файла в иной директории:

    touch /shared-folder/my-data

---------------------------------------

создание простой (символьной, не жёсткой) ссылки на файл в другой папке

    ln -s /home/dmitry/Документы/test/testfile.txt
    ln -s /etc/apache2/mods-available/rewrite.load 

---------------------------------------
