<?php ## ����� ��������� �����.
setlocale(LC_ALL, '');
$mtime = filemtime(__FILE__);
echo "��������� ��������� ��������: ".date("Y-m-d H:i:s", $mtime);
chmod(__FILE__, '0755');
echo "<br />".decoct(fileperms(__FILE__));
?>