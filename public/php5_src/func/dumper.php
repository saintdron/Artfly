<?php ## Функция вывода содержимой переменной.
// Распечатывает дамп переменной на экран.
function dumper($obj) {
  echo
    "<font size=2><pre>",
      htmlspecialchars(dumperGet($obj)),
    "</pre></font>";
}

// Возвращает строку- дамп значения переменной в древовидной форме
// (если это массив или объект). В переменной $leftSp хранится
// строка спробелами, которая будет выводиться слева от текста.
function dumperGet(&$obj, $leftSp="") {
  if (is_array($obj)) {
    $type = "Array[".count($obj)."]";
  } elseif (is_object($obj)) {
    $type = "Object";
  } elseif (gettype($obj) == "boolean") {
    return $obj ? "true" : "false";
  } else {
    return "\"$obj\"";
  }
  $buf = $type;
  $leftSp .= "    ";
  for (Reset($obj); list($k, $v) = each($obj); ) {
    if ($k === "GLOBALS") continue;
    $buf .= "\n$leftSp$k => ".dumperGet($v, $leftSp);
  }
  return $buf;
}
?>
