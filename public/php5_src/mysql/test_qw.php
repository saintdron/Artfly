<?php
require_once "lib/mysql_qw.php";
require_once "mysql_connect.php";
// ����������, ��� �� - ������...
$name = "' OR '1";
// ���������� ������.
echo mysql_make_qw('DELETE FROM people WHERE name=?', $name)."<br>";
// ������������ ������.
echo mysql_make_qw('DELETE FROM people WHERE name=? OR ?', $name)."<br>";
// ��� ��� �������� ���������� �������.
mysql_qw('DELETE FROM people WHERE name=? OR ?', $name)
  or die(mysql_error());
?>