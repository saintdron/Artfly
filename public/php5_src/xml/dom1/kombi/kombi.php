<?php ## ��������������� ������� ������������ DOM-������
require_once 'unicode.inc';
/**
 * ������� ������ ������ domDocument �� ������ XML-���������,
 * ��������������� �������� script1.php
 *
 * @return  ��������� ������ domDocument
 */
function loadprogram()
{
    $domdocument=new domDocument('1.0',Encoding);
    ob_start();     //�������� ����������� ������
    include_once 'script1.php';  //���������� ������ XML-����������
    //��������� DOM-������ �� ������ ����������� ������
    $domdocument->loadXML(ob_get_contents());
    ob_end_clean(); //�������� ����� � ��������� �����������
    return $domdocument;
}

$domdocument=loadprogram();   //������������ XML-��������
echo $domdocument->saveXML(); //���������� ���
?>
