<?php ## ��������� ������ �������� �����.
require_once "Test/Gbook/Model.php";  // ���������� ������ (����)

class Test_Gbook_Show extends Subsys_Templier_Component {
  // ����� ����� ����������.
  function main($params) {
    // �������� �������� ���������, ����������� �� �������.
    $name = isset($params['book'])? $params['book'] : null;
    if (!$name) {
      $this->croak("parameter 'book' is not specified");
      return false;
    }
    $Book = Test_Gbook_Model::load($name);
    return $Book;
  }
}
?>