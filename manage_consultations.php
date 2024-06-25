<?php
// Подключение к базе данных
require_once 'db.php';

// Обработка формы обновления статуса заявки
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE consultations SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        $status_updated = true; // Флаг успешного обновления статуса
    } else {
        echo "Ошибка при обновлении статуса заявки: " . $stmt->error;
    }
}

// Получение списка заявок из базы данных
$sql = "SELECT * FROM consultations";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление заявками</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <section class="manage-consultations">
        <div class="container">
        <h1 class="hero__block-title">Управление заявками</h1>
        <?php if (isset($status_updated) && $status_updated) { ?>
            <div class="success-message">Статус изменен</div>
        <?php } ?>
        <table>
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Отчество</th>
                    <th>Email</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['surname']; ?></td>
                    <td><?php echo $row['patronymic']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $row['id']; ?>">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <select name="status">
                                <option value="на рассмотрении" <?php if ($row['status'] == 'на рассмотрении') echo 'selected'; ?>>На рассмотрении</option>
                                <option value="одобрено" <?php if ($row['status'] == 'одобрено') echo 'selected'; ?>>Одобрено</option>
                            </select>
                            <button type="submit">Обновить</button>
                        </form>
                    </td>
                    <td>
                    <a href="edit_consultation_details.php?id=<?php echo $row['id']; ?>" class="btn">Редактировать</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
    </section>
</body>
</html>

