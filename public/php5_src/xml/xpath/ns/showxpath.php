<?php ## ������ showxpath.php ����������� ����������� �������
      ##  � ���������� �������� ����
$xmlfile=$_GET['xmlfile'];      //��� XML-�����
$levels=$_GET['levels']-1;      //����� ������������ �������
$contextpath=$_GET['contextpath'];      //����� ������������ ����
$xpath=stripslashes($_GET['xpath']);          //������ XPATH

include 'shownodes.inc';
include 'unicode.inc';

$document=new domDocument();
$document->preserveWhiteSpace=false;
$document->formatOutput=true;
$document->load($xmlfile);      //��������� ��������

if (!$contextpath)      //�� ����� ����������� ����
    $contextpath='/';   //=> ��������

//������� ���������� ������ domXpath ��� ���������
$domxpath=new domXpath($document);
//���������������� ������� ����
include 'registerns.inc';
$nstable=registerns($domxpath);

//����� ����������� ���� (1-� ������� �������)
$context=@$domxpath->query(utf8encode($contextpath));
if (!$context || $context->length == 0) {
    $error="�������� ����������� ����, ������ ���� �������� ���� /";
    $context=$domxpath->query('/');
}
$context=$context->item(0);
//����� ����, ��������������� �������
$list=$domxpath->query(utf8encode($xpath),$context);
//������������ HTML-��������?>
<HTML>
<HEAD>
<link REL="stylesheet" TYPE="text/css" HREF="style.css"></LINK>
<TITLE>��������� ���������� ������� <?php echo $xpath?>
�� ���� <?php echo $contextpath?>
</TITLE>
</HEAD>
<BODY>
<span CLASS='error'><?php echo @$error?></span>
<?php echo $nstable?>
<TABLE ALIGN=center
><TR><TH>����:</TH><TD><?php echo $xmlfile?></TD></TR
><TR><TH>���� (��������):</TH><TD><?php echo $contextpath?></TD></TR
><TR><TH>������:</TH><TD><?php echo $xpath?></TD></TR
></TABLE>
<HR WIDTH=50%>
<?php
//������������ ������ � ����������� ������
$ret='';
for($child=$document->firstChild;$child;
    $child=$child->nextSibling){ //�������� �� ������� ������
    if ($child->nodeType==XML_DOCUMENT_TYPE_NODE) continue;
    $ret.=shownodes($child,0);
}
echo utf8decode($ret);  //���������� ���������� ���������
?>
</BODY>
</HTML>
