<?php ## ������������ PHP_OutputBuffering::__toString().
require_once "lib/config.php"; 
require_once "PHP/OutputBuffering.php";
// ������������� �������� ����� � ���������.
$h1 = new PHP_OutputBuffering();
  // ������� ��������� �����.
  echo "����� � ������ ������.";
  // ��� ��� ������������� �������� ����� (��������� �������).
  $h2 = new PHP_OutputBuffering();
    // ������� ������ ����� �����.  
    echo "����� �� ������ ������.";
    // ������ ��������� � ����������, ��� ���� ��������� � �������.
    $first  = $h1->__toString();
    $second = $h2->__toString();  
  // ���������� ������ �����.  
  $h2 = null;
// ���������� ������ �����.  
$h1 = null;
// ������� ����������� ����� �����.
echo "1: $first<br>";
echo "2: $second<br>";
?>