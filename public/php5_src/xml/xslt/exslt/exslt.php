<?php ## ������ exslt.php
$domxsl=new domDocument();
$domxsl->load($argv[1]);//��������� XSL-����

$domxml=new domDocument();
$domxml->substituteEntities=true;      //���������� �����������
$domxml->preserveWhiteSpace=false;      //������ �����������
$domxml->load($argv[2]); //��������� XML-����

$xsl=new xsltProcessor();//������� XSLT-���������
if (!$xsl->hasExsltSupport()) exit;

@$xsl->importStylesheet($domxsl); //��������������� XSLT-��������

echo $xsl->transformtoXML($domxml); //��������� �������������
?>


