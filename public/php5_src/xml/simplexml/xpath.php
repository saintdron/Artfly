<?php ## ����� ��������� �� ������� XPATH
include 'unicode.inc';
$xml="<?xml version='1.0' encoding='".Encoding."'?>
<root>
 <child1>�����1</child1>
 <child2>�����2</child2>
 <child1>�����3</child1>
 <child>
     <child1>�����4</child1>
     <child1>�����5</child1>
 </child>
</root>";

//�������� ���������
$sxml=simplexml_load_string($xml);//�������� XML-���������
//����� ���� ��������� � ������ child1
$list=$sxml->xpath('//child1');

//����� �������� ��������� ���������
foreach($list as $element)
    echo utf8decode("$element\r\n");
?>
