<?php ## ������ ������ � TTF-�������.
require_once "lib/imagettf.php";
// ��������� ������. 
// ��������! ��� ����������� ������� ���� ���������� ��
// ���������� �� � ��������� Windows, � � Unicode!
$string = toUnicodeEntities("������, ���!");
// �����.
$font = getcwd()."/times.ttf";
// ��������� ������� �������.
$im = imageCreateFromPng("sample02.png");
// ���� �������� ������� �� �������� �������.
$angle = (microtime(true)*10)%360;
// ���� ������, ����� ����� ��� �� ���� � ����, ���������������� �������:
# $angle = rad2deg(atan2(imageSY($im), imageSX($im)));
// ��������� ������ ������ ��� ������ �����������.
$size = imageTtfGetMaxSize(
  $angle, $font, $string, 
  imageSX($im), imageSY($im)
);
// ������� � ������� ����� �����
$shadow = imageColorAllocate($im, 0, 0, 0);
$color  = imageColorAllocate($im, 128, 255, 0);
// ��������� ���������� ������, ����� ����� �������� � ������.
$sz = imageTtfSize($size, $angle, $font, $string);
$x = (imageSX($im) - $sz[0]) / 2 + $sz[2];
$y = (imageSY($im) - $sz[1]) / 2 + $sz[3];
// ������ ������ ������, ������� ������ �� �������, � ����� - 
// �������� ������ ������ (����� ������� ������ ����).
imageTtfText($im, $size, $angle, $x+3, $y+2, $shadow, $font, $string);
imageTtfText($im, $size, $angle, $x, $y, $color, $font, $string);
// �������� � ���, ��� ����� ������� ������� PNG.
Header("Content-type: image/png");
// ������� �������
imagePng($im);
?>