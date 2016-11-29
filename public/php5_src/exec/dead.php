<?php ## ������ �������� ����������.
Header("Content-type: text/plain");
// ���������� � ����������� �������.
$spec = array(
   0 => array("pipe", "r"),  // stdin
   1 => array("pipe", "w"),  // stdout
   2 => array("file", "/tmp/error-output.txt", "a") // stderr
);
// ��������� �������.
$proc = proc_open("cat", $spec, $pipes);
// ������ ����� ������ � $pipes[0] � ������ �� $pipes[1].
for ($i=0; $i<10000; $i++)
  fwrite($pipes[0], "Hello World #$i!\n");
fclose($pipes[0]);
while (!feof($pipes[1])) echo fgets($pipes[1], 1024);
fclose($pipes[1]);
// ��������� ����������.
proc_close($proc);
?>