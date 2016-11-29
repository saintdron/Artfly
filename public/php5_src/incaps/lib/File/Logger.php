<?php ## �����������.
// �����, ���������� ������� ������� ���� ��������.
class File_Logger {
  public $f;               // �������� ����
  public $name;            // ��� �������
  public $lines = array(); // ������������� ������
  public $t;
  // ������� ����� ���� ������� ��� ��������� �������� � �����
  // �������������. �������� $name - ���������� ��� �������.
  public function __construct($name, $fname) { 
    $this->name = $name;
    $this->f = fopen($fname, "a+"); 
    $this->log("### __construct() called!");
  }
  // ������������� ���������� ��� ����������� �������.
  // ��������� ���� �������.
  public function __destruct() {
    $this->log("### __destruct() called!");
    // ������� ������� ��� ����������� ������.
    fputs($this->f, join("", $this->lines));
    // ����� ��������� ����.
    fclose($this->f); 
  }
  // ��������� � ������ ���� ������. ��� �� �������� � ���� �����
  // ��, � ������������ � ����� � �������� ��� �� ������ __destruct().
  public function log($str) { 
    // ������ ������ ������������ ������� ����� � ������ �������.
    $prefix = "[".date("Y-m-d_h:i:s ")."{$this->name}] ";
    $str = preg_replace('/^/m', $prefix, rtrim($str));
    // ��������� ������.
    $this->lines[] = $str."\n";
  }
}
?>