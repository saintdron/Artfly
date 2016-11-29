<?php ## "Активизация" HTML-ссылки.
$text = 'Ссылка: (http://thematrix.com), www.ru?"a"=b, http://lozhki.net.';
echo hrefActivate($text);

// Функция обратного вызова для preg_replace_callback().
function hrefCallback($p) {
  // Преобразуем спецсимволы в HTML-представление.
  $name = htmlspecialchars($p[0]);
  // если нет протокола, добавляем его в начало строки.  
  $href = !empty($p[1])? $name : "http://$name";
  // формируем ссылки.
  return "<a href=\"$href\">$name</a>";
}

// Заменяем ссылки на их HTML-эквиваленты ("подчеркивает ссылки").
function hrefActivate($text) {
  return preg_replace_callback(
    '{
      (?:
        (\w+://)          # протокол с двумя слэшами
        |                 # - или -
        www\.             # просто начинается на www
      )
      [\w-]+(\.[\w-]+)*   # имя хоста
      (?: : \d+)?         # порт (не обязателен)
      [^<>"\'()\[\]\s]*   # URI (но без кавычек и скобок)
      (?:                 # последний символ должен быть...
          (?<! [[:punct:]] )  # НЕ пунктуацией
        | (?<= [-/&+*]     )  # но допустимо окончание на -/&+*
      )
    }xis',
    "hrefCallback",
    $text
  );
}   
?>
