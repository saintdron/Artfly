<?php ## ���������� set_error_handler().
echo "������ ���������.<br>";
set_error_handler("handler");
{
  // ���, � ������� ��������������� ����������.
  echo "���, ��� ����� ������...<br>";
  // ���������� ("�����������") ����������.
  trigger_error("Hello!");
  echo "...����� � �����.<br>";  
}
echo "����� ���������.<br>";
// �������-����������.
function handler($num, $str) {
  // ��� �����������.
  echo "������: $str<br>";
  exit();
}
?>