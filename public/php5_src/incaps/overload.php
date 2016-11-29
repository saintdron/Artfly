<?php ## �������� ��������� � ������ ������.
class Hooker {
  // ������� �������� ������.
  public  $opened = 'opened';
  // ������� ����� ������.
  public function method() { echo "Whoa, deja vu.<br>"; }
  // � ���� ������� ����� ��������� ��� "�����������" ��������.
  private $vars   = array();  
  // �������� ��������� �������� ��������.
  public function __get($name) {
    echo "��������: �������� �������� $name.<br>";
    // ���������� null, ���� "�����������" �������� ��� �� ����������.
    return isset($this->vars[$name])? $this->vars[$name] : null;
  }
  // �������� ��������� �������� ��������.
  public function __set($name, $value) {
    echo "��������: ������������� �������� $name ������ '$value'.<br>";  
    //����� ������� �������� ������� �������.
    return $this->vars[$name] = trim($value);
  }
  // �������� ������ ��������������� ������.
  public function __call($name, $args) {
    echo "��������: �������� $name � �����������: ";
    var_dump($args);
    return $args[0];
  }
}
// ����������� ������ ������.
$obj = new Hooker();
echo "<b>�������� �������� �������� ��������.</b><br>";
echo "��������: {$obj->opened}<br>";
echo "<b>�������� ������� �����.</b><br>";
$obj->method();
echo "<b>������������ ��������������� ��������.</b><br>";
$obj->nonExistent = 101;
echo "<b>��������� �������� ��������������� ��������.</b><br>";
echo "��������: {$obj->nonExistent}<br>";
echo "<b>��������� � ��������������� ������.</b><br>";
$obj->nonExistent(6);
?>
