<?php ## ������ � ������� ������ � "���������" �����.
require_once "lib/config.php"; 
require_once "PHP/OutputBuffering.php";
// ������������� �������� ����� � ���������.
$h = new PHP_OutputBuffering();
  // ����� ������� � �����.
  echo "������ �������� ���������.<br>";
  // �������� �������, "�� ����", ��� ��� ������������� �����.
  $formatted = inner();
  // �������� ��� ����� � �����.
  echo "����� �������� ���������."; 
  // �������� ��������� ����� �� �������.
  $text = "{$h->__toString()}<br>������� �������: \"$formatted\"";
// ��������� ��������. ����� ����������� ������������� � �����������.  
$h = null;
// �������� ��, ��� �������� � ����������, � ����������� ������.
echo $text;
exit();
// �������, ��������������� �������� ����� � ����� �����.
// �����������, ��� ��� ������ ����� ����� ������������.
function inner() {
  $buf = new PHP_OutputBuffering();
  echo "���� ����� ������� � �����.";
  return "<b>{$buf->__toString()}</b>";
  // �� ����� ���������� � ������ ������ ob_end_clean() -
  // ��� ������������� ������ ���������� ������� $buf!
}
?>