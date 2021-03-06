<?php
/**
 * Описание переменных
 * @var mysqli $connection идентификатор соединения БД
 * @var string $title заголовок страницы
 * @var array $config массив с настройками сайта
 */

require_once __DIR__ . '/bootstrap.php';

$categories = get_categories($connection);
$lots_per_page = $config['pagination']['lots_per_page'];
$message = 'Результаты поиска по запросу ';

if (!isset($_GET['search'])) {
    header('Location: /404.php');
    exit();
}

$search = filter_search_form($_GET);
$current_page_number = get_current_page_number($_GET);
$count_total_founded_lots = get_count_total_founded_lots_from_search($connection, $search);
$total_pages_count = calculate_total_page_count($count_total_founded_lots, $lots_per_page);
$lots = search_lots($connection, $search, $lots_per_page, $current_page_number);

if (!$search || $count_total_founded_lots === 0) {
    $message = 'Ничего не найдено по вашему запросу';
}

$main_menu = include_template('/menu/menu.php', ['categories' => $categories]);
$main_page = include_template('search.php', [
    'lots' => $lots,
    'categories' => $categories,
    'search' => $search,
    'message' => $message,
    'total_pages_count' => $total_pages_count,
    'count_total_founded_lots' => $count_total_founded_lots,
    'current_page_number' => $current_page_number,
    'lots_per_page' => $lots_per_page
]);
$main_footer = include_template('footer.php', ['categories' => $categories, 'main_menu' => $main_menu]);
$layout_content = include_template('layout.php', [
    'main_menu' => $main_menu,
    'content' => $main_page,
    'footer' => $main_footer,
    'title' => $title . '| Результаты поиска',
    'form_data' => $search
]);

print($layout_content);
