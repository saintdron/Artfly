<?php ## ����������� ���������� GZip-������.
require_once "lib/config.php"; 
// ������� ������ ������������� �������� Cookie page_size_after.
function ob_saveCookieAfter($s) { 
  setcookie("page_size_after", strlen($s));
  return $s; 
}
// ����������, �� ��� Cookie page_size_before.
function ob_saveCookieBefore($s) { 
  setcookie("page_size_before", strlen($s));
  return $s; 
}
// ������������� �������� ������������.
ob_start("ob_saveCookieAfter");
ob_start("ob_gzhandler", 9);
ob_start("ob_saveCookieBefore");
// ������ ����� �������� ����� ����� - �� ����� ����.
?>
<!-- ������� ���������� � ������ (� ��������� �������). -->
<b><?include "gz.htm"?></b><hr>
<!-- ������� ����� ��������. -->
<pre>
<?=file_get_contents("../preg/largetextfile.txt")?>
</pre>