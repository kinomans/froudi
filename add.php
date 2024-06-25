<?php
include 'db.php';

// Обработка действий
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];
    
    if ($action == "add") {
        $name_product = $_POST["name_product"];
        $text_product = $_POST["text_product"];
        $price_product = $_POST["price_product"];
        $image_product = $_FILES["image_product"]["name"];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image_product"]["name"]);
        
        if (move_uploaded_file($_FILES["image_product"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO products (name_products, text_products, price_products, image_products) VALUES ('$name_product', '$text_product', '$price_product', '$image_product')";
            if ($conn->query($sql) === TRUE) {
                echo "Товар успешно добавлен.";
            } else {
                echo "Ошибка при добавлении товара: " . $conn->error;
            }
        } else {
            echo "Ошибка при загрузке изображения.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/services.css">
    <link rel="stylesheet" href="css/application.css">
</head>

<body>
    <main class="main">
        <div class="container adminpanel__contaienr">
            <h1 class="adminpanel__title">Управление услугами</h1>
            <!-- Форма для добавления товара -->
            <div class="adminpanel__block-add">
                <h2 class="adminpanel__block-title">Добавить услугу</h2>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
                    enctype="multipart/form-data">
                    <input class="adminpanel__block-title" type="hidden" name="action" value="add">
                    <input class="adminpanel__block-descr" type="text" id="name_product" name="name_product" required
                        placeholder="Название услуги:">
                    <textarea class="adminpanel__block-descr" id="text_product" name="text_product" required
                        placeholder="Описание услуги:"></textarea>
                    <input class="adminpanel__block-descr" type="number" id="price_product" name="price_product" min="0"
                        step="0.01" required placeholder="Цена услуги:">
                    <input class="adminpanel__block-img" type="file" id="image_product" name="image_product"
                        accept="image/*" required placeholder="Изображение услуги:">
                    <button class="btn-reset adminpanel__block-btn" type="submit">Добавить</button>
                </form>
            </div>
            <div class="hero__services__blocks">
                <?php
require_once 'db.php';

// Получение списка товаров
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
                <div class="hero__services__block">
                    <img class="hero__services__block__content-img" src="uploads/<?php echo $row["image_products"]; ?>"
                        alt="<?php echo $row["name_products"]; ?>">
                    <div class="hero__services__block__content">
                        <h3 class="hero__services__block__content-title"><?php echo $row["name_products"]; ?></h3>
                        <p class="hero__services__block__content-descr"><?php echo $row["text_products"]; ?></p>
                        <div class="hero__services__block__content-line"></div>
                        <p class="hero__services__block__content-price">Стоимость услуги:
                            <?php echo number_format($row["price_products"], 2, ",", " "); ?> Р.</p>
                        <div class="hero__services__block__content-buttons">
                            <a href="edit_product.php?id=<?php echo $row["id_product"]; ?>"
                                class="btn-reset hero__services__block__content-btn">Редактировать</a>
                            <form action="delete_product.php" method="post" style="display: inline-block;">
                                <input type="hidden" name="id" value="<?php echo $row["id_product"]; ?>">
                                <button type="submit"
                                    class="btn-reset hero__services__block__content-btn">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
    }
} else {
    ?>
                <p>Нет товаров для отображения.</p>
                <?php
}

$conn->close();
?>
            </div>

            <div class="adminpanel__block-link">
                <a class="adminpanel__link" href="adminPanel.php" class="btn-reset">Вернуться в Админ панель</a>
            </div>
        </div>
        </div>
        </div>
    </main>
</body>

</html>

<style>
.adminpanel__contaienr {}

.adminpanel__title {
    color: #474766;
    font-size: 64px;
    font-weight: 400;
    margin-bottom: 75px;
}

.adminpanel__blocks-form {
    display: flex;
    flex-direction: column;
}

.adminpanel__block-add {
    max-width: 1000px;
    display: flex;
    flex-direction: column;
    margin-bottom: 75px;
}

.adminpanel__block-title {
    color: #474766;
    font-size: 40px;
    font-weight: 700;
    margin-bottom: 42px;
}

.adminpanel__block-descr {
    color: #474766;
    font-size: 32px;
    font-weight: 400;
    background-repeat: no-repeat;
    border: none;
    border-bottom: 1px solid #474766;
    outline: none;
    margin-bottom: 44px;
}

.adminpanel__block-img {
    margin-bottom: 44px;
}

.adminpanel__block-btn {
    max-width: 300px;
    padding: 13px 106px;
    border-radius: 20px;
    background-color: #222;
    color: #FFF;
    font-size: 20px;
    font-weight: 400;
}

.adminpanel__block-change {
    max-width: 1000px;
    display: flex;
    flex-direction: column;
    margin-bottom: 75px;
}

.adminpanel__block-del {
    max-width: 1000px;
    display: flex;
    flex-direction: column;
    margin-bottom: 75px;
}

::placeholder {
    color: #a0b0c6;
    font-size: 20px;
    font-weight: 400;
}

.adminpanel__link {
    width: 514px;
    color: #474766;
    font-size: 40px;
    font-weight: 700;
}

.adminpanel__block-link {
    margin-top: 100px;
    margin-bottom: 100px;
}

.hero__services__block__content-btn:not(:last-child) {
    margin-right: 70px;
}
</style>