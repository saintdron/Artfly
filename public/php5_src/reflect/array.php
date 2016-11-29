<?php ## ������������� ����������� �������� PHP5.
/*
 * ����� ������������ ����� ������, ����� �������� ���������������
 * � �������� ��������. ��������, ����� "key", "kEy" � "KEY" � �����
 * ������ ������� ������ �������� ����������� (� ������� �� �����������
 * �������� PHP, � ������� ��� �����������).
 */
class InsensitiveArray implements ArrayAccess {
  // ����� ����� ������� ������ ��������� � ������ ��������.
  private $a = array();
  // ���������� true, ���� ������� $offset ����������.
  public function offsetExists($offset) { 
    $offset = strtolower($offset);  // ��������� � ������ �������
    $this->log("offsetExists('$offset')");
    return isset($this->a[$offset]);
  }
  // ���������� ������� �� ��� �����.
  public function offsetGet($offset) { 
    $offset = strtolower($offset);
    $this->log("offsetGet('$offset')");
    return $this->a[$offset]; 
  }
  // ������������� ����� �������� �������� �� ��� �����.
  public function offsetSet($offset, $data) { 
    $offset = strtolower($offset);
    $this->log("offsetSet('$offset', '$data')");
    $this->a[$offset] = $data;
  }
  // ������� ������� � ��������� ������.
  public function offsetUnset($offset) { 
    $offset = strtolower($offset);
    $this->log("offsetUnset('$offset')");
    unset($this->array[$offset]); 
  }
  // ��������� ������� ��� ������������ ������������.
  public function log($str) {
    echo "$str<br>";
  }
}
// ��������.
$a = new InsensitiveArray();
$a->log("## ������������� �������� (�������� =).");
$a['php'] = 'There is more than one way to do it.';
$a['pHp'] = '��� �������� ������ ������������ ������ �����������.';
$a->log("## �������� �������� �������� (�������� []).");
$a->log("<b>��������:</b> '{$a['PHP']}'");
$a->log("## ��������� ������������� �������� (�������� isset()).");
$a->log("<b>exists:</b> ".(isset($a['Php'])? "true" : "false"));
$a->log("## ���������� ������� (�������� unset()).");
unset($a['phP']);
?>