<?php
    // Устанавливаем часовой пояс (Москва), чтобы время и дата были корректными
    date_default_timezone_set('Europe/Moscow');

    // Название страницы
    $page_title = "Обо мне — Михаил Задолинный, Лабораторная работа №3";

    // Текущая страница для подсветки меню
    $current_page = 'about.php';

    $nav_items = [
        ["link" => "index.php", "text" => "Главная"],
        ["link" => "about.php", "text" => "Обо мне"],
        ["link" => "skills.php", "text" => "Навыки"],
    ];

    // Динамический список (формируется из массива согласно требованиям)
    $focus_points = [
        "Слежу за семантикой и логичными именами классов.",
        "Использую Flexbox и Grid для адаптивной сетки.",
        "Экспериментирую с анимациями и hover-состояниями.",
        "Пишу аккуратный и читаемый CSS/HTML код.",
        "Постепенно добавляю динамику за счет PHP и JS.",
    ];

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
                        echo $item['link'];
                    ?>" <?php
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
        <section id="about" class="section">
            <h1>Обо мне</h1>
            <h2>Краткая информация</h2>
            <p>
                Меня зовут Задолинный Михаил Дмитриевич. Учусь на 2 курсе Московского политехнического университета.
                В этом семестре начал системно изучать веб: HTML, CSS и основы JavaScript. Ценю понятные интерфейсы,
                семантичную разметку и аккуратный визуал. Люблю учиться новому и доводить работу до результата.
            </p>
            <h2>Направления развития</h2>
            <p>Сейчас сосредоточен на следующих направлениях развития:</p>
            <ul class="about-list">
                <?php foreach ($focus_points as $point): ?>
                <li><?php echo $point; ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>

    <footer class="site-footer">
        <p><?php echo $footer_stamp; ?> — Михаил Задолинный. Учебный проект по дисциплине «Основы веб‑технологий».</p>
    </footer>
</body>
</html>

