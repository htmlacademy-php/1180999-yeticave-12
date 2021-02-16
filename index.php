<?php
/**
 * Описание переменных
 * @var mysqli $connection идентификатор соединения БД
 * @var string $title заголовок страницы
 * @var int $is_auth флаг авторизации
 * @var string $user_name имя пользователя
 * @var string $content шаблон главной страницы
 * @var string $footer шаблон футера
 */

require_once('bootstrap.php');

$lots = get_active_lots($connection);
$categories = get_categories($connection);

$main_menu = include_template('/menu/promo_menu.php', ['categories' => $categories]);
$main_page = include_template('main.php', ['promo_menu' => $main_menu, 'lots' => $lots]);
$main_footer = include_template('footer.php', ['categories' => $categories]);
$layout_content = include_template('layout.php', [
    'content' => $main_page,
    'footer' => $main_footer,
    'title' => $title,
    'user_name' => $user_name,
    'is_auth' => $is_auth,
    ]
);

print($layout_content);

