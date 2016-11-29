<?php ## �������� ������� ������������ ������ (reflection API).
require_once "lib/config.php"; 
require_once "Math/Complex2.php";
// ����� ��� ������ �������� � ���������� $className.
$className = "Math_Complex2";
// ...� ��������� ��� ������������ - � $args.
$args = array(1, 2);
// ������� ������, �������� ��� ���������� � ������.
// ����������, ReflectionClass �������� "�������, ��������
// �������� � ������ ������". �� ������� � PHP5.
$class = new ReflectionClass($className);
// ������� ������ ������ ����� ��������.
$obj = $class->newInstance(101, 303);
echo "������ ������: $obj<br>";
// �� �� �� ������ ������������ $args, � ��������� ���� ������� 
// ��������� ����� �������. ������ ������� ������ ������ ������.
$obj = call_user_func_array(array(&$class, "newInstance"), $args);
echo "������ ������: $obj<br>";
?>