<?php ## ��������� ������� ���� �������� ����� ��� ���������� �����.
// ���������� ����������.
include_once "getmxrr.php";
// ��������� ������ �������.
$host = "thematrix.com";
getmxrr($host, $mxes, $weights)
  or die("�� ������� �������� DNS-������ ��� ����� $host."); 
echo "����� *@$host ����������� ��������� �������� ������:<br>";
for ($i=0; $i<count($mxes); $i++) {
  echo "<li><tt>{$mxes[$i]}</tt>";
  echo " (��� = {$weights[$i]})\n";
}
?>
