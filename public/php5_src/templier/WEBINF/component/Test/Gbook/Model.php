<?php ## ������ �������� �����.
class Test_Gbook_Model {
  // ��������� �������� ����� � �����. ���������� ���������� �����.
  function load($name) {
    $fname = "data/$name.dat";
    @mkdir(dirname($fname));
    if (!file_exists($fname)) return array();
    $Book = unserialize(file_get_contents($fname)); 
    return $Book;
  }
  // ��������� ���������� ����� �� �����.
  function save($name, $Book) {
    $fname = "data/$name.dat";
    $f = fopen($fname, "w");
    fwrite($f, serialize($Book));
    fclose($f);
  }
}
?>