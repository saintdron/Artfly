<?php ## �������� ����� ������� songsPHPToDo�.php
require_once ('xslmodify+.inc');
$importlevel=3; 	//������� ����������� XSLT-��������
$nsong=0; //����� ������� �����
$outputformat='xml';
$xslfile='songs.xsl';   //XSLT-����
$xmlfile='songs.xml';   //XML-����

if ($argc>1) $importlevel=$argv[1];
if ($argc>2) $nsong=$argv[2];
if ($argc>3) $outputformat=$argv[3];
if ($argc>4) $xslfile=$argv[4];
if ($argc>5) $xmlfile=$argv[5];

$domxml=new domDocument();
$domxml->substituteEntities=true;      //���������� �����������
$domxml->load($xmlfile); //��������� XML-����

$domxsl=new domDocument();
$domxsl->load($xslfile);//��������� XSL-����

//��������� xsl-����� ���������� ������
setImportsLevel($domxsl,$importlevel);
//���������� ������ �������
setOutputFormat($domxsl,$outputformat);

$xsl=new xsltProcessor();//������� XSLT-���������
@$xsl->importStylesheet($domxsl); //��������������� XSLT-��������

//�������� XSLT-��������� �������� nsong - ����� ������� �����
$xsl->setParameter('','nsong',$nsong);

require_once ('xsltphpfuncs.inc');  //��������� PHP-�������
$xsl->registerPHPFunctions();   //��������������� ��
$outdom=$xsl->transformtoDOC($domxml); //��������� �������������
addSummaryInfo($outdom);    //�������� �������� ����������

include "nstoxhtml.inc";
$outdom=nstoxmhtl($outdom);     //������� � ����������� xhtml
$outdom->formatOutput=true;
echo $outdom->saveXML();        //����� ���������
?>
