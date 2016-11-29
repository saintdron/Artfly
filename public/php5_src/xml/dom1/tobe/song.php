<?php ## ������ �������������� XML-����� ����� �����
require_once 'unicode.inc';
require_once 'formcouplets.inc';
require_once 'formRefrain.inc';
require_once 'formsong.inc';

$songdoc=new domDocument('1.0',Encoding);
$songdoc->substituteEntities=true;      //���������� �����������
$songdoc->preserveWhiteSpace=false;     //������������ �������
$songdoc->load('song.xml');             //��������� XML-����

//������� ��������� doctype �� �������������
$songdoc->removeChild($songdoc->doctype);

$song=$songdoc->documentElement;        //��������� �������� ������� �����
//������� �� ������ ���� ���������, �������� ��� � ���������� $draft
//� ��������� �������� ������ ����� ��������
$draft=$song->removeChild($song->childNodes->item(0));
$Refrain=$draft->childNodes->item(0); //��������� ������
$refrain=$draft->childNodes->item(1); //��������� �������
$couplets=$draft->childNodes->item(2);//��������� ��������� ��������

formRefrain($Refrain);  //������������� ������
form�ouplets($couplets,$refrain); //������������� ��������� ��������
formsong($song,$couplets,$Refrain); //������������ �����

$songdoc->formatOutput=TRUE;
$songdoc->save('SONG.xml');
?>
