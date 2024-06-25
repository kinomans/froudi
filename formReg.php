<?php
session_start();

// Проверяем, есть ли данные пользователя в сессии
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['user_role'] == 'admin') {
        header("Location: adminPanel.php");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reg-modal</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main class="main">
        <div class="container">
            <div class="modal" id="reg-modal">
                <div class="modal-content modal-content-reg">
                    <a href="index.php"><span class="close-button">&times;</span></a>
                    <h2 class="modal-content-title">Регистрация</h2>
                    <form action="reg.php" id="reg-form" method="POST">
                        <label for="reg-name" class="form__title">Имя</label>
                        <input type="text" id="reg-name" name="reg-name" class="form__descr form__descr-reg-name"
                            required pattern="^[А-Яа-яЁё\s]+$" placeholder="Введите свое Имя">
                        <label for="reg-surname" class="form__title">Фамили</label>
                        <input type="text" id="reg-surname" name="reg-surname" class="form__descr form__descr-reg-name"
                            required pattern="^[А-Яа-яЁё\s]+$" placeholder="Введите свою Фамилию">
                        <label for="reg-patronymic" class="form__title">Отчество</label>
                        <input type="text" id="reg-patronymic" name="reg-patronymic"
                            class="form__descr form__descr-reg-name" required pattern="^[А-Яа-яЁё\s]+$" placeholder="Введите свое Отчество">
                        <label for="reg-email" class="form__title">E-mail</label>
                        <input type="email" id="reg-email" name="reg-email" class="form__descr form__descr-auth-email"
                            required pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" placeholder="Введите свой E-mail">
                        <label for="reg-password" class="form__title">Password</label>
                        <input type="password" id="reg-password" name="reg-password"
                            class="form__descr form__descr-auth-password" required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" placeholder="Введите свой пароль">
                        <button type="submit" class="form__btn btn-reset">Зарегистрироваться</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>