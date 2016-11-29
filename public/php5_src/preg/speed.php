<?php ## ��������� �������� PCRE � POSIX.
$re = "a(((((.*)*)*)*)*)*b";
$st = "abcdefgh";
// ��������� �������� PCRE (���).
$t = microtime(true);
$result = preg_match("/$re/", $st);
printf("PCRE($result): %.2f c<br>", microtime(true)-$t);
// ��������� �������� POSIX (���).
$t = microtime(true);
$result = ereg($re, $st);
printf("POSIX($result): %.2f c<br>", microtime(true)-$t);
?>