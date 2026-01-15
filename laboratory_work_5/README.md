# Лабораторная работа №5: PHP + MySQL

## Структура (3 PHP-файла)

```
laboratory_work_5/
├── db.php        # подключение к MySQL (php server + XAMPP)
├── index.php     # главная страница: таблица терминов + галерея
├── add.php       # страница добавления (форма + обработка POST)
├── database.sql  # создание БД и тестовые данные
├── style.css     # единое оформление
└── Data/img/     # изображения (png/svg/jpg) + placeholder
```

## Как запустить (PHP Server + XAMPP)

1. **MySQL через XAMPP**
   - Запусти `xampp-control.exe` и включи *MySQL*.
   - Открой phpMyAdmin и импортируй `database.sql` (создаст БД `lab5_data`).
   - Помести необходимые изображения в `laboratory_work_5/Data/img/`.

2. **PHP Server (VS Code extension)**
   - В `php.ini`, который использует расширение, раскомментируй строку `extension=mysqli`.
   - В VS Code выбери `index.php` → `PHP Server: Serve Project`. Пример адреса: `http://localhost:3000/laboratory_work_5/index.php`.

3. **Параметры подключения**
   - `db.php` использует `host=127.0.0.1`, `user=root`, `password=''`, `db=lab5_data`, `port=3306`.
   - Если пароль у root есть, измени `DB_PASSWORD`.

## Функциональность

- `index.php`: выводит не менее 10 терминов и галерею изображений. Заголовок изображения показывается в `title` и под картинкой.
- `add.php`: содержит форму и логику обработки POST-запроса. Добавляет записи в таблицы `terms` и `images` в одной транзакции и выводит статус.
- `db.php`: проверяет доступность расширения `mysqli` и создаёт подключение, общая точка входа для остальных страниц.

## Файлы изображений

- Имена файлов должны совпадать со значениями столбца `img` таблицы `images`.
- Для отсутствующих файлов используется `Data/img/placeholder.png` (можно заменить своим).

## Полезно

- Если видишь «Class mysqli not found» — включи `extension=mysqli` в `php.ini` того PHP, что запускает PHP Server.
- При изменении структуры данных повторно импортируй `database.sql` через phpMyAdmin.

