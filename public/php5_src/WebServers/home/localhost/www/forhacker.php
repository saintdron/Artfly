<?php ## ������, ������� ���������� � ������.
die("������� ��� �������, ���� ������������� ������ ��������� ������!");
if ($type = @$_REQUEST['type']) {
  $fname = "$type.txt";
  if ($f = @fopen($fname, "r")) {
    $content = fread($f, filesize($fname));
  }
}
?>
<html>
<body>
  <form name="<?php echo $_ENV["SCRIPT_NAME"]?>">
    ��������: 
    <select name="type">
      <option value="site">������� �����</option>
      <option value="world">������� �������</option>
      <option value="weather">������� ������</option>
    </select><br/>
    <input type=submit value="����������� �������" />
  </form>
  <?php if (@$content) echo "<hr/>$content" ?>
</body>
</html>