<?php ## ��������� testsaveXML.php ������ XML-��������� � ���������
      ## � ������ ���������
require_once "unicode.inc";
$domdocument=new domDocument('1.0',Encoding);
$xmldocument=XMLHead.
"<HTML>
<HEAD>
<TITLE>������ XML-���������</TITLE>
</HEAD>
<BODY>
<H1>������ XML-��������� </H1>
<IMG SRC='picture1.gif' ALT='�������� 1' />
<IMG SRC='picture2.gif' ALT='�������� 2' />
</BODY>
</HTML>
";
$domdocument->preserveWhiteSpace=false; //��������� ���������� �������
$domdocument->loadXML($xmldocument); // ��������� ������ �������� �� XML-���������

echo "����� ��������� � ��������� KOI8-R � ���������:\r\n";
$domdocument->formatOutput=true;
$domdocument->encoding='KOI8-R';
echo $domdocument->saveXML(); //������� �������� � ���������
echo "\r\n";

echo "����� ��������� � ��������� WINDOWS-1251 ����� �������:\r\n";
$domdocument->encoding='WINDOWS-1251';
$domdocument->formatOutput=false;
echo $domdocument->saveXML();
?>
