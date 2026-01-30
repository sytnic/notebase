## Добавление tailwindcss в laravel

### Установка nodejs и npm

https://www.hostinger.ru/rukovodstva/chto-takoe-npm
https://www.hostinger.ru/rukovodstva/kak-ustanovit-node-js-npm-ubuntu

npm - менеджеров пакетов, он устанавливается как часть nodejs.

````
sudo apt update
sudo apt install nodejs
sudo apt install npm 
nodejs -v
````

Удаление

    sudo apt remove nodejs 


### Переустановка nodejs и npm при необходимости

https://qastack.ru/ubuntu/426750/how-can-i-update-my-nodejs-to-the-latest-version

```
sudo npm cache clean -f
sudo npm install -g n
sudo n stable
```
> start a new shell, or execute PATH="$PATH"

### Установить tailwindcss в Laravel

В папке с проектом:

    npm init



--  npm install

-- npm install tailwindcss


    