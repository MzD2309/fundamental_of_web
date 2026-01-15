<?php
    date_default_timezone_set('Europe/Moscow');


    // Название страницы
    $page_title = "Главная — Михаил Задолинный, Лабораторная работа №3";

    // Текущая страница для подсветки меню
    $current_page = 'index.php';

    // Навигация (формируется с помощью двух PHP-включений согласно требованиям)
    $nav_items = [
        ["link" => "index.php", "text" => "Главная"],
        ["link" => "about.php", "text" => "Обо мне"],
        ["link" => "skills.php", "text" => "Навыки"],
    ];



    $current_hour = (int) date('H');
    $current_second = (int) date('s');

    if ($current_hour >= 5 && $current_hour < 12) {
        $greeting = "Доброе утро";
    } elseif ($current_hour >= 12 && $current_hour < 18) {
        $greeting = "Добрый день";
    } elseif ($current_hour >= 18 && $current_hour < 22) {
        $greeting = "Добрый вечер";
    } else {
        $greeting = "Доброй ночи";
    }

    $hero_text = "{$greeting}! Я Михаил, студент Московского Политеха";

    // Динамическая загрузка фотографий в зависимости от секунды
    $hero_images = [
        'even' => [
            'src' => 'images/image1.jpg',
            'alt' => 'Фото',
        ],
        'odd' => [
            'src' => 'images/image2.jpg',
            'alt' => 'Фото',
        ],
    ];

    $hero_image = ($current_second % 2 === 0) ? $hero_images['even'] : $hero_images['odd'];

    $footer_stamp = 'Сформировано ' . date('d.m.Y \в H-i:s');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header class="site-header">
        <nav class="nav">
            <a class="logo" href="index.php" aria-label="На главную">МЗ</a>
            <ul class="nav-list">
                <?php foreach ($nav_items as $item): ?>
                <li>
                    <a href="<?php
                        // Первый PHP-скрипт: выводим адрес ссылки
                        echo $item['link'];
                    ?>" <?php
                        // Второй PHP-скрипт: выводим класс и текст ссылки
                        if ($item['link'] === $current_page) {
                            echo 'class="nav-link nav-link--active">' . $item['text'];
                        } else {
                            echo 'class="nav-link">' . $item['text'];
                        }
                    ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero" id="top">
            <img src="<?php echo $hero_image['src']; ?>" alt="<?php echo $hero_image['alt']; ?>" class="beautiful_image"> 
            <div class="hero-text">
                <h1><?php echo $hero_text; ?></h1>
                <p>Изучаю основы веб‑технологий, делаю учебные проекты и прокачиваю навыки фронтенда. 
                   Интересуюсь доступностью интерфейсов и аккуратным кодом.</p>                   
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <p><?php echo $footer_stamp; ?> — Михаил Задолинный. Учебный проект по дисциплине «Основы веб‑технологий».</p>
    </footer>
</body>
</html>
