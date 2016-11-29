<?php ## �������� ������ � ��������������.
// ���������� ����� �������-����������.
function myErrorHandler($errno, $msg, $file, $line) {
  // ���� ������������ @, ������ �� ������.
  if (error_reporting() == 0) return;
  // ����� - ������� ���������.
  echo '<div style="border-style:inset; border-width:2">';
  echo "��������� ������ � ����� <b>$errno</b>!<br>"; 
  echo "����: <tt>$file</tt>, ������ $line.<br>";  
  echo "����� ������: <i>$msg</i>";    
  echo "</div>";
}
// ������������ �� ��� ���� ����� ������.
set_error_handler("myErrorHandler", E_ALL);
// �������� ������� ��� ��������������� �����, ����� 
// ������������� ��������������, ������� ����� �����������.
filemtime("spoon");
?>
