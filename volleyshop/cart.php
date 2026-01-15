<?php
include "header.php";
include "config/db.php";

// Проверка авторизации
if (!isset($_SESSION['user'])) {
    echo "<p>Для просмотра списка покупок нужно войти на сайт.</p>";
    include "footer.php";
    exit;
}

$user_id = $_SESSION['user']['id'];

// Удаление товара из списка покупок
if (isset($_GET['remove']) && is_numeric($_GET['remove'])) {
    $remove_id = intval($_GET['remove']);
    $stmt = $mysqli->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $remove_id, $user_id);
    $stmt->execute();
    header("Location: cart.php");
    exit;
}

// Получаем список товаров
$stmt = $mysqli->prepare("
    SELECT cart.id AS cart_id, products.* 
    FROM cart 
    INNER JOIN products ON cart.product_id = products.id 
    WHERE cart.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>

<section class="cart-section">
    <h1>Список покупок</h1>
    <?php if ($result->num_rows === 0): ?>
        <p>Список пуст.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Сумма</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): 
                    $total += $row['price'];
                ?>
                <tr>
                    <td><img src="assets/img/<?php echo $row['img']; ?>" width="80" alt=""></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['price']; ?> ₽</td>
                    <td>1</td>
                    <td><?php echo $row['price']; ?> ₽</td>
                    <td><a href="cart.php?remove=<?php echo $row['cart_id']; ?>" class="btn remove-btn">Удалить</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <p class="total">Общая сумма: <strong><?php echo $total; ?> ₽</strong></p>
    <?php endif; ?>
</section>

<?php include "footer.php"; ?>
