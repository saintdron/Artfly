<?php ## �������� ����� �� ������� (��� �����������).
// ���������� ������� mailx() (��. ����).
include_once "lib/mailx.php";
// ���� ����� ����� ���� �������, ��������, �� ���� ������,
// ��� �������� ���������� ������ ��� �������� �����.
$text = "Cookies need love like everything does.";
// ���������� ������.
$tos = array("a@mail.ru", "b@mail.ru");
// ��������� ������.
$tpl = file_get_contents("mail.eml");
// ���������� ������ � ����� �� �����������.
foreach ($tos as $to) {
  // �������� �������� �������.
  $mail = $tpl;
  $mail = strtr($mail, array(
    "{TO}"   => $to,
    "{TEXT}" => $text,
  ));
  // �������� mailx(), ���������� �� �����.
  mailx($mail);
}
?>