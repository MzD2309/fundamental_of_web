<?php
// Подключение к MySQL для PHP Server + XAMPP
// При необходимости измените пароль root и порт.

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'lab5_data');
define('DB_PORT', 3306);

ensure_mysqli();

$mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

if ($mysql->connect_errno) {
    http_response_code(500);
    die('Ошибка подключения к базе данных: ' . $mysql->connect_error);
}

$mysql->set_charset('utf8mb4');

function ensure_mysqli(): void
{
    if (!class_exists('mysqli')) {
        http_response_code(500);
        die('Расширение mysqli не найдено. Включите extension=mysqli в php.ini используемого PHP.');
    }
}
