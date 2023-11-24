## Пропала подсветка изменений файла согласно Git в Visual Studio Code

Попробовать перезапустить встроенный Git.  

> Extensions - Фильтр в поисковой строке "@builtin" - Найти Git - Disable - Перезагрузка - Enable  



Что помогло:

1.

- Удалить все папки из Workspace.  
- Изнутри VScode "File - Add Folder to Workspace..."
- Сохранить Workspace под каким-либо именем

Заработало.
- Далее добавлять в Workspace новые папки изнутри VScode через "File - Add Folder to Workspace..."

Работает.

2. 

Закрыть Workspace (File -> Close Workspace).  
Открыть нужную папку File -> Open Folder. Далее (новые папки) File - Add Folder to Workspace. Будет создат Untitled Workspace.