<?php ## ����������� E-mail � HTML-������.
$text = "������ �� somebody@mail.ru, � ����� �� other@mail.ru!";
$html = preg_replace(
  '/(\S+)@([a-z0-9.]+)/is',     // ����� ��� E-mail
  '<a href="mailto:$0">$0</a>', // �������� �� �� �������
  $text                         // ������ � $text
);
echo $html;
?>
