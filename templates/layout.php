<?php
/**
 * @var string $title заголовок страницы
 * @var int $is_auth флаг авторизации
 * @var string $user_name имя пользователя
 * @var string $content шаблон главной страницы
 * @var string $footer шаблон футера
 */
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link href="../css/normalize.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/flatpickr.min.css" rel="stylesheet">
</head>
<body>
    <div class="page-wrapper">
    <header class="main-header">
        <div class="main-header__container container">
            <h1 class="visually-hidden">YetiCave</h1>
            <a class='main-header__logo' href="/">
                <img src="../img/logo.svg" width="160" height="39" alt="Логотип компании YetiCave">
            </a>
            <form class="main-header__search" method="get" action="https://echo.htmlacademy.ru" autocomplete="off">
                <label class="page__item--hidden" for="search">Поиск</label>
                <input id="search" type="search" name="search" placeholder="Поиск лота">
                <input class="main-header__search-btn" type="submit" name="find" value="Найти">
            </form>
            <a class="main-header__add-lot button" href="add.php">Добавить лот</a>

            <nav class="user-menu">
            <!-- здесь должен быть PHP код для показа меню и данных пользователя -->
            <?php if ($is_auth === 1): ?>
                <div class="user-menu__logged">
                    <p><?= $user_name ?></p>
                    <a class="user-menu__bets" href="/pages/my-bets.html">Мои ставки</a>
                    <a class="user-menu__logout" href="#">Выход</a>
                </div>
            <?php else: ?>
                <ul class="user-menu__list">
                    <li class="user-menu__item">
                    <a href="/sign-up.php">Регистрация</a>
                    </li>
                    <li class="user-menu__item">
                    <a href="#">Вход</a>
                    </li>
                </ul>
            <?php endif; ?>
            </nav>
        </div>
        <?= $top_menu ?? '' ?>
    </header>
    <main class="container"><?= $content ?></main>
</div>

<footer class="main-footer"><?= $footer ?></footer>

<script src="../flatpickr.js"></script>
<script src="../script.js"></script>
</body>
</html>
