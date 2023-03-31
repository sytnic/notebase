# Git Credential Manager

Устанавливается во время установки

![gcm](./img/git-gcm.png)

Команда

    git config --list

иногда

    git config --global --list

показывает в списке этот менеджер.

    credential.helper=manager
  
После его установки вместо привычного спрашивания пользователя и токена один раз появляется диалоговое окно

![sign-in](./img/sign-in.png)

 и сохраняет все данные в менеджер Windows по пути Control Panel → User Accounts → Credential Manager → Manage Windows Credentials (Панель управления\Учетные записи пользователей\Диспетчер учетных данных\Учетные данные Windows).

https://stackoverflow.com/questions/15381198/remove-credentials-from-git

[//]: ![gcm](./img/manage-paroles.png)

<img src="./img/manage-paroles.png" alt="drawing" width="800"/>


После этого все "git push" выполняются без спроса пользователя и пароля.

Предлагают разные способы для удаления запоминания токена.  
https://stackoverflow.com/questions/15381198/remove-credentials-from-git  

Но лучше при установке Git сразу выбирать None.

