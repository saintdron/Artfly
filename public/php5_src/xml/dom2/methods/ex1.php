<?php ## ������ ��������� ��������� ��������� � ������������� ����
require_once 'unicode.inc';
require_once 'controls.inc';
$document=new domDocument('1.0',Encoding);
$root=$document->createElementNS($book,'book:book');
$document->appendChild($root);  //�������� ������� book
foreach($controls as $controlname => $sections) { 				//($controlname='if')
    //��� ���� �������� ����������� ��������
    $tagname='book:'.$controlname; //��� ��������� � ������� ���� �����
    $control=$document->createElementNS($book,$tagname);
    $root->appendChild($control); //�������� ��������� ��������
    foreach ($sections as $lang => $section) {//��� ������ ������ ��������
	foreach ($section as $name => $text){//�������� ������ � ��������
	    $qname="$lang:$name"; //����������������� ���               	(�.�. $gname='phpns:format')
	    $ns=$$lang; //������� ����                                 		(�.�. $ns='phpns')
	    //������� ������� � �������� � ���� �����
	    $element=$document->createElementNS($ns,$qname);		//($ns=$phpns="http://www.nevod.ru/nevod/staff/kaf/php5")
	    $text=utf8encode($text);					//($text='if (�������) ���� else ����')
	    $element->appendChild($document->createTextNode($text));
	    $control->appendChild($element);
	}
    }
}
$document->formatOutput=true;
echo $document->saveXML(); //������� ���������� ��������
?>
