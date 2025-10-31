## JS модули, которые не работают локально

Модули JS работают только на сервере (локальном или онлайн). Модули не работают, если страницу вызывать из проводника. В этом случае срабатывает ошибка "CORS request not HTTP".  
https://developer.mozilla.org/en-US/docs/Web/HTTP/Guides/CORS/Errors/CORSRequestNotHttp

## Ошибка чтения querySelector('svg use').getAttribute('href')

Вызывается в Edge и только локально.  

Элемент

    const svgOfActiveBtn = btnToActive.querySelector('svg use').getAttribute('href')
    
вызывает ошибку 

    Uncaught TypeError: Cannot read properties of null (reading 'querySelector')
    
в Edge локально, только в Edge и только локально. Ошибка не позволяет JS-скрипту переключать стили тёмного/светлого фона в Bootstrap5. Если выставить проект в локальный сервер, то всё работает. В других браузерах работает и локально. 

##