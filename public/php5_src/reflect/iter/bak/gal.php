<?php ## ������ ������������� ����������: ������� ��������.
// ����������� �����: ������ �������� ������� (���������� ��� ����).
abstract class FilesystemEntry {
  // ���� � �������.
  public $path;
  // �����������.
  public function __construct($path) {
    $this->path = $path;
  }
}

// ��������.
class Image extends FilesystemEntry {
  // ���������� ���������� �� �����������.
  public function getInfo() {
    return getimagesize($this->path);
  }
}

// ������� (���������� � ����������). ��� �������� ���������� ���� ����������.
class Gallery extends FilesystemEntry implements IteratorAggregate {
  public $ext = array('gif', 'jpg', 'png', 'bmp');
  // �����������. ���������� ���������� ������-��������.
  public function __construct($path, $ext=null) {
    parent::__construct($path);
    if ($ext !== null) $this->ext = $ext;
  }
  // ���������� �������� - "�������������" ������� �������.
  public function getIterator() {
    return new GalleryIterator($this);
  }
}

class GalleryPage implements IteratorAggregate {
  // ���������� �������� - "�������������" ������� �������.
  public function getIterator() {
    return new GalleryIterator($this);
  }
}

// �����-��������. �������� �������������� ��� �������� Directory 
// ��� �������� ����������� ����������.
class GalleryIterator implements Iterator {
  // ������ �� "������-���������".
  private $owner;
  // ����� ������ � ���������� � ��������.
  private $entries = array();
  // ������� ����� �������� ��� ��������.
  private $n = 0;
  // �����������. �������������� ����� ��������.
  public function __construct($owner) {
    $this->owner = $owner;
    // ������� glob() �������� ����� ������, ���� ���� � ���������� 100000
    // ������. ��� ����������� ���, ��� �������� ������ (����� �������) ��
    // ����������� ����� (��� ���������� �����, �� ���������� �������).
    $this->entries = glob("{$owner->path}/*");
  }
  //*
  //* ����� ���� ��������������� ����������� ������� ���������� Iterator.
  //*
  // ���������� �������� �� ������ �������.
  public function rewind() {
    $this->n = 0;
  }
  // ���������, �� ����������� �� ��� ��������.
  public function valid() {
    return $this->n < count($this->entries);
  }
  // ���������� ������� ����.
  public function key() {
    return $this->entries[$this->n];
  }
  // ���������� ������� ��������.
  public function current() {
    $path = $this->entries[$this->n];
    return is_dir($path)? new Gallery($path) : new Image($path);
  }
  // ����������� �������� � ���������� �������� � ������.
  public function next() {
    $this->n++;
  }
}

// ��� ������� - ��������� ����������, � ������� ����� ��������.
$g = new Gallery("C:/windows");
foreach ($g->getPage(0, 20) as $path=>$entry) {
  if ($entry instanceof Image) {
    // ���� ��� - �����������, � �� �������������...
    echo "<pre>$path: ".print_r($entry->getInfo(), true)."</pre>";
  }
}
?>