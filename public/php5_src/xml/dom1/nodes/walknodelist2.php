<?php ## ����� �������� ����� � �������������� �������
      ## firstChild � nextSibling
require_once 'unicode.inc';
$xml="<?xml version='1.0' encoding='".Encoding."'?>
<root attr1='1' attr2='2'
  ><child>1-� �������� ����</child
  ><child>2-� �������� ����</child
  ></root>";
$dom=new domDocument();
$dom->loadXML($xml);
$root=$dom->documentElement;
echo "����� �������� �����: {$root->childNodes->length}\r\n";
$i=0;
for ($child=$root->firstChild;$child;$child=$child->nextSibling) {
    echo "���� $i: ";
    echo utf8decode("$child->nodeName='$child->nodeValue'\r\n");
    $i++;
}
?>
