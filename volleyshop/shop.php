<?php
include "header.php";
include "config/db.php";
?>
<section class="shop-section">
<h1>Каталог товаров</h1>
<div class="view-buttons">
    <button id="tableViewBtn">Таблица</button>
    <button id="gridViewBtn">Карточки</button>
</div>
<div id="tableView" class="view">
    <table>
        <thead>
            <tr>
                <th>Фото</th>
                <th>Название</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Краткое описание</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $mysqli->query("SELECT * FROM products");
            while($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><img src="assets/img/<?php echo $row['img']; ?>" width="80"></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row['price']; ?> ₽</td>
                <td><?php echo $row['short_desc']; ?></td>
                <td><a href="product.php?id=<?php echo $row['id']; ?>" class="btn">Подробнее</a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<div id="gridView" class="view" style="display:none;">
    <div class="grid-container">
        <?php
        $result->data_seek(0);
        while($row = $result->fetch_assoc()):
        ?>
        <div class="product-card">
            <img src="assets/img/<?php echo $row['img']; ?>">
            <h3><?php echo $row['name']; ?></h3>
            <p><?php echo $row['short_desc']; ?></p>
            <p><strong><?php echo $row['price']; ?> ₽</strong></p>
            <a href="product.php?id=<?php echo $row['id']; ?>" class="btn">Подробнее</a>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</section>
<?php include "footer.php"; ?>
