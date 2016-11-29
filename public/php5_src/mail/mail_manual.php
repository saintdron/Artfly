<?php ## ������� ����� �������, ����� SMTP-������ ����������.
// ���������� �������� ������� getmxrr().
include_once "../net/getmxrr.php";
// ���������� ��������� �������.
include_once "lib/template.php";
include_once "lib/mailenc.php";
include_once "lib/mailx.php";
include_once "lib/socketmail.php";

$mail = template("mail.php.eml", array(
  "to"   => "���-�� ����� �������� <somebody@thematrix.com>", 
  "text" => "�������� �����!"
));
$mail = mailenc($mail);
mailx_manual($mail, $reason)
  or die("Errors:<br>".join("<br>", $reason));
echo "����� ��������.";
?>