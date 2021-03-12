<?php

/**
 * Функция обработки числовых параметров
 * @param string $id принимаеый параметр id
 * @return int|null в случае успешной проверки, возвращает целое число
 */
function get_param_id(string $id): ?int
{
    $id = $id ?? null;
    if (!$id || !is_numeric($id)) {
        return null;
    }
    return (int) $id;
}

/**
 * Функция возвращает введенное значение текстового поля формы
 * Ограничение: запросы методом POST
 * @param string $name название поля в форме добавления лота
 * @return string возвращает введенное значение поля формы
 */
function get_post_value(string $name) : string
{
    return $_POST[$name] ?? '';
}

/**
 * Функция возвращает введенное значение текстового поля формы
 * Ограничение: запросы методом GET
 * @param string $name название поля в форме добавления лота
 * @return string возвращает введенное значение поля формы
 */
function get_field_value(string $name) : string
{
    return $_GET[$name] ?? '';
}

/**
 * Возвращает номер текущей страницы
 * @param array $data
 * @return int если номера нет, возвращает номер страницы поумолчанию - 1
 */
function get_current_page_number(array $data) : int
{
    if (empty($data['page'])) {
        return 1;
    }
    return (int) $data['page'];
}

/**
 * @param int $count_total_founded_lots
 * @param int $lots_per_page
 * @return int
 */
function calculate_total_page_count(int $count_total_founded_lots, int $lots_per_page) : int
{
    return (int) ceil($count_total_founded_lots / $lots_per_page);
}

/**
 * @param array $mailer
 * @param string $user_email
 * @param string $text
 */
function notify_winner(array $mailer, string $user_email, string $text) :void
{
    $transport = new Swift_SmtpTransport($mailer['host'], $mailer['port'], $mailer['encryption']);
    $transport->setUsername($mailer['username']);
    $transport->setPassword($mailer['password']);

    $message = new Swift_Message('YetiCave');
    $message->setTo($user_email);
    $message->setBody($text, 'text/html');
    $message->setFrom($mailer['username'], "YetiCave");

    $mailer = new Swift_Mailer($transport);
    $mailer->send($message);
}

/**
 * @param mysqli $connection
 * @param array $lot
 * @return int|null
 */
function complete_lot(mysqli $connection, array $lot): ?int
{
    $bets = get_last_bet_of_lot($connection, $lot['id']);
    if (!empty($bets)) {
        add_winner_to_lot($connection, $lot['id'], $bets['user_id']);
        return $bets['user_id'];
    }
    return null;
}
