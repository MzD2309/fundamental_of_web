<?php
include "header.php";
include "config/db.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) { include "footer.php"; exit; }

$id = intval($_GET['id']);
$stmt = $mysqli->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
if (!$product) { include "footer.php"; exit; }

if (isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];
        $stmt2 = $mysqli->prepare("INSERT INTO cart (user_id, product_id) VALUES (?, ?)");
        $stmt2->bind_param("ii", $user_id, $id);
        $stmt2->execute();
        $message = "Товар добавлен в список покупок!";
    } else { $message = "Войдите, чтобы добавить товар."; }
}
?>
<section class="product-detail">
<?php if(isset($message)) echo "<p class='msg'>$message</p>"; ?>
<div class="product-container">
<div class="product-image">
<img src="assets/img/<?php echo $product['img']; ?>">
</div>
<div class="product-info">
<h1><?php echo $product['name']; ?></h1>
<p><strong>Категория:</strong> <?php echo $product['category']; ?></p>
<p><strong>Цена:</strong> <?php echo $product['price']; ?> ₽</p>
<p><?php echo $product['full_desc']; ?></p>
<p><strong>Количество в наличии:</strong> <?php echo $product['quantity']; ?></p>
<h3>Характеристики:</h3>
<?php
$specs = json_decode($product['specs'], true);
if ($specs):
?>
<ul>
<?php foreach($specs as $k=>$v): ?>
<li><strong><?php echo ucfirst($k); ?>:</strong> <?php echo $v; ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<form method="POST">
<button type="submit" name="add_to_cart" class="btn">Добавить в список покупок</button>
</form>
</div>
</div>
</section>
<?php include "footer.php"; ?>
