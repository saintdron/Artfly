<?php ## �������� ���� ����������.
// ���������������� ����������.
class HeadshotException extends Exception {}
// �������, ������������ ����������.
function eatThis() { throw new HeadshotException("bang-bang!"); }
// ������� � �����-�������������.
function action() {
  echo "���, ��� ����� ������, ";
  try {
    // ��������, ������� ������!
    eatThis();
  } catch (Exception $e) {
    // ����� ����� ����������, ������� �����...
    echo "����� � �����.<br>";
    // ...� ����� �������� ��� ���������� ������.
    throw $e;
  }
}
try {
  // �������� �������.
  action();
} catch (HeadshotException $e) {
  echo "��������, �� ������������: {$e->getMessage()}";
}
?>