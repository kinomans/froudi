<?php
session_start();

// Проверяем, есть ли данные пользователя в сессии
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['user_role'] == 'admin') {
        header("Location: adminPanel.php");
    } else {
        header("Location: userPanel.php");
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>auth-modal</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main class="main">
        <div class="container">
            <div class="modal" id="auth-modal">
                <div class="modal-content">
                    <a href="index.php"><span class="close-button">&times;</span></a>
                    <h2 class="modal-content-title">Авторизация</h2>
                    <?php if (isset($auth_error)) { ?>
                    <p style="color: red;"><?php echo $auth_error; ?></p>
                    <?php } ?>
                    <form action="auth.php" id="auth-form" method="POST">
                        <label for="auth-email" class="form__title">E-mail</label>
                        <input type="email" id="auth-email" name="auth-email" class="form__descr form__descr-auth-email"
                            required placeholder="Введите свой E-mail">
                        <label for="auth-password" class="form__title" autocomplete="current-password">Password</label>
                        <input type="password" id="auth-password" name="auth-password"
                            class="form__descr form__descr-auth-password" required placeholder="Введите свой пароль">
                        <button type="submit" class="form__btn form__btn-auth btn-reset">Войти</button>
                    </form>
                    <?php
                    if (isset($auth_error)) {
                        echo "<div class='auth-error'>" . $auth_error . "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>