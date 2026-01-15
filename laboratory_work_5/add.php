<?php
include __DIR__ . '/db.php';

$status = null;
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $term = trim($_POST['term'] ?? '');
    $definition = trim($_POST['definition'] ?? '');
    $imageName = trim($_POST['image_name'] ?? '');
    $imageFile = trim($_POST['image_file'] ?? '');

    $errors = [];

    if ($term === '' || $definition === '' || $imageName === '' || $imageFile === '') {
        $errors[] = 'Все поля обязательны для заполнения';
    }

    if ($imageFile !== '' && !preg_match('/^[\w\-.]+$/u', $imageFile)) {
        $errors[] = 'Имя файла может содержать только буквы, цифры, точку, дефис и подчёркивание.';
    }

    if (!$errors) {
        $mysql->begin_transaction();
        try {
            $stmt = $mysql->prepare('INSERT INTO terms (term, definition) VALUES (?, ?)');
            $stmt->bind_param('ss', $term, $definition);
            $stmt->execute();
            $termId = $stmt->insert_id;

            $stmtImg = $mysql->prepare('INSERT INTO images (name, img, term_id) VALUES (?, ?, ?)');
            $stmtImg->bind_param('ssi', $imageName, $imageFile, $termId);
            $stmtImg->execute();

            $mysql->commit();
            $status = 'success';
            $message = 'Данные успешно добавлены.';
        } catch (Throwable $e) {
            $mysql->rollback();
            $status = 'error';
            $message = 'Ошибка при добавлении: ' . $e->getMessage();
        }
    } else {
        $status = 'error';
        $message = implode(' ', $errors);
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Добавить термин</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="wrapper">
    <header class="hero">
        <h1>Добавление термина</h1>
        <nav>
            <a href="index.php">Главная</a>
        </nav>
    </header>

    <main>
        <?php if ($status): ?>
            <section class="card">
                <p class="status <?= htmlspecialchars($status) ?>">
                    <?= htmlspecialchars($message) ?>
                </p>
            </section>
        <?php endif; ?>

        <section class="card">
            <h2>Новая запись</h2>
            <form action="add.php" method="post" class="form-grid">
                <label>
                    Термин
                    <input type="text" name="term" required placeholder="HTML" />
                </label>
                <label>
                    Определение
                    <textarea name="definition" rows="4" required placeholder="Краткое описание"></textarea>
                </label>
                <label>
                    Название изображения
                    <input type="text" name="image_name" required placeholder="HTML Logo" />
                </label>
                <label>
                    Имя файла изображения
                    <input type="text" name="image_file" required placeholder="html.png" />
                    <small>Файл должен лежать в Data/img</small>
                </label>
                <div class="form-actions">
                    <button type="submit" class="btn primary">Сохранить</button>
                    <a class="btn secondary" href="index.php">Отмена</a>
                </div>
            </form>
        </section>
    </main>
</div>
</body>
</html>

