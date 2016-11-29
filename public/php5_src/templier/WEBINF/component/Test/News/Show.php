<?php ## ��������� ������ ��������.
class Test_News_Show extends Subsys_Templier_Component {
  // ����� ����� ����������.
  function main($params) {
    // �������� �������� ���������, ����������� �� �������.
    $file = isset($params['file'])? $params['file'] : null;
    if (!$file) {
      $this->croak("parameter 'file' is not specified");
      return false;
    }
    $num  = isset($params['num'])? $params['num'] : 5;
    // ���������� ������ $num �������� � �����. ������ ������,
    // ���� ������� ������ ���������� ������ ��������, ������ ���
    // �������� ����� �� ��������� ��� ��������������� � ����������.
    $result = array();
    $f = @fopen($file, "r");
    if (!$f) {
      $this->croak("could not find $file");
      return false;
    }
    for ($i=0; !feof($f) && $i < $num; $i++) {
      $n = trim(fgets($f, 1024));
      if (!$n) continue;
      list ($date, $text) = preg_split('/\s+/', $n, 2);
      $result[] = array(
        'date' => $date,
        'text' => $text,
      );
    }
    // ��������� ������ ������ ������� ��������� ����� ������.
    return $result;
  }
  // ����� ����� ���� � ������ (���������������) ������.
}
?>