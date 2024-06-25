<?php
require_once 'db.php';

// Получаем ID товара из запроса
$product_id = $_POST['id'];

// Удаляем товар из базы данных
$sql = "DELETE FROM products WHERE id_product = '$product_id'";
if ($conn->query($sql) === TRUE) {
    echo "Товар успешно удален.";
    header("Location: add.php"); // Перенаправление на главную страницу
} else {
    echo "Ошибка при удалении товара: " . $conn->error;
}

$conn->close();
?>