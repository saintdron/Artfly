<?php ## ������ �������� ���� ��������
require_once 'unicode.inc';
$domdocument=new domDocument('1.0',Encoding);   //��������

$tablenode=$domdocument->createElement('table');//�������� �������
$domdocument->appendChild($tablenode);  //�������� � ���������

$attrnode=$domdocument->createAttribute('width');//������� ������� width
$tablenode->setAttributeNode($attrnode);//�������� ��� � ��������
$textnode=$domdocument->createTextNode('100%'); //������� ���� ��������
$attrnode->appendChild($textnode); //������������ ��� � ��������

$domdocument->formatOutput=true;
$tablexml=utf8decode($domdocument->saveXML($tablenode));
echo $tablexml; //������� XHTML ����� �������
?>
