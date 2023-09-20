Тестовое задание
================

## Развертывание проекта

1. После скачивания проекта проследить, чтобы на папки ```/runtime``` и ```/web/assets``` были права записи.
2. Создать копию файла ```/config/db.tmp.php``` под именем ```db.php```
3. Прописать в нем реальные ```dbname```, ```username```, ```password```
4. Запустить в корне сайта команду 
```
php yii migrate
```
для создания таблиц; на вопрос ответить ```"y"```

## Запуск импорта

Команда

```
php yii import
```
из корня сайта.
Исходные файлы должны лежать в папке /data


## Просмотр данных на странице

1. В настройках локального сервера ```DocumentRoot``` должен указывать на папку ```/web```
2. Страница всего одна, с пагинацией.
