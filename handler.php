<?php
// Подключение к базе данных
require_once 'db.php';

// Обработка формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"])) {
        $email = $_POST["email"];

        // Проверка, авторизован ли пользователь
        $sql = "SELECT id, name, surname, patronymic FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Вставка данных в таблицу consultations
            $sql = "INSERT INTO consultations (user_id, name, surname, patronymic, email, status) VALUES (?, ?, ?, ?, ?, 'на рассмотрении')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issss", $user["id"], $user["name"], $user["surname"], $user["patronymic"], $email);
            if ($stmt->execute()) {
                echo "Заявка на консультацию успешно отправлена!";
            } else {
                echo "Ошибка при отправке заявки: " . $stmt->error;
            }
        } else {
            // Если пользователь не авторизован, перенаправление на страницу авторизации
            header("Location: formAuth.php");
            exit;
        }
    } else {
        echo "Ошибка: поле 'email' не передано в форме.";
    }
}

$conn->close();
?>
