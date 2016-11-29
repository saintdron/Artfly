<?php ## ��������� ���������� ������ � �������� �����.
require_once "Test/Gbook/Model.php";  // ���������� ������ (����)

class Test_Gbook_Add extends Subsys_Templier_Component {
  var $NEW_ELEMENT = "new";
  // ��������� ����������.
  function main($params) {
    // �������� �������� ���������, ����������� �� �������.
    $name = isset($params['book'])? $params['book'] : null;
    if (!$name) {
      $this->croak("parameter 'book' is not specified");
      return false;
    }
    // ���� ��������� ������� ����� ������� ������ ��������...
    if (!empty($_REQUEST['doAdd'])) {
      $new = $_REQUEST[$this->NEW_ELEMENT];
      $new['stamp'] = time();
      // �������� ������.
      $errors = $this->validate($new);
      if ($errors) return $errors;
      // ��������� ������.
      $Book = Test_Gbook_Model::load($name);
      $Book = array(time() => $new) + $Book;
      Test_Gbook_Model::save($name, $Book);
      // ���������� � Cookie ������ ���������� (�� ����������� ������).
      unset($new['text']); unset($new['stamp']);
      SetCookie("gbook", serialize($new), time()+3600*24*365, "/");
      // ��������� �����������������.
      Header("Location: http://{$_SERVER['HTTP_HOST']}{$_SERVER['SCRIPT_NAME']}?".time());
      exit();
    } else {
      // ���� ������ �� ������, ��������� ����� ����������� ����������.
      $data = @unserialize($_COOKIE['gbook']);
      $_POST[$this->NEW_ELEMENT] = $data;
      // ��� ������ �������� � INPUT-����� �������� ������������� -
      // �� ���� ����������� ���������� HTML_FormPersister.
    }
    // ������ ���.
    return array();
  }

  // ��������� ������������ ����� ������.
  function validate(&$new) {
    $errors = array();
    if (!trim($new['name'])) {
      $errors['name'] = true;
    }
    if (!trim($new['email'])) {
      $errors['email'] = true;
    }
    if (!trim($new['occupation'])) {
      $errors['occupation'] = true;
    }
    if (!trim($new['text'])) {
      $errors['text'] = true;
    }
    return $errors;
  }
}
?>