<?php ## ������ ������ � fopen wrappers.
echo "<h1>������ �������� (HTTP):</h1>";
echo file_get_contents("http://php.net");
echo "<h1>������ �������� (FTP):</h1>";
echo file_get_contents("ftp://ftp.aha.ru/");
?>