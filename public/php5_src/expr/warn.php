<?xml version="1.0"?>

    <!--���������� ����������� �������������� -->
<form action="warn.php">
<input type=submit name="doGo" value="Click!">
</form>
<?php
//<!-- � ������� $_REQUEST ������ ���������� ��������� �� ����� ������.-->
if (@$_REQUEST['doGo']) echo "�� ������ ������!";
?>
