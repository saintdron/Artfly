<?php ## ����������� global.
$a = 100;
function test() {
  global $a;
  unset($a);
}
test();
var_dump($GLOBALS);
echo $a;  // ������� 100, �. �. ��������� $a �� ���� ������� � test()!
?>
