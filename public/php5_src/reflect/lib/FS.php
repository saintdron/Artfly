<?php ## ������ ����������� ���������.
/**
 * ����������. ��� �������� ���������� ���� ����������.
 */ 
class FS_Directory implements IteratorAggregate {
  public $path;
  // �����������.
  public function __construct($path) {
    $this->path = $path;
  }
  // ���������� �������� - "�������������" ������� �������.
  public function getIterator() {
    return new FS_DirectoryIterator($this);
  }
}

/**
 * �����-��������. �������� �������������� ��� �������� FS_Directory
 * ��� �������� ����������� ��������.
 */ 
class FS_DirectoryIterator implements Iterator {
  // ������ �� "������-���������".
  private $owner;
  // ���������� �������� ����������.
  private $d = null;
  // ������� ��������� ������� ����������.
  private $cur = false;
  // �����������. �������������� ����� ��������.
  public function __construct($owner) {
    $this->owner = $owner;
    $this->d = opendir($owner->path);
    $this->rewind();
  }
  //*
  //* ����� ���� ��������������� ����������� ������� ���������� Iterator.
  //*
  // ������������� �������� �� ������ �������.
  public function rewind() {
    rewinddir($this->d);
    $this->cur = readdir($this->d);
  }
  // ���������, �� ����������� �� ��� ��������.
  public function valid() {
    // readdir() ���������� false, ����� �������� �������� �����������.
    return $this->cur !== false;
  }
  // ���������� ������� ����.
  public function key() {
    return $this->cur;
  }
  // ���������� ������� ��������.
  public function current() {
    $path = $this->owner->path."/".$this->cur;
    return is_dir($path)? new FS_Directory($path) : new FS_File($path);
  }
  // ����������� �������� � ���������� �������� � ������.
  public function next() {
    $this->cur = readdir($this->d);
  }
}

/**
 * ����.
 */ 
class FS_File {
  public $path;
  // �����������.
  public function __construct($path) {
    $this->path = $path;
  }
  // ���������� ���������� �� �����������.
  public function getSize() {
    return filesize($this->path);
  }
  // ����� ����� ���� ������ ������.
}
?>