<?php ## ������ ������ ����� 1-�� ������
$xml="<root><child1/><child2/></root>";
$dom=new domDocument();
$dom->loadXML($xml);
echo "�������� ��������: \r\n";echo $dom->saveXML();
$root=$dom->documentElement;
$nodelist=$root->childNodes;    //������ ����� 1-�� ������
$child0=$dom->createElement('child0');
$root->insertBefore($child0,$root->firstChild);
echo "\r\n����������������� ��������: \r\n";echo $dom->saveXML();
echo "\r\n���������� ��������� � ����� ������:\r\n";
for ($i=0;$i<$nodelist->length;$i++) {
    $child=$nodelist->item($i);
    $child->setAttribute('id',$i);
}
echo "�������� ��������: \r\n";echo $dom->saveXML();
?>
