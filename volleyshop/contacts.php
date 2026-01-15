<?php
include "header.php";
include "config/db.php";

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $text = trim($_POST['message']);

    if (!$name || !$email || !$text) {
        $message = "Пожалуйста, заполните все поля!";
    } else {
        // Здесь можно отправлять на email или сохранять в БД
        // Для теста просто выводим сообщение об успехе
        $message = "Спасибо, ваше сообщение отправлено!";
    }
}
?>

<section class="contacts-section">
    <h1>Контакты</h1>
    <?php if ($message) echo "<p class='msg'>$message</p>"; ?>
    <form method="POST" class="contact-form">
        <input type="text" name="name" placeholder="Ваше имя" required>
        <input type="email" name="email" placeholder="Ваш Email" required>
        <textarea name="message" placeholder="Сообщение" rows="6" required></textarea>
        <button type="submit" class="btn">Отправить</button>
    </form>

    <div class="contact-info">
        <h2>Наши контакты</h2>
        <p>Телефон: +7 (900) 000-00-00</p>
        <p>Email: volleypro@mail.ru</p>
        <p>Адрес: г. Москва, ул. Спортивная, 10</p>
    </div>
