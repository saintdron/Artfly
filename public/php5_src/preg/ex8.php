<?php ## ��������� "������" � "�������" ���������������.
$str = '[b]������ ����� [b]� ��� - ��� ������[/b] ���������[/b]';
$to  = '<b>$1</b>';
$re1 = '|\[b\] (.*)  \[/b\]|ixs';
$re2 = '|\[b\] (.*?) \[/b\]|ixs';
$result = preg_replace($re1, $to, $str);
echo "������ ������: ".htmlspecialchars($result)."<br>";
$result = preg_replace($re2, $to, $str);
echo "������� ������: ".htmlspecialchars($result)."<br>";
?>