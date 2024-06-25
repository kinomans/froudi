<?php
// Подключение файла с параметрами подключения к базе данных
require_once 'db.php';

// Обработка формы регистрации
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["reg-name"];
    $surname = $_POST["reg-surname"];
    $patronymic = $_POST["reg-patronymic"];
    $email = $_POST["reg-email"];
    $password = $_POST["reg-password"];

    // Проверка, что пользователь с таким email не существует
    $sql = "SELECT COUNT(*) as count FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row["count"] > 0) {
        // Пользователь с таким email уже существует
        $error_message = "Пользователь с таким email уже зарегистрирован";
    } else {
        // Хеширование пароля
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Подготовка и выполнение SQL-запроса
        $sql = "INSERT INTO users (name, surname, patronymic, email, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $surname, $patronymic, $email, $hashed_password);

        if ($stmt->execute()) {
            // Регистрация успешна, создаем сессию и перенаправляем на защищенную страницу
            session_start();
            $_SESSION["user_id"] = $stmt->insert_id;
            $_SESSION["user_email"] = $email;
            header("Location: userPanel.php");
            exit;
        } else {
            // Ошибка при регистрации
            $error_message = "Ошибка при регистрации: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();

    // Вывод сообщения об ошибке
    if (isset($error_message)) {
        echo $error_message;
    }
}
?>