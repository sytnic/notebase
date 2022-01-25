## Git

    git init

Отключение папок в .gitignore

    /.vagrant
    /storage
    /bootstrap/cache

Коммит

    git add .

    git commit -m "..."

    git log --oneline

    git tag -a 0.1

После создания удаленного репозитория:

https://docs.github.com/en/authentication/keeping-your-account-and-data-secure/creating-a-personal-access-token

//  Использовалось ранее, без токенов
      git remote add origin https://github.com/myuser/myrepo.git

//  Отменить связку    
//    git remote remove origin

// C токенами, можно так:
    git remote add origin https://<access-token-name>:<access-token>@gitlab.com/myuser/myrepo.git

// Проще всего по-старому, вместо пароля вводится токен
    git remote add origin https://github.com/myuser/myrepo.git


    git push origin master

    git push origin 0.1

    git branch develop

    git checkout develop