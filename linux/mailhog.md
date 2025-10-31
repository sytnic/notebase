## Как установить Go in Linux

Go (Golang) можно установить в Linux из официального источника — сайта go.dev/dl. Для Linux доступен установочный пакет в виде архива .tar.gz. dzen.rualldevstack.comdzen.ru

Пошаговая инструкция

Если ранее в системе была установлена версия Go, её необходимо удалить, чтобы избежать конфликтов. Для этого нужно: dzen.ru

* Удалить пакет golang-go: 

  sudo apt remove golang-go

  .
* Удалить каталог, связанный с Go: сначала определить путь к исполняемому файлу Go: 

  which go

  , затем удалить каталог (заменить /usr/local/go на путь, полученный в предыдущей команде, если он отличается): 

  sudo rm -rf /usr/local/go

  .
* Обновить список пакетов: 

  sudo apt update

  .

 dzen.ru

Установить Go из официального источника: dzen.ru

* Перейти на сайт go.dev/dl и выбрать подходящую версию Go для 64-разрядной архитектуры Linux (например, go1.24.2.linux-amd64.tar.gz).
* Скачать архив: 

  wget https://go.dev/dl/go1.24.2.linux-amd64.tar.gz

  .
* Распаковать архив в каталог 

  /usr/local

  : 

  sudo tar -C /usr/local -xzf go1.24.2.linux-amd64.tar.gz

  .

 dzen.ru

Проверить установку: открыть терминал (или командную строку) и выполнить команду: 

go version

 — должна вывести версию установленного Go. dzen.rudzen.ru

Видео с инструкцией по установке языка программирования Go на операционную систему Linux:

2:03

Как установить компилятор Go в Linux (Ubuntu, Fedora)?

Rutube

Настройка окружения

Для корректной работы Go необходима настройка переменных окружения PATH и GOPATH: dzen.ru

* Открыть файл .profile: 

  sudo nano ~/.profile

  .
* Добавить следующие строки в конец файла: 

  export PATH=$PATH:/usr/local/go/bin

  , 

  export GOPATH=$HOME/go

  , 

  export PATH=$PATH:$GOPATH/bin

  .
* Сохранить, закрыть файл и обновить переменные окружения: 

  source ~/.profile

  .
* Создать рабочую директорию для проектов Go: 

  mkdir $HOME/go

## Как установить mailhog.exe in Linux

MailHog не устанавливается в виде файла с расширением .exe — это предварительно скомпилированная программа на языке Go, которая запускает локальный SMTP-сервер и предоставляет веб-интерфейс для просмотра сообщений. leosjoberg.comdeepwiki.comlibreselfhosted.com

Установка MailHog на Linux зависит от версии Go: deepwiki.com

* Для Go < v1.18 — 

  sudo apt-get -y install golang-go go get github.com/mailhog/MailHog

  .
* Для Go >= v1.17 (Debian Bookworm) — 

  sudo apt-get -y install golang-go go install github.com/mailhog/MailHog@latest

  .

 deepwiki.comlibreselfhosted.com

Пошаговая инструкция

После установки MailHog запускается запуском исполняемого файла. Например, в Ubuntu путь к файлам Go bin — 

~/go/bin/

, поэтому запуск — 

~/go/bin/MailHog

. deepwiki.comlibreselfhosted.com

Важно: по умолчанию MailHog запускает SMTP-сервер на порту 1025, а HTTP-сервер (веб-интерфейс и API) — на порту 8025. deepwiki.comlibreselfhosted.com

Возможные ошибки

* Порты 1025 или 8025 уже в использовании — можно указать альтернативные порты.

## 


https://dev.to/dendihandian/mailhog-in-laradock-1ej6


## Как настроить mailhog без Homestead - Laravel 6

MailHog можно настроить для работы с Laravel 6 без использования Homestead — для локальной разработки можно использовать MailHog как SMTP-сервер, который работает локально на машине. Настройка включает установку MailHog и настройку конфигурации приложения Laravel. practicaldev-herokuapp-com.global.ssl.fastly.netredberry.internationaleuperia.com

Установка

* Установить MailHog. Можно использовать бинарный файл MailHog или установить его через репозиторий на GitHub. Например, есть репозиторий 

  docker_laravel_mailhog

  , который позволяет создать минимальную среду Laravel (LEMP) с MailHog с помощью docker-compose. practicaldev-herokuapp-com.global.ssl.fastly.neteuperia.comgithub.com
* Запустить MailHog. Можно использовать команду 

  docker-compose up -d

   — это создаст контейнер MailHog, и SMTP- и веб-порты контейнера (1025 и 8025) будут сопоставлены с портами машины-хоста. practicaldev-herokuapp-com.global.ssl.fastly.netdev.toredberry.international

Конфигурация

* Обновить настройки в файле .env приложения Laravel. Нужно изменить параметры:
  * MAIL_MAILER — установить значение «SMTP», чтобы использовать Simple Mail Transfer Protocol (SMTP) для отправки писем.
  * MAIL_HOST — назначить значение «mailhog», которое является именем контейнера MailHog.
  * MAIL_PORT — использовать порт по умолчанию SMTP для MailHog — 1025.
  * MAIL_USERNAME, MAIL_PASSWORD, MAIL_ENCRYPTION — установить значения «null», так как MailHog не требует аутентификации или шифрования.

 redberry.internationaleuperia.com

После обновления настроек приложение Laravel будет отправлять письма через сервис MailHog. Чтобы посмотреть отправленные письма, нужно перейти по адресу 

http://localhost:8025

 в веб-браузере. 

## как добавить mailhog в файл docker-compose

MailHog можно добавить в файл docker-compose.yml для настройки инструмента тестирования электронной почты, который запускает поддельный SMTP-сервер. Это позволяет разработчикам тестировать функциональность электронной почты в своих приложениях, не беспокоясь о том, что письма будут отправлены реальным получателям. bobcares.comdev.toblog.programster.org

Пример

В файле docker-compose.yml нужно определить сервис MailHog:

services:  
mailhog:  
image: mailhog/mailhog  
ports: [1](https://bobcares.com/blog/docker-mailhog-sendmail/)[6](https://blog.programster.org/mailhog)  
- "1025:1025" # порт SMTP   
- "8025:8025" # порт веб-интерфейса MailHog  

По умолчанию MailHog запускает SMTP-сервер на порту 1025, а веб-сервер — на порту 8025. bobcares.comblog.programster.orgkool.dev

Инструкция

После создания файла docker-compose.yml нужно запустить контейнеры MailHog с помощью команды 

docker-compose up -d

. Эта команда загружает необходимые образы Docker и запускает контейнеры MailHog в отсоединённом режиме. bobcares.com

Важно:

* Не использовать MailHog в производственной среде — инструмент не предназначен для использования в реальном мире.
* Можно настроить параметры в файле .env (опционально) — например, изменить порт, на котором будет доступен MailHog, или версию инструмента.

## 
