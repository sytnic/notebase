# add html to the page

```
    //Create html on page

    // 1. Создаётся переменная со значениями HTML (тут - из объекта JSON)
    var title = jsonData.data.title;

    // 2. Создаётся элемент P
	var p = document.createElement('p');

    // 3. В элемент P добавляется значения HTML 
    p.innerHTML = title;
    
    // 4. Получившийся P встраивается на страницу
	document.body.appendChild(p);
```