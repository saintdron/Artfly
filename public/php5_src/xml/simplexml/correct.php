<?php ## ������ ������������� ��������� ����� ���������
include 'unicode.inc';
$xml="<?xml version='1.0' encoding='".Encoding."'?>
<root>
 <child1>�����</child1>
 <child2>�����</child2>
 <child1>�����</child1>
</root>";

//�������� ���������
$sxml=simplexml_load_string($xml);//�������� XML-���������

//������������� �������� child2
$sxml->child2.=utf8encode("+����������� �����");
$sxml->child2['add']=utf8encode('����������� �������');

//������������� ��������� child1
$sxml->child1[0].=utf8encode("+����������� �����");
$sxml->child1[1].=utf8encode("+����������� �����");
$sxml->child1[0]['add']=utf8encode('����������� �������');
$sxml->child1[1]['add']=utf8encode('����������� �������');

//����� ���������
echo $sxml->to_xml_string();
?>
