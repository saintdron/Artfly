<?php ## ���������� try �� ��������� ��������.
echo "������ ���������.<br>";  
try { 
  echo "������ try-�����.<br>";
  outer(); 
  echo "����� try-�����.<br>";  
} catch (Exception $e) { 
  echo " ����������: {$e->getMessage()}<br>";
} 
echo "����� ���������.<br>";  
function outer() { 
  echo "����� � ������� ".__METHOD__."<br>";
  inner(); 
  echo "����� �� ������� ".__METHOD__."<br>";  
} 
function inner() { 
  echo "����� � ������� ".__METHOD__."<br>";
  throw new Exception("Hello!");
  echo "����� �� ������� ".__METHOD__."<br>";  
}
?>