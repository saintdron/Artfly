<?php ## ������ ������: �������� ���� � �������.
echo "<html><body>\n";
echo "<h2>��������� �������:</h2>";
$f = fopen("../news.txt", "r");
for ($i=1; !feof($f) && $i<=5; $i++) {
  echo "<li>$i-� �������: ".fgets($f, 1024);
}
echo "</body></html>\n";
?>