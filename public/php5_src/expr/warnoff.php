<?xml version="1.0"?>
<!--Отключение навязчивого предупреждения -->
<form action="warnoff.php">
<input type=submit name="doGo" value="Click!">
</form>
<?php
// В массиве $_REQUEST всегда содержатся пришедшие из формы данные.
if (filter_input(INPUT_GET, 'doGo')) {echo iconv("Windows-1251", "utf-8","Вы нажали кнопку!");}

