<?php ## ������ ������� move13dom.php ������������� ���������� dom
$dom=new domDocument;
$dom->load('game.xml'); //��������� ��������
$game=$dom->documentElement;    //�������� �������
$move=$game->getAttribute('moves')+1; //������� moves ��������� ��������
$game->setAttribute('moves',$move); //���������� ����� ��������
foreach($game->childNodes as $l){//��� ���� �������� ���������
    if ($l->nodeName=='l1') {	 //������� ������� l1?
	foreach ($l->childNodes as $c){  //��� ���� �������� ���������
	    if ($c->nodeName=='c3') { //������� ������� c3?
		 //���������� ������� move � �������� ��������
		$c->setAttribute('move',$move);
		$c->firstChild->data='O';
	    }
	}
    }
}
echo $dom->saveXML();
?>
