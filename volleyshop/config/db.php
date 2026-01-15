<?php
$host = "localhost";
$user = "mzd231on_volley";
$pass = "M_123456";
$dbname = "mzd231on_volley";

$mysqli = new mysqli($host, $user, $pass, $dbname);

if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

$mysqli->set_charset("utf8");
?>
