<?php ## ������������� ������������ �����������.
// ��������: "������������ ������".
interface IWorldObject {
  public function getCoord();  // ���������� ���������� �������
  // �������� ��������, ���� ������ �� �����������!
}
// ��������: "���������� � ��������".
interface IWheeled {
  public function getNumWheels(); // ���������� ����� �����
}
// ��������: "������������ ��������". ��������: ��� ���������� 
// ����������� ����� ������������ �������� ����� extends, � �� 
// implements! �������, ��������� ������������� ����������.
interface ITransport extends IWorldObject {
  public function getNumPassengers(); // ����������� ����� ����������
}
// "���������" - ���: ������������ �������� � ��������, ������������
// � ������������ ����.
class Zaporojets implements ITransport, IWheeled, IWorldObject {
  private $coordArray;
  public function getCoord() { return $coordArray; }
  public function getNumWheels() { return 4; }
  public function getNumPassengers() { return 16; }
  // ����� ����� ���������� �����������, ���������� � ������ ������.
}
?>
