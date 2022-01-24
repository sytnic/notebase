## Запуск с подготовленными файлами

Закидываешь в папку Vagrantfile и bootsrap.sh и запускаешь  

    vagrant up

Read more [here](./vagrant_prepared_files.md)

---
## Запуск без подготовленных файлов

Сначала создается файл vagrantfile

    vagrant init hashicorp/bionic64

Запустить. Статус.

    vagrant up
    vagrant global-status

Войти в Linux

    vagrant ssh

Выйти

    logout
    exit

Выключение вирт.машины 0181cbe

    vagrant halt 0181cbe

---
## Команды vagrant

поставить на паузу

    vagrant suspend 

перезагрузить конфиг (без выполнения provision).  
Reload so that these changes (in Vagrantfile) can take effect.

    vagrant reload 

перезагрузить конфиг (с выполнением provision).  
to reload your machine with provision

	vagrant reload --provision

Список box'ов, сохраненных в кеше
    
	vagrant box list

Уничтожить машину 03ec212 (не уничтожает box)

    vagrant destroy 03ec212

---
## Linux команды

add a new folder in your virtual machine's vagrant directory.

    vagrant@vagrant:~$ touch /vagrant/foo

---




