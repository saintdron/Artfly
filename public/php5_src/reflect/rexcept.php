<?php ## �������� ���������� ���������.
try {
  $obj = new ReflectionFunction("spoon");
} catch (ReflectionException $e) {
  echo "����������: ", $e->getMessage();
}
?>