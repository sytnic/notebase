## Запуск с подготовленными файлами

> Vagrant

- Копируешь Vagrantfile и bootstrap.sh
- Меняешь в Vagrantfile project_slug и host:4510 в строчке config.vm.network
- Добавляешь сайт в hosts (без порта) согласно прописанному в bootstrap.sh (ServerName для Apache)
- vagrant up
- проверка в браузере (папка _check_for_public), сайт подгружается из папки public согласно document_root в Vagrantfile