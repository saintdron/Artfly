<?php ## ������ ������ �������� �� ��������������
include 'unicode.inc';
$dom=new domDocument('1.0',Encoding);
$dom->load('Song.xml'); //��������� ����� � ������������ �������������� id
$id2=$dom->getElementById(2);   //����� ������� � ��������������� id=2
echo utf8decode($dom->saveXML($id2))."\r\n";//���������� ��������� �������
?>
