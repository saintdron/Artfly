<?php ## ����� ������ �������.
// ����������� ���������� ��������� � include_path.
require_once "lib/config.php"; 
// �������� ������.
require_once "Math/Complex.php";
// ������� ����� ������ ������ Math_Complex.
$obj = new Math_Complex;
// ����������� ��������� �������� ���������.
$obj->re = 16.7;
$obj->im = 101;
// ����� ������ add() � ����������� (18.09, 303) ������� $obj.
$obj->add(18.09, 303);
// ������� ���������:
echo "({$obj->re}, {$obj->im})";
?>
