<?php ## Удаление HTML-тегов из строки.
$st = "
  <b>Жирный текст</b>
  <tt>моноширинный текст</tt>
  <a href='http://www.dklab.ru'>Ссылка</a>
  a<x && y>d
";
echo "Исходящий текст $st";
echo "<hr>После удаления тегов: ".strip_tags($st,"<tt><b>");
?>
