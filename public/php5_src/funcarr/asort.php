<?php ## ���������� ������� �� ���������.
$A = array(
  "a" => "Zero",
  "b" => "Weapon",
  "c" => "Alpha",
  "d" => "Processor"
);
arsort($A);
print_r($A);
// Array([c]=>Alpha [d]=>Processor [b]=>Weapon [a]=>Zero)
// ��� �����, ��������� ������ ������� ��� ����=>��������
?>
