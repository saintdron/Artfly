<?php ## �������� ��������� ������ �������.
// ������������� �������� � ����� 1.
ob_start();         
  // ��������� ����� ������� � 1-� �����.
  echo "From delusion lead me to truth.<br>\n";  
  // ����������� �� ����� ����� 1 � ������������ ������.
  ob_start();         
    // ����� ������� � ����� 2.
    echo "From death lead me to immortality.<br>\n";
    // �������� ����� �� ������ ������.
    $second = ob_get_contents(); 
  // ��������� (��� ������ � �������) ����� 2 � ������������ ������.
  ob_end_clean();     
  // ������� ����� � ����� 1.
  echo "From darkness lead me to light.<br>\n";  
  // �������� ����� � ������ ������.
  $first = ob_get_contents(); 
// �.�. ��� ��������� �����, ����������� �����������.
ob_end_clean(); 
// ������������ ������ ��� ����� "���������" ������.
$first  = preg_replace('/^/m', '&nbsp;&nbsp;', trim($first));
$second = preg_replace('/^/m', '&nbsp;&nbsp;', trim($second));
// ������������� �������� �������, ������� �� ��������� � �������.
echo "<i>���������� ������� ������:</i><br>$first";
echo "<i>���������� ������� ������:</i><br>$second";
?>