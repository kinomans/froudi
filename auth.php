<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["auth-email"];
    $password = $_POST["auth-password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email); 
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($user['role'] == 'admin') {
            $_SESSION['user'] = [
                "user_id" => $user['id'],
                "user_email" => $user['email'],
                "user_name" => $user['name'],
                "user_surname" => $user['surname'],
                "user_patronymic" => $user['patronymic'],
                "user_role" => $user['role'],
                "role" => "admin"
            ];
            header("Location:adminPanel.php");
            exit;
        } elseif ($user['role'] == 'user') {
            $_SESSION['user'] = [
                "user_id" => $user['id'],
                "user_email" => $user['email'],
                "user_name" => $user['name'],
                "user_surname" => $user['surname'],
                "user_patronymic" => $user['patronymic'],
                "user_role" => $user['role'],
                "role" => "user"
            ];
            header("Location:userPanel.php");
            exit;
        }
    } else {
        $_SESSION['error_message'] = "Неверный логин или пароль";
        header("Location: formReg.php");
        exit;
    }
}
?>