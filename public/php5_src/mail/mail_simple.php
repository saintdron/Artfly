<?php ## Отправка почты по шаблону (плохой вариант).
// Этот текст может быть получен, например, из базы данных,
// или являться сообщением форума или гостевой книги.
$text = "Cookies need love like everything does.";
// Получатели письма.
$tos = array("a@mail.ru", "b@mail.ru");
// считываем шаблон.
$tpl = file_get_contents("mail.eml");
// Отправляем письма в цикле по получателям.
foreach ($tos as $to) {
  // Заменяем элемент шаблонаà.
  $mail = $tpl;
  $mail = strtr($mail, array(
    "{TO}"   => $to,
    "{TEXT}" => $text,
  ));
  // Разделяем тело сообщения и заголовки.
  list ($head, $body) = preg_split("/\r?\n\r?\n/s", $mail, 2);
  // Отправляем почту. Внимание! Опасный прием!
  mail("", "", $body, $head);
}
?>
