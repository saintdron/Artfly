<?php ## �������� ������� ������������ ������.
require_once "lib/config.php"; 
require_once "Math/Complex2.php";
// ����� ��� ������ �������� � ���������� $className.
$className = "Math_Complex2";
// ������� ����� ������.
$obj = new $className(6, 1);
echo "��������� ������: $obj";
?>