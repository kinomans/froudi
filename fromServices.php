<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница Услуг</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/services.css">
    <link rel="stylesheet" href="css/application.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <main class="main">
        <section class="services">
            <div class="container services__container">
                <h2 class="hero__services__title">Услуги</h2>
                <div class="hero__services__blocks">
                    <!-- fromServices.php -->
                    <?php
require_once 'db.php';

// Получение списка товаров
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

                    <?php if ($result->num_rows > 0) { ?>
                    <?php while($row = $result->fetch_assoc()) { ?>
                    <div class="hero__services__block">
                        <img class="hero__services__block__content-img"
                            src="uploads/<?php echo $row["image_products"]; ?>"
                            alt="<?php echo $row["name_products"]; ?>">
                        <div class="hero__services__block__content">
                            <h3 class="hero__services__block__content-title"><?php echo $row["name_products"]; ?></h3>
                            <p class="hero__services__block__content-descr"><?php echo $row["text_products"]; ?></p>
                            <div class="hero__services__block__content-line"></div>
                            <p class="hero__services__block__content-price">Стоимость услуги:
                                <?php echo number_format($row["price_products"], 2, ",", " "); ?> Р.</p>
                            <button class="btn-reset hero__services__block__content-btn">Приобрести</button>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } else { ?>
                    <p>Нет товаров для отображения.</p>
                    <?php } ?>
                </div>
            </div>
        </section>
        <section class="application">
            <div class="container">
                <h2 class="application__title">Закажите наши услуги уже сегодня!</h2>
                <p class="application__descr">Наша компания предоставляет широкий спектр услуг высочайшего качества. Мы
                    ценим каждого клиента и гарантируем индивидуальный подход к вашим потребностям.</p>
                <p class="application__descr application__descr-2">Заполните форму ниже, и наши специалисты свяжутся с
                    вами в течение 8 рабочих часов, чтобы обсудить детали и составить предложение, которое идеально
                    подойдет именно для вас.</p>
                <p class="application__descr application__descr-3">Просто оставьте свои контактные данные, и мы свяжемся
                    с вами в ближайшее время:</p>
                <form class="application__form" method="POST" action="application.php">
                    <label class="form__title" for="email" class="application__descr">Email:</label>
                    <input class="form__descr form__descr-auth-email" type="email" id="email" name="email"
                        placeholder="Введите свой email" required>
                    <label for="phone" class="application__descr" for="phone">Телефон:</label>
                    <input class="form__descr form__descr-icon-tel" type="tel" id="phone" name="phone"
                        placeholder="Введите свой телефон" required>
                    <input class="application-btn" type="submit" value="Отправить">
                </form>
                <p class="application__descr">Ждем вашего отклика!</p>
            </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>
<style>
.form__descr-icon-tel {
    background-image: url("/img/tel.png");
    background-repeat: no-repeat;
}
</style>