<?php ## ��� ������� �������� ���������� ������ DOM
require_once 'unicode.inc';
$domdocument=new domDocument('1.0',Encoding);   //��������

$element1=$domdocument->createElement('body');
$element2=new domElement('body');
?>
