<?php ## ������ ��� �������� ����������������� MySQL.
echo "<pre>";
// ��������� ���������� � ���� MySQL:
// ������������: root, ������: ������.
@mysql_connect("localhost", "root", "")
  or die(mysql_error());
// ����� �������� � ����� ������ "mysql" (���������� �� 
// ��������� � ������ ������������ ������� MySQL).  
@mysql_select_db("mysql")
  or die(mysql_error());
// �������� ��� ������ �� ������� "users" �� "mysql".
$r = @mysql_query("SELECT * FROM user")
  or die(mysql_error());
// � ����� �������� ������ ��������� ������.  
while ($row = mysql_fetch_assoc($r)) {
  print_r($row);
}
?>