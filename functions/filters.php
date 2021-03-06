<?php
/**
 * Функция фильтрации данных из формы добавления лота
 * @param array $form_data
 * @return array возвращает отфильтрованный массив с данными
 */
function filter_form_lot(array $form_data): array
{
    $form_data = filter_form_fields($form_data);

    $form_data['category_id'] = (int)$form_data['category_id'];
    $form_data['price'] = (int)$form_data['price'];
    $form_data['step'] = (int)$form_data['step'];

    return $form_data;
}

/**
 * Функция фильтрации данных из формы
 * @param array $form_data данные из формы
 * @return array возвращает отфильтрованный массив с данными
 */
function filter_form_fields(array $form_data): array
{
    $form_data = array_map(function ($var) {
        return htmlspecialchars($var, ENT_QUOTES);
    }, $form_data);

    return $form_data;
}

/**
 * Функция фильтрации поля поиска
 * @param array $search_data
 * @return string возвращает отфильтрованую строку поля поиска
 */
function filter_search_form(array $search_data): string
{
    $search_data = filter_form_fields($search_data);

    return trim($search_data['search']);
}

