1. Задание.

SELECT DISTINCT ON ("category_id") * FROM "items" ORDER BY "category_id", "price" DESC LIMIT 3;

2. Задание.

CREATE NONCLUSTERED INDEX IX1 ON some_table (a,b) INCLUDE (c);

CREATE NONCLUSTERED INDEX IX3 ON some_table (a) INCLUDE (b,c);

CREATE NONCLUSTERED INDEX IX4 ON some_table (b) INCLUDE (a,c);

CREATE CLUSTERED INDEX IX2 ON some_table (c ASC);

Про селективность. 
Когда записей с одинаковым значением мало, тогда селективность будет высокой эти колонки надо использовать первыми в составных индексах.

3. Задание.

Для формирования короткой ссылки нужно отправить запрос по адресу хоста, на котором будут развернуты контейнеры, на порт 8090.

Пример:

curl --location --request POST 'http://127.0.0.1:8090/short/' \
--header 'Content-Type: application/json' \
--data-raw '{
    "link": "https://ya.ru"
}'

Ответ будет следующим.

{
    "short_url": "http://127.0.0.1:8090/go/c6bec"
}

Перейдя по ссылке, вы получите редирект на целевую страницу.

Все разворачивается через docker-compose.
