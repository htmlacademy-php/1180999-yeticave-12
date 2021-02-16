<?php
/**
 * Функция загружает файл в папку 'uploads/' и возвращает ссылку на загруженный файл
 * @param array $file массив с данными о файле
 * @return string|null если файл успешно загружен, возвращает ссылку на загруженный файл
 */
function upload_file(array $file): ?string
{
    if (!empty($file['image']['name'])) {
        $file_name = $file['image']['name'];
        $file_temp = $file['image']['tmp_name'];
        $file_path = __DIR__ . '/uploads/';
        $file_status = move_uploaded_file($file_temp, $file_path . $file_name);

        if ($file_status == true) {
            return 'uploads/' . $file_name;
        } else {
            exit('При загрузке файла, произошла критическая ошибка');
        }
    }
    return null;
}

