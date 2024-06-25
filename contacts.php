<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contacts.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <main class="main">
        <section class="contacts">
            <div class="container contacts__container">
                <h2 class="contacts__title">Контакты</h2>
                <div class="contacts__blocks">
                    <div class="contacts__block">
                        <div class="contacts__block__content">
                            <h3 class="contacts__block__content-title">Адрес</h3>
                            <div class="contacts__block__content-block-descr-street">
                                <p class="contacts__block__content-descr">Москва, улица Юности, дом 5 строение 4, офис 2
                                </p>
                            </div>
                        </div>
                        <div class="contacts__block">
                            <div class="contacts__block__content">
                                <h3 class="contacts__block__content-title">Телефоны</h3>
                                <div class="contacts__block__content-block-descr-phone">
                                    <p class="contacts__block__content-descr">+7 (499) 535-64-34</p>
                                    <p class="contacts__block__content-descr">+7 (495) 005-05-44</p>
                                </div>
                            </div>
                            <div class="contacts__block">
                                <div class="contacts__block__content">
                                    <h3 class="contacts__block__content-title">E-mail</h3>
                                    <div class="contacts__block__content-block-descr-mail">
                                        <p class="contacts__block__content-descr">info@analitikprodaj.ru</p>
                                        <p class="contacts__block__content-descr">iпо вопросам бронирования</p>
                                        <p class="contacts__block__content-descr">info@analitikprodaj.ru</p>
                                        <p class="contacts__block__content-descr">по вопросам сотрудничества</p>

                                    </div>
                                </div>
                                <div class="contacts__block">
                                    <div class="contacts__block__content">
                                        <h3 class="contacts__block__content-title">График</h3>
                                        <div class="contacts__block__content-block-descr-graph">
                                            <p class="contacts__block__content-descr">Понедельник - пятница, с 10:00 до
                                                19:00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn-reset contacts__block-btn">Построить маршрут</button>
                        </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
</body>

</html>