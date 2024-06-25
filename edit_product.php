<?php
require_once 'db.php';

// Получаем ID продукта из URL
$product_id = $_GET["id"];

// Получаем данные о продукте из базы данных
$sql = "SELECT * FROM products WHERE id_product = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

$product_name = $product["name_products"];
$product_text = $product["text_products"];
$product_price = $product["price_products"];
$product_image = $product["image_products"];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование продукта</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1 class="adminpanel__title">Редактирование продукта</h1>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $product_id; ?>"
            enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $product_id; ?>">

            <label class="form__title" for="name">Название:</label>
            <input class="form__descr" type="text" id="name" name="name" value="<?php echo $product_name; ?>" required>

            <label class="form__title" for="text">Описание:</label>
            <textarea class="form__descr" id="text" name="text"><?php echo $product_text; ?></textarea>

            <label class="form__title" for="price">Цена:</label>
            <input class="form__descr" type="number" id="price" name="price" value="<?php echo $product_price; ?>">

            <label class="form__title" for="image">Изображение:</label>
            <input class="form__descr" type="file" id="image" name="image" accept="image/*">

            <button class="btn-reset adminpanel__block-btn" type="submit">Сохранить</button>
        </form>

        <?php
// Обработка обновления продукта
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $product_id = $_POST["id"];
    $product_name = $_POST["name"];
    $product_text = $_POST["text"];
    $product_price = $_POST["price"];
    $product_image = $_FILES["image"]["name"]; // Получаем имя загруженного файла

    // Проверяем, была ли загружена новая картинка
    if (!empty($product_image)) {
        $upload_dir = "uploads/";
        $product_image = basename($product_image);
        // Перемещаем загруженный файл в указанную директорию
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $upload_dir . $product_image)) {
            echo "Файл " . basename($product_image) . " был успешно загружен.";
        } else {
            echo "Ошибка при загрузке файла.";
        }
    } else {
        // Если новая картинка не была загружена, используем текущую
        $product_image = $product["image_products"];
    }

    // Код для обновления продукта в базе данных
    $sql = "UPDATE products 
        SET name_products = ?, 
            text_products = ?, 
            price_products = ?,
            image_products = ?
        WHERE id_product = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $product_name, $product_text, $product_price, $product_image, $product_id);
    if ($stmt->execute()) {
        echo "Данные успешно обновлены.";
    } else {
        echo "Ошибка при обновлении данных: " . $stmt->error;
    }
}
?>
        <a class="adminpanel__block-btn adminpanel__block-btn-2" href="add.php">вернуться</a>
    </div>
</body>

</html>
<style>
.form__descr {
    padding-left: 0px;
}

.adminpanel__block-btn {
    max-width: 300px;
    padding: 13px 106px;
    border-radius: 20px;
    background-color: #222;
    color: #FFF;
    font-size: 20px;
    font-weight: 400;
    margin-bottom: 100px;
}

.adminpanel__block-btn-2 {
    background-color: #2589FF;
}

.adminpanel__title {
    color: #474766;
    font-size: 64px;
    font-weight: 400;
    margin: 50px 0;
}
</style>