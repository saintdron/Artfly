<?php ## ��������� html2html �������� HTML-��������
      ##  � ����������� ��� � ������� HTML
$document=new domDocument();
$document->loadHTMLFile('html1.html');
$document->formatOutput=true;
echo $document->saveHTML();
?>
