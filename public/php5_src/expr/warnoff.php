<?xml version="1.0"?>
<!--���������� ����������� �������������� -->
<form action="warnoff.php">
<input type=submit name="doGo" value="Click!">
</form>
<?php
// � ������� $_REQUEST ������ ���������� ��������� �� ����� ������.
if (filter_input(INPUT_GET, 'doGo')) {echo iconv("Windows-1251", "utf-8","�� ������ ������!");}

