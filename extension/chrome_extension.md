# Почему в расширении Chrome не получается переслать переменные между файлами.

ошибка Uncaught SyntaxError: Cannot use import statement outside a module


## Причина ошибки

Ошибка возникает, потому что браузер по умолчанию обрабатывает JavaScript-файлы как скрипты (script), а не как модули (module). Синтаксис import/export доступен только в модулях.

При попытке использовать import в стандартном скрипте, браузер выдаёт ошибку:

Uncaught SyntaxError: Cannot use import statement outside a module

## Решения

## Способ 1. Указать тип module в manifest.json

В манифесте расширения явно укажите, что скрипт — это модуль.

manifest.json:

```json
{
  "manifest_version": 3,
  "name": "My Extension",
  "version": "1.0",
  "content_scripts": [
    {
      "matches": ["<all_urls>"],
      "js": ["content.js"],
      "type": "module"
    }
  ],
  "background": {
    "service_worker": "background.js",
    "type": "module"
  }
}
```
content.js:

```js
import { helperFunction } from './utils.js';

helperFunction();
```
utils.js:

```js
export function helperFunction() {
  console.log('Функция из модуля utils.js');
}
```

## Способ 2. Указать type="module" в HTML (для popup/options)

Если у вас есть HTML-страница (например, popup или options), укажите тип модуля в теге <script>.

popup.html:
```html
<!DOCTYPE html>
<html>
<head>
  <title>Popup</title>
</head>
<body>
  <script type="module" src="popup.js"></script>
</body>
</html>
```

popup.js:
```js
import { someFunction } from './shared.js';
someFunction();
```
shared.js:
```js
export function someFunction() {
  console.log('Функция из shared.js');
}
```

## Способ 3. Использовать Webpack/Rollup (сборщики модулей)

Настройте сборщик модулей, чтобы объединить все файлы в один бандл.

webpack.config.js:
```js
module.exports = {
  entry: './src/main.js',
  output: {
    filename: 'bundle.js',
    path: __dirname + '/dist'
  },
  mode: 'development'
};
```

Затем в manifest.json подключите собранный файл:

```json
"content_scripts": [
  {
    "matches": ["<all_urls>"],
    "js": ["dist/bundle.js"]
  }
]
```

## Способ 4. Старый способ: глобальные переменные (не рекомендуется)

Можно обойтись без модулей, используя глобальные переменные.

script1.js:
```js
window.mySharedData = {
  value: 42,
  helper: function() { console.log('Helper'); }
};
```

script2.js:
```js
console.log(window.mySharedData.value); // 42
window.mySharedData.helper(); // 'Helper'
```

В manifest.json просто перечислите скрипты в нужном порядке:

```json
"content_scripts": [
  {
    "matches": ["<all_urls>"],
    "js": ["script1.js", "script2.js"]
  }
]
```

## Сравнение способов

| Способ | Плюсы | Минусы | Когда использовать | |--------|-------|---------|------------------| | type: "module" в manifest.json | Нативно, без дополнительных инструментов | Требует поддержки модулей браузером | Для новых расширений (MV3) | | type="module" в HTML | Просто для popup/options | Только для HTML-страниц | Для popup, options, страниц настроек | | Сборщики (Webpack/Rollup) | Мощная система сборки, поддержка старых браузеров | Нужно настраивать сборщик | Для сложных проектов с множеством зависимостей | | Глобальные переменные | Работает везде, просто | Засоряет глобальную область, нет инкапсуляции | Для быстрого прототипирования или очень простых случаев |

## Важные нюансы

1. Порядок загрузки. При использовании глобальных переменных важен порядок подключения скриптов в manifest.json.
2. Относительные пути. В модулях пути должны быть точными, включая расширение файла: import { x } from './file.js'.
3. CORS-ограничения. Модули имеют более строгие правила CORS — убедитесь, что все файлы доступны.
4. Отладка. При использовании сборщиков исходные карты (source maps) упростят отладку.
5. Совместимость. Модули хорошо поддерживаются в Chrome 61+ (Manifest V3).

## Чек-лист для быстрой диагностики

1. Проверьте manifest.json: есть ли "type": "module" для нужных скриптов?
2. Если есть HTML-страницы — есть ли type="module" у <script>?
3. Проверьте пути в import: они должны быть корректны и включать расширение .js.
4. Убедитесь, что все импортируемые файлы действительно существуют.
5. Проверьте консоль на другие ошибки, которые могут мешать загрузке модулей.

## Итоговый вывод

Лучший способ для современных расширений Chrome (Manifest V3) — использовать "type": "module" в manifest.json. Это нативное решение, не требующее дополнительных инструментов.

Для сложных проектов с множеством файлов рассмотрите сборщики модулей (Webpack, Rollup), которые дадут больше гибкости и возможностей оптимизации.

--- 