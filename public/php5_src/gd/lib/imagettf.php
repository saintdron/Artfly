<?php ## ���������� �������� ������� ��� ������ � TTF.
// ������������ ������� imageTtfBBox(). �������� ���������
// ���� ��� ��������� ���� �������� $angle (�������� �������
// ��� ���� �������� �������).
function imageTtfBBox_fixed($size, $angle, $fontfile, $text) {
  // ��������� ������ ��� ������� ���� ��������.
  $horiz = imageTtfBBox($size, 0, $fontfile, $text);
  // ��������� ����� � ������� ���� ��������.
  $cos = cos(deg2rad($angle));
  $sin = sin(deg2rad($angle));
  $box = array();
  // ��������� ������� ������ ����������.
  for ($i=0; $i<7; $i+=2) {
    list ($x, $y) = array($horiz[$i], $horiz[$i+1]);
    $box[$i]   = round($x * $cos + $y * $sin);
    $box[$i+1] = round($y * $cos - $x * $sin);
  }
  return $box;
} 

// ��������� ������� �������������� � ��������������� � �������������
// ���������, � ������� ������ ��������� �����. �������������� ������ 
// ����� ���������:
// array(
//   0  => ������ ��������������,
//   1  => ������ ��������������,
//   2  => �������� ��������� ����� �� X ������������ ������ ��������
//         ���� ��������������,
//   3  => �������� ��������� ����� �� Y
// )
function imageTtfSize($size, $angle, $fontfile, $text) {
  // ��������� ������������ �������������.
  $box = imageTtfBBox_fixed($size, $angle, $fontfile, $text);
  $x = array($box[0], $box[2], $box[4], $box[6]);
  $y = array($box[1], $box[3], $box[5], $box[7]);
  // ��������� ������, ������ � �������� ��������� �����.
  $width  = max($x)-min($x);
  $height = max($y)-min($y);
  return array($width, $height, 0-min($x), 0-min($y));
}

// ������� ���������� ���������� ������ ������, ��������, ���
// ����� $text ����������� ������ ����������� � �������������
// ��������� ($width, $height).
function imageTtfGetMaxSize($angle, $fontfile, $text, $width, $height) {
  $min = 1;
  $max = $height;
  while (true) {
    // ������� ������ - ������� ����� ���������� � ���������.
    $size = round(($max + $min) / 2);
    $sz = imageTtfSize($size, $angle, $fontfile, $text);
    if ($sz[0] > $width || $sz[1] > $height) {
      // ����� ��������� ������������ ������ �� �� ���, ���� ����� �� 
      // "������������" �������������.
      $max = $size;
    } else {
      // ��������, ����� ����������� �����������, ���� ����� ����������. 
      $min = $size;
    }
    // ������� � �������� ������� ���� � �����.
    if (abs($max-$min) < 2) break;
  }
  return $min;
}

// ������� ����������� ����� �� ��������� iso8859-5 � Unicode-entities.
// �� ���������� �������� ����� �������� imageTtfText(), ����� ��������� 
// ���������� ������� �����. �������� $from ������ �������� ���������
// �������� (��. convert_cyr_string() ��� �������� �������� ���������).
function toUnicodeEntities($text, $from="w") { 
  $text = convert_cyr_string($text, $from, "i");
  $uni = ""; 
  for ($i=0, $len=strlen($text); $i<$len; $i++) { 
    $char = $text{$i}; 
    $code = ord($char); 
    $uni .= ($code>175)? "&#" . (1040+($code-176)) . ";" : $char; 
  } 
  return $uni; 
} 
?>