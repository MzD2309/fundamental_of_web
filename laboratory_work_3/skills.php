<?php
    // Устанавливаем часовой пояс (Москва), чтобы время и дата были корректными
    date_default_timezone_set('Europe/Moscow');


    // Название страницы
    $page_title = "Навыки — Михаил Задолинный, Лабораторная работа №3";

    // Текущая страница для подсветки меню
    $current_page = 'skills.php';

    // Навигация (формируется с помощью двух PHP-включений согласно требованиям)
    $nav_items = [
        ["link" => "index.php", "text" => "Главная"],
        ["link" => "about.php", "text" => "Обо мне"],
        ["link" => "skills.php", "text" => "Навыки"],
    ];

    // Навыки
    $skills = [
        ["Навык" => "Python", "Уровень" => "Базовый+", "Опыт" => "Учебные проекты"],
        ["Навык" => "Java", "Уровень" => "Базовый+", "Опыт" => "Учебные проекты"],
        ["Навык" => "HTML5 (семантика)", "Уровень" => "Базовый+", "Опыт" => "Учебные проекты"],
        ["Навык" => "CSS (Flexbox, Grid)", "Уровень" => "Базовый", "Опыт" => "Практика в лабораторных"],
        ["Навык" => "PHP (Основы)", "Уровень" => "Начинающий", "Опыт" => "ЛР №3"],
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
                    ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section id="skills" class="section">
            <h1>Навыки</h1>
            <h2>Технические компетенции</h2>
            <p>Мои текущие сильные стороны и направления развития:</p>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Навык</th>
                            <th>Уровень</th>
                            <th>Опыт</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($skills as $skill): ?>
                        <tr>
                            <td><?php echo $skill['Навык']; ?></td>
                            <td><?php echo $skill['Уровень']; ?></td>
                            <td><?php echo $skill['Опыт']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>            
    </main>

    <footer class="site-footer">
        <p><?php echo $footer_stamp; ?> — Михаил Задолинный. Учебный проект по дисциплине «Основы веб‑технологий».</p>
    </footer>
</body>
</html>

