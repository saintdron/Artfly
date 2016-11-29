<?php ## "������" ���������� ������������.
// ������� ���������� "�������" �����.
require_once "File/Logger.php";
// �����, ����������� � File_Logger ����� ����������������.
class File_Logger_Debug0 {
  // ������ "��������" ������ File_Logger.
  private $logger; 
  // ����������� ������ ������. ������� ������ File_Logger.
  public function __construct($name, $fname) { 
    $this->logger = new File_Logger($name, $fname);
    // ����� ����� ������������������� ������ �������� ��������
    // ������, ���� ��� �����.
  }
  // ��������� ����� �����.
  public function debug($s, $level=0) {
    $stack = debug_backtrace();
    $file = basename($stack[$level]['file']);
    $line = $stack[$level]['line'];
    $this->logger->log("[at $file line $line] $s");
  }
  // ��������� �� ����� ������ ����� log().
  public function log($s) { return $this->logger->log($s); }
  // � ����� ������-���������� �� ������ ������� ��� �������
  // ������ �� File_Logger.
}
?>