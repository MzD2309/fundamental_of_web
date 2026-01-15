<?php
    // Получение GET-параметров для повторного заполнения
    $name = '';
    $email = '';
    $source = '';
    
    if (isset($_GET['N'])) { 
        $name = htmlspecialchars($_GET['N']);
    }
    if (isset($_GET['E'])) {
        $email = htmlspecialchars($_GET['E']);
    }
    if (isset($_GET['S'])) {
        $source = htmlspecialchars($_GET['S']);
    }
    
    include 'header.html';
?>

<main>
    <form action="home.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">ФИО:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Ваш е-майл:</label>
            <input type="email" id="email" name="email" placeholder="example@mail.ru" value="<?php echo $email; ?>" required>
        </div>

        <div class="form-group">
            <label for="message">Сообщение:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="category">Тема обращения:</label>
            <select id="category" name="category" required>
                <option value="propose">Предложение</option>
                <option value="complaint">Жалоба</option>
            </select>
        </div>

        <div class="form-group">
            <label for="attachment">Выбор файла:</label>
            <input type="file" id="attachment" name="attachment">
        </div>

        <div class="form-group radio-group">
            <label>Откуда узнали о нас:</label>
            <div class="radio-options">
                <label class="radio-label">
                    <input type="radio" name="source" value="internet" <?php echo ($source === 'internet') ? 'checked' : ''; ?> required>
                    Реклама из интернета
                </label>
                <label class="radio-label">
                    <input type="radio" name="source" value="friends" <?php echo ($source === 'friends') ? 'checked' : ''; ?> required>
                    Рассказали друзья
                </label>
            </div>
        </div>

        <div class="form-group checkbox-group">
            <label class="checkbox-label">
                <input type="checkbox" name="consent" value="yes" required>
                Даю согласие на обработку данных
            </label>
        </div>

        <div class="form-group submit-group">
            <button type="submit">Отправить</button>
        </div>
    </form>
</main>

</body>
</html>

