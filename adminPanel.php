<?php
session_start();

// Проверяем, есть ли данные администратора в сессии
if (isset($_SESSION['user']) && $_SESSION['user']['user_role'] == 'admin') {
    $adminName = $_SESSION['user']['user_name'];
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/services.css">
</head>

<body>
    <?php
require_once 'db.php';
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    $userName = $_SESSION['user']['user_name'];
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <main class="main">
            <div class="container">
                <h1 class="adminpanel__title">Добрый день, уважаемый <?php echo $userName; ?>!</h1>
                <p class="adminpanel__descr">Здесь вы можете управлять всеми аспектами работы сайта и обеспечивать его
                    эффективное функционирование.</p>
                <!-- Add your admin-specific content here -->
                <p class="adminpanel__descr-2">Управление услугами: вы можете редактировать, добавлять и удалять услуги
                    на сайте.</p>
                <a href="add.php" class="adminpanel__link">Редактировать услуги</a>
                <a href="manage_consultations.php" class="adminpanel__link">Управление заявками</a>
                <a href="logout.php" class="adminpanel__link">Logout</a>
            </div>
        </main>
        <script src="js/script.js"></script>
        <style>
        .adminpanel__title {
            margin-top: 50px;
            color: #474766;
            font-size: 48px;
            font-weight: 400;
            margin-bottom: 55px;
        }

        .adminpanel__descr {
            max-width: 1106px;
            color: #474766;
            font-size: 36px;
            font-weight: 400;
            margin-bottom: 35px;
        }

        .adminpanel__descr-2 {
            max-width: 885px;
            color: #474766;
            font-size: 22px;
            font-weight: 400;
            margin-bottom: 20px;
        }

        .adminpanel__btn {}

        .adminpanel__link {
            display: inline-block;

            text-align: center;
            color: #FFF;
            font-size: 19px;
            font-weight: 400;
            padding: 10px 90px;
            border-radius: 20px;
            background-color: #222;
        }
        </style>
    </body>

    </html>