<?php ## ��������� ������ �������� ����� (shopswalk.php)
require_once 'unicode.inc';
require_once "wallet.class";
require_once "order.class";
require_once "shops.class";

$wallet=new wallet();
$order=new order();
$shops=new shops($argv[1]);//�������� ��������, ����� � ������ ���������

$shops->walk($order,$wallet);//�������� �� ���������

//��������� ����� ��������� ���������, ������ � ���������
$wallet->save();
$order->save();
$shops->save();
?>
