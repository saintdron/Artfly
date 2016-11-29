<?php ## Модификация части URL без изменения других его участков.
require_once "lib/http_build_url.php";
// URL, с которым будем работать.
$url = "http://user@example.com:80/path?arg=value#anchor";
// Другие примеры, которые вы можете испробовать.
//   $url = "/path?arg=value#anchor";
//   $url = "thematrix.com";
//   $url = "http://thematrix.com/#top"; # без '/' перед '#' не работает!
// Разбиваем URL на части.
$parsed = parse_url($url);
// Разбиваем одну из частей, QUERY_STRING, на элементы массива.
parse_str(@$parsed['query'], $query);
// Добавляем новый элемент в массив QUERY_STRING.
$query['names']['read'] = 'tom';
// Собираем QUERY_STRING назад из массива.
$parsed['query'] = http_build_query($query);
// Созаем результирующий URLL.
$newurl = http_build_url($parsed);
// Выводим результат работы.
echo "Старый URL: $url<br>";
echo "Новый: $newurl";
?>
