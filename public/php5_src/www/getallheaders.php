<?php ## ��������� ���������� �������.
# �������� ������ ���� PHP ���������� � ���� ������ Apache!
$headers = getallheaders();
Header("Content-type: text/plain");
print_r($headers);
?>
