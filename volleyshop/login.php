<?php
include "header.php";
include "config/db.php";

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username']
        ];
        header("Location: index.php");
        exit;
    } else {
        $message = "Неправильный email или пароль!";
    }
}
?>

<section class="auth-section">
    <h1>Вход</h1>
    <?php if ($message) echo "<p class='msg'>$message</p>"; ?>
    <form method="POST" class="auth-form">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit" class="btn">Войти</button>
    </form>
    <p>Нет аккаунта? <a href="register.php">Зарегистрируйтесь</a></p>
</section>

<?php include "footer.php"; ?>
