## Синтаксис работающих примеров в админере

'datebirth' - date  
'doc_id'    - int  
Остальные   - varchar

Всё без апострофов, цифра в значениях c кавычками

    INSERT INTO client_requests 
    (firstname, midname, surname, datebirth, phone, doc_id, spec_name)
    VALUES ('tert', 'terti', 'ertt', '2020-12-31', '305-15', '1', 'tewr');

Всё без апострофов, цифра в значениях без кавычек

    INSERT INTO client_requests 
    (firstname, midname, surname, datebirth, phone, doc_id, spec_name)
    VALUES ('tert', 'terti', 'ertt', '2020-12-31', '305-15', 2, 'tewr');

Таблица с апострофами

    INSERT INTO `client_requests` 
    (firstname, midname, surname, datebirth, phone, doc_id, spec_name)
    VALUES ('tert', 'terti', 'ertt', '2020-12-31', '305-15', 2, 'tewr');

Таблица без апострофов

    INSERT INTO client_requests 
    (`firstname`, `midname`, `surname`, `datebirth`, `phone`, `doc_id`, `spec_name`)
    VALUES ('tert', 'terti', 'ertt', '2020-12-31', '305-15', 2, 'tewr');

Всё с апострофами

    INSERT INTO `client_requests` 
    (`firstname`, `midname`, `surname`, `datebirth`, `phone`, `doc_id`, `spec_name`)
    VALUES ('tert', 'terti', 'ertt', '2020-12-31', '305-15', 2, 'tewr');

