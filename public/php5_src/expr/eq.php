<?php ## ��������� ��������� � ���������������.
$yeap = array("����������", true);
$nein = array("����������", "���������");
if ($yeap == $nein)  echo iconv("Windows-1251", "UTF-8","��� ������� �����");
if ($yeap === $nein) echo "��� ������� ������������";