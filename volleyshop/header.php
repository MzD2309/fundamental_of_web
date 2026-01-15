<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VolleyPro Shop</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="navbar">
    <div class="logo">VolleyPro</div>
    <nav>
        <a href="index.php">Главная</a>
        <a href="shop.php">Магазин</a>
        <a href="contacts.php">Контакты</a>
        <?php if(isset($_SESSION['user'])): ?>
            <a href="cart.php">Список покупок</a>
            <a href="logout.php">Выход</a>
        <?php else: ?>
            <a href="login.php">Вход</a>
        <?php endif; ?>
    </nav>
</header>
