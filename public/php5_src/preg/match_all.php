<?php ## ��������� ����� preg_match_all().
Header("Content-type: text/plain");
$flags = array(
  "PREG_PATTERN_ORDER",
  "PREG_SET_ORDER",
  "PREG_SET_ORDER|PREG_OFFSET_CAPTURE",
);
$re   = '|<(\w+).*?>(.*?)</\1>|s';
$text = "<b>�����</b>  � ��� <i>������ �����</i>";
echo "������: $text\n";
echo "���������: $re\n\n";
foreach ($flags as $name) {
  preg_match_all($re, $text, $pockets, eval("return $name;"));
  echo "���� $name:\n";
  print_r($pockets);
  echo "\n";
}
?>