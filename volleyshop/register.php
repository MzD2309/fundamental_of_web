<?php
include "header.php";
include "config/db.php";

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if (!$username || !$email || !$password) {
        $message = "Все поля обязательны!";
    } elseif ($password !== $password_confirm) {
        $message = "Пароли не совпадают!";
    } else {
        // Проверка уникальности email
        $stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $message = "Пользователь с таким email уже существует!";
        } else {
            // Хэшируем пароль
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt2 = $mysqli->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt2->bind_param("sss", $username, $email, $hash);
            if ($stmt2->execute()) {
                $message = "Регистрация успешна! Теперь вы можете войти.";
            } else {
                $message = "Ошибка регистрации!";
            }
        }
    }
}
?>

<section class="auth-section">
    <h1>Регистрация</h1>
    <?php if ($message) echo "<p class='msg'>$message</p>"; ?>
    <form method="POST" class="auth-form">
        <input type="text" name="username" placeholder="Имя пользователя" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <input type="password" name="password_confirm" placeholder="Подтвердите пароль" required>
        <button type="submit" class="btn">Зарегистрироваться</button>
    </form>
</section>

<?php include "footer.php"; ?>
