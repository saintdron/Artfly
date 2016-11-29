<?php ## ��������� ��������� ��� ��������.
$numbers = array(100, 313, 605);
foreach ($numbers as &$v) $v++;
echo "�������� �������: ";
foreach ($numbers as $elt) {echo "$elt ";}

$a=['ds'=>'dsd','fewr'=>'dsdsa2'];
$b=serialize($a);
echo $b;
$с=unserialize($b);
var_dump($с);