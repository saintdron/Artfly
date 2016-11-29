<?php ## ����� ������� �������������� ������� DOM
$head='��������� ������� DOM � '. phpversion();?>
<HTML>
<HEAD><TITLE><?php echo $head?></TITLE>
<BODY>
<CENTER><H4><?php echo $head?></H4></CENTER>
<?php
require_once 'unicode.inc';
require_once 'countdepth.inc';
$dom=new domDocument();
$dom->preserveWhiteSpace=false;
$dom->load('modules.xml');//��������� XML-���� �������� DOM-�������

$depth=countDepth($dom->documentElement,0);//���������� �������

require_once 'featurestable.class';
$table=new featuresTable(); //������� TABLE
$table->leftHead($depth); //������� ��������� �������
$table->rightHead($depth);
include 'formrow.inc';
formRow($dom->documentElement,0); //������� ������ �������
unset($table);
?>
</BODY></HTML>
