<?php ## �������� ��������� �� ��������� ������.
// �����, ������������ ���� �����.
class Father {
  // ������ �����, ����� ����� �������� ������� - ������.
  public $children = array();
  // ������� ��������� � ������ ����������� �������.
  function __destruct() { echo "Father ����.<br>"; }
}
// ������� ���������� ����.
class Child {
  // ��� ���� ����� �������?
  public $father;
  // ������� ������ ������� (� ��������� ��� ����).
  function __construct(Father $father) { $this->father = $father; }
  function __destruct() { echo "Child ����.<br>"; }  
}
// ��� �� ��� ������.
$father = new Father;
// ������ ����� ������.
$child = new Child($father);
// ...� �������� ��� �� ����� ����������.
$father->children[] = $child;
echo "���� ��� ��� ����... ������� ����.<br>";
// ������ �����, � ��� ������.
$father = $child = null;
echo "��� ������, ����� ���������.<br>";
// �� ��������� �������, ��� �������� �����!
?>