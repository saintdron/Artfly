<?php ## �������� ��������� @.
if (@$_REQUEST['submit']) echo "������ ������!"
?>
<form action="<?=$_SERVER['SCRIPT_NAME']?>">
<input type="submit" name="submit" value="Go!">
</form>
