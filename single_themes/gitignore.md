## gitignore - в чем разница между /folder и folder/

**«/folder»**

https://stackoverflow.com/questions/5861280/gitignore-folder-vs-folder

Ведущий символ / закрепляет шаблон игнорирования в той точке дерева, где находится конкретный файл .gitignore.

**«folder/»**

https://www.atlassian.com/ru/git/tutorials/saving-changes/gitignore?ysclid=mkz4rol15864892602



Косая черта в конце шаблона означает каталог. Все содержимое любого каталога репозитория, соответствующего этому имени (включая все его файлы и подкаталоги), будет игнорироваться.

    logs/

Игнорируются

    logs/debug.log
    logs/latest/foo.bar
    build/logs/foo.bar
    build/logs/latest/debug.log

https://wiki.merionet.ru/articles/fajl-gitignore-kak-ignorirovat-fajly-i-papki-v-git

Стоит отметить, что если вы напишете просто имя каталога без слеша, то этот шаблон будет соответствовать как любым файлам, так и любым каталогам с таким именем:

```bash
    # соответствует любым файлам и каталогам с именем test
    test
```
