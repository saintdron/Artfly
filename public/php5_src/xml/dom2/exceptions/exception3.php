<?php ## ������ �������� ������������� XML-��������� ������� loadXML()
$xml="<root><child11/><child2/></root1>";
$dom=new domDocument();
$ret=$dom->loadXML($xml);
echo $dom->saveXML();
