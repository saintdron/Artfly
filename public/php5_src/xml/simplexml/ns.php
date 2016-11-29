<?php ## ����� ��������� �� ������� XPATH � ���������
      ##  ������������� ����
include 'unicode.inc';
$xml="<?xml version='1.0' encoding='".Encoding."'?>
<root xmlns:a='http://...ns1' xmlns='http://...ns2'>
 <a:child1>�����1</a:child1>
 <child2>�����2</child2>
 <child1>�����3</child1>
 <child xmlns='http://...ns1'>
     <child1>�����4</child1>
     <child1>�����5</child1>
 </child>
</root>";

//�������� ���������
$sxml=simplexml_load_string($xml);//�������� XML-���������
//���������� �������� A ������� � �������� ���� http://...ns1
$sxml->register_ns('A','http://...ns1');
//����� ���� ��������� � ������ child1 � ������� ���� http://...ns1
$list=$sxml->xsearch('//A:child1');

//����� �������� ��������� ���������
foreach($list as $element)
    echo utf8decode("$element\r\n");
?>
