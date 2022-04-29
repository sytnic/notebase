## Некоторые команды linux 
---
### Навигация по файлам

cd  
cd ~  
ls  

pwd  

---
### Apache

httpd -v  
ps aux | httpd

sudo apachectl start  
sudo apachectl stop  
sudo apachectl restart  

cd /etc/apache2  
где apache2.conf - главный файл конфигурации  

---
### Файлы

cat file.txt  
вывести содержимое файла  

sudo nano file.txt  
создать файл

### Права на файлы

ls -la  

sudo chmod 644 file.txt  
Установить разрешения 644 для файла

---
### PHP

php -v  

---

### PATH

which php  
echo $PATH

Файлы для PATH в ~:  
.bash_profile или  
.bashrc

Добавление пути в PATH:

nano .bash_profile  
export PATH = "/usr/local/mysql/bin:$PATH"  

затем закрыть и открыть терминал  
или прочитать .bash_profile:  
source .bash_profile

---

### MySQL

> Установка пароля В Linux:

    which mysqladmin  
    mysqladmin -u root password  

Изменить пароль:

    mysqladmin -u root -p password  


> Установка пароля В Windows:

Запустить в командной строке ...bin/mysql//mysql.exe  
 (т.е. где установлен mysql.exe в опенсервере, wamp'e, xamp'e) 

    mysqladmin -u root password 
    (в первый раз вход без пароля, установка пароля)

    mysqladmin -u root -p password 
    (вход с паролем, установка пароля)





