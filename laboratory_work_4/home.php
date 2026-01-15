<?php
    include 'header.html';
    
    // Проверка наличия данных формы
    if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['message']) || !isset($_POST['category'])) {
        echo '<p>Ошибка: не все обязательные поля заполнены.</p>';
        echo '<a href="index.php" class="btn">Вернуться к форме</a>';
        echo '</body></html>';
        exit;
    }
    
    $name = htmlspecialchars($_POST['name']);
    $message = htmlspecialchars($_POST['message']);
    $category = $_POST['category'];
    $source = isset($_POST['source']) ? $_POST['source'] : '';
    $attachment_name = '';
    
    // Обработка прикрепленного файла
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $attachment_name = htmlspecialchars($_FILES['attachment']['name']);
    }
?>

<main>
    <div class="response">
        <p>Здравствуйте, <?php echo $name; ?>!</p>
        
        <?php
        // Проверка типа обращения
        if ($category == 'propose') {
            echo '<p>Спасибо за ваше предложение:</p>';
        } else {
            echo '<p>Мы рассмотрим Вашу жалобу:</p>';
        }
        ?>
        
        <textarea readonly><?php echo $message; ?></textarea>
        
        <?php
        // Вывод информации о прикрепленном файле
        if ($attachment_name != '') {
            echo '<p>Вы приложили следующий файл: ' . $attachment_name . '</p>';
        }
        ?>
        
        <a href="index.php?N=<?php echo urlencode($name); ?>&E=<?php echo urlencode($_POST['email']); ?>&S=<?php echo urlencode($source); ?>" class="btn">Заполнить снова</a>
    </div>
</main>

</body>
</html>

