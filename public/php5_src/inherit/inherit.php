<?php ## �������� ������ File_Logger_Debug0.
require_once "lib/config.php"; 
require_once "File/Logger/Debug.php";
$logger = new File_Logger_Debug("test.log");
$logger->log("������� ���������");
$logger->debug("���������� ���������");
?>