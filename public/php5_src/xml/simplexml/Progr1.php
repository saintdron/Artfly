<?php ## ������ �������� ����� �������� � ��������� UTF-8
include 'unicode.inc';
$xml="<?xml version='1.0' encoding='UTF-8'?>
<���������>
  <MTV>����� MTV</MTV>
  <�����>����� �����</�����>
</���������>";

$prog=simplexml_load_string($xml);//�������� XML-���������
$mtv=$prog->MTV;//������� MTV 1-�� ������
echo utf8decode($mtv)."\r\n";

$mustv=$prog->�����;    //������� ����� 1-�� ������
echo utf8decode($mustv)."\r\n";
?>
