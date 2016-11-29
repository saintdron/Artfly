<?php ## �������� virtual() � CGI-������ PHP.
// ������� virtual() �� ��������������?
if (!function_exists("virtual")) {
  // ����� ���������� ����.
    echo "67";
  function virtual($uri) {
    $url = "http://".$_SERVER["HTTP_HOST"].$uri;
    echo join("", file($url));
  }
}
// ������ - ������� �������� �������� �����.
virtual("/");
?>