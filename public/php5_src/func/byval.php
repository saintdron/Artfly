<?php ## �������� ���������� �� ��������.
function increment($a) { 
  echo "������� ��������: $a<br>";
  $a++;
  echo "����� ����������: $a<br>";
}
# ...
$num = 10;
echo "��������� ��������: $num<br>";
increment($num);
echo "����� ������ �������: $num<br>";
?>
