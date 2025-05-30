## Забыл добавить gitignore, как убрать файлы из проекта

https://eric.blog/2014/05/11/remove-files-from-git-addingupdating-gitignore/

https://stackoverflow.com/questions/13541615/how-to-remove-files-that-are-listed-in-the-gitignore-but-still-on-the-repositor

История (локальная) при этом не удаляется. Версия - git version 2.40.1.windows.1.  
Но здесь создаётся ещё один коммит для фиксации изменений.   

Здесь убираются из отслеживания все файлы.

```
git rm -r --cached .
git add .
git commit -m "Drop files from .gitignore"
```

Как вариант, можно убрать из отслеживания отдельно файлы или папки:

    git rm -r --cached file1 file2 dir/file3

или только папку

    git rm -r --cached dirWindowsApp5
    
Далее - новый коммит

    git add .
    git commit -m "Removing ignored files in WindowsApp5"

## Git Reset & Git Revert. Откат коммитов.

https://ru.hexlet.io/courses/intro_to_git/lessons/commits-cancelation/theory_unit

https://www.atlassian.com/ru/git/tutorials/undoing-changes/git-revert

https://www.atlassian.com/ru/git/tutorials/undoing-changes/git-reset

Этим командам указывается необходимй коммит из прошлого. Также могут быть указаны флаги.

> git reset

`git reset` удаляет и стирает историю коммиттов до выбранного коммита.  
Обычно делается так

    git reset --hard HEAD~2

При этом удалится, начиная со следующего коммита, то есть удалится текущий и ещё два.

Его не следует делать, если коммиты запушены или с ними работает кто-то ещё.  
`git reset` не создаёт новые коммиты, свидетельствующие об удалении истории.  

> git revert

`git revert` - мягкое удаление. Откатывает к необходимому коммиту, отменяет внесённые ранее изменения, но не удаляет и не стирает историю коммитов.  
Обычно делается так

    git revert f03a5fb
    
или можно так, что отменяет изменения последнего коммита

    git revert HEAD

Так как при этом отменяются внесённые изменения и создаётся новый коммит, фиксирующий это, `git revert` безопасно применять, он не удаляет историю коммитов.  

`git revert` безопасно приводит к предыдущему состоянию репозитория.  
`git reset` не безопасно приводит к предыдущему состоянию репозитория.    

## git commit --amend. Незначительные изменения в последнем коммите.

Использовать для изменения в одном коммите одной ветки.  
Возникнут проблемы, если --amend нужно будет применить к разным веткам.

Аменд перезаписывает последний коммит. Для незначительных изменений в последнем коммите. Нельзя использовать --amend, если коммит уже запушен.

    git commit --amend      
        Можно использовать для изменения сообщения в коммите.

> Если забыл добавить файл в коммит

  В случае с незначительным изменением в файлах, сначала добавляются файлы в отслеживаемый Индекс (add), потом --amend.   
       

    git add forgotten_file
    git commit --amend

## 
