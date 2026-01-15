<?php
include __DIR__ . '/db.php';

$termsQuery = $mysql->query('SELECT id, term, definition FROM terms ORDER BY id');
$imagesQuery = $mysql->query('SELECT id, name, img FROM images ORDER BY id');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Словарь веб-технологий</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="wrapper">
    <header class="hero">
        <h1>Словарь веб-технологий</h1>
        <nav>
            <a href="index.php">Главная</a>
            <a href="add.php">Добавить термин</a>
        </nav>
    </header>

    <main>
        <section class="card">
            <h2>Термины и определения</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Термин</th>
                            <th>Определение</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($termsQuery && $termsQuery->num_rows > 0): ?>
                        <?php while ($term = $termsQuery->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($term['id']) ?></td>
                                <td><?= htmlspecialchars($term['term']) ?></td>
                                <td><?= htmlspecialchars($term['definition']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Нет данных. Импортируйте database.sql.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="card">
            <h2>Галерея изображений</h2>
            <div class="gallery">
                <?php if ($imagesQuery && $imagesQuery->num_rows > 0): ?>
                    <?php while ($image = $imagesQuery->fetch_assoc()): ?>
                        <figure class="gallery__item">
                            <img src="Data/img/<?= htmlspecialchars($image['img']) ?>" alt="<?= htmlspecialchars($image['name']) ?>"
                                 title="<?= htmlspecialchars($image['name']) ?>" onerror="this.src='Data/img/placeholder.png'" />
                            <figcaption><?= htmlspecialchars($image['name']) ?></figcaption>
                        </figure>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Загрузите изображения в папку Data/img и заполните таблицу images.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Лабораторная работа №5. PHP + MySQL.</p>
    </footer>
</div>
</body>
</html>

