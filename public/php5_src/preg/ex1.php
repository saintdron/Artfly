<?php ## ������ ������.
// ���������, ��� � ������ ���� ����� (���� ��� ����� �����).
preg_match('/(\d+)/s', "article_123.html", $pockets);
// ���������� (������������ � �������) �������� � $pockets[1].
echo $pockets[1]; // ������� 123
?>