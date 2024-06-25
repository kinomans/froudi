<?php
// Подключение к базе данных
require_once 'db.php';

// Получение данных заявки по ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM consultations WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}

// Обработка формы обновления данных заявки
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['patronymic']) && isset($_POST['email'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $patronymic = $_POST['patronymic'];
    $email = $_POST['email'];

    $sql = "UPDATE consultations SET name = ?, surname = ?, patronymic = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $surname, $patronymic, $email, $id);

    if ($stmt->execute()) {
        $data_updated = true; // Флаг успешного обновления данных
    } else {
        echo "Ошибка при обновлении данных заявки: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование заявки</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <section class="edit-consultation-details">
        <h1>Редактирование заявки</h1>
        <?php if (isset($data_updated) && $data_updated) { ?>
            <div class="success-message">Данные успешно изменены</div>
            <script>
                setTimeout(function() {
                    window.location.href = 'manage_consultations.php';
                }, 3000);
            </script>
        <?php } else { ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $row['id']; ?>">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>

            <label for="surname">Фамилия:</label>
            <input type="text" id="surname" name="surname" value="<?php echo $row['surname']; ?>" required>

            <label for="patronymic">Отчество:</label>
            <input type="text" id="patronymic" name="patronymic" value="<?php echo $row['patronymic']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>

            <button type="submit">Обновить</button>
        </form>
        <?php } ?>
    </section>
</body>
</html>



