<?php ## ����� ���� � ������ <��������> � ��������� �������
include 'unicode.inc';
$dom=new domDocument('1.0',Encoding);
$dom->load('SONG.xml');
$stress=$dom->getElementsByTagname(utf8encode('��������'));
for ($i=0;$i<$stress->length;$i++) {
    $node=$stress->item($i);
    echo utf8decode($dom->saveXML($node))."\n";
}
?>
