<?php ## �������� ��������� �������.
$mul = create_function('$a,$b', 'return $a*$b;');
$neg = create_function('$a', 'return -$a;');
echo $mul(10, 20) . "<br>";  // ������� 200
echo $neg(2) . "<br>";       // ������� -2
?>
