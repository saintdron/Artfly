<?php ## ��������� html2xhtml �������� HTML-��������
      ##  � ����������� ��� � ������� XML
$document=new domDocument();
$document->loadHTMLFile('html1.html');
$document->formatOutput=true;
echo $document->saveXML();
?>
