r = 4  
w = 2  
x = 1  
  = 0  

ps aux | grep httpd

   maybe
ps aux | grep -v grep | grep "apache"


sudo chown root file.txt
	поменять владельца

sudo chown dmitry *
	поменять владельца всем файлам в папке 

sudo chmod 777 testfile.txt
	поменять права - 600, 644, 666 ...

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

	удалить скрытые файлы
sudo rm .gitignore

	удалить папку
sudo rm -rf  project2
        или
sudo rm -r  project2
        удалить всё содержимое в текущей директории
     rm -rf *

---------------------------------------

 создание простой (символьной, не жёсткой) ссылки на файл в другой папке
ln -s /home/dmitry/Документы/test/testfile.txt
ln -s /etc/apache2/mods-available/rewrite.load 

---------------------------------------