<?php ## ��������������� ����� ��� "������" ������������.
require_once "lib/config.php"; 
require_once "File/Logger/Debug0.php";
$logger = new File_Logger_Debug0("test", "test.log");
// �������� ��, ��� ����� - ���, ��� ����� File_Logger,
// "�����" � File_Logger_Debug0...
croak($logger, "Hasta la vista.");
// ������� ��������� �������� ���� File_Logger.
function croak(File_Logger $l, $msg) {
  $l->log($msg);
  exit();
}
?>