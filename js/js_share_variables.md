# Как в JS передать переменную из одного файла в другой

## 1. Модули ES6 (рекомендуемый способ)

Современный стандарт для браузеров и Node.js (с type: "module" в package.json или расширением .mjs).

---

Файл file1.js (источник):
```js
export const myVariable = 'Привет из file1!';
export let counter = 42;

// Экспорт по умолчанию (можно только один на файл)
export default function greet() {
  return 'Здравствуйте!';
}
```
---

Файл file2.js (приёмник):
```js
// Именованный импорт
import { myVariable, counter } from './file1.js';

// Импорт по умолчанию
import greetFunction from './file1.js';

console.log(myVariable); // 'Привет из file1!'
console.log(counter);   // 42
console.log(greetFunction()); // 'Здравствуйте!'
```
---

## 2. CommonJS (для Node.js)

Стандартный способ в Node.js без модулей ES6.

---
```js
Файл file1.js :

const myVariable = 'Привет из Node.js!';
const helper = () => 'Вспомогательная функция';

module.exports = {
  myVariable,
  helper
};
// Или по отдельности:
// exports.myVariable = myVariable;
```
---

Файл file2.js :
```js
const { myVariable, helper } = require('./file1.js');

console.log(myVariable); // 'Привет из Node.js!'
console.log(helper());  // 'Вспомогательная функция'
```
---

## 3. Глобальные переменные (не рекомендуется)

Подходит только для браузеров. Объявляет переменную в глобальной области (window).

---

Файл file1.js :
```js
window.sharedVar = 'Глобальное значение';
// Или без window (в глобальном скоупе):
var globalVar = 'Ещё одно глобальное';
```
---

Файл file2.js :
```js
console.log(sharedVar);  // 'Глобальное значение'
console.log(globalVar); // 'Ещё одно глобальное'
```
Минусы:

* риск конфликтов имён;
* затрудняет отладку;
* не работает в строгом режиме ('use strict');
* не подходит для Node.js.

---

## 4. LocalStorage (для браузера)

Сохраняет данные в браузере пользователя — доступны между сессиями и вкладками.

---

Файл file1.js :
```js
const userData = { name: 'Анна', age: 30 };
localStorage.setItem('userData', JSON.stringify(userData));
```
---

Файл file2.js :
```js
const savedData = JSON.parse(localStorage.getItem('userData'));
console.log(savedData.name); // 'Анна'
```
Нюансы:

* хранит только строки — используйте JSON.stringify/JSON.parse для объектов;
* синхронная операция (может замедлять выполнение);
* лимит ~5 МБ на домен.

---

## 5. Передача через функцию

Если файлы связаны через вызов функций (например, главный скрипт вызывает модуль).

---

Файл module.js :
```js
function processData(dataFromMain) {
  console.log('Получено:', dataFromMain);
  return dataFromMain.toUpperCase();
}

module.exports = processData;
```
---

Файл main.js :
```js
const process = require('./module.js');
const input = 'привет мир';
const result = process(input);
console.log(result); // 'ПРИВЕТ МИР'
```
---

## Сравнительная таблица методов

| Способ        | Где работает | Плюсы                                | Минусы                                     | |---------------|--------------|---------------------------------------|---------------------------------------------| | ES6 Modules   | Браузеры, Node.js | Современный стандарт, чёткая структура | Требует поддержки модулей (Node.js: type: module) | | CommonJS      | Node.js       | Стандарт для Node.js, простая синтаксис | Не работает в браузерах без сборщика        | | Глобальные переменные | Браузеры | Простота                             | Конфликты имён, плохая практика              | | LocalStorage  | Браузеры     | Сохраняет данные между сессиями         | Только строки, синхронный, лимит объёма     | | Передача через функцию | Везде   | Гибкость, явная логика               | Требует организации кода вокруг вызовов функций |

---

## Рекомендации по выбору

* Для новых проектов: используйте ES6 Modules — это современный стандарт с хорошей поддержкой.
* Для Node.js-приложений: выбирайте CommonJS (если не используете ES6) или ES6 с настройкой type: "module".
* Для сохранения состояния между сессиями: LocalStorage (браузер) или файлы/БД (Node.js).
* Избегайте глобальных переменных — они усложняют поддержку кода.
* Для сложных сценариев рассмотрите сборщики (Webpack, Vite) или менеджеры состояния (Redux, Zustand).

---