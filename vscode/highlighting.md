## Пропала подсветка изменений файла согласно Git в Visual Studio Code

Пробовал перезапустить встроенный Git.  

> Extensions - Фильтр в поисковой строке "@builtin" - Найти Git - Disable - Перезагрузка - Enable  

Неизвестно, повлияло ли это.

Что помогло:
- Удалить все папки из Workspace.  
- Изнутри VScode "File - Add Folder to Workspace..."
- Сохранить Workspace под каким-либо именем

Заработало.
- Далее добавлять в Workspace новые папки изнутри VScode через "File - Add Folder to Workspace..."

Работает.