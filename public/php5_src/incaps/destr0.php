<?php ## ����� ������������ ��������.
require_once "lib/config.php"; 
require_once "File/Logger0.php";
// ������� � ����� ����� �������� File_Logger0.
for ($n=0; $n<10; $n++) {
  $logger = new File_Logger0("test$n", "test.log");
  $logger->log("Hello!");
  // ����������, ��� �� �������� ������ ������� close().
#  $logger->close();
}
?>