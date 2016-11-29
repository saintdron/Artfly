<?php ## ���������� �������� �� ������������.
$tile = imageCreateFromJpeg("sample1.jpg"); 
$im   = imageCreateTrueColor(800, 600); 
imageFill($im, 0, 0, imageColorAllocate($im, 0, 255, 0));
imageSetTile($im, $tile);
// ������� ������ ����� �� ���������� ������������.
$p = array();
for ($i=0; $i<4; $i++) {
  array_push($p, mt_rand(0, imageSX($im)), mt_rand(0, imageSY($im)));
}
// ������ ����������� �������������.
imageFilledPolygon($im, $p, count($p)/2, IMG_COLOR_TILED); 
// ������� ���������.
Header("Content-type: image/jpeg");
// ������� �������� � ������������ ��������� (100).
imageJpeg($im, '', 100);
// ����� ���� ����� � ������� PNG.
#Header("Content-type: image/png");
#imagePng($im);
?>
