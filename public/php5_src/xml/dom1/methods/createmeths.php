<?php ## ������ ������������� ������� ������ domDocument
      ##  � ������������� ������

require_once 'unicode.inc';
$listNodes=Array(
  "Element"		 => Array("string tagName"=>"��� ����"),
  "DocumentFragment"	 => Array(),
  "TextNode"		 => Array("string data"=>"�����"),
  "Comment"		 => Array("string data"=>"����� �����������"),
  "CDATASection"	 => Array("string data"=>"����� ������"),
  "ProcessingInstruction"=> Array("string target"=>"��� ����������",
				  "string data"=>"����� ������ ����������"),
  "Attribute"		 => Array("string name"=>"��� ��������"),
  "EntityReference"	 => Array("string name"=>"��� ����������")
);

$domdocument=new domDocument('1.0',Encoding);   //��������

$tablenode=$domdocument->createElement('table');//�������� �������
$domdocument->appendChild($tablenode);  //�������� � ���������

$comment=utf8encode('��������� �������');   //�����������
$tablenode->appendChild($domdocument->createComment($comment));

$trnode=$domdocument->createElement('tr');
$tablenode->appendChild($trnode);       //������ ���������

$heads=Array('����� ������ domDocument','����������� new','���������');
foreach($heads as $head) {//������������ ���� TH ���������
    $thnode=$domdocument->createElement('th');
    $trnode->appendChild($thnode);
    $textnode=$domdocument->createTextNode(utf8encode($head));
    $thnode->appendChild($textnode);
}

$comment=utf8encode('���� �������');
$tablenode->appendChild($domdocument->createComment($comment));
foreach ($listNodes as $node => $pars){  //�� ���� ����� �����
    $comment=utf8encode("���� $node");
    $tablenode->appendChild($domdocument->createComment($comment));

    //������ �������� ������, ������, ����������
    $trnode=new domElement('tr');
    $tablenode->appendChild($trnode);

    $method="create$node()";
    //��� ������ ��� ������� createTextNode �
    // createAttribute ����������� ������������
    $new=($node=='TextNode'?'domText()':
		($node=='Attribute'?'domAttr':"dom$node()"));

    foreach (Array($method,$new) as $funcname) {  //������� ������ � ������
	$tdnode=new domElement('td');
	$trnode->appendChild($tdnode);
	$text=new domText(utf8encode($funcname));
	$tdnode->appendChild($text);    //�������� ��� �������
    }

    $tdnode=new domElement('td');       //������� �������� ����������
    $trnode->appendChild($tdnode);
    $i=0;$n=count($pars);$content='';
    foreach($pars as $par => $descr) {	 //�� ���� ����������
	//������������ ��������� ����: "��������" " - " "��������"
	$tdnode->appendChild(new domText(utf8encode($par)));
	$tdnode->appendChild(new domText(" - "));
	$tdnode->appendChild(new domText(utf8encode($descr)));
	if (++$i < $n)  //���� �� ��������� �������� �������� ��� BR
	    $tdnode->appendChild(new domElement('br'));
    }
}

$domdocument->formatOutput=true;
$tablexml=utf8decode($domdocument->saveXML($tablenode));
echo $tablexml; //������� XHTML ����� �������
?>
