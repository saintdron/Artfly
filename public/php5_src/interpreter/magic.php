<?php ## ����������� ��������� ������� magic_quotes_gpc.
// ������ ���-������, ���� ������ ������ Go!
if (!isset($_REQUEST['name'])) 
  $_REQUEST['name'] = '�������� "�� ���������"';
?>
<form action="<?=$_SERVER['SCRIPT_NAME']?>">
<input type="text" name="name" size="40"
  value="<?=htmlspecialchars($_REQUEST['name'])?>"> 
<input type="submit" name="submit" value="Go!">
</form>
