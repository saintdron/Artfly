<?php ## ���������� �������������.
require_once "lib/config.php";
require_once "Subsys/Templier/ApacheHandler.php";
require_once "Subsys/Templier/Smarty.php";
# �������� ��� ������ ���������� Subsys_Templier_ApacheHandler.
$handler = new Subsys_Templier_ApacheHandler("Subsys_Templier_Smarty");
$handler->processRequest();
?>