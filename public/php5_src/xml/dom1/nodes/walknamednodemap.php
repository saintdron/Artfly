<?php ## ������������� ����������������� � ������� �������
      ##  � ����� ������ ������ NamedNodeMap
require_once 'unicode.inc';
$xml="<?xml version='1.0' encoding='".Encoding."'?>
<root attr1='1' attr2='2'
  ><child>1-� �������� ����</child
  ><child>2-� �������� ����</child
  ></root>";
$dom=new domDocument();
$dom->loadXML($xml);
$root=$dom->documentElement;
$namedNodeMap=$root->attributes;//�������� ������ ��������� root
echo "����� ���������: $namedNodeMap->length\r\n";
for ($i=0;$i<$namedNodeMap->length;$i++) {
    $attr=$namedNodeMap->item($i);//i-� �������
    echo "������� $i: ";
    echo utf8decode("$attr->nodeName='$attr->nodeValue'\r\n");
}
$attrname='attr2';
$attr2=$namedNodeMap->getNamedItem($attrname);
echo "������� � ������ $attrname :";
echo utf8decode("$attr2->nodeName='$attr->nodeValue'\r\n");
?>
