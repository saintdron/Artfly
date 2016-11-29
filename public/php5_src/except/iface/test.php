<?php ## ������������� �������� ����������.
require_once "exceptions.php";
try {
  printDocument();
} catch (IFileException $e) {
  // ������������� ������ �������� ����������.
  echo "�������� ������: {$e->getMessage()}.<br>";
} catch (Exception $e) {
  // �������� ���� ��������� ����������.
  echo "����������� ����������: <pre>", $e, "</pre>";
}
function printDocument() {
  $printer = "//./printer";
  // ���������� ���������� ����� IFileException � INetException.
  if (!file_exists($printer)) 
    throw new NetPrinterWriteException($printer);
}
?>