<?php ## Пример функции и ее использования.
// функция принимает ассоциативный массив и создает несколько
// тегов <option value="$key">$value, где $key - очередной 
// ключ массива, а $value - очередное значение. Если задан
// также и второй параметр, то у соответствующего тега option
// проставляется атрибут selected.
function selectItems($items, $selected=0) { 
  $text = "";
  foreach ($items as $k=>$v) { 
    if ($k === $selected) $ch = " selected"; else $ch = "";
    $text .= "<option$ch value='$k'>$v</option>\n";   
  }  
  return $text;
}
// Предположим, что у нас есть массив имен и фамилий.
$names = array(
  "Weaving"  => "Hugo",
  "Goddard"  => "Paul", 
  "Taylor"   => "Robert",
);
// Если был выбран элемент, вывести информацию.
if (isset($_REQUEST['surname'])) {
  $name = $names[$_REQUEST['surname']];
  echo "Вы выбрали: {$_REQUEST['surname']}, {$name} ";
}
?>
<!-- Форма для выбора имени человека. -->
<form action="<?=$_SERVER['SCRIPT_NAME']?>" method=post>
  Выберите имя: 
  <select name=surname>
    <?=selectItems($names, $_REQUEST['surname'])?>
  </select><br>
  <input type=submit value="Узнать фамилию">
</form>
