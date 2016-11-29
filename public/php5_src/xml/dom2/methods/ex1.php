<?php ## Пример программы генерации элементов с пространством имен
require_once 'unicode.inc';
require_once 'controls.inc';
$document=new domDocument('1.0',Encoding);
$root=$document->createElementNS($book,'book:book');
$document->appendChild($root);  //корневой элемент book
foreach($controls as $controlname => $sections) { 				//($controlname='if')
    //для всех описаний управляющих структур
    $tagname='book:'.$controlname; //имя структуры в области имен книги
    $control=$document->createElementNS($book,$tagname);
    $root->appendChild($control); //добавить заголовок описания
    foreach ($sections as $lang => $section) {//для каждой секции описания
	foreach ($section as $name => $text){//выделить секцию и описание
	    $qname="$lang:$name"; //квалифицированное имя               	(т.е. $gname='phpns:format')
	    $ns=$$lang; //область имен                                 		(т.е. $ns='phpns')
	    //создать элемент и добавить в него текст
	    $element=$document->createElementNS($ns,$qname);		//($ns=$phpns="http://www.nevod.ru/nevod/staff/kaf/php5")
	    $text=utf8encode($text);					//($text='if (условие) блок else блок')
	    $element->appendChild($document->createTextNode($text));
	    $control->appendChild($element);
	}
    }
}
$document->formatOutput=true;
echo $document->saveXML(); //вывести полученный документ
?>
