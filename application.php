<?php
// Подключение к базе данных
require_once 'db.php';

// Начинаем сессию
session_start();

// Обработка формы отправки заявки
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["phone"], $_POST["email"])) {
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    // Поиск пользователя по email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $user_id = $user["id"];

        // Подготовка и выполнение SQL-запроса для добавления заявки
        $stmt = $conn->prepare("INSERT INTO service_requests (user_id, phone) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $phone);
        if ($stmt->execute()) {
            // Заявка успешно добавлена
            echo "Заявка успешно отправлена!";
        } else {
            echo "Ошибка при добавлении заявки: " . $stmt->error;
        }
    } else {
        echo "Пользователь с указанным email не найден.";
    }

    $stmt->close();
}