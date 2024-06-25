<?php
require_once 'db.php';
session_start();

// Проверяем, есть ли данные пользователя в сессии
if (isset($_SESSION['user'])) {
    $userName = $_SESSION['user']['user_name'];
    $userRole = $_SESSION['user']['user_role'];
    $userId = $_SESSION['user']['user_id'];

    // Получение списка заявок пользователя
    $sql = "SELECT * FROM consultations WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $consultations = $stmt->get_result();
} else {
    // Если данные пользователя в сессии отсутствуют, перенаправляем на страницу авторизации
    header("Location: formAuth.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1 class="userpanel__title">Добро пожаловать в свой профиль, <?php echo $userName; ?>!</h1>
        <p class="userpanel__descr">Здесь вы можете видеть свои заявки на услуги</p>

        <!-- Вывод информации о ранее отправленных заявках -->
        <h2 class="userpanel__descr-cons-title">Ваши заявки на консультацию:</h2>

        <?php 
if ($consultations->num_rows > 0) {
    while ($row = $consultations->fetch_assoc()) { 
?>
            <p class='userpanel__descr-cons'>Статус: <?php echo $row['status']; ?></p>
        <?php 
    } 
} else {
    echo "<p class='userpanel__descr-cons'>Нет заявок</p>";
}
?>

        <h2 class="userpanel__descr-cons-title">Ваши заявки на услуги:</h2>
        <?php
// Получение списка заявок текущего пользователя
$user_id = $_SESSION['user']['user_id'];
$stmt = $conn->prepare("SELECT sr.id, sr.status, sr.phone FROM service_requests sr WHERE sr.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
        <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p class='userpanel__descr-cons'> Статус: " . $row["status"] . "</p>";
    }
} else {
    echo "<p class='userpanel__descr-cons'>Нет заявок</p>";
}
?>
        <a class="userpanel__link" href="index.php">Вход</a>
        <a class="userpanel__link" href="logout.php">Logout</a>
    </div>
    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
</body>

</html>
<style>
.userpanel__title {
    margin-top: 45px;
    color: #474766;
    font-size: 32px;
    font-weight: 400;
    margin-bottom: 15px;
}

.userpanel__descr {
    color: #474766;
    font-size: 24px;
    font-weight: 400;
    margin-bottom: 30px;
}

.userpanel__link {
    display: inline-block;
    text-align: center;
    color: #FFF;
    font-size: 16px;
    font-weight: 400;
    padding: 8px 70px;
    border-radius: 20px;
    background-color: #222;
    margin-top: 50px;

}

.userpanel__descr-cons {
    color: #333;
    font-size: 20px;
    font-weight: 400;

}

.userpanel__descr-cons:not(:last-child) {
    margin-bottom: 10px;
}

.userpanel__descr-cons-title {
    color: #474766;
    font-size: 24px;
    margin-bottom: 10px;
}

.userpanel__link:not(:last-child) {
    margin-right: 30px;
}
</style>