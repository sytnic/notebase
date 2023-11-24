Все пользователи компьютера:

    net user  

Данные о конкретном пользователе

    net user username

Кто сидит в сессиях (Windows Server 2012) 

    query user
    quser

Кто текущий пользователь

    whoami

Поиск данных о процессе (PowerShell). Процесс можно найти в `Диспетчер задач - Подробности` и вставить его без `.exe`, на примере `MyProcess.exe`: 

    Get-NetTCPConnection -OwningProcess $((Get-Process MyProcess).id)
