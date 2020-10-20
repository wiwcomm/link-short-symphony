1. Задание.

SELECT DISTINCT ON ("category_id") * FROM "items" ORDER BY "category_id", "price" DESC;

2. Задание.

Тут я не очень силен. 
CREATE INDEX some_table_idx ON some_table (a, b);
CREATE INDEX some_table_idx2 ON some_table_idx (info NULLS FIRST);
CREATE INDEX some_table_idx3 ON some_table_idx (id DESC NULLS LAST);

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
    "short_url": "http://127.0.0.1:8090/go/791ad3ceb773cee9b115"
}

Перейдя по ссылке, вы получите редирект на целевую страницу.

Все разворачивается через docker-compose.
