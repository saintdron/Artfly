<?php ## ����������� �����: ������-����.
require_once "ShapeA.php";
class Circle extends Shape {
  // ������ ����� � �������� 1:1.
  private $radius;
  // ������� ����� ������-���� � ��������� �������.
  public function __construct($radius=100) {
    $this->radius = $radius;
    parent::__construct();
  }
  // �������� ���� �� ������.
  public function show() {
    list ($x, $y) = $this->getCoord();
    $radius = $this->radius * $this->getScale();
    // ���������� "���������" ��� ���������� ����� ($x, $y, $radius).
    echo "������ ����: ($x, $y, $radius)<br>";
  }
  // ������� ������ � ������.
  public function hide() {
    list ($x, $y) = $this->getCoord();
    $radius = $this->radius * $this->getScale();
    // ���������� "���������" ��� �������� ����� ($x, $y, $radius).
    echo "������� ����: ($x, $y, $radius)<br>";    
  }
}
?>