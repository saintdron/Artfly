<?php ## ���������� �������� (������ � CGI-������ PHP!)
// ������� ��������� ���������� ��������.
Header("Status: 200 OK");
// �������� URI-���������� �������� �������.
$dir = dirname($_SERVER['SCRIPT_NAME']);
// ������������ ������������� �� ����������� (!) URI.  
Header("Location: $dir/result.php");
exit();
?>