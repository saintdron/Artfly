<?php ## ����������� � ����������.
// �����, �������������� �������� �� ����� ��������.
class Orator {
  private $name;
  function __construct($name) {
    $this->name = $name;
    echo "������ ������ {$this->name}.<br>";
  }
  function __destruct() {
    echo "��������� ������ {$this->name}.<br>";  
  }
}
function outer() { 
  $obj = new Orator(__METHOD__);
  inner(); 
} 
function inner() { 
  $obj = new Orator(__METHOD__);
  echo "��������, �����������!<br>";
  throw new Exception("Hello!");
}
// �������� ���������.
echo "������ ���������.<br>";  
try { 
  echo "������ try-�����.<br>";
  outer(); 
  echo "����� try-�����.<br>";  
} catch (Exception $e) { 
  echo " ����������: {$e->getMessage()}<br>";
} 
echo "����� ���������.<br>";  
?>