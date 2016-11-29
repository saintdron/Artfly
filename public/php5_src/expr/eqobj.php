<?php ## Операторы равенства и эквивалентности.
class AgentSmith {}
$smit = new AgentSmith();
$wesson = new AgentSmith();
if ($smit == $wesson) echo iconv("Windows-1251", "UTF-8", "Объекты равны.");
if ($smit === $wesson) echo iconv("Windows-1251", "UTF-8", "Объекты эквивалентны.");
?>
