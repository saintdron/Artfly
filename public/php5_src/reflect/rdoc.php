<?php ## ����������������.
/**
 * ������������ ��� ��������� ����
 * ������� (����� "/**" �� ������ ���� ��������!)
 */
function func() {}
$obj = new ReflectionFunction("func");
echo "<pre>".$obj->getDocComment()
?>