<?php ## �������� XML-��������� ������� loadXML()
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
// ��������� ������ �������� �� XML-���������
$domdocument->loadXML($xmldocument);
?>
